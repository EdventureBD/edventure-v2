{{--previous student/pages/course/course.blade.php--}}
<x-landing-layout headerBg="white">

    <link rel="stylesheet" href="/css/tooltip.css">
    <style>
        .bold-header {
            font-weight: bolder;
            color: #6400c8;
        }
        .card-footer:hover {
            background: #6400c8 !important;
        }
        @media screen and (max-width:768px){
            #cards-parent {
                justify-content: space-around !important;
            }
        }
        @media screen and (max-width:576px){
            #cards-parent {
                justify-content: center !important;
            }
        }
    </style>
    <div class="page-section ">
        <div class="container ">
            <div class="py-4">
                <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700"> Courses Category</div>
            </div>
            @if(count($errors)> 0)
                <div class="mb-5">
                    <div class="">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong> Error !</strong> {{ $error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="text-center @if($categories->count()>=7) course-category-js @endif @if(empty($intermediary_levels)) mb-5 @endif">
                @foreach($categories as $category)
                    @if($selected_category_slug)
                        @if($category->slug==$selected_category_slug)
                            <a href="{{route('course',$category->slug)}}" class="mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm text-white
                                mx-1 bradius-15 bshadow-medium btn-orange-customed px-4">{{$category->title}}</a>
                        @else
                            <a href="{{route('course',$category->slug)}}" class="mb-3  d-inline-block course-category-single-js btn fw-800 text-xxsm text-purple
                                mx-1 bradius-15 bshadow-medium bg-white px-4">{{$category->title}}</a>
                        @endif
                    @else
                        <a href="{{route('course',$category->slug)}}" class="mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm text-purple
                            mx-1 bradius-15 bshadow-medium bg-white px-4">{{$category->title}}</a>
                    @endif
                @endforeach
            </div>

            @if($intermediary_levels)
                <div class="py-4">
                    <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700"> Programs </div>
                </div>
                <div class="text-center @if($intermediary_levels->count()>=7) course-category-js @endif @if(empty($selected_intermediary_level)) mb-5 @endif">
                    @if ( count($intermediary_levels) > 0 )
                        @foreach($intermediary_levels as $level)
                            @if(isset($selected_intermediary_level->slug))
                                @if($level->slug==$selected_intermediary_level->slug)
                                    <a href="{{ route('course', [ $selected_category_slug, $level->slug ]) }}"  class="mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm text-white
                                    mx-1 bradius-15 bshadow-medium btn-orange-customed px-4">{{$level->title}}</a>
                                @else
                                    <a href="{{ route('course', [ $selected_category_slug, $level->slug ]) }}"  class="mb-3  d-inline-block course-category-single-js btn fw-800 text-xxsm text-purple
                                    mx-1 bradius-15 bshadow-medium bg-white px-4">{{$level->title}}</a>
                                @endif
                            @else
                                <a href="{{ route('course', [ $selected_category_slug, $level->slug ]) }}"  class="mb-3  d-inline-block course-category-single-js btn fw-800 text-xxsm text-purple
                                    mx-1 bradius-15 bshadow-medium bg-white px-4">{{$level->title}}</a>
                            @endif
                        @endforeach
                    @else
                        <h1>No Programs For This Course Category Exist !!</h1>
                    @endif
                </div>
            @endif

            @if($selected_intermediary_level)
                @if ( count($courses) > 0 || count($bundles) > 0 )
{{--                    <div class="py-1 text-center d-flex justify-content-center">--}}
{{--                        <p class="text-center">{{ $courses->links('vendor.pagination.custom') }}</p>--}}
{{--                    </div>--}}
                    <div class="row {{count($courses) + count($bundles) == 1 ? 'justify-content-center' : 'justify-content-around'}} py-5" id="cards-parent">

                    <div class="row justify-content-center py-3 card-group-row mb-lg-8pt">
                        @foreach ($courses as $course)
                            <div class="mb-4">
                                <div class="card text-center"
                                    style="border-radius: 26px;width: 248px;height: 301px;padding:0px !important">
                                    <div class="card-header fw-800"
                                        style="color: #6400C8;font-size: 16px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;border-radius: 26px 26px 0 0"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="{{ $course->title }}">
                                        {{ $course->title }}
                                    </div>
                                    <div class="card-body">
                                        @if ($course->banner)
                                            <img class="img-fluid" height="96" width="112"
                                                src="{{asset($course->banner)}}"
                                                alt="Course Banner">
                                        @else
                                            <img class="img-fluid" height="96" width="112"
                                                src="/img/category_details/default-image.png" alt="Exam image">
                                        @endif
                                    </div>
                                    <a href="{{ route('course-preview', $course->slug ) }}">
                                        <div class="card-footer fw-700 text-white d-flex justify-content-between" style="border-radius: 0 0 26px 26px;background:#FA9632">
                                          <span style="font-size: .9rem">Course Details</span>
                                          <span style="font-size: .9rem">{{!empty($course->price) && !is_null($course->price) ? 'PAID': 'FREE'}}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        {{-- course part ends  --}}

                        {{-- bundle part  --}}
                        @foreach ($bundles as $bundle)
                            <div class="mb-4">
                                <div class="card text-center"
                                    style="border-radius: 26px;width: 248px;height: 301px;padding:0px !important">
                                    <div class="card-header fw-800"
                                        style="color: #6400C8;font-size: 16px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;border-radius: 26px 26px 0 0"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="{{$bundle->bundle_name }}">
                                        {{ $bundle->bundle_name }}
                                    </div>
                                    <div class="card-body">
                                        @if ($bundle->banner)
                                            <img class="img-fluid" height="96" width="112"
                                                src="{{asset($bundle->banner)}}"
                                                alt="Course Banner">
                                        @else
                                            <img class="img-fluid" height="96" width="112"
                                                src="/img/category_details/default-image.png" alt="Exam image">
                                        @endif
                                    </div>
                                    <a href="{{ route('bundle-preview', $bundle->slug ) }}">
                                        <div class="card-footer fw-700 text-white d-flex justify-content-between" style="border-radius: 0 0 26px 26px;background:#FA9632">
                                          <span style="font-size: .9rem">Bundle Details</span>
                                          <span style="font-size: .9rem">{{!empty($bundle->price) && !is_null($bundle->price) ? 'PAID': 'FREE'}}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        {{-- bundle part ends  --}}
                    </div>
                @else
                    <div class="text-center py-4 mb-4">
                        <h1>No Courses or Bundles For This Program Exist !!</h1>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-landing-layout>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
