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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ModelExamController extends Controller
{
    /**
     * Load index page to view and create new model exam
     * @return Application|Factory|View
     */
    public function index()
    {
        $exam_categories = ExamCategory::get();
        $exams = ModelExam::query()->with('category')
                            ->with('topic')->with('mcqTotalResult');

        if(request()->input('query.category')) {
            $exams = $exams->where('exam_category_id',request()->input('query.category'));
        }

        if(request()->input('query.topic')) {
            $exams = $exams->where('exam_topic_id',request()->input('query.topic'));
        }

        if(request()->input('query.exam')) {
            $exams = $exams->where('id',request()->input('query.exam'));
        }

        $exams = $exams->orderByDesc('created_at')->paginate(5);

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
            $filename = rand().'_'.str_replace(' ', '_', $request->title).'_'.Carbon::today()->toDateString().'.pdf';
            $path = $request->file('solution_pdf')->storeAs(
                'solutionPdf', $filename, 'public'
            );
            $inputs['solution_pdf'] = $filename;
        }

        if($request->hasFile('image')) {
            $filename = rand().'_'.str_replace(' ', '_', $request->title).'_'.Carbon::today()->toDateString().'.jpg';
            $path = $request->file('image')->storeAs(
                'examImage', $filename, 'public'
            );
            $inputs['image'] = $filename;
        }

        ModelExam::query()->create($inputs);

        return redirect()->back()->with('status','Exam Created Successfully');

    }

    /**
     * Load edit page for model exam update
     * @param $examId
     * @return Application|Factory|View
     */
    public function edit($examId)
    {
        $exam = ModelExam::query()->where('id',$examId)->with('topic')->with('category')->firstOrFail();
        $exam_topics = ExamTopic::query()->where('exam_category_id', $exam->exam_category_id)->get();
        return view('admin.pages.model_exam.exam.edit', compact('exam','exam_topics'));
    }


    /**
     * Update specific model exam
     * @param UpdateModelExamRequest $request
     * @param $examId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateModelExamRequest $request, $examId)
    {
        $inputs = $request->validated();
        $exam = ModelExam::query()->find($examId);

        if($request->hasFile('solution_pdf')) {

            if($exam->solution_pdf) {
                @unlink(public_path('storage/solutionPdf/'.$exam->solution_pdf));
            }

            $filename = rand().'_'.str_replace(' ', '_', $request->title).'_'.Carbon::today()->toDateString().'.pdf';
            $path = $request->file('solution_pdf')->storeAs(
                'solutionPdf', $filename, 'public'
            );
            $inputs['solution_pdf'] = $filename;
        }

        if($request->hasFile('image')) {

            if($exam->image) {
                @unlink(public_path('storage/examImage/'.$exam->image));
            }

            $filename = rand().'_'.str_replace(' ', '_', $request->title).'_'.Carbon::today()->toDateString().'.jpg';
            $path = $request->file('image')->storeAs(
                'examImage', $filename, 'public'
            );
            $inputs['image'] = $filename;
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
        McqQuestion::query()->where('model_exam_id', $id)->delete();

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
     * Get exams list by specific category and topic
     * @param $categoryId
     * @param $topicId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExamByCategoryAndTopic($categoryId, $topicId)
    {
        $topics = ModelExam::query()->select('id','title')
                        ->where('exam_category_id',$categoryId)
                        ->where('exam_topic_id',$topicId)->get();

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
            Cache::forever('exam_topics',$exam_topics);
            Cache::forever('exam_category', request()->get('c'));
        }

        if(request()->has('t') || Cache::has('exam_category')) {
            $exams = ModelExam::query()->with('mcqTotalResult')->with('paymentOfExams')
                                ->where('exam_topic_id', request()->get('t'))
                                ->where('exam_category_id', Cache::get('exam_category'))
                                ->where('visibility',1)
                                ->has('mcqQuestions')
                                ->orderByDesc('created_at')
                                ->paginate(4);
            $exam_topics = Cache::get('exam_topics');
            Cache::forever('exam_topic', request()->get('t'));
        }

        return view('student.pages_new.model-exam.index',compact('exam_categories','exam_topics','exams'));
    }


    /**
     * Initially load for presenting exam paper to the student
     * If a student already attempted the exam, load the exam result by same route
     * @param $examId
     * @return Application|Factory|View
     */
    public function getMcqExamPaper($examId)
    {
        $examId = Crypt::decrypt($examId);

        $exam = ModelExam::query()->where('id',$examId)->with('mcqQuestions')->firstOrFail();


        //If already attempted the exam, load exam results
        $student_id = auth()->user()->is_admin && request()->input('student_id') ?
                                                    request()->input('student_id') :
                                                    auth()->user()->id;
        if(auth()->check() && $result = $this->examAttended($examId, $student_id)) {

            $exam_answer = McqMarkingDetail::query()->with('mcqQuestion')
                                            ->where('model_exam_id', $examId)
                                            ->where('student_id',$student_id)
                                            ->get();
            return view('student.pages_new.model-exam.mcq-result',compact('result','exam_answer','exam'));
        }
        return view('student.pages_new.model-exam.exam-paper', compact('exam'));
    }

    /**
     * Submit student exam paper for mcq
     * @param Request $request
     * @param $examId
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     */
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

    public function modelExamResult()
    {

        $results =  McqTotalResult::query()->with(['modelExam' => function($q) {
            $q->with('topic')->with('category');
        }])->with('student');

        //filterable data for result search
        $filters['student'] = McqTotalResult::query()->with('student:id,name,email')->get()->unique('student_id');
        $filters['exam'] = McqTotalResult::query()->with('modelExam:id,title')->get()->unique('model_exam_id');

        if(request()->input('query.student')) {
            $student_id = request()->input('query.student');
            $results = $results->whereHas('student', function ($q) use ($student_id) {
                $q->where('id', $student_id);
            });
        }

        if(request()->input('query.email')) {
            $student_id = request()->input('query.email');
            $results = $results->whereHas('student', function ($q) use ($student_id) {
                $q->where('id', $student_id);
            });
        }

        if(request()->input('query.exam')) {
            $exam_id = request()->input('query.exam');
            $results = $results->whereHas('modelExam', function ($q) use ($exam_id) {
                $q->where('id', $exam_id);
            });
        }

        $results = $results->paginate(5);

        return view('admin.pages.model_exam.result.index', compact('results','filters'));
    }

    /**
     * Check whether specific student already attended specific exam
     * @param $examId
     * @param $studentId
     * @return Builder|Model|object|null
     */
    private function examAttended($examId, $studentId)
    {
        return McqTotalResult::query()
                            ->where('model_exam_id',$examId)
                            ->where('student_id',$studentId)
                            ->first();
    }
}
