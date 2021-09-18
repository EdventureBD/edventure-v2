@extends('admin.layouts.default', [
'title'=>'Assignment Details',
'pageName'=>'Assignment Details',
'secondPageName'=>'Assignment Details'
])

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Course :</b> {{ $exam->course->title }}<br>
                    @if(!empty($exam->topic)&&!is_null($exam->topic))<b>Topic :</b> {{ $exam->topic->title }} <br> @endif
                    <b>Assignment :</b> {{ $exam->title }}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="text-muted">
                                    <span
                                        style="font-weight: bolder">
                                        Question
                                    </span>: {{ $assignment->question }}
                                    @if ($assignment->image)
                                        <img class="product-image-thumb" style="width: 30%;height: 30%;"
                                            src="{{ Storage::url($assignment->image) }}" alt="">
                                    @endif
                                </h4>
                            </div>
                            <div class="col-md-2">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Marks: </span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $assignment->marks }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Exam</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $exam->title }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
