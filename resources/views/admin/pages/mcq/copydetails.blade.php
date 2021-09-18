@extends('admin.layouts.default', [
                                    'title'=>'MCQ Details', 
                                    'pageName'=>'MCQ Details', 
                                   'secondPageName'=>'MCQ Details'
                                ])

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">MCQ: <span style="color: rgb(18, 160, 61)">{{ $mcq->question }}</span></h3>

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
                                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> MCQ Question </h3>
                                <h4 class="text-muted">
                                    <span style="text-decoration: underline;text-decoration-color: rgb(115, 87, 242);font-weight: bolder">
                                        Question
                                    </span>: {{ $mcq->question }}
                                    @if ($mcq->image)
                                        <img class="product-image" style="width: 30%;height: 30%;" src="{{ Storage::url($mcq->image) }}" alt="">
                                    @endif
                                </h4>
                            </div>
                            <div class="col-md-2">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">
                                            Answer: @if (($mcq->answer) == 1) 1 
                                                    @elseif(($mcq->answer) == 2) 2 
                                                    @elseif(($mcq->answer) == 3) 3 
                                                    @elseif(($mcq->answer) == 4) 4
                                                    @endif
                                        </span>
                                        <span class="info-box-number text-center text-primary mb-0">
                                            @if (($mcq->answer) == 1)
                                                {{ $mcq->field1 }}
                                            @elseif(($mcq->answer) == 2)
                                                {{ $mcq->field2 }}
                                            @elseif(($mcq->answer) == 3)
                                                {{ $mcq->field3 }}
                                            @elseif(($mcq->answer) == 4)
                                                {{ $mcq->field4 }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Option 1</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $mcq->field1 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Option 2</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $mcq->field2 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Option 3</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $mcq->field3 }} <span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Option 4</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $mcq->field4 }} <span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Exam</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $name->title }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Number of attended participants</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $mcq->number_of_attempt }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Gain Marks</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $mcq->gain_marks }} <span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Success Rate</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $mcq->success_rate }} <span>
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
