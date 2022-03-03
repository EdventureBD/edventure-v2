
<x-landing-layout headerBg="white">
    <style>
        .card{
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
            padding: 14px 80px 18px 36px;
            cursor: pointer;
        }
        .ribbon {
            width: 150px;
            height: 150px;
            overflow: hidden;
            position: absolute;
        }
        .ribbon::before,
        .ribbon::after {
            position: absolute;
            z-index: -1;
            content: '';
            display: block;
            border: 5px solid #6400C8;
        }
        .ribbon span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 15px 0;
            background-color: #6400C8;
            box-shadow: 0 5px 10px rgba(0,0,0,.1);
            color: #fff;
            font: 700 18px/1 'Lato', sans-serif;
            text-shadow: 0 1px 1px rgba(0,0,0,.2);
            text-transform: uppercase;
            text-align: center;
        }

        .ribbon-top-left {
            top: -10px;
            left: 12px;
        }
        @media(max-width:576px) {
            .ribbon-top-left {
                left: 53px;
            }
        }
        .ribbon-top-left::before,
        .ribbon-top-left::after {
            border-top-color: transparent;
            border-left-color: transparent;
        }
        .ribbon-top-left::before {
            top: 0;
            right: 0;
        }
        .ribbon-top-left::after {
            bottom: 0;
            left: 0;
        }
        .ribbon-top-left span {
            right: -25px;
            top: 30px;
            transform: rotate(-45deg);
        }

        .card:hover{
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }

        .card h3{
            font-weight: 600;
        }

        .card img{
            position: absolute;
            top: 20px;
            right: 15px;
            max-height: 120px;
        }

        .card-1{
            background-image: url(https://ionicframework.com/img/getting-started/ionic-native-card.png);
            background-repeat: no-repeat;
            background-position: right;
            background-size: 80px;
        }

        @media(max-width: 990px){
            .card{
                margin: 20px;
            }
        }
    </style>
    <div class="page-section">
        <div class="container">
            @include('partials.alert')

            @if(count($exam_categories) > 0)
                <div class="py-4">
                    <div class="text-center bradius-10 py-2 w-100 text-gray text-sm fw-700"> Exams Category</div>
                    @if(!request()->has('c'))
                        <div class="text-center"> Select a Category</div>
                    @endif
                </div>
            @else
                <div class="py-4">
                    <div class="text-center bradius-10 py-2 text-gray text-sm">
                        <h4 class="fw-700">
                            Exams are processing
                        </h4>
                        <span>Coming Soon..</span>
                    </div>
                </div>
            @endif
            <div class="text-center @if($exam_categories->count()>=7) course-category-js @endif ">
                @foreach($exam_categories as $category)
                    @php($href = route('model.exam',['c' => $category->id]))
                    @php($payment_href = '/')
                    @php($data_toggle = '')
                    @php($icon = !empty($category->price) ? 'fas fa-lock' : '')

                    @if(count($category->paymentOfCategories) > 0 && auth()->check())
                        @foreach($category->paymentOfCategories as $value)
                            @if($value->user_id == auth()->user()->id)
                                @php($icon = !empty($category->price) ? 'fas fa-lock-open' : '')
                                @php($href = route('model.exam',['c' => $category->id]))
                                @break
                            @else
                                @php($icon = !empty($category->price) ? 'fas fa-lock' : '')
                                @php($payment_href = route('category.single.payment.initialize', $category->id))
                                @php($href = '#categoryDetail'.$category->id)
                                @php($data_toggle = 'modal')
                                @continue
                            @endif
                        @endforeach
                    @else
                        @if(!is_null($category->price) && $category->price != 0)
                            @php($icon = !empty($category->price) ? 'fas fa-lock' : '')
                            @php($payment_href = route('category.single.payment.initialize', $category->id))
                            @php($href = '#categoryDetail'.$category->id)
                            @php($data_toggle = 'modal')
                        @endif
                    @endif

                    <a href="{{$href}}"
                       class="{{Illuminate\Support\Facades\Cache::get('exam_category') == $category->id ? 'text-white btn-orange-customed' : 'text-purple bg-white'}} mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm
                            mx-1 bradius-15 bshadow-medium px-4" data-toggle="{{$data_toggle}}">
                        <i class="{{$icon}}"></i>
                        {{$category->name}}</a>

                    <div class="modal fade"
                         id="categoryDetail{{ $category->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 25px; border: 3px solid #6400c8">
                                <div style="background: #6400c8; color: #FA9632; -webkit-border-top-left-radius: 15px; -webkit-border-top-right-radius: 15px"
                                     class="modal-header d-flex justify-content-center">
                                    <h5 class="modal-title font-weight-bolder">Disclaimer: This is a paid bundle</h5>
{{--                                    <button type="button" class="close"--}}
{{--                                            data-dismiss="modal" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">&times;</span>--}}
{{--                                    </button>--}}
                                </div>
                                <div class="modal-body">
                                    <h3 class="font-weight-bolder">This bundle includes:</h3> <br>
                                    <p>{!! $category->details  !!}</p> <br>
                                    <span style="color: #6400c8; font-size: 44px; font-weight: bolder;">
                                        ৳ {{$category->price}}
                                    </span>

                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <a style="border-radius: 10px;background: #FA9632;color: white;" class="btn font-weight-bolder" href="{{$payment_href}}">
                                        Pay Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($exam_topics) > 0 )
                <div class="py-4">
                    <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700">Topics</div>
                </div>
            <div class="text-center @if($exam_topics->count()>=7) course-category-js @endif ">
                @foreach($exam_topics as $topic)
                    <a href="{{route('model.exam',['t' => $topic->id])}}"
                       class="{{Illuminate\Support\Facades\Cache::get('exam_topic') == $topic->id ? 'text-white btn-orange-customed' : 'text-purple bg-white'}} mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm
                            mx-1 bradius-15 bshadow-medium px-4">{{$topic->name}}</a>
                @endforeach
            </div>
            @else
                @if(request()->has('c'))
                    <div class="py-4">
                        <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700">No Topics Found</div>
                    </div>
                @endif
            @endif

            @if(count($exams) > 0 )
                <div class="row justify-content-center py-3 card-group-row mb-lg-8pt">

                    @foreach ($exams as $exam)
                        @php($label = 'Take Exam')
                        @php($d_none = 'd-none')
                        @php($href = route('model.exam.paper.mcq', \Illuminate\Support\Facades\Crypt::encrypt($exam->id)))

                        @if(count($exam->paymentOfExams) > 0 && auth()->check())
                            @foreach($exam->paymentOfExams as $value)
                                @if($value->user_id == auth()->user()->id)
                                    @php($label = 'Take Exam')
                                    @php($href = route('model.exam.paper.mcq', \Illuminate\Support\Facades\Crypt::encrypt($exam->id)))
                                    @break
                                @else
                                    @php($label = 'Pay')
                                    @php($href = route('single.payment.initialize', $exam->id))
                                    @continue
                                @endif
                            @endforeach
                        @else
                            @if(!is_null($exam->exam_price) && $exam->exam_price != 0)
                                @php($label = 'Pay')
                                @php($href = route('single.payment.initialize', $exam->id))
                            @endif
                        @endif

                        @if(count($exam->mcqTotalResult) > 0 && auth()->check())
                            @foreach($exam->mcqTotalResult as $value)
                                @if($value->student_id == auth()->user()->id)
                                    @php($label = 'View Result')
                                    @php($d_none = '')
                                    @php($href = route('model.exam.paper.mcq', \Illuminate\Support\Facades\Crypt::encrypt($exam->id)))
                                    @break
                                @endif
                            @endforeach
                        @endif
                        <div class="col-md-3 mb-4" style="max-width: 100%;padding-right: 0 !important;">
                            <div class="{{$d_none}} ribbon ribbon-top-left"><span>done</span></div>
                            <div style="background-position: center center !important;
                                        background: url({{$exam->image ? Storage::url('examImage/'.$exam->image) : ''}})"
                                 class="single-exam text-center mx-auto p-4 mb-md-0">
                                <h5 style="max-height: 100px; white-space: nowrap; width: 100%; overflow: hidden;
                                text-overflow: ellipsis;" class="text-center mt-2">{{ $exam->title }} </h5>
                                <p class=" text-center text-md mt-2 fw-600 text-price">{{(int)($exam->exam_price)}}৳</p>
                                <div class=" text-center d-block">
                                    <a
                                       href="{{!auth()->check() ? 'javascript:void(0);' : $href}}"
                                       class="{{auth()->check() && auth()->user()->is_admin == 1 ? 'disabled' : ''}}{{!auth()->check() ? 'logInAlert' : ''}} btn btn-outline text-purple mt-2">
                                            {{$label}}
                                    </a>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-md-4">--}}
{{--                            <div class="card card-1">--}}
{{--                                <h3>{{ $exam->title }}</h3>--}}
{{--                                <p>A curated set of   ES5/ES6/TypeScript wrappers for plugins to easily add any native functionality to your Ionic apps.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    @endforeach
            </div>
                <div class="py-5 py-md-1 text-center d-flex justify-content-center">
                    <p class="text-center">{{ $exams->withQueryString()->links('vendor.pagination.custom') }}</p>
                </div>
        @endif
    </div>
    </div>

    {{--    /************************* Sweet Alert ******************************/--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--    /*******************************************************/--}}

    <script>
        var loginAlert = document.getElementsByClassName('logInAlert');

        for(var i = 0; i < loginAlert.length; i++) {
            (function(index) {
                loginAlert[index].addEventListener("click", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Please login to continue',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    })
                })
            })(i);
        }
    </script>
</x-landing-layout>
