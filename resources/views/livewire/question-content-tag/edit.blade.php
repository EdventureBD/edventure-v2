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
                            <h3 class="card-title">Edit question content tag</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="updateQuestionContentTag">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Exam</label>
                                            <select class="form-control" wire:model="examId">
                                                <option value="" selected> Select exam</option>
                                                {{-- @foreach($exams as $exam)
                                                    <option value="{{ $exam->id }}">{{ $exam->title }} -> {{ $exam->exam_type }}</option>
                                                @endforeach --}}
                                            </select>
                                            @error('examId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Questions</label>
                                            <select class="form-control" wire:model="questionId">
                                                <option value="" selected>Select Question</option>
                                                {{-- @if (is_array($questions) || is_object($questions))
                                                    @foreach($questions as $question)
                                                        <option value="{{ $question->id }}">{{ $question->question }}</option>
                                                    @endforeach
                                                @endif --}}
                                            </select>
                                            @error('questionId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="topicName">Topic</label>
                                            <select class="form-control" wire:model="contentTagId">
                                                <option value="" selected>Select Topic</option>
                                                @if (is_array($contentTags) || is_object($contentTags))
                                                    {{-- @foreach($contentTags as $contentTag)
                                                        <option value="{{ $contentTag->id }}">{{ $contentTag->title }}
                                                        </option>
                                                    @endforeach --}}
                                                @endif
                                            </select>
                                            @error('topicId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ URL::previous() }}"><button type="button" class="btn btn-danger">Back</button></a>
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
