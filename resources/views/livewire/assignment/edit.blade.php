@section('css1')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

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
                                <b>Assignment :</b> {{ $exam->title }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveAssignment">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" wire:ignore>
                                            <label for="question" class="col-form-label">Question <span
                                                    class="must-filled">*</span></label>
                                            <textarea input="question" id="question" wire:model="question"
                                                placeholder="Enter question"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                required>{{ old('question') }}</textarea>
                                            @error('question')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleInputFile" class="col-form-label">Choose
                                                        Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" wire:model="image"
                                                                class="custom-file-input hidden" id="exampleInputFile">
                                                            <label class="custom-file-label"
                                                                for="exampleInputFile">Choose image</label>
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                @if ($tempImage)
                                                    <img style="width:200px; border-radius: 50%" class="product-image"
                                                        src="{{ $tempImage->temporaryUrl() }}" alt="">
                                                @else
                                                    <img style="width:150px; border-radius: 50%"
                                                        src="{{ $image }}" alt="...">
                                                @endif
                                                <div wire:loading wire:target="image">
                                                    <p style="color: indigo">Uploading Image ....</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="marks">Marks <span
                                                    class="must-filled">*</span></label>
                                            <input type="text" id="marks" class="form-control" wire:model="marks"
                                                placeholder="Enter marks">
                                            @error('marks')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="examId">Exam <span
                                                    class="must-filled">*</span></label>
                                            <select class="form-control" wire:model="examId" disabled>
                                                <option>{{ $exam->title }}</option>
                                            </select>
                                            @error('examId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="{{ URL::previous() }}"><button type="button"
                                            class="btn btn-danger">Back</button></a>

                                    <div wire:loading wire:target="saveAssignment">
                                        <p style="color: indigo">Creating....</p>
                                    </div>
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

@section('js1')
    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#question').summernote({
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('question', contents);
                    }
                }
            })
        })
    </script>
@endsection
