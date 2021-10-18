<x-landing-layout headerBg="white">
    <div class="page-section ">
        <div class="container page__container">
            <div class="page-separator py-4">
                <div class="page-separator__text text-center bradius-10 py-3 d-inline-block w-100 text-gray text-sm fw-700">Popular Courses</div>
            </div>
            <div class="row card-group-row mb-lg-8pt">
                @foreach ($courses as $course)
                <div class="col-md-3 mb-4">
                    <div class="single-exam mx-auto p-4 mb-md-0" style="background-image: url('/img/landing/physics.png')">
                        <img src="/img/landing/exam_1.png" width="50" alt="">
                        <h5 class="text-sm mt-3">{{ $course->title }} </h5>
                        {{-- <p class="text-xxsm fw-400 mt-3">Course details</p> --}}
                        <a href="{{ route('course-preview', $course->slug) }}"  class="btn btn-outline text-purple mt-4">Go To Exam</a>
                    </div>
                </div>

                @endforeach
            </div>
            <div class="mb-32pt">
                {{ $courses->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</x-landing-layout>
<?php /*@extends('student.layouts.default', [
                                    'title'=>'Course', 
                                    'pageName'=>'Course', 
                                    'secondPageName'=>'Course'
                                ])

@section('content')
<!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        {{-- <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout"> --}}
            {{-- <div class="mdk-drawer-layout__content"> --}}
                <div class="page-section">
                    <div class="container page__container">
                        <div class="page-separator">
                            <div class="page-separator__text">Popular Courses</div>
                        </div>
                        <div class="row card-group-row mb-lg-8pt">
                            @foreach ($courses as $course)
                                <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">
                                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                        {{-- data-overlay-onload-show data-popover-onload-show data-force-reveal --}}
                                        data-partial-height="44" data-toggle="popover" data-trigger="click">
                                        <a href="{{ route('course-preview', $course->slug) }}" class="js-image" data-position="">
                                            @if ($course->logo)
                                                <img src="{{ Storage::url($course->logo) }}" style="widows: 430px;height: 168px;" alt="course">
                                            @else
                                                <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" alt="course">
                                            @endif
                                            <span class="overlay__content align-items-start justify-content-start">
                                                <span class="overlay__action card-body d-flex align-items-center">
                                                    <i class="material-icons mr-4pt">play_circle_outline</i>
                                                    <span class="card-title text-white">Preview</span>
                                                </span>
                                            </span>
                                        </a>
                                        <div class="mdk-reveal__content">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex">
                                                        <a class="card-title h2" href="{{ route('course-preview', $course->slug) }}">{{ $course->title }}</a>
                                                    </div>
                                                    <a href="{{ route('course-preview', $course->slug) }}" data-toggle="tooltip"
                                                        data-title="{{ $course->CourseLecture->count() }} Lectures" data-placement="top" data-boundary="window"
                                                        class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite</a>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="rating flex">
                                                        <span class="rating__item"><span
                                                                class="material-icons">star</span></span>
                                                        <span class="rating__item"><span
                                                                class="material-icons">star</span></span>
                                                        <span class="rating__item"><span
                                                                class="material-icons">star</span></span>
                                                        <span class="rating__item"><span
                                                                class="material-icons">star</span></span>
                                                        <span class="rating__item"><span
                                                                class="material-icons">star_border</span></span>
                                                    </div>
                                                    <small class="text-50">6 hours</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-32pt">
                            {{ $courses->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>

            {{-- </div> --}}
        {{-- </div> --}}
    </div>
<!-- // END Header Layout Content -->
@endsection
 */ ?>