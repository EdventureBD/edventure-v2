@extends('admin.layouts.default', [
'title'=>'Blog',
'pageName'=>'Create Blog',
'secondPageName'=>'Create Blog'
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
        function previewFile(input, image) {
            var file = $("input[type=file]").get(0).files[0];

            var previewImage = "preview" + image;
            console.log(image, file, previewImage);
            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $('#' + previewImage).attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

@section('content')
    {{-- @livewire('exam.blog', ['exam'=>$exam]) --}}

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit Blog</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('blog.update', $blog) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title" class="col-form-label">Title
                                        <span class="must-filled">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        value="{{ old('title') ? old('title') : $blog->title }}">
                                    @error('title')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="subTitle" class="col-form-label">Sub Title
                                        <span class="must-filled">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="subTitle" id="subTitle"
                                        value="{{ old('subTitle') ? old('subTitle') : $blog->subtitle }}">
                                    @error('subTitle')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="authorId">Author
                                        <span class="must-filled">*</span>
                                    </label>
                                    <select class="form-control" name="authorId">
                                        <option disabled selected value>Select Author</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('authorId') == $user->id ? 'selected' : '' }}
                                                {{ $user->id == $blog->author_id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('authorId')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-form-label">Description
                                        <span class="must-filled">*</span>
                                    </label>
                                    <textarea input="description" id="description" name="description"
                                        placeholder="Enter question"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                        required>{!! old('description') ? old('description') : $blog->description !!}</textarea>
                                    @error('description')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
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
            $('#description').summernote();
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
