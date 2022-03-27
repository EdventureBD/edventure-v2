<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #iframe {
            width: 100%!important;
            height: 248px!important;
            border-radius: 15px;
        }
        .includes {
            border: 1px solid #fa9632;
            border-radius: 15px;
            padding: 15px;
            font-weight: bold;
        }
        .marginLeft10 {
            margin-left: 10px
        }
        .bold-header {
            font-weight: bolder;
            color: #6400c8;
        }
        .scroll-y {
            overflow-y: auto;
            max-height: 10vh;
        }

        .scroll-x {
            overflow-x: auto;
            overflow-y: hidden;
            max-width: 50%;
            height: 100px;
        }
        .nav-tabs .nav-link {
            border: 3px solid #6400c8;
            color: #6400c8;
            width: 50%;
            text-align: center;
            font-weight: bold;
        }
        .nav-tabs .nav-link:hover {
            border: 3px solid #6400c8;
        }
        .nav-tabs .nav-link:nth-child(1) {
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .nav-tabs .nav-link:nth-child(2) {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
            color: white;
            background-color: #6400c8;
            border-color: #6400c8 #6400c8 #6400c8;
            padding: 15px;
            text-shadow: 2px 1px 4px black;
        }
        .nav-tabs {
            border-bottom: none;
        }
        .custom-shadow {
            filter: drop-shadow(0px 103.559px 168.131px rgba(0, 0, 0, 0.100973)) drop-shadow(0px 23.1312px 37.5543px rgba(0, 0, 0, 0.149027)) drop-shadow(0px 6.88678px 11.1809px rgba(0, 0, 0, 0.25));

        }
        #headingOne:before,
        #headingTwo:before {
            font-family: 'Font Awesome 5 Free';
            content: "\f107";
            float: right;
            transition: all 0.5s;
        }
        #headingOne.active:before,
        #headingTwo.active:before{
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            transform: rotate(180deg);
        }
        .sticky {
            position: fixed;
            top: 8% !important;
            width: 531px;
        }

        @media (max-width: 768px) {
            .sticky {
                top: 7% !important;
                width: 320px !important;
            }
        }
        @media (max-width: 576px) {
            .sticky {
                top: 9% !important;
                width: 330px !important;
            }
            #parent-div {
                flex-direction: column-reverse;
            }
        }

        @media (min-width: 578px) {
            #parent-div {
                flex-direction: row;
            }
        }
        .payment-btn {
            border: 1px solid #fa9632;
            border-radius: 15px;
            padding: 10px;
            background-color: #fafafa;
        }

        .category-details-action-btn:before {
            font-family: 'Font Awesome 5 Free';
            content: "\f0a9";
            float: right;
            margin-left: 5px;
            font-size: 20px;
        }
        .category-details-action-btn {
            padding: 15px;
            border-radius: 15px;
            width: 100%;
            font-size: 15px;
            font-weight: 800;
            background-color: #FA9632;
            color: white;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease 0s;
            cursor: pointer;
            text-shadow: 2px 1px 4px black;
        }

        .category-details-action-btn:hover {
            /*background-color: #ffb300;*/
            background-color: #f2a44b;
            box-shadow: 0 15px 20px rgba(231, 128, 108, 0.4);
            color: #fff;
            transform: translateY(-7px);
        }

        .offer-price {
            font-size: 30px;
        }

        .offer-price:before {
            content: '৳';
            font-size: 20px;
            margin-right: 5px;
        }

        .actual-price {
            font-size: 30px;
        }

        .actual-price:before {
            content: '৳';
            font-size: 20px;
            margin-right: 5px;
        }
    </style>
