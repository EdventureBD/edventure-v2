{{--previous student/pages/course/course_preview.blade.php--}}

<x-landing-layout headerBg="white">
    <div class="page-section course-info bg-gradient-purple py-5 px-3 px-md-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="text-white">{{ $bundle->bundle_name }}</h1>
                    <p class="lead text-white-50 measure-hero-lead">{{ $bundle->description }}</p>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-start">
                        @if(!empty($bundle->trailer))<a href="student-lesson.html" class="d-inline-block text-dark bg-light-gray bradius-15 bshadow px-3 fw-600 py-2"  data-toggle="modal" data-target="#showTrailer">Watch
                            trailer <i class="fas fa-play ml-2"></i>
                        </a>@endif
                        <div class="modal fade" id="showTrailer" tabindex="-1" role="dialog" aria-labelledby="showTrailer" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="text-right">
                                <button type="button" class="close pr-2 text-sm" data-dismiss="modal" aria-label="Close" onclick="closeVideo()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <iframe  src="https://www.youtube.com/embed/{{$bundle->trailer ? $bundle->trailer : 'xcJtL7QggTI'}}" title="YouTube video player" width="100%" height="420px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        
                                </div>
                            </div>
                            </div>
                        </div>
                        <a href="{{ route('bundle_enroll', $bundle->slug) }}" class="d-inline-block text-dark bg-light-gray bradius-15 bshadow px-3 fw-600 py-2 ml-3">@if ($bundle->price > 0) Enroll Now @else Enroll Now (free) @endif</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
        <div class="container page__container">
            <ul class="flex align-items-sm-center my-3 ">
                <li class="nav-item navbar-list__item d-inline-block">
                    <i class="far fa-clock"></i>
                    {{ $bundle->duration }} month
                </li>
                <li class="nav-item navbar-list__item ml-4 d-inline-block">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M18.09,10.5V9H9.59V4.5A1.5,1.5 0 0,0 8.09,3A1.5,1.5 0 0,0 6.59,4.5A1.5,1.5 0 0,0 8.09,6V9H5.09V10.5H8.09V16.7C8.09,19.06 10,20.97 12.34,21C14.68,20.96 16.54,19.04 16.5,16.7C16.5,15.11 15.75,13.61 14.5,12.62C14.28,12.44 14.05,12.28 13.8,12.15C13.58,12.05 13.34,12 13.1,12C12.39,12 11.74,12.39 11.39,13C11.2,13.3 11.1,13.65 11.1,14C11.11,15.1 12,16 13.11,16C13.73,16 14.31,15.69 14.69,15.2C14.9,15.67 15,16.18 15,16.7C15.04,18.2 13.86,19.45 12.34,19.5C10.81,19.5 9.58,18.23 9.59,16.7V10.5H18.09Z" />
                    </svg>
                    {{ $bundle->price }}
                </li>

            </ul>
        </div>
    </div>


    <div class="border-bottom-2 py-5 bg-light-gray">
        <div class="container page__container max-w-50 w-100">
            @if(Session::has('message'))
                <div class="alert alert-warning">{{ Session::get('message') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="pb-0 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="page-separator">
                <div class="page-separator__text bg-purple-light text-center bradius-10 py-3 d-inline-block w-100 text-gray text-sm"><span class="fw-700">Solution Of The Exams</span>
                    <p class="text-gray text-xxsm fw-200  lh-5">Solution videos and PDFs will appear here after everyone has completed all the exams</p>
                </div>
            </div>
            
            <h1 class="text-center mt-3" style="font-weight: 600;"> Courses </h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                        @forelse ($bundle->courses as $course)
                            <div class="accordion__item">
                                <div class="row no-gutters accordion__toggle bg-light-gray mt-3 py-3 px-3 bradius-15 bshadow text-dark fw-600" data-toggle="collapse" data-target="#course-toc-{{ $course->id }} " data-parent="#parent">
                                    <div class="col-11 title text-md-left text-center">
                                        <span class="pl-4">{{ $course->title }} </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No Courses found
                        @endforelse
                    </div>
                </div>
            </div>

            <h1 class="text-center mt-3" style="font-weight: 600;"> Lectures </h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                        @php
                            $show = true;
                        @endphp
                        @forelse ($bundle->courses as $course)
                            @forelse ($course->courseTopic as $course_topic)
                                @forelse ($course_topic->CourseLecture as $lecture)
                                    <div class="accordion__item">
                                        <div class="row no-gutters accordion__toggle bg-light-gray mt-3 py-3 px-3 bradius-15 bshadow text-dark fw-600" data-toggle="collapse" data-target="#course-toc-{{ $lecture->id }} " data-parent="#parent">
                                            <div class="col-11 title text-md-left text-center">
                                                <span class="pl-4">{{ $lecture->title }} </span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    @if($show)
                                        <p class="text-center mt-2" style="font-weight: 600;"> No Lectures Found </p>
                                    @endif
                                    @php
                                        $show = false;
                                    @endphp
                                @endforelse
                            @empty
                                @if($show)
                                    <p class="text-center mt-2" style="font-weight: 600;"> No Lectures Found </p>
                                @endif
                                @php
                                    $show = false;
                                @endphp
                            @endforelse
                        @empty
                            @if($show)
                                <p class="text-center mt-2" style="font-weight: 600;"> No Lectures Found </p>
                            @endif
                            @php
                                $show = false;
                            @endphp
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
    function closeVideo(){
        var modalIframe = document.querySelector("#showTrailer iframe");
        modalIframe.src = modalIframe.src;
    }
    </script>
</x-landing-layout>