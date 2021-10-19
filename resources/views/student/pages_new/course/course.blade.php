{{--previous student/pages/course/course.blade.php--}}
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
