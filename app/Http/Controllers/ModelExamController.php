<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModelExamRequest;
use App\Http\Requests\UpdateModelExamRequest;
use App\Jobs\OnMcqSubmit;
use App\Models\ExamCategory;
use App\Models\ExamTopic;
use App\Models\McqMarkingDetail;
use App\Models\McqQuestion;
use App\Models\McqTotalResult;
use App\Models\ModelExam;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ModelExamController extends Controller
{
    /**
     * Load index page to view and create new model exam
     * @return Application|Factory|View
     */
    public function index()
    {
        $exam_categories = ExamCategory::get();
        $exams = ModelExam::query()->with('category')->with('topic')->paginate(5);

        return view('admin.pages.model_exam.exam.index', compact('exam_categories','exams'));
    }

    /**
     * Store New model exam data
     * @param CreateModelExamRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateModelExamRequest $request)
    {
        $inputs = $request->validated();
        if($request->hasFile('solution_pdf')) {
            $filename = str_replace(' ', '_', $request->title).'_'.Carbon::today()->toDateString().'.pdf';
            $path = $request->file('solution_pdf')->storeAs(
                'solutionPdf', $filename, 'public'
            );
            $inputs['solution_pdf'] = $filename;
        }

        ModelExam::query()->create($inputs);

        return redirect()->back()->with('status','Exam Created Successfully');

    }

    public function edit($examId)
    {
        $exam = ModelExam::query()->where('id',$examId)->with('topic')->with('category')->first();
        $exam_topics = ExamTopic::query()->where('exam_category_id', $exam->exam_category_id)->get();
        return view('admin.pages.model_exam.exam.edit', compact('exam','exam_topics'));
    }


    public function update(UpdateModelExamRequest $request, $examId)
    {
        $inputs = $request->validated();

        if($request->hasFile('solution_pdf')) {

            $filename = str_replace(' ', '_', $request->title).'_'.Carbon::today()->toDateString().'.pdf';
            $path = $request->file('solution_pdf')->storeAs(
                'solutionPdf', $filename, 'public'
            );
            $inputs['solution_pdf'] = $filename;
        }

        ModelExam::query()->where('id',$examId)->update($inputs);

        return redirect()->back()->with('status','Exam Updated Successfully');
    }

    /**
     * Delete Specific model exam
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        ModelExam::query()->find($id)->delete();

        return redirect()->back()->with('status','Exam Deleted Successfully');
    }

    /**
     * Get topic list by category id
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopicsByCategory($categoryId)
    {
        $topics = ExamTopic::query()->select('id','name')->where('exam_category_id',$categoryId)->get();

        return response()->json($topics);
    }

    /**
     * Update model exam visibility status by ajax request
     * @param $examId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateExamVisibility($examId)
    {
        $exam  = ModelExam::query()->find($examId);

        if($exam->visibility == 1) {
           $exam->visibility = 0;
           $exam->save();
           $flag = 'hide';
        } else {
            $exam->visibility = 1;
            $exam->save();
            $flag = 'visible';
        }

        return response()->json($flag);
    }

    /**
     * Download solution pdf of specific exam uploaded by admin
     * @param $examId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadSolutionPdf($examId)
    {
        $model_exam = ModelExam::query()->find($examId);

        $file = public_path().'/storage/solutionPdf/'.$model_exam->solution_pdf;
        return Response()->download($file);
    }

    /**
     * Load model exam landing page to show available exams to student
     * Same path is used to load exam categories, exam topics.
     * Same path is used to load exams according to selected category and topic.
     * @return Application|Factory|View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getModelExams()
    {
        $exam_categories = ExamCategory::query()->get();
        $exam_topics = [];
        $exams = [];

        if(!request()->has('c') && !request()->has('t')) {
            Cache::forget('exam_topics');
            Cache::forget('exam_category');
            Cache::forget('exam_topic');
        }
        if(request()->has('c')) {
            $exam_topics = ExamTopic::query()
                                    ->whereHas('modelExam', function ($q) {
                                        $q->has('mcqQuestions')
                                            ->where('visibility',1);
                                    })
                                    ->where('exam_category_id', request()->get('c'))->get();
            Cache::put('exam_topics',$exam_topics);
            Cache::put('exam_category', request()->get('c'));
        }

        if(request()->has('t')) {
            $exams = ModelExam::query()->with('mcqTotalResult')
                                ->where('exam_topic_id', request()->get('t'))
                                ->where('exam_category_id', Cache::get('exam_category'))
                                ->where('visibility',1)
                                ->has('mcqQuestions')
                                ->get();
            $exam_topics = Cache::get('exam_topics');
            Cache::put('exam_topic', request()->get('t'));
        }
        return view('student.pages_new.model-exam.index',compact('exam_categories','exam_topics','exams'));
    }


    public function getMcqExamPaper($examId)
    {
        $exam = ModelExam::query()->where('id',$examId)->with('mcqQuestions')->first();

        if(auth() && $result = $this->examAttended($examId, auth()->user()->id)) {

            $exam_answer = McqMarkingDetail::query()->with('mcqQuestion')
                                            ->where('model_exam_id', $examId)
                                            ->where('student_id',auth()->user()->id)
                                            ->get();
            return view('student.pages_new.model-exam.mcq-result',compact('result','exam_answer','exam'));
        }
        return view('student.pages_new.model-exam.exam-paper', compact('exam'));
    }

    public function submitMcq(Request $request, $examId)
    {

        $inputs = $request->validate([
            'mcq' => 'required',
            'exam_end_time' => 'required'
        ]);
        $student_id = auth()->user()->id;

        if ($this->examAttended($examId, $student_id)) {
            return redirect()->back()->withErrors('You have already attempted on this exam!!');
        }

        $mcq = $inputs['mcq'];

        $exam = ModelExam::query()->find($examId);

        OnMcqSubmit::dispatch($mcq,$exam,$inputs['exam_end_time'],$student_id);

        return view('student.pages_new.batch.exam.examSubmissionGreeting');
    }

    private function examAttended($examId, $studentId)
    {
        return McqTotalResult::query()
                            ->where('model_exam_id',$examId)
                            ->where('student_id',$studentId)
                            ->first();
    }
}
