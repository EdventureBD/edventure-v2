@extends('student.layouts.default', [
                                    'title'=>'Batch', 
                                    'pageName'=>'Batch', 
                                    'secondPageName'=>'Batch'
                                ])

@section('content')
    <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
            <div class="container page__container page-section">
                <div class="page-separator">
                    <div class="page-separator__text">Batches</div>
                </div>
                <div class="row card-group-row mb-lg-8pt">
                    @foreach ($batches as $batch)
                        @if ($batch->batch->status == 1)
                            <div class="col-lg-3 card-group-row__col">
                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card">
                                    <a href="{{ route('batch-lecture', $batch->batch->slug) }}"
                                        class="card-img-top js-image"
                                        data-position=""
                                        data-height="140">
                                        <img src="{{ asset('student/public/images/paths/angular_430x168.png') }}" alt="batch">
                                        <span class="overlay__content">
                                            <span class="overlay__action d-flex flex-column text-center">
                                                <i class="material-icons icon-32pt">play_circle_outline</i>
                                                <span class="card-title text-white">Resume</span>
                                            </span>
                                        </span>
                                    </a>
                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                    href="{{ route('batch-lecture', $batch->batch->slug) }}">Learn {{ $batch->course->title }}
                                                </a>
                                                <small class="text-50 font-weight-bold mb-4pt">with {{ $batch->batch->teacher->name }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row justify-content-between">
                                            <div class="col-auto d-flex align-items-center">
                                                <p class="flex text-50 lh-1 mb-0"><small>Batch : {{ $batch->batch->title }}</small></p>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>{{ $batch->course->CourseLecture->count() }} lessons</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    <!-- // END Header Layout Content -->
@endsection