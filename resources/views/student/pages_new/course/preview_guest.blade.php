<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- custom css link  --}}
    <link rel="stylesheet" href="/css/course-detail.css">
    {{-- custom css link ends  --}}
<div class="page-section">
    <div class="container">
        @if(Session::has('message'))
            <div style="border-radius: 25px" class="alert alert-warning">{{ Session::get('message') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 25px">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="d-flex mb-3" id="parent-div">
            <div class="w-100  mt-5">
                <h2 class="bold-header text-center" id="course-title-1">
                    {{ $course->title }}
                </h2>

                <div class="includes">
                    <div class="row">
                        <div class="col-md-6 d-flex my-2">
                            <div class="col-4 p-0 my-auto">
                                <img class="img-fluid" src="/img/category_details/participant.png" alt="participant's photo"/>
                            </div>
                            <div class="col-8 d-flex flex-column p-0 my-auto">
                                <div class="text-nowrap detail-parts-font">কোর্সটি করছেন </div>
                                <div class="text-nowrap detail-parts-font">
                                    {{\App\Enum\Converter::en2bn($course->totalCourseEnrolled()).' জন'}}
                                </div>
                            </div>
                        </div>

                        @if($course->time_allotted)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/timer.png" alt="timers">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">সময় লাগবে </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($course->time_allotted) ?? 0}} ঘন্টা
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($course->video_lecture)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/completeSolution.png" alt="video lectures">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">ভিডিও লেকচার </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($course->video_lecture) ?? 0}}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($course->given_notes)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/paperFinal.png" alt="notes">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">নোটস</div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($course->given_notes) ?? 0}}
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if($course->quiz)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/quiz-mindmap-img/Quiz.png" alt="quiz">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">কুইজ</div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($course->quiz) ?? 0}} টি
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if($course->mind_map)
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/quiz-mindmap-img/Mindmap.png" alt="mindmap">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">মাইন্ড ম্যাপ  </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($course->mind_map) ?? 0}}
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
                @php($teachers = $course->teacher_lists)
                @if($teachers)
                    <div class="teachers mt-5">
                        <h5 class="bold-header">শিক্ষক</h5>
                        <div class="d-flex overflow-x-scroll"
                             style="border-radius: 25px 25px 0 0; background-color: #eeeeee; padding: 10px">
                             @foreach($teachers as $teacher)
                                <div class="teachers-parent text-center {{ count($teachers) == 1 ? 'col-12' : 'col-6'}} d-flex flex-column justify-content-center align-items-center">
                                    @if($teacher->image)
                                        <img style="border-radius: 50%" height="80" width="80" src="{{$teacher->image}}" alt="teacher's image" class="teachers-image">
                                    @else
                                        <img height="80" width="80" src="/img/category_details/teacher.png" alt=""  class="teachers-image">
                                    @endif
                                    <span class="teachers-name"><b>{{$teacher->name}}</b></span>
                                        <small class="teachers-education">{{$teacher->teacherDetails->education ?? ''}}</small>
                                        <small class="teachers-detail">
                                            @if($teacher->teacherDetails && $teacher->teacherDetails->year_of_experience && $teacher->teacherDetails->expertise)
                                                {{$teacher->teacherDetails->year_of_experience}} years of teaching experience in {{$teacher->teacherDetails->expertise}}
                                            @endif
                                        </small>
                                </div>
                            @endforeach
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
                               style="border-top-right-radius: 0px !important; padding:15px">বিস্তারিত</a>

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
                            @if($course->description)
                                <div class="my-3">
                                    <h5 class="bold-header my-3">কোর্স সম্পর্কে</h5>
                                    <div class="p-3 course-detail-single-unit">
                                        {{$course->description}}
                                    </div>
                                </div>
                            @endif

                            @if($course->course_for_whom)
                                <div class="my-3">
                                    <h5 class="bold-header my-3">কোর্সটি কাদের জন্য?</h5>
                                    <div class="p-3 course-detail-single-unit">
                                        {{$course->course_for_whom}}
                                    </div>
                                </div>
                            @endif
                            <div class="my-3">
                                <h5 class="bold-header my-3">কোর্সের জন্য কী কী লাগবে?</h5>
                                <div class="p-3 course-detail-single-unit">
                                    শুধু ল্যাপটপ/মোবাইল ফোনে ইন্টারনেট কানেকশন এবং যেকোনো ব্রাউজার হলেই কোর্সটি করা যাবে। আমাদের এখনো কোনো অ্যাপ নেই, তাই আলাদা কোনো অ্যাপ ইনস্টল করার দরকারও নেই!
                                </div>
                            </div>

                        </div>
                        <div style="padding: 20px;overflow-y:scroll;word-break: break-word;" class="tab-pane text-justify col-md-12 fade"
                             id="examRoutine"
                             role="tabpanel"
                             aria-labelledby="examRoutine-tab">
                            @if(true)
                                <div class="faq my-3">
                                    @if(count($course->CourseTopic) > 0)
                                        <h5 class="bold-header">কোর্সে কী কী লার্নিং ম্যাটেরিয়াল পাচ্ছেন?</h5>
                                        <div class="d-flex justify-content-between align-items-center my-4">
                                            <div class="bold-header">
                                                Course Content
                                            </div>
                                        </div>
                                    @endif
                                    <div class="accordion mt-5" id="accordionExample">
                                        @forelse ($course->CourseTopic as $batchTopic)
                                            <div class="tabtab" style="margin-bottom: 20px">
                                                <div style="background-color: #FFFFFF; border-radius: 15px; padding: 10px;box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                                    <h2 class="mb-0">
                                                        <button style="color: #6400c8; font-weight: bold;text-shadow: 2px 1px 4px white;"
                                                                class="btn btn-block text-left panel-heading focus-boxShadow-none"
                                                                type="button"
                                                                data-target="#batchTab{{$loop->iteration}}">
                                                            {{ $batchTopic->title }}
                                                        </button>
                                                    </h2>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="d-flex justify-content-center">
                                                <h5 style="color: #6400C8" class="font-weight-bold">No Topics uploaded yet</h5>
                                            </div>
                                        @endforelse
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
                                 class="panel-collapse collapse mt-2 one text-justify py-2"
                                 aria-labelledby="headingOne">
                                আমাদের ওয়েবসাইট পরিচালনায় অথবা আমাদের কোর্স সম্পর্কে কোন জিজ্ঞাসা থাকলে সরাসরি ক্লিক করো ফেইসবুক মেসেঞ্জার আইকনে (স্ক্রীনের নিচে ডানদিকে) আর লগ ইন করে আমাদের কাছে লিখে পাঠাও তোমার সম্মুখীন হওয়া সমস্যাগুলো। দ্রুততম সময়ে সমস্যা সমাধানে আমরা আছি তোমাদের সাথে।
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
                                 class="panel-collapse collapse mt-2 two text-justify py-2"
                                 aria-labelledby="headingTwo">
                                কোর্সটি কিনতে প্রথমেই লগ ইন করো আমাদের Edventure প্ল্যাটফর্মে, প্রোমো কোড থাকলে তা অ্যাপ্লাই করে তারপর “এক্সামটি কিনুন” বাটনটিতে ক্লিক করো। SurjoPay দিয়ে বিকাশ, নগদ, রকেট সহ অন্যান্য ব্যাংক একাউন্টের মাধ্যমে তোমার সুবিধামতো পেমেন্ট করে সহজেই এনরোল করো  আমাদের কোর্সে।
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 ml-lg-5 mt-5">
                <h1 class="bold-header d-none" id="course-title-2">
                    {{ $course->title }}
                </h1>
                <div class="test">
                    <iframe
                        id="iframe"
                        src="https://www.youtube.com/embed/{{$course->trailer ? $course->trailer : '2K4xUL5tsaM'}}"
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>


                    <div class="payment-btn text-center">
                        @php($href = auth()->check() ? route('enroll', $course->slug)  : 'javascript:void(0)')
                        @php($loginAlert = auth()->check() ? '' : 'loginAlert')
                        @php($paidCourse = !empty($course->price) && !is_null($course->price))
                        <div id="payment_section">
                                <div class="d-flex justify-content-around">
                                    @if($paidCourse)
                                    <span class="actual-price">{{$course->price}}</span>
                                    @endif
                                </div>
                                <a class="{{$loginAlert}} btn category-details-action-btn"
                                   href="{{$href}}">
                                    {{$paidCourse ? 'কোর্সটি কিনুন' : 'কোর্সটি এনরোল করুন'}}
                                </a>
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
