@extends('admin.layouts.default', [
'title'=>'CQ Details',
'pageName'=>'CQ Details',
'secondPageName'=>'CQ Details'
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
    {{-- @livewire('exam.cq', ['exam'=>$exam]) --}}

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Create CQ</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('cq.store', $exam) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="examId" type="hidden" value="{{ $exam->id }}">
                                <input name="slug" type="hidden" value="{{ $exam->slug }}">
                                {{-- উদ্দীপক --}}
                                <fieldset class="border p-2">
                                    <legend class="w-auto">উদ্দীপক <span class="must-filled">*</span></legend>
                                    <div class="form-group">
                                        {{-- <label for="question" class="col-form-label">Question <span
                                                class="must-filled">*</span></label> --}}
                                        <textarea input="creative_question" id="creative_question" name="creative_question"
                                            placeholder="Enter question"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                            readonly>{!! $cq->creative_question !!}</textarea>
                                        @error('creative_question')
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
                                                            <input type="file" name="uddipokimage"
                                                                class="custom-file-input hidden" id="exampleInputFile"
                                                                onchange="previewFile(this);">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                image</label>
                                                        </div>
                                                    </div>
                                                    @error('uddipokimage')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <img class="product-image" src="http://placehold.it/150x100"
                                                    id="previewImg" class="avatar" alt="...">
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                {{-- জ্ঞানমূলক --}}
                                <fieldset class="border p-2 mt-4">
                                    <legend class="w-auto">জ্ঞানমূলক <span class="must-filled">*</span></legend>
                                    <div class="form-group">
                                        {{-- <label for="question" class="col-form-label">Question <span
                                                class="must-filled">*</span></label> --}}
                                        <textarea input="question" id="question1" name="gyanmulokquestion"
                                            placeholder="Enter question"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                            required>{{ old('gyanmulokquestion') }}</textarea>
                                        @error('gyanmulokquestion')
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
                                                            <input type="file" name="gyanmulokimage"
                                                                class="custom-file-input hidden" id="exampleInputFile"
                                                                onchange="previewFile(this);">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                image</label>
                                                        </div>
                                                    </div>
                                                    @error('gyanmulokimage')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <img class="product-image" src="http://placehold.it/150x100"
                                                    id="previewImg" class="avatar" alt="...">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="marks">Marks <span
                                                        class="must-filled">*</span></label>
                                                <input type="text" id="marks" class="form-control" name="gyanmulokmarks"
                                                    value="1" placeholder="Enter marks" required readonly>
                                                @error('gyanmulokmarks')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="col-form-label" for="examId">Content Tag <span
                                                    class="must-filled">*</span></label>
                                            <div class="select2-purple">
                                                {{-- <select class="select2" multiple name="gyanmulokcontentTagIds[]"
                                                    data-placeholder="Select a Content Tag"
                                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                    @foreach ($contentTags as $contentTag)
                                                        <option value="{{ $contentTag->id }}">{{ $contentTag->title }}
                                                        </option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                            @error('gyanmulokcontentTagIds')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>

                                {{-- অনুধাবন --}}
                                <fieldset class="border p-2 mt-4">
                                    <legend class="w-auto">অনুধাবন <span class="must-filled">*</span></legend>
                                    <div class="form-group">
                                        {{-- <label for="question" class="col-form-label">Question <span
                                                class="must-filled">*</span></label> --}}
                                        <textarea input="question" id="question2" name="onudhabonquestion"
                                            placeholder="Enter question"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('onudhabonquestion') }}</textarea>
                                        @error('onudhabonquestion')
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
                                                            <input type="file" name="onudhabonimage"
                                                                class="custom-file-input hidden" id="exampleInputFile"
                                                                onchange="previewFile(this);">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                image</label>
                                                        </div>
                                                    </div>
                                                    @error('onudhabonimage')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <img class="product-image" src="http://placehold.it/150x100"
                                                    id="previewImg" class="avatar" alt="...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="marks">Marks <span
                                                        class="must-filled">*</span></label>
                                                <input type="text" id="marks" class="form-control" name="onudhabonmarks"
                                                    value="2" placeholder="Enter marks" required readonly>
                                                @error('onudhabonmarks')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="col-form-label" for="examId">Content Tag <span
                                                    class="must-filled">*</span></label>
                                            <div class="select2-purple">
                                                {{-- <select class="select2" multiple name="onudhaboncontentTagIds[]"
                                                    data-placeholder="Select a Content Tag"
                                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                    @foreach ($contentTags as $contentTag)
                                                        <option value="{{ $contentTag->id }}">{{ $contentTag->title }}
                                                        </option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                            @error('onudhaboncontentTagIds')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>

                                {{-- প্রয়োগমূলক --}}
                                <fieldset class="border p-2 mt-4">
                                    <legend class="w-auto">প্রয়োগমূলক <span class="must-filled">*</span></legend>
                                    <div class="form-group">
                                        {{-- <label for="question" class="col-form-label">Question <span
                                                class="must-filled">*</span></label> --}}
                                        <textarea input="question" id="question3" name="proyugquestion"
                                            placeholder="Enter question"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('proyugquestion') }}</textarea>
                                        @error('proyugquestion')
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
                                                            <input type="file" name="proyugimage"
                                                                class="custom-file-input hidden" id="exampleInputFile"
                                                                onchange="previewFile(this);">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                image</label>
                                                        </div>
                                                    </div>
                                                    @error('proyugimage')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <img class="product-image" src="http://placehold.it/150x100"
                                                    id="previewImg" class="avatar" alt="...">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="marks">Marks <span
                                                        class="must-filled">*</span></label>
                                                <input type="text" id="marks" class="form-control" name="proyugmarks"
                                                    value="3" placeholder="Enter marks" readonly required>
                                                @error('proyugmarks')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="col-form-label" for="examId">Content Tag <span
                                                    class="must-filled">*</span></label>
                                            <div class="select2-purple">
                                                {{-- <select class="select2" multiple name="proyugcontentTagIds[]"
                                                    data-placeholder="Select a Content Tag"
                                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                    @foreach ($contentTags as $contentTag)
                                                        <option value="{{ $contentTag->id }}">{{ $contentTag->title }}
                                                        </option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                            @error('proyugcontentTagIds')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>

                                {{-- উচ্চতর দক্ষতা --}}
                                <fieldset class="border p-2 mt-4">
                                    <legend class="w-auto">উচ্চতর দক্ষতা <span class="must-filled">*</span>
                                    </legend>
                                    <div class="form-group">
                                        {{-- <label for="question" class="col-form-label">Question <span
                                                class="must-filled">*</span></label> --}}
                                        <textarea input="question" id="question4" name="ucchotorquestion"
                                            placeholder="Enter question"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('ucchotorquestion') }}</textarea>
                                        @error('ucchotorquestion')
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
                                                            <input type="file" name="ucchotorimage"
                                                                class="custom-file-input hidden" id="exampleInputFile"
                                                                onchange="previewFile(this);">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                image</label>
                                                        </div>
                                                    </div>
                                                    @error('ucchotorimage')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <img class="product-image" src="http://placehold.it/150x100"
                                                    id="previewImg" class="avatar" alt="...">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="marks">Marks <span
                                                        class="must-filled">*</span></label>
                                                <input type="text" id="marks" class="form-control" name="ucchotormarks"
                                                    value="4" placeholder="Enter marks" readonly required>
                                                @error('ucchotormarks')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="col-form-label" for="examId">Content Tag <span
                                                    class="must-filled">*</span></label>
                                            <div class="select2-purple">
                                                {{-- <select class="select2" multiple name="ucchotorcontentTagIds[]"
                                                    data-placeholder="Select a Content Tag"
                                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                    @foreach ($contentTags as $contentTag)
                                                        <option value="{{ $contentTag->id }}">{{ $contentTag->title }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                            @error('ucchotorcontentTagIds')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="border p-2 mt-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile" class="col-form-label">Choose anser pdf file
                                                    <span class="must-filled">*</span></label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="answer" class="custom-file-input hidden"
                                                            id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            answer
                                                            pdf</label>
                                                    </div>
                                                </div>
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
                                                    <option value="{{ $exam->id }}" selected>{{ $exam->title }} ->
                                                        {{ $exam->id }}</option>
                                                </select>
                                                @error('examId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
            $('#creative_question').summernote();
            $('#question1').summernote();
            $('#question2').summernote();
            $('#question3').summernote();
            $('#question4').summernote();
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
