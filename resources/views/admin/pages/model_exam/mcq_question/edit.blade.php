@extends('admin.layouts.default', [
'title'=> 'Model Exam',
'pageName'=> 'Edit Mcq Question',
'secondPageName' => 'Edit Mcq Question'
])

@section('content')
    <a href="{{route('model.exam.question.index',$mcqQuestion->model_exam_id)}}" title="Back to Question"> <span class="iconify text-info m-3 text-xl" data-icon="akar-icons:arrow-back-thick-fill"></span> </a>
    <form action="{{route('model.exam.question.update',$mcqQuestion->id)}}" id="question_form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-12">
                           <textarea id="question"
                                     input="question"
                                     name="question"
                                     class="form-control"
                                     placeholder="Enter Question">{{$mcqQuestion->question}}</textarea>
                    <span class="text-red" id="question_error"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                           <textarea id="field_1"
                                     input="field_1"
                                     name="field_1"
                                     placeholder="Enter Option 1"
                                     class="form-control">{{$mcqQuestion->field_1}}</textarea>
                    <span class="text-red" id="field_1_error"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                           <textarea id="field_2"
                                     name="field_2"
                                     placeholder="Enter Option 2"
                                     class="form-control">{{$mcqQuestion->field_2}}</textarea>
                    <span class="text-red" id="field_2_error"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                           <textarea id="field_3"
                                     name="field_3"
                                     placeholder="Enter Option 3"
                                     class="form-control">{{$mcqQuestion->field_3}}</textarea>
                    <span class="text-red" id="field_3_error"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                           <textarea id="field_4"
                                     name="field_4"
                                     placeholder="Enter Option 4"
                                     class="form-control">{{$mcqQuestion->field_4}}</textarea>
                    <span class="text-red" id="field_4_error"></span>
                </div>
            </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                           <textarea id="explanation"
                                     name="explanation"
                                     placeholder="Explanation"
                                     class="form-control">{{ $mcqQuestion->explanation }}</textarea>
                <span class="text-red" id="explanation_error"></span>
            </div>
        </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" readonly value="{{$mcqQuestion->examTag->name}}">
                </div>
                <div class="form-group col-md-6">
                    <select
                        class="form-control"
                        name="answer"
                        required>
                        <option value="">Select a answer</option>
                        <option {{$mcqQuestion->answer == 1 ? 'selected' : ''}} value="1">Option 1</option>
                        <option {{$mcqQuestion->answer == 2 ? 'selected' : ''}} value=2>Option 2</option>
                        <option {{$mcqQuestion->answer == 3 ? 'selected' : ''}} value=3>Option 3</option>
                        <option {{$mcqQuestion->answer == 4 ? 'selected' : ''}} value=4>Option 4</option>
                    </select>
                </div>
            </div>

        <div class="d-flex justify-content-end">
            <button type="submit"
                    class="btn btn-outline-success">Update
            </button>
        </div>
    </form>

@endsection

@include('admin.pages.model_exam.mcq_question.utils')

<script src="/js/new-dashboard/iconify-icons.js"></script>
