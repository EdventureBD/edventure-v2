<x-landing-layout headerBg="white">
    <div id="studentDashboard" data-course-enrolement="{{json_encode($batchStudentEnrollment)}}" data-batch-enrolement="{{json_encode($batchStudentEnroll)}}" data-user="{{json_encode(auth()->user())}}">
    {{-- @include('student.pages_new.user.sidebar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="student-info">
                    <h2>Hello {{auth()->user()->name}}</h2>
                    <p>Nice to have you back</p>
                </div>
                <div class="page-headline text-center">
                    <h2>Your enrolled courses</h2>
                </div>
                @forelse ($batchStudentEnrollment as $batchStudentEnrollment)
                    <div class="single-course">
                        <a href="{{ route('course-preview', $batchStudentEnrollment->course->slug) }}" class="avatar avatar-4by3 mr-12pt">
                            @if ($batchStudentEnrollment->course->logo)
                                <img src="{{ Storage::url($batchStudentEnrollment->course->logo) }}" class="avatar-img rounded" alt="course">
                            @else
                                <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" class="avatar-img rounded" alt="course">
                            @endif
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="{{ route('course-preview', $batchStudentEnrollment->course->slug) }}">{{ $batchStudentEnrollment->course->title }}</a>
                        </div>
                    </div>
                @empty
                    <div class="single-course">
                        <a href="#" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="#">No Enrolled Courses</a>
                        </div>
                    </div>
                @endforelse
    
                <div class="page-headline text-center">
                    <h2>Your Batches</h2>
                </div>
                @forelse ($batchStudentEnroll as $batchStudentEnroll)
                    <div class="single-course">
                        <a href="{{ route('batch-lecture', $batchStudentEnroll->batch->slug) }}" class="avatar avatar-4by3 mr-12pt">
                            @if ($batchStudentEnroll->course->logo)
                                <img src="{{ Storage::url($batchStudentEnroll->course->logo) }}" class="avatar-img rounded" alt="course">
                            @else
                                <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" class="avatar-img rounded" alt="course">
                            @endif
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="{{ route('batch-lecture', $batchStudentEnroll->batch->slug) }}">{{ $batchStudentEnroll->batch->title }}</a>
                        </div>
                    </div>
                @empty
                    <div class="single-course">
                        <a href="#" class="avatar avatar-4by3 mr-12pt">
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="#">No batches</a>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="col-md-8">

            </div>
        </div>
    </div> --}}
</x-landing-layout>
<?php /*@extends('student.layouts.default', [
                                    'title'=>'Profile', 
                                    'pageName'=>'Profile', 
                                    'secondPageName'=>'Profile'
                                ])

@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">

        <div class="page-section bg-primary">
            <div
                class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-md-left">
                @if ($user->image)
                    <div class="avatar avatar-lg mr-2">
                        <img src="{{ Storage::url($user->image) }}" width="104" alt="Avatar" class="avatar-img rounded-circle">
                    </div>
                @else
                    <div class="avatar avatar-lg mr-2">
                        <span class="avatar-title rounded-circle" style="font-size: 2rem;">
                            @php
                                echo auth()->user()->name[0];
                            @endphp
                        </span>
                    </div>
                @endif
                <div class="flex mb-32pt mb-md-0">
                    <h2 class="text-white mb-0">{{ auth()->user()->name }}</h2>
                    <p class="lead text-white-50 d-flex align-items-center">Student <span
                            class="ml-16pt d-flex align-items-center"></span></p>
                </div>
                <a href="{{ route('edit-profile', auth()->user()->id) }}" class="btn btn-outline-white">Edit profile</a>
            </div>
        </div>
        <div class="container page__container page-section">
            <div class="page-headline text-center">
                <h2>Your enrolled courses</h2>
            </div>
            <div class="row card-group-row mb-8pt">
                @forelse ($batchStudentEnrollment as $batchStudentEnrollment)
                    <div class="col-sm-4 card-group-row__col">
                        <div class="card card-sm card-group-row__card">
                            <div class="card-body d-flex align-items-center">
                                <a href="{{ route('course-preview', $batchStudentEnrollment->course->slug) }}" class="avatar avatar-4by3 mr-12pt">
                                    @if ($batchStudentEnrollment->course->logo)
                                        <img src="{{ Storage::url($batchStudentEnrollment->course->logo) }}" class="avatar-img rounded" alt="course">
                                    @else
                                        <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" class="avatar-img rounded" alt="course">
                                    @endif
                                    <span class="overlay__content"></span>
                                </a>
                                <div class="flex">
                                    <a class="card-title mb-4pt" href="{{ route('course-preview', $batchStudentEnrollment->course->slug) }}">{{ $batchStudentEnrollment->course->title }}</a>
                                    {{-- <div class="d-flex align-items-center">
                                        <div class="rating mr-8pt">

                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                            <span class="rating__item"><span class="material-icons">star</span></span>

                                            <span class="rating__item"><span class="material-icons">star_border</span></span>

                                            <span class="rating__item"><span class="material-icons">star_border</span></span>

                                        </div>
                                        <small class="text-muted">3/5</small>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-sm-12 card-group-row__col">
                        <div class="card card-sm card-group-row__card">
                            <div class="card-body d-flex align-items-center">
                                <a href="#" class="avatar avatar-4by3 mr-12pt">
                                    {{-- @if ($batchStudentEnrollment->course->logo)
                                        <img src="{{ Storage::url($batchStudentEnrollment->course->logo) }}" class="avatar-img rounded" alt="course">
                                    @else
                                        <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" class="avatar-img rounded" alt="course">
                                    @endif --}}
                                    <span class="overlay__content"></span>
                                </a>
                                <div class="flex">
                                    <a class="card-title mb-4pt" href="#">No Enrolled Courses</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="page-headline text-center">
                <h2>Your Batches</h2>
            </div>
            <div class="row card-group-row mb-8pt">
                @forelse ($batchStudentEnroll as $batchStudentEnroll)
                    <div class="col-sm-4 card-group-row__col">
                        <div class="card card-sm card-group-row__card">
                            <div class="card-body d-flex align-items-center">
                                <a href="{{ route('batch-lecture', $batchStudentEnroll->batch->slug) }}" class="avatar avatar-4by3 mr-12pt">
                                    @if ($batchStudentEnroll->course->logo)
                                        <img src="{{ Storage::url($batchStudentEnroll->course->logo) }}" class="avatar-img rounded" alt="course">
                                    @else
                                        <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" class="avatar-img rounded" alt="course">
                                    @endif
                                    <span class="overlay__content"></span>
                                </a>
                                <div class="flex">
                                    <a class="card-title mb-4pt" href="{{ route('batch-lecture', $batchStudentEnroll->batch->slug) }}">{{ $batchStudentEnroll->batch->title }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-sm-12 card-group-row__col">
                        <div class="card card-sm card-group-row__card">
                            <div class="card-body d-flex align-items-center">
                                <a href="#" class="avatar avatar-4by3 mr-12pt">
                                    <span class="overlay__content"></span>
                                </a>
                                <div class="flex">
                                    <a class="card-title mb-4pt" href="#">No batches</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- START OF ANALYSIS  --}}
            {{-- <div class="page-headline text-center">
                <h2>Analysis</h2>
            </div>
            <div class="row card-group-row mb-8pt">
            @forelse ($batchStudent as $batchStudent)
                <div class="col-md-6 card-group-row__col">
                    <div class="card card-group-row__card">
                        <div class="card-header p-0 nav">
                            <div class="row no-gutters flex" role="tablist">
                                <div class="col-auto">
                                    <div class="p-card-header d-flex align-items-center">
                                        <div class="h2 mb-0 mr-3">
                                            {{ $batchStudent->course->title }}
                                        </div>
                                        <div class="flex">
                                            <p class="mb-0"><strong>Alerts</strong></p>
                                            <p class="text-50 mb-0 d-flex align-items-center">
                                                <small>All Content tags</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @livewire('student.user.analysis', ['course' => $batchStudent->course], key($batchStudent->course->id))
                    </div>
                </div>
            @empty
                <div class="col-sm-12 card-group-row__col">
                    <div class="card card-sm card-group-row__card">
                        <div class="card-body d-flex align-items-center">
                            <a href="#" class="avatar avatar-4by3 mr-12pt">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="#">
                                    To know your progress first enroll to a course and add to a batch. In a batch you have to attempt an exam. By joining an exam you can see your progress report here.
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
            </div> --}}
            {{-- END OF ANALYSIS  --}}

        </div>

    </div>
    <!-- // END Header Layout Content -->
@endsection
*/ ?>