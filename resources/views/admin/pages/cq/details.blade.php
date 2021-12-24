@extends('admin.layouts.default', [
'title'=>'CQ Details',
'pageName'=>'CQ Details',
'secondPageName'=>'CQ Details'
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
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="question" class="col-form-label">Question <span
                                                        class="must-filled"></span></label>
                                                <p>{!! $cq->creative_question !!}</p>
                                                @error('question')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($cq->image)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="col-form-label">Image</label>
                                                    <div class="input-group">
                                                        <div class="___class_+?18___">
                                                            <img class="product-image-thumb"
                                                                src='{{ Storage::url("$cq->image") }}' alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- জ্ঞানমূলক --}}
                                    <div class="card bg-light mb-3 shadow ">
                                        <div class="card-header bold"><strong> জ্ঞানমূলক </strong></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="card-text">{!! $cquestion1->question !!}</p>
                                                </div>
                                                @if ($cquestion1->image)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="" class="col-form-label">Image</label>
                                                            <div class="input-group">
                                                                <div class="___class_+?18___">
                                                                    <img class="product-image-thumb"
                                                                        src='{{ Storage::url("$cquestion1->image") }}'
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Content Tags</h4>
                                                    <ul>
                                                        @foreach ($questionContentTags1 as $questionContentTag1)
                                                            <li>{{ $questionContentTag1->contentTag->title }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Number Of attempts: {{ $cquestion1->number_of_attempt }}</h5>
                                                    <h5>Gain Marks: {{ $cquestion1->gain_marks }}</h5>
                                                    <h5>Success Rate: {{ $cquestion1->success_rate }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- অনুধাবন --}}
                                    <div class="card bg-light mb-3 shadow ">
                                        <div class="card-header"><strong> অনুধাবন </strong></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="card-text">{!! $cquestion2->question !!}</p>
                                                </div>
                                                @if ($cquestion2->image)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="" class="col-form-label">Image</label>
                                                            <div class="input-group">
                                                                <div class="___class_+?18___">
                                                                    <img class="product-image-thumb"
                                                                        src='{{ Storage::url("$cquestion2->image") }}'
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Content Tags</h4>
                                                    <ul>
                                                        @foreach ($questionContentTags2 as $questionContentTag2)
                                                            <li>{{ $questionContentTag2->contentTag->title }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Number Of attempts: {{ $cquestion2->number_of_attempt }}</h5>
                                                    <h5>Gain Marks: {{ $cquestion2->gain_marks }}</h5>
                                                    <h5>Success Rate: {{ $cquestion2->success_rate }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- প্রয়োগমূলক --}}
                                    <div class="card bg-light mb-3 shadow ">
                                        <div class="card-header"><strong> প্রয়োগমূলক </strong></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="card-text">{!! $cquestion3->question !!}</p>
                                                </div>
                                                @if ($cquestion3->image)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="" class="col-form-label">Image</label>
                                                            <div class="input-group">
                                                                <div class="___class_+?18___">
                                                                    <img class="product-image-thumb"
                                                                        src='{{ Storage::url("$cquestion3->image") }}'
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Content Tags</h4>
                                                    <ul>
                                                        @foreach ($questionContentTags3 as $questionContentTag3)
                                                            <li>{{ $questionContentTag3->contentTag->title }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Number Of attempts: {{ $cquestion3->number_of_attempt }}</h5>
                                                    <h5>Gain Marks: {{ $cquestion3->gain_marks }}</h5>
                                                    <h5>Success Rate: {{ $cquestion3->success_rate }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- উচ্চতর দক্ষতা --}}
                                    <div class="card bg-light mb-3 shadow ">
                                        <div class="card-header"><strong> উচ্চতর দক্ষতা </strong></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="card-text">{!! $cquestion4->question !!}</p>
                                                </div>
                                                @if ($cquestion4->image)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="" class="col-form-label">Image</label>
                                                            <div class="input-group">
                                                                <div class="___class_+?18___">
                                                                    <img class="product-image-thumb"
                                                                        src='{{ Storage::url("$cquestion4->image") }}'
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Content Tags</h4>
                                                    <ul>
                                                        @foreach ($questionContentTags4 as $questionContentTag4)
                                                            <li>{{ $questionContentTag4->contentTag->title }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Number Of attempts: {{ $cquestion4->number_of_attempt }}</h5>
                                                    <h5>Gain Marks: {{ $cquestion4->gain_marks }}</h5>
                                                    <h5>Success Rate: {{ $cquestion4->success_rate }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card bg-light mb-3 mt-3 shadow">
                                        <h3>Standard Answer PDF</h3>
                                        <iframe src="{{ Storage::url($cq->standard_ans_pdf) }}" frameborder="0"
                                            width="100%" height="600px"></iframe>
                                    </div>


                                    {{-- <div class="row">
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
                                    </div> --}}

                                    <div class="card-footer">
                                        <a href="{{ URL::previous() }}"><button type="button"
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
