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
use App\Models\ModelMcqQuestionAnalysis;
use App\Models\ModelMcqTagAnalysis;
use App\Models\PaymentOfCategory;
use App\Models\PaymentOfExams;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

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
        if($inputs['negative_marking'] == false) {
            $inputs['negative_marking_value'] = 0;
        }
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
        McqTotalResult::query()->where('model_exam_id', $id)->delete();
        McqMarkingDetail::query()->where('model_exam_id', $id)->delete();
        ModelMcqTagAnalysis::query()->where('model_exam_id', $id)->delete();
        PaymentOfExams::query()->where('model_exam_id', $id)->delete();
        ModelMcqQuestionAnalysis::query()->where('model_exam_id', $id)->delete();

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
     * Load exam category
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getModelExams()
    {
        $exam_categories = ExamCategory::query()
                                        ->where('visibility',1)
                                        ->withCount('paymentOfCategories')
                                        ->withCount('totalParticipation')
                                        ->paginate(6);
        $exam_topics = [];
        $exams = [];

        if(request()->has('c')) {
            $category = $exam_categories->where('uuid',request()->get('c'))->first();


            abort_if(!$category, 404);


            if(!is_null($category->price) && $category->price != 0) {
                if(auth()->check() && $this->paidForCategory($category->id,auth()->user()->id)) {
                    return redirect()->route('model.exam.category.topics',$category->uuid);
                }
            } else {
                if(auth()->check() && $this->attemptedTOExamOfCategory($category->id,auth()->user()->id)) {
                    return redirect()->route('model.exam.category.topics',$category->uuid);
                }
            }

            return view('student.pages_new.model-exam.category-details',compact('category'));
        }
        return view('student.pages_new.model-exam.category',compact('exam_categories','exam_topics','exams'));
    }

    /**
     * Load topics and exam for specific category
     * @param $uuid
     * @return Application|Factory|View|\Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getModelExamsTopics($uuid)
    {
        $category = ExamCategory::query()->where('uuid',$uuid)->where('visibility',1)->firstOrFail();
        Cache::forget('exam_topic');
        $exams = [];

        if(!is_null($category->price) && $category->price != 0) {
            if(auth()->check() && !$this->paidForCategory($category->id,auth()->user()->id)) {
                return redirect()->route('model.exam',['c' => $category->uuid]);
            }
        }

        $exam_topics = ExamTopic::query()
                                ->whereHas('modelExam', function ($q) {
                                    $q->has('mcqQuestions')->where('visibility',1);
                                })
                                ->where('exam_category_id', $category->id)->get();

        if(request()->has('t')) {
            Cache::forever('exam_topic', request()->get('t'));
            $exams = ModelExam::query()->with('mcqTotalResult')->with('paymentOfExams')
                                ->where('exam_topic_id', request()->get('t'))
                                ->where('exam_category_id', $category->id)
                                ->where('visibility',1)
                                ->has('mcqQuestions')
                                ->orderByDesc('created_at')
                                ->paginate(4);
        }
        return view('student.pages_new.model-exam.index', compact('category','exam_topics','exams'));
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

        $exam = ModelExam::query()->where('id',$examId)->with(['mcqQuestions' => function($q) {
                $q->orderByDesc('id');
        }])->firstOrFail();

        //If already attempted the exam, load exam results
        $student_id = auth()->user()->is_admin && request()->input('student_id') ?
                                                    request()->input('student_id') :
                                                    auth()->user()->id;
        if(auth()->check() && $result = $this->examAttended($examId, $student_id)) {
            $exam_answer = McqMarkingDetail::query()->with(['mcqQuestion' => function($q) {
                                                $q->with('modelMcqQuestionAnalysis');
                                            }])
                                            ->where('model_exam_id', $examId)
                                            ->where('student_id',$student_id)
                                            ->groupBy(['model_exam_id','mcq_question_id'])
                                            ->orderByDesc('created_at')
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

//        return view('student.pages_new.batch.exam.examSubmissionGreeting', ['topics' => []]);
        $inputs = $request->validate([
            'mcq' => 'required',
            'exam_end_time' => 'required'
        ]);
        $exam = ModelExam::query()->find($examId);
        $topics = [];
        $student_id = auth()->user()->id;
        $topics = ExamTopic::query()
                            ->with('examCategory')
                            ->whereHas('modelExam', function ($q) {
                                $q->has('mcqQuestions')
                            ->where('visibility',1);
                            })->where('exam_category_id',$exam->exam_category_id)->get();

        if ($this->examAttended($examId, $student_id)) {
            return redirect()->back()->withErrors('You have already attempted on this exam!!');
        }

        $mcq = $inputs['mcq'];

        OnMcqSubmit::dispatch($mcq,$exam,$inputs['exam_end_time'],$student_id);

        return view('student.pages_new.batch.exam.examSubmissionGreeting', compact('topics'));
    }

    /**
     * Get exam results for admin to see of student attending the exams
     * @return Application|Factory|View
     */
    public function modelExamResult()
    {

        $results =  McqTotalResult::query()->with(['modelExam' => function($q) {
            $q->with('topic')->with('category');
        }])->groupBy(['student_id','model_exam_id'])->with('student');

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

        $results = $results->orderByDesc('total_marks')->paginate(5);

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

    /**
     * Check if a student already paid for a category
     * @param $categoryId
     * @param $studentId
     * @return bool
     */
    private function paidForCategory($categoryId, $studentId)
    {
        return PaymentOfCategory::query()
                                ->where('exam_category_id', $categoryId)
                                ->where('user_id', $studentId)
                                ->exists();
    }

    /**
     * Check if a student already attempted to any exam of a specific category
     * @param $categoryId
     * @param $studentId
     * @return bool
     */
    private function attemptedTOExamOfCategory($categoryId, $studentId)
    {
        return McqTotalResult::query()
                                ->whereHas('modelExam', function ($q) use ($categoryId) {
                                    $q->where('exam_category_id', $categoryId);
                                })
                                ->where('student_id',$studentId)
                                ->exists();
    }
}
