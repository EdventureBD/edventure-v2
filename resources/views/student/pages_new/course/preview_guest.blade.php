{{--previous student/pages/course/course_preview.blade.php--}}

{{-- <x-landing-layout headerBg="white">
    <div class="page-section course-info bg-gradient-purple py-5 px-3 px-md-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="text-white">{{ $course->title }}</h1>
                    <p class="lead text-white-50 measure-hero-lead">{{ $course->description }}</p>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-start">
                        @if(!empty($course->trailer))<a href="student-lesson.html" class="d-inline-block text-dark bg-light-gray bradius-15 bshadow px-3 fw-600 py-2"  data-toggle="modal" data-target="#showTrailer">Watch
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

                                    <iframe  src="https://www.youtube.com/embed/{{$course->trailer ? $course->trailer : 'xcJtL7QggTI'}}" title="YouTube video player" width="100%" height="420px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                </div>
                            </div>
                            </div>
                        </div>
                            <a href="{{ route('enroll', $course->slug) }}" class="d-inline-block text-dark bg-light-gray bradius-15 bshadow px-3 fw-600 py-2 ml-3">@if ($course->price > 0) Enroll Now @else Enroll Now (free) @endif</a>

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
                    {{ $course->duration }} month
                </li>
                <li class="nav-item navbar-list__item ml-4 d-inline-block">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M18.09,10.5V9H9.59V4.5A1.5,1.5 0 0,0 8.09,3A1.5,1.5 0 0,0 6.59,4.5A1.5,1.5 0 0,0 8.09,6V9H5.09V10.5H8.09V16.7C8.09,19.06 10,20.97 12.34,21C14.68,20.96 16.54,19.04 16.5,16.7C16.5,15.11 15.75,13.61 14.5,12.62C14.28,12.44 14.05,12.28 13.8,12.15C13.58,12.05 13.34,12 13.1,12C12.39,12 11.74,12.39 11.39,13C11.2,13.3 11.1,13.65 11.1,14C11.11,15.1 12,16 13.11,16C13.73,16 14.31,15.69 14.69,15.2C14.9,15.67 15,16.18 15,16.7C15.04,18.2 13.86,19.45 12.34,19.5C10.81,19.5 9.58,18.23 9.59,16.7V10.5H18.09Z" />
                    </svg>
                    {{ $course->price }}
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
                        <ul>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                        @forelse ($course_topics as $batchTopic)
                            <div class="accordion__item  ">
                                <div class="row no-gutters accordion__toggle bg-light-gray mt-3 py-3 px-3 bradius-15 bshadow text-dark fw-600" data-toggle="collapse" data-target="#course-toc-{{ $batchTopic->id }} " data-parent="#parent">
                                    <div class="col-11 title text-md-left text-center">
                                        <span class="pl-4">{{ $batchTopic->title }} </span>
                                    </div>

                                </div>

                            </div>
                        @empty
                            No Topics found
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
</x-landing-layout> --}}

{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++new design starts ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- custom css link  --}}
    <link rel="stylesheet" href="/css/course-detail.css">
    {{-- custom css link ends  --}}
