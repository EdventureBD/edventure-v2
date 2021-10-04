@extends('admin.layouts.default', [
'title'=>'MCQ',
'pageName'=>'Edit MCQ',
'secondPageName'=>'Edit MCQ'
])

@section('css1')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">

    <script>
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

@section('content')
    {{-- @livewire('mcq.edit', [
        'mcq' => $mcq,
        'exam' => $exam,
        'contentTags' => $contentTags,
        'questionContentTag' => $questionContentTag
    ]) --}}

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
                            <form role="form" method="POST" action="{{ route('mcq.update', [$exam,$mcq]) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                {{ csrf_field() }}
                                <input name="examId" type="hidden" value="{{ $exam->id }}">
                                <input name="slug" type="hidden" value="{{ $exam->slug }}">
                                <div class="form-group">
                                    <label for="question" class="col-form-label">Question <span
                                            class="must-filled">*</span></label>
                                    {{-- <input type="text" class="form-control" name="question"
                                                value={{ $mcq->question }} placeholder="Enter question"> --}}
                                    <textarea input="question" id="question" name="question" placeholder="Enter question"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('question') ? old('question') : $mcq->question }}</textarea>
                                    @error('question')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputFile" class="col-form-label">Choose
                                                    Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input hidden"
                                                            id="exampleInputFile" onchange="previewFile(this);">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            image</label>
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            @if ($mcq->image)
                                                <img class="product-image" src="{{ Storage::url($mcq->image) }}"
                                                    id="previewImg" class="avatar" alt="...">
                                            @else
                                                <img class="product-image" src="http://placehold.it/150x100"
                                                    id="previewImg" class="avatar" alt="...">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="field1" class="col-form-label">Option 1 <span
                                                    class="must-filled">*</span></label>
                                            {{-- <input type="text" class="form-control" name="field1"
                                                value="{{ $mcq->field1 }}" placeholder="Option 1"> --}}
                                            <textarea input="field1" id="field1" name="field1" placeholder="Option 1"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('field1') ? old('field1') : $mcq->field1 }}</textarea>
                                            @error('field1')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="field2" class="col-form-label">Option 2 <span
                                                    class="must-filled">*</span></label>
                                            {{-- <input type="text" class="form-control" name="field2"
                                                value="{{ $mcq->field2 }}" placeholder="Option 2"> --}}
                                            <textarea input="field2" id="field2" name="field2" placeholder="Option 2"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('field2') ? old('field2') : $mcq->field2 }}</textarea>
                                            @error('field2')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="field3" class="col-form-label">Option 3 <span
                                                    class="must-filled">*</span></label>
                                            {{-- <input type="text" class="form-control" name="field3"
                                                value="{{ $mcq->field3 }}" placeholder="Option 3"> --}}
                                            <textarea input="field3" id="field3" name="field3" placeholder="Option 3"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('field3') ? old('field3') : $mcq->field3 }}</textarea>
                                            @error('field3')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="field4" class="col-form-label">Option 4 <span
                                                    class="must-filled">*</span></label>
                                            {{-- <input type="text" class="form-control" name="field4"
                                                value="{{ $mcq->field4 }}" placeholder="Option 4"> --}}
                                            <textarea input="field4" id="field4" name="field4" placeholder="Option 4"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('field4') ? old('field4') : $mcq->field4 }}</textarea>
                                            @error('field4')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="examId">Answer <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" name="answer">
                                                <option value="" selected>Select Answer</option>
                                                <option value="1" {{ $mcq->field1 ? 'selected' : '' }}>Option 1</option>
                                                <option value="2" {{ $mcq->field2 ? 'selected' : '' }}>Option 2</option>
                                                <option value="3" {{ $mcq->field3 ? 'selected' : '' }}>Option 3</option>
                                                <option value="4" {{ $mcq->field4 ? 'selected' : '' }}>Option 4</option>
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
                                            <select class="form-control" name="examId" disabled>
                                                <option>{{ $exam->title }}</option>
                                            </select>
                                            @error('examId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="examId">Content Tag <span
                                                class="must-filled">*</span></label>
                                        <div class="select2-purple">
                                            <select class="select2" multiple name="contentTagIds[]"
                                                data-placeholder="Select a Content Tag"
                                                data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                @foreach ($questionContentTags as $questionContentTag)
                                                    <option value="{{ $questionContentTag->content_tag_id }}" selected>
                                                        {{ $questionContentTag->contentTag->title }}</option>
                                                @endforeach
                                                @foreach ($contentTags as $contentTag)
                                                    <option value="{{ $contentTag->id }}">{{ $contentTag->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('contentTagIds')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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

@endsection

@section('js1')
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>


    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#question').summernote();
            $('#field1').summernote();
            $('#field2').summernote();
            $('#field3').summernote();
            $('#field4').summernote();
        })
    </script>

@endsection

@section('js2')
    <!-- Page script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>
@endsection
