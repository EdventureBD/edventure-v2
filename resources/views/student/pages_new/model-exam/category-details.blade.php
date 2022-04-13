<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- custom css link  --}}
    <link rel="stylesheet" href="/css/category-details.css">
    {{-- custom css link ends  --}}
<div class="page-section">
    <div class="container">
        <div class="d-flex mb-3" id="parent-div">
            <div class="w-100  mt-5">
                <h1 class="bold-header">
                    {{$category->name}}
                </h1>

                <div class="includes">
                    <div class="row">
                        <div class="col-md-6 d-flex my-2">
                            <div class="col-4 p-0 my-auto">
                                <img class="img-fluid" src="/img/category_details/participant.png" alt="participant's photo"/>
                            </div>
                            <div class="col-8 d-flex flex-column p-0 my-auto">
                                <div class="text-nowrap detail-parts-font">এক্সামটি দিয়েছে </div>
                                <div class="text-nowrap detail-parts-font">
                                    @if(!is_null($category->price) && $category->price != 0)
                                        @php($number = $category->payment_of_categories_count <= 83 ? 83 : $category->payment_of_categories_count)
                                        {{\App\Enum\Converter::en2bn($number)}} জন
                                    @else
                                        @php($number = $category->total_participation_count <= 83 ? 83 : $category->total_participation_count)
                                        {{\App\Enum\Converter::en2bn($number)}} জন
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(!empty($category->time_allotted) && !is_null($category->time_allotted))
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/timer.png" alt="timer's photo">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">সময় লাগবে </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($category->time_allotted)}} ঘন্টা
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($category->full_solutions) && !is_null($category->full_solutions))
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/completeSolution.png" alt="completeSolution">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">পূর্ণাঙ্গ সমাধান </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($category->full_solutions)}} <span style="font-size: 20px;font-weight: 600;">+</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($category->paper_final) && !is_null($category->paper_final))
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/paperFinal.png" alt="paperFinal">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">পেপার ফাইনাল </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($category->paper_final)}} টি
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if(!empty($category->subject_final) && !is_null($category->subject_final))
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/subjectFinal.png" alt="subjectFinal">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">সাবজেক্ট ফাইনাল </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($category->subject_final)}} টি
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if(!empty($category->final_exam) && !is_null($category->final_exam))
                            <div class="col-md-6 d-flex my-2">
                                <div class="col-4 p-0 my-auto">
                                    <img class="img-fluid" src="/img/category_details/modelTest.png" alt="FinalModelTest">
                                </div>
                                <div class="col-8 d-flex flex-column p-0 my-auto">
                                    <div class="text-nowrap detail-parts-font">ফাইনাল মডেল টেস্ট </div>
                                    <div class="text-nowrap detail-parts-font">
                                        {{\App\Enum\Converter::en2bn($category->final_exam)}} টি
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>

                @if($category->teacher_lists)
                    <div class="teachers mt-5">
                        <h5 class="bold-header">শিক্ষকবৃন্দ</h5>
                        <div class="d-flex overflow-x-scroll" style="border-radius: 25px 25px 0 0; background-color: #eeeeee; padding: 10px">
                            @foreach($category->teacher_lists as $teacher)
                                <div class="text-center col-6 d-flex flex-column justify-content-center align-items-center" style="padding: 0 10px; align-content: center; border-right: 1px solid lightgrey;height: 175px">
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
                        <div class="nav custom-shadow nav-tabs d-flex justify-content-center align-items-center" id="nav-tab" role="tablist">
                            <a class="nav-link active"
                               data-toggle="tab"
                               href="#examDetails"
                               role="tab"
                               aria-controls="examDetails"
                               aria-selected="true"
                               style="border-top-right-radius: 0px !important; padding:15px">এক্সাম বিস্তারিত</a>

                            <a class="nav-link"
                               data-toggle="tab"
                               href="#examRoutine"
                               role="tab"
                               aria-controls="examRoutine"
                               aria-selected="false"
                               style="border-top-left-radius: 0px !important; padding: 15px">রুটিন</a>

                        </div>
                    </nav>
                    <div style="border: 5px solid #eeeeee; border-radius: 15px" class="tab-content mt-5" id="nav-tabContent">
                        <div style="padding: 20px;overflow-y:scroll;word-break: break-word;" class="tab-pane text-justify col-md-12 fade active show"
                             id="examDetails"
                             role="tabpanel"
                             aria-labelledby="video-tab">
                            @if($category->details)
                                {!! $category->details !!}
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
                            @if($category->routine_image)
                                <img class="img-fluid" src="{{Storage::url('categoryRoutine/'.$category->routine_image)}}" alt="">
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

            <div class="w-100 ml-lg-5 mt-5">
                <div class="test">
                    <iframe
                        id="iframe"
                        src="{{'https://www.youtube-nocookie.com/embed/'.$category->category_video}}"
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>


                    <div class="payment-btn text-center">
                        <div class="d-flex justify-content-end">
                            <a style="color: #6400C8;"
                               class="font-weight-bold"
                               id="toggle_promo"
                               href="Javascript:void(0)">Promo Code</a>
                        </div>
                        <div id="coupon_section" class="d-none">
                            <div class="d-flex justify-content-start font-weight-bold">
                                <span style="color: #6400C8;">Put your promo code here</span>
                            </div>

                            <div class="input-group my-3" style="border-radius: 15px">
                                <div class="input-group-prepend">
                                    <a href="Javascript:void(0)"
                                       style="background: white; border-top-left-radius: 15px; border-bottom-left-radius: 15px; border: 1px solid #fa9632"
                                       id="cancle_promo"
                                       class="input-group-text">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                <input type="text"
                                       style="border: 1px solid #fa9632"
                                       class="form-control p-4"
                                       placeholder="code"
                                       aria-label="code"
                                       id="promo_code"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <a href="Javascript:void(0)"
                                       class="input-group-text coupon-btn"
                                       style="border-top-right-radius: 15px !important;border-bottom-right-radius: 15px; border: 1px solid #fa9632"
                                       id="basic-addon2">
                                        Apply
                                    </a>
                                </div>
                            </div>
                        </div>

                        @php($href = auth()->check() ? route('category.single.payment.initialize', $category->id) : 'javascript:void(0)')
                        @php($loginAlert = auth()->check() ? '' : 'loginAlert')
                        <div id="payment_section">
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
    $('#toggle_promo').on('click', function () {
        $('#coupon_section').removeClass('d-none')
        $('#payment_section').addClass('d-none')
        $('#toggle_promo').addClass('d-none')
    })
    $('#cancle_promo').on('click', function () {
        $('#coupon_section').addClass('d-none')
        $('#payment_section').removeClass('d-none')
        $('#toggle_promo').removeClass('d-none')
        $('#promo_code').val(null)
    })
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