<div class="page-section">
    <div class="container">
        @if ($errors->any())
            <div class="alert mt-5 alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="d-flex mb-3" id="parent-div">
            <div class="w-100  mt-5">
                <h1 class="bold-header">
                    {{ $course->title }}
                </h1>

                <div class="includes">
                    <div class="row">
                        <div class="col-md-6 d-flex my-2">
                            <div class="col-4 p-0 my-auto">
                                <img class="img-fluid" src="/img/category_details/participant.png" alt="participant's photo"/>
                            </div>
                            <div class="col-8 d-flex flex-column p-0 my-auto">
                                <div class="text-nowrap detail-parts-font">কোর্সটি করছেন </div>
                                <div class="text-nowrap detail-parts-font">
                                    {{-- @if(!is_null($category->price) && $category->price != 0)
                                        @php($number = $category->payment_of_categories_count <= 83 ? 83 : $category->payment_of_categories_count)
                                        {{\App\Enum\Converter::en2bn($number)}} জন
                                    @else
                                        @php($number = $category->total_participation_count <= 83 ? 83 : $category->total_participation_count)
                                        {{\App\Enum\Converter::en2bn($number)}} জন
                                    @endif --}}
                                </div>
                            </div>
                        </div>

                        @if(true)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/timer.png" alt="timers">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">সময় লাগবে </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{-- {{\App\Enum\Converter::en2bn($category->time_allotted)}} --}}1 ঘন্টা
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(true)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/completeSolution.png" alt="video lectures">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">ভিডিও লেকচার </div>
                                    <div class="text-nowrap detail-parts-font">
                                        250 <span style="font-size: 20px;font-weight: 600;">+</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(true)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/paperFinal.png" alt="notes">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">নোটস</div>
                                    <div class="text-nowrap detail-parts-font">
                                        10 <span style="font-size: 20px;font-weight: 600;">+</span>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if(true)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/course-detail/quiz.png" alt="quiz">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">কুইজ</div>
                                    <div class="text-nowrap detail-parts-font">
                                        50 টি
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if(true)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/course-detail/mindMap.png" alt="mindmap">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">মাইন্ড ম্যাপ  </div>
                                    <div class="text-nowrap detail-parts-font">
                                        250 <span style="font-size: 20px;font-weight: 600;">+</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>

                @if(true)
                    <div class="teachers mt-5">
                        <h5 class="bold-header">শিক্ষক</h5>
                        <div class="d-flex"
                             style="border-radius: 25px; background-color: #eeeeee; padding: 10px">
                            {{-- @foreach($category->teacher_lists as $teacher)
                                <div class="text-center col-6 d-flex flex-column justify-content-center align-items-center" style="padding: 0 10px; align-content: center; border-right: 1px solid lightgrey;height: 175px">
                                    @if($teacher->image)
                                        <img style="border-radius: 50%" height="80" width="80" src="{{$teacher->image}}" alt="">
                                    @else
                                        <img height="80" width="80" src="/img/category_details/teacher.png" alt="">
                                    @endif
                                    <span><b>{{$teacher->name}}</b></span>
                                        <span>A great teacher of all</span>
                                </div>
                            @endforeach --}}
                            <div class="text-center col-12 d-flex flex-column justify-content-center align-items-center"
                                 style="padding: 0 10px; align-content: center; height: 175px">
                                @if(true)
                                    <img style="border-radius: 50%" height="80" width="80" src="/" alt="">
                                @else
                                    <img height="80" width="80" src="/img/category_details/teacher.png" alt="">
                                @endif
                                <span><b>My name</b></span>
                                <span>A great teacher of all</span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="exam-details mt-5">
                    <nav>
                        <div class="nav custom-shadow nav-tabs d-flex justify-content-center align-items-center" id="nav-tab" role="tablist">
                            <a class="nav-link active"
                               data-toggle="tab"
                               href="#examDetails"
                               role="tab"
                               aria-controls="examDetails"
                               aria-selected="true"
                               style="border-top-right-radius: 0px !important; padding:15px">কোর্সের বিস্তারিত</a>

                            <a class="nav-link"
                               data-toggle="tab"
                               href="#examRoutine"
                               role="tab"
                               aria-controls="examRoutine"
                               aria-selected="false"
                               style="border-top-left-radius: 0px !important; padding: 15px">সিলেবাস</a>

                        </div>
                    </nav>
                    <div style="border: 5px solid #eeeeee; border-radius: 15px; background-color: #eeeeee" class="tab-content mt-5" id="nav-tabContent">
                        <div style="padding: 20px;overflow-y:scroll;word-break: break-word;" class="tab-pane text-justify col-md-12 fade active show"
                             id="examDetails"
                             role="tabpanel"
                             aria-labelledby="video-tab">
                            @if(true)
                                {{-- {!! $category->details !!} --}}

                                <div class="my-3">
                                    <h5 class="bold-header my-3">কোর্স সম্পর্কে</h5>
                                    <div class="p-3 course-detail-single-unit">
                                        বিশ্ববিদ্যালয় ভর্তি পরীক্ষার্থীদের কাছে English যেন এক আতংকের নাম। ঢাকা বিশ্ববিদ্যালয়ের ভর্তি পরীক্ষায় শতকরা ৯০ ভাগ মানুষ English এ ফেইল করে। আমাদের স্বপ্নের বিশ্ববিদ্যালয়ে পড়াশুনার পথে বাধা হয়ে দাঁড়ায় এই একটি
                                        বিষয়।৬ বছর বিশ্ববিদ্যালয় মেন্টরিং এর অভিজ্ঞতা বিশ্ববিদ্যালয় ভর্তি পরীক্ষার্থীদের কাছে English যেন এক আতংকের নাম। ঢাকা বিশ্ববিদ্যালয়ের ভর্তি পরীক্ষায় শতকরা ৯০ ভাগ মানুষ English এ ফেইল করে। আমাদের স্বপ্নের
                                        বিশ্ববিদ্যালয়ে পড়াশুনার পথে বাধা হয়ে দাঁড়ায় এই একটি  my-2বিষয়।৬ বছর বিশ্ববিদ্যালয় মেন্টরিং এর অভিজ্ঞতা
                                    </div>
                                </div>
                                <div class="my-3">
                                    <h5 class="bold-header my-3">কোর্সটি কাদের জন্য?</h5>
                                    <div class="p-3 course-detail-single-unit">
                                        বিশ্ববিদ্যালয়ে ভর্তি হতে চাও এবং পরীক্ষায় English আছে- এমন হলেই কোর্সটি তোমাদের জন্য। One course for all varsity admissions!

                                    </div>
                                </div>
                                <div class="my-3">
                                    <h5 class="bold-header my-3">কোর্সের জন্য কী কী লাগবে?</h5>
                                    <div class="p-3 course-detail-single-unit">
                                        শুধু ল্যাপটপ/মোবাইল ফোনে ইন্টারনেট কানেকশন এবং যেকোনো ব্রাউজার হলেই কোর্সটি করা যাবে। আমাদের এখনো কোনো অ্যাপ নেই, তাই আলাদা কোনো অ্যাপ ইনস্টল করার দরকারও নেই!
                                    </div>
                                </div>
                                <div class="my-3">
                                    <h5 class="bold-header my-3">কোর্সের জন্য কী কী লাগবে?</h5>
                                    <div class="p-3 course-detail-single-unit">
                                        শুধু ল্যাপটপ/মোবাইল ফোনে ইন্টারনেট কানেকশন এবং যেকোনো ব্রাউজার হলেই কোর্সটি করা যাবে। আমাদের এখনো কোনো অ্যাপ নেই, তাই আলাদা কোনো অ্যাপ ইনস্টল করার দরকারও নেই!
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <img style="width: 100%; height: 100%" src="/img/category_details/exam_details.svg"/>
                                    <span style="color: grey">এক্সামের বিস্তারিত এখানে দেয়া হবে</span>
                                </div>
                            @endif

                        </div>
                        <div style="padding: 20px;overflow-y:scroll;word-break: break-word;" class="tab-pane text-justify col-md-12 fade"
                             id="examRoutine"
                             role="tabpanel"
                             aria-labelledby="examRoutine-tab">
                            @if(true)
                                <div class="faq my-3">
                                    <h5 class="bold-header">কোর্সে কী কী লার্নিং ম্যাটেরিয়াল পাচ্ছেন?</h5>
                                    <div class="d-flex justify-content-between align-items-center my-4">
                                        <div class="bold-header">
                                            Course Content
                                        </div>
                                        <div style="background: #FFFFFF;
                                        border-radius: 27.5765px;">
                                            <h2 class="mb-0">
                                                <button style="color: #6400c8; font-weight: bold;text-shadow: 2px 1px 4px white;"
                                                        class="btn btn-block text-left panel-heading focus-boxShadow-none"
                                                        type="button"
                                                        data-toggle="collapse"
                                                        data-target=".collapse-all"
                                                        aria-expanded="true"
                                                        id="headingOne"
                                                        aria-controls="itemOne">
                                                        Collapse All
                                                </button>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="accordion mt-5" id="accordionExample">
                                        <div class="tabtab">
                                            <div style="background-color: #FFFFFF; border-radius: 15px; padding: 10px;box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                                <h2 class="mb-0">
                                                    <button style="color: #6400c8; font-weight: bold;text-shadow: 2px 1px 4px white;"
                                                            class="btn btn-block text-left panel-heading focus-boxShadow-none"
                                                            type="button"
                                                            data-toggle="collapse"
                                                            data-target="#courseMaterialOne"
                                                            aria-expanded="true"
                                                            id="headingOne"
                                                            aria-controls="itemOne">
                                                            Sentence Structure
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="courseMaterialOne"
                                                class="panel-collapse collapse mt-2 one collapse-all"
                                                aria-labelledby="headingOne">
                                                পাখিরাই সাধারণত কীট-পতঙ্গের প্রধান শত্রু। পাখি এবং অন্যান্য শত্রুদের আক্রমণ এড়াবার জন্যে কীট-পতঙ্গ জাতীয় প্রাণীদের মধ্যে  অপেক্ষাকৃত উন্নত শ্রেণীর প্রাণী অপেক্ষা বহুল পরিমাণে অনুকরণপ্রিয়তা পরিলক্ষিত হয়।
                                            </div>
                                        </div>

                                        <div class="tabtab">
                                            <div class="mt-4" style="background-color: #FFFFFF; border-radius: 15px; padding: 10px;box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                                <h2 class="mb-0">
                                                    <button
                                                        style="color: #6400c8; font-weight: bold; text-shadow: 2px 1px 4px white;"
                                                        class="btn btn-block text-left panel-heading focus-boxShadow-none"
                                                        type="button"
                                                        data-toggle="collapse"
                                                        data-target="#courseMaterialTwo"
                                                        aria-expanded="true"
                                                        id="headingTwo"
                                                        aria-controls="itemTwo">
                                                        Other things in sentence
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="courseMaterialTwo"
                                                class="panel-collapse collapse mt-2 two collapse-all"
                                                aria-labelledby="headingTwo">
                                                পাখিরাই সাধারণত কীট-পতঙ্গের প্রধান শত্রু। পাখি এবং অন্যান্য শত্রুদের আক্রমণ এড়াবার জন্যে কীট-পতঙ্গ জাতীয় প্রাণীদের মধ্যে  অপেক্ষাকৃত উন্নত শ্রেণীর প্রাণী অপেক্ষা বহুল পরিমাণে অনুকরণপ্রিয়তা পরিলক্ষিত হয়।
                                            </div>
                                        </div>

                                        <div class="tabtab">
                                            <div class="mt-4" style="background-color: #FFFFFF; border-radius: 15px; padding: 10px;box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                                <h2 class="mb-0">
                                                    <button
                                                        style="color: #6400c8; font-weight: bold; text-shadow: 2px 1px 4px white;"
                                                        class="btn btn-block text-left panel-heading focus-boxShadow-none"
                                                        type="button"
                                                        data-toggle="collapse"
                                                        data-target="#courseMaterialThree"
                                                        aria-expanded="true"
                                                        id="headingTwo"
                                                        aria-controls="itemTwo">
                                                        Different kinds of sentences
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="courseMaterialThree"
                                                class="panel-collapse collapse mt-2 two collapse-all"
                                                aria-labelledby="headingTwo">
                                                পাখিরাই সাধারণত কীট-পতঙ্গের প্রধান শত্রু। পাখি এবং অন্যান্য শত্রুদের আক্রমণ এড়াবার জন্যে কীট-পতঙ্গ জাতীয় প্রাণীদের মধ্যে  অপেক্ষাকৃত উন্নত শ্রেণীর প্রাণী অপেক্ষা বহুল পরিমাণে অনুকরণপ্রিয়তা পরিলক্ষিত হয়।
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <img style="width: 100%; height: 100%" src="/img/category_details/exam_routine.svg"/>
                                    <span style="color: grey">এক্সামের রুটিন এখানে দেয়া হবে</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="faq mt-5">
                    <h5 class="bold-header">সচারচর জিজ্ঞাসা</h5>
                    <div class="accordion mt-5" id="accordionExample">
                        <div class="tabtab">
                            <div style="background-color: #eeeeee; border-radius: 15px; padding: 10px;box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                <h2 class="mb-0">
                                    <button style="color: #6400c8; font-weight: bold;text-shadow: 2px 1px 4px white;"
                                            class="btn btn-block text-left panel-heading focus-boxShadow-none"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#itemOne"
                                            aria-expanded="true"
                                            id="headingOne"
                                            aria-controls="itemOne">
                                        কোনো টেকনিক্যাল সমস্যা কিভাবে রিপোর্ট করবো?
                                    </button>
                                </h2>
                            </div>
                            <div id="itemOne"
                                 class="panel-collapse collapse mt-2 one"
                                 aria-labelledby="headingOne">
                                পাখিরাই সাধারণত কীট-পতঙ্গের প্রধান শত্রু। পাখি এবং অন্যান্য শত্রুদের আক্রমণ এড়াবার জন্যে কীট-পতঙ্গ জাতীয় প্রাণীদের মধ্যে  অপেক্ষাকৃত উন্নত শ্রেণীর প্রাণী অপেক্ষা বহুল পরিমাণে অনুকরণপ্রিয়তা পরিলক্ষিত হয়।
                            </div>
                        </div>

                        <div class="tabtab">
                            <div class="mt-4" style="background-color: #eeeeee; border-radius: 15px; padding: 10px;box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                <h2 class="mb-0">
                                    <button
                                        style="color: #6400c8; font-weight: bold; text-shadow: 2px 1px 4px white;"
                                        class="btn btn-block text-left panel-heading focus-boxShadow-none"
                                        type="button"
                                        data-toggle="collapse"
                                        data-target="#itemTwo"
                                        aria-expanded="true"
                                        id="headingTwo"
                                        aria-controls="itemTwo">
                                        কোর্সটি কিভাবে কিনবো?
                                    </button>
                                </h2>
                            </div>
                            <div id="itemTwo"
                                 class="panel-collapse collapse mt-2 two"
                                 aria-labelledby="headingTwo">
                                পাখিরাই সাধারণত কীট-পতঙ্গের প্রধান শত্রু। পাখি এবং অন্যান্য শত্রুদের আক্রমণ এড়াবার জন্যে কীট-পতঙ্গ জাতীয় প্রাণীদের মধ্যে  অপেক্ষাকৃত উন্নত শ্রেণীর প্রাণী অপেক্ষা বহুল পরিমাণে অনুকরণপ্রিয়তা পরিলক্ষিত হয়।
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 ml-lg-5 mt-5">
                <div class="test">
                    <iframe
                        id="iframe"
                        src=""
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>


                    <div class="payment-btn text-center">
                        @php($href = auth()->check() ? route('enroll', $course->slug)  : 'javascript:void(0)')
                        @php($loginAlert = auth()->check() ? '' : 'loginAlert')

                        <div id="payment_section">
                                <div class="d-flex justify-content-around">
                                    <span class="actual-price">{{$course->price}}</span>
                                </div>
                                <a class="{{$loginAlert}} btn category-details-action-btn" href="{{$href}}">কোর্সটি কিনুন</a>
                        </div>

                    </div>

                    <div class="payment-info text-center mt-2">
                        <span style="font-size: 13px; color: grey">কোর্সটি কিনুন, বাটনটিতে ক্লিক করলে আপনার পেমেন্ট প্রক্রিয়া শুরু হয়ে যাবে। </span><br>
                        <span style="font-size: 13px; color: grey">পেমেন্ট প্রক্রিয়া বিস্তারিত জানতে এই </span> <a style="text-decoration: none; font-size: 13px; margin-left: 2px" href="/">ভিডিও দেখুন </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</x-landing-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $(window).scroll(function(){
        if($(this).scrollTop() > 300){
            $('.payment-btn').addClass('sticky')
        } else{
            $('.payment-btn').removeClass('sticky')
        }
    });
    $('.loginAlert').on('click', function () {
        Swal.fire({
            icon: 'info',
            title: 'Please login to continue',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
    })



    $('.one').on('show.bs.collapse', function () {
        $('#headingOne').addClass('active');
    });

    $('.one').on('hide.bs.collapse', function () {
        $('#headingOne').removeClass('active');
    });

    $('.two').on('show.bs.collapse', function () {
        $('#headingTwo').addClass('active');
    });

    $('.two').on('hide.bs.collapse', function () {
        $('#headingTwo').removeClass('active');
    });
</script>