<div class="page-section">
    <div class="container">
        <div class="d-flex mb-3" id="parent-div">
            <div class="w-100  mt-5">
                <h1 class="bold-header">
                    {{$category->name}}
                </h1>

                <div class="includes">
                    <div class="row">
                        <div class="col-md-6 d-flex mt-3">
                            <img src="/img/category_details/icons8-users-48.png"/>
                            <span class="marginLeft10">এক্সামটি দিয়েছে <br>
                                @if(!is_null($category->price) && $category->price != 0)
                                    @php($number = $category->payment_of_categories_count <= 84 ? 84 : $category->payment_of_categories_count)
                                    {{\App\Enum\Converter::en2bn($number)}} জন
                                @else
                                    @php($number = $category->total_participation_count <= 84 ? 84 : $category->total_participation_count)
                                    {{\App\Enum\Converter::en2bn($number)}} জন
                                @endif
                            </span>
                        </div>

                        @if(!empty($category->time_allotted) && !is_null($category->time_allotted))
                            <div class="col-md-6 d-flex mt-3">
                                <img src="/img/category_details/icons8-time-48.png" alt="">
                                <span class="marginLeft10">সময় লাগবে <br> {{\App\Enum\Converter::en2bn($category->time_allotted)}} ঘন্টা</span>
                            </div>
                        @endif

                        @if(!empty($category->full_solutions) && !is_null($category->full_solutions))
                            <div class="col-md-6 d-flex mt-3">
                                <img src="/img/category_details/icons8-users-48.png"/>
                                <span class="marginLeft10">পূর্ণাঙ্গ সমাধান <br> {{\App\Enum\Converter::en2bn($category->full_solutions)}}+</span>
                            </div>
                        @endif

                        @if(!empty($category->paper_final) && !is_null($category->paper_final))
                            <div class="col-md-6 d-flex mt-3">
                                <img src="/img/category_details/icons8-time-48.png" alt="">
                                <span class="marginLeft10">পেপার ফাইনাল <br> {{\App\Enum\Converter::en2bn($category->paper_final)}} টি</span>
                            </div>
                        @endif


                        @if(!empty($category->subject_final) && !is_null($category->subject_final))
                            <div class="col-md-6 d-flex mt-3">
                                <img src="/img/category_details/icons8-users-48.png"/>
                                <span class="marginLeft10">সাবজেক্ট ফাইনাল <br> {{\App\Enum\Converter::en2bn($category->subject_final)}} টি</span>
                            </div>
                        @endif


                        @if(!empty($category->final_exam) && !is_null($category->final_exam))
                            <div class="col-md-6 d-flex mt-3">
                                <img src="/img/category_details/icons8-time-48.png" alt="">
                                <span class="marginLeft10">ফাইনাল মডেল টেস্ট <br> {{\App\Enum\Converter::en2bn($category->final_exam)}} টি</span>
                            </div>
                        @endif

                    </div>

                </div>

                @if($category->teacher_lists)
                    <div class="teachers mt-5">
                        <h5 class="bold-header">শিক্ষকবৃন্দ</h5>
                        <div class="d-flex" style="border-radius: 25px; background-color: #eeeeee; padding: 10px">
                            @foreach($category->teacher_lists as $teacher)
                                <div class="text-center" style="display: inline-grid; padding-right: 10px; padding-left: 10px; align-content: center; border-right: 1px solid lightgrey;">
                                    @if($teacher->image)
                                        <img style="border-radius: 50%" height="80" width="80" src="{{$teacher->image}}" alt="">
                                    @else
                                        <img height="80" width="80" src="/img/category_details/teacher.png" alt="">
                                    @endif
                                    <span><b>{{$teacher->name}}</b></span>
                                        <span>A great teacher of all</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="exam-details mt-5">
                    <nav>
                        <div class="nav custom-shadow nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-link active"
                               data-toggle="tab"
                               href="#examDetails"
                               role="tab"
                               aria-controls="examDetails"
                               aria-selected="true">এক্সাম বিস্তারিত</a>

                            <a class="nav-link"
                               data-toggle="tab"
                               href="#examRoutine"
                               role="tab"
                               aria-controls="examRoutine"
                               aria-selected="false">রুটিন</a>

                        </div>
                    </nav>
                    <div style="border: 25px solid #eeeeee; border-radius: 15px" class="tab-content mt-5" id="nav-tabContent">
                        <div style="padding: 10px" class="tab-pane text-center col-md-12 fade active show"
                             id="examDetails"
                             role="tabpanel"
                             aria-labelledby="video-tab">
                            @if($category->details)
                                {!! $category->details !!}
                            @else
                                <img style="width: 100%; height: 100%" src="/img/category_details/exam_details.svg"/>
                                <span style="color: grey">এক্সামের বিস্তারিত এখানে দেয়া হবে</span>
                            @endif

                        </div>
                        <div style="padding: 10px" class="tab-pane text-center col-md-12 fade"
                             id="examRoutine"
                             role="tabpanel"
                             aria-labelledby="examRoutine-tab">
                            @if($category->routine_image)
                                <img style="width: 100%; height: 100%" src="{{Storage::url('categoryRoutine/'.$category->routine_image)}}" alt="">
                            @else
                                <img style="width: 100%; height: 100%" src="/img/category_details/exam_routine.svg"/>
                                <spna style="color: grey">এক্সামের রুটিন এখানে দেয়া হবে</spna>
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
                                            class="btn btn-block text-left panel-heading"
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
                                        class="btn btn-block text-left panel-heading"
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

            <div class="w-100 ml-md-5 mt-5">
                <div class="test">
                    <iframe
                        id="iframe"
                        src="{{'https://www.youtube-nocookie.com/embed/'.$category->category_video}}"
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>


                    <div class="payment-btn text-center">
                        @php($href = auth()->check() ? route('category.single.payment.initialize', $category->id) : 'javascript:void(0)')
                        @php($loginAlert = auth()->check() ? '' : 'loginAlert')
                        <div>
                            @if(!is_null($category->offer_price) && $category->offer_price != 0)
                                <div class="d-flex justify-content-around">
                                    <span style="text-decoration: line-through; color: red" class="actual-price">{{$category->price}}</span>

                                    <span style="" class="offer-price">{{$category->offer_price}}</span>
                                </div>
                                <a class="{{$loginAlert}} btn category-details-action-btn" href="{{$href}}">এক্সামটি কিনুন</a>

                            @elseif(!is_null($category->price) && $category->price != 0)
                                <span class="actual-price">{{$category->price}}</span><br>
                                <a class="{{$loginAlert}} btn category-details-action-btn" href="{{$href}}">এক্সামটি কিনুন</a>

                            @else
                                <a class="btn category-details-action-btn" href="{{route('model.exam.category.topics',$category->uuid)}}">পরীক্ষার জন্য যান</a>
                            @endif
                        </div>

                    </div>

                    <div class="payment-info text-center mt-2">
                        <span style="font-size: 13px; color: grey">এক্সামটি কিনুন, বাটনটিতে ক্লিক করলে আপনার পেমেন্ট প্রক্রিয়া শুরু হয়ে যাবে। </span><br>
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
