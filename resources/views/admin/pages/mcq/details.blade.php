@extends('admin.layouts.default', [
'title'=>'MCQ Details',
'pageName'=>'MCQ Details',
'secondPageName'=>'MCQ Details'
])
@section('css1')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- right column -->
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title"><b>Course :</b> {{ $exam->course->title }}<br>
                                    @if (!empty($exam->topic) && !is_null($exam->topic))<b>Topic :</b> {{ $exam->topic->title }} <br> @endif
                                    <b>Exam :</b> {{ $exam->title }}
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="question" class="col-form-label">Question <span
                                                        class="must-filled"></span></label>
                                                {{-- <input type="text" class="form-control" value="{{ $mcq->question }}"
                                                    disabled> --}}
                                                <p>{!! $mcq->question !!}</p>
                                                @error('question')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="col-form-label">Image</label>
                                                <div class="input-group">
                                                    <div class="___class_+?18___">
                                                        <img class="product-image-thumb"
                                                            src='{{ Storage::url("$mcq->image") }}' alt="">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 card ml-4">
                                            <div class="form-group card-body">
                                                <label for="field1" class="col-form-label">Option 1</label>
                                                <p>{!! $mcq->field1 !!}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 card ml-4">
                                            <div class="form-group card-body">
                                                <label for="field2" class="col-form-label">Option 2</label>
                                                <p>{!! $mcq->field2 !!}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 card ml-4">
                                            <div class="form-group card-body">
                                                <label for="field3" class="col-form-label">Option 3</label>
                                                <p>{!! $mcq->field3 !!}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 card ml-4">
                                            <div class="form-group card-body">
                                                <label for="field4" class="col-form-label">Option 4</span></label>
                                                <p>{!! $mcq->field4 !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="examId">Answer <span
                                                        class="must-filled">*</span></label>
                                                <select class="form-control" disabled>
                                                    <option @if ($mcq->answer == 1) selected @endif>Option 1</option>
                                                    <option @if ($mcq->answer == 2) selected @endif>Option 2</option>
                                                    <option @if ($mcq->answer == 3) selected @endif>Option 3</option>
                                                    <option @if ($mcq->answer == 4) selected @endif>Option 4</option>
                                                </select>
                                                @error('answer')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="examId">Exam <span
                                                        class="must-filled">*</span></label>
                                                <select class="form-control" disabled>
                                                    <option>{{ $exam->title }}</option>
                                                </select>
                                                @error('examId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="number_of_attempt" class="col-form-label">No of Attempt</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $mcq->number_of_attempt }}">
                                                @error('number_of_attempt')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gain_marks" class="col-form-label">Gained marks</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $mcq->gain_marks }}">
                                                @error('gain_marks')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gain_marks" class="col-form-label">Success rate</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $mcq->success_rate }}">
                                                @error('success_rate')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 card">
                                            <div class="form-group card-body">
                                                <label for="field4" class="col-form-label">Explanation</span></label>
                                                <p>{!! $mcq->explanation !!}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <a href="javascript:history.back()"><button type="button"
                                                class="btn btn-danger">Back</button></a>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@section('js1')
    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

@endsection
