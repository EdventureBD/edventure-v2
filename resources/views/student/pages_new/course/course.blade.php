{{--previous student/pages/course/course.blade.php--}}
<x-landing-layout headerBg="white">
    <div class="page-section ">
        <div class="container ">
            <div class="py-4">
                <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700"> Courses Category</div>
            </div>
            <div class="text-center course-category-js-temp">
                @foreach($categories as $category)
                    @if($category->slug==$selected_category_slug)
                        <a href="{{route('course',$category->slug)}}"  class="mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm text-white 
                            mx-1 bradius-15 bshadow-medium bg-purple px-4">{{$category->title}}</a>
                    @else
                        <a href="{{route('course',$category->slug)}}"  class="mb-3  d-inline-block course-category-single-js btn fw-800 text-xxsm text-purple 
                            mx-1 bradius-15 bshadow-medium bg-white px-4">{{$category->title}}</a>
                    @endif
                @endforeach 
            </div>
            <div class="py-5 py-md-1 text-center d-flex justify-content-center">
               <p class="text-center">{{ $courses->links('vendor.pagination.custom') }}</p> 
            </div>
            <div class="row py-3 card-group-row mb-lg-8pt">
                @foreach ($courses as $course)
                <div class="col-md-3 mb-4">
                    <div class="single-exam text-center mx-auto p-4 mb-md-0" style="background-image: url({{asset($course->banner)}});">
                        <img src="{{asset($course->icon)}}" width="50" alt="">
                        <h5 class="text-center text-sm mt-2">{{ $course->title }} </h5>
                        <p class=" text-center text-md mt-2 fw-600 text-price">{{$course->price}}৳</p>
                        <div class=" text-center d-block "">
                            <a href="{{ route('course-preview', $course->slug) }}"  class="btn btn-outline text-purple mt-2">Go To Exam</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-landing-layout>
