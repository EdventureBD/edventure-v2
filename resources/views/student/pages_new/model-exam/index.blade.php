
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
                    <a href="{{route('model.exam',['c' => $category->id])}}"
                       class="{{Illuminate\Support\Facades\Cache::get('exam_category') == $category->id ? 'text-white bg-purple' : 'text-purple bg-white'}} mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm
                            mx-1 bradius-15 bshadow-medium px-4">{{$category->name}}</a>
                @endforeach
            </div>
            @if(count($exam_topics) > 0 )
                <div class="py-4">
                    <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700">Topics</div>
                </div>
            <div class="text-center @if($exam_topics->count()>=7) course-category-js @endif ">
                @foreach($exam_topics as $topic)
                    <a href="{{route('model.exam',['t' => $topic->id])}}"
                       class="{{Illuminate\Support\Facades\Cache::get('exam_topic') == $topic->id ? 'text-white bg-purple' : 'text-purple bg-white'}} mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm
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
                        @php($href = route('model.exam.paper.mcq', $exam->id))

                        @if(count($exam->paymentOfExams) > 0 && auth()->check())
                            @foreach($exam->paymentOfExams as $value)
                                @if($value->user_id == auth()->user()->id)
                                    @php($label = 'Take Exam')
                                    @php($href = route('model.exam.paper.mcq', $exam->id))
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
                                    @php($href = route('model.exam.paper.mcq', $exam->id))
                                    @break
                                @endif
                            @endforeach
                        @endif
                        <div class="col-md-3 mb-4" style="max-width: fit-content;padding-right: 0 !important;">
                            <div style="background-position: center center !important;
                                        background: url({{$exam->image ? Storage::url('examImage/'.$exam->image) : ''}})"
                                 class="single-exam text-center mx-auto p-4 mb-md-0">
                                <h5 style="max-height: 100px" class="text-center mt-2">{{ $exam->title }} </h5>
                                <p class=" text-center text-md mt-2 fw-600 text-price">{{(int)($exam->exam_price)}}৳</p>
                                <div class=" text-center d-block">
                                    <a
                                       id="{{!auth()->check() ? 'logInAlert' : ''}}"
                                       href="{{!auth()->check() ? 'javascript:void(0);' : $href}}"
                                       class="{{auth()->check() && auth()->user()->is_admin == 1 ? 'disabled' : ''}} btn btn-outline text-purple mt-2">
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
        document.getElementById('logInAlert').onclick = function(){
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
        }
    </script>
</x-landing-layout>
