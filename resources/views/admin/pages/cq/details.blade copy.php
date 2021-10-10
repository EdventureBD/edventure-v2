@extends('admin.layouts.default', [
'title'=>'CQ Details',
'pageName'=>'CQ Details',
'secondPageName'=>'CQ Details'
])

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Exam: <span style="color: rgb(18, 160, 61)">{{ $exam->title }}</span></h3>

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
                                <h3 class="text-primary">Question:</h3>
                                <h4 class="text-muted">
                                    <span style="text-decoration-color: rgb(115, 87, 242);">
                                        {!! $creativeQuestion->creative_question !!}
                                    </span>
                                    @if ($creativeQuestion->image)
                                        <img class="product-image-thumb" style="width: 300px;"
                                            src="{{ Storage::url($creativeQuestion->image) }}" alt="">
                                    @endif
                                </h4>
                            </div>
                            <div class="col-md-2">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Marks: </span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $creativeQuestion->marks }}</span>
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
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Number of attended
                                            participants</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $creativeQuestion->number_of_attempt }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Gain Marks</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $creativeQuestion->gain_marks }}
                                            <span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Success Rate</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $creativeQuestion->success_rate }}
                                            <span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/Viewer.js/#..{{ Storage::url($creativeQuestion->standard_ans_pdf) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="javascript:history.back()"><button type="button" class="btn btn-danger">Back</button></a>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
