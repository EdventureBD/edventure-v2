<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="/css/model-exam-index.css">
    <link rel="stylesheet" href="/css/tooltip.css">

    <div class="page-section">
        <div class="container">
            @include('partials.alert')

            @if (count($exam_categories) > 0)
                <div class="py-4">
                    <div class="text-center bradius-10 py-4 w-100 text-sm " style="font-weight: 900; color: #76777A">
                        Exams Category</div>
                    <div class="row justify-content-center" id="categories-section">
                        @foreach ($exam_categories as $category)
                        <div class="card col-lg-5 card-parent-div">
                            <h5 class="card-title mx-auto card-title-customed" data-toggle="tooltip" data-placement="top" title="{{ $category->name }}">{{ $category->name }}</h5>
                            <div class="row no-gutters">
                                <div class="col-4 d-flex flex-column" style="justify-content: space-evenly">
                                    <div class="d-flex justify-content-center align-items-center">
                                        @if ($category->image)
                                            <img class="img-fluid" height="96" width="112"
                                                src="{{ Storage::url('categoryImage/' . $category->image) }}"
                                                alt="Exam category image">
                                        @else
                                            <img class="img-fluid" height="96" width="112"
                                                src="/img/category_details/default-image.png" alt="Exam category image">
                                        @endif
                                    </div>
                                    <div class="position-relative d-flex bottom-0" style="justify-content: space-evenly">
                                        @php($rand =  rand(4,5))
                                        @for($i=1;$i<=5;$i++)
                                            @php($rand =  rand(4,5))
                                            @if($rand < $i)
                                                <span class="iconify" data-icon="ant-design:star-filled" style="color: #c4c4c4;"></span>
                                            @else
                                                <span class="iconify" data-icon="ant-design:star-filled" style="color: #fa9632;"></span>
                                            @endif

{{--                                        <span class="iconify" data-icon="ant-design:star-filled" style="color: #fa9632;"></span>--}}
{{--                                        <span class="iconify" data-icon="ant-design:star-filled" style="color: #fa9632;"></span>--}}
{{--                                        <span class="iconify" data-icon="ant-design:star-filled" style="color: #fa9632;"></span>--}}
{{--                                        <span class="iconify" data-icon="ant-design:star-filled" style="color: #c4c4c4;"></span>--}}
                                        @endfor
                                    </div>
                                </div>
                                <div class="my-auto vertical-line">

                                </div>
                                <div class="col-7">
                                    <div class="card-body">
                                        <div class="row row-cols-2">
                                            <div class="d-flex justify-content-start">
                                                <span class="iconify" data-icon="akar-icons:book" style="color: #6c686e;"></span>
                                                <div class="card-text-customed">
                                                    {{array_sum([$category->paper_final,$category->subject_final,$category->final_exam])}}
                                                    Exams
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <span class="iconify" data-icon="clarity:alarm-clock-line" style="color: #6c686e;"></span>
                                                <div class="card-text-customed">
                                                    {{!empty($category->time_allotted) ? $category->time_allotted.' Hour' : 'Not set'}}
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <span class="iconify" data-icon="emojione-monotone:spiral-notepad" style="color: #6c686e;"></span>
                                                <div class="card-text-customed">
                                                    {{!empty($category->full_solutions) ? $category->full_solutions.' solutions' : 'Not set'}}
                                                </div>
                                            </div>
{{--                                            <div class="d-flex justify-content-start">--}}
{{--                                                <span class="iconify" data-icon="eva:people-outline" style="color: #6c686e;"></span>--}}
{{--                                                <div class="card-text-customed">--}}
{{--                                                    @if(!is_null($category->price) && $category->price != 0)--}}
{{--                                                        @php($number = $category->payment_of_categories_count <= 83 ? 83 : $category->payment_of_categories_count)--}}
{{--                                                        {{$number}} Students--}}
{{--                                                    @else--}}
{{--                                                        @php($number = $category->total_participation_count <= 83 ? 83 : $category->total_participation_count)--}}
{{--                                                        {{$number}} Students--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="d-flex justify-content-start">
                                                <span class="iconify" data-icon="healthicons:money-bag-outline" style="color: #6c686e;"></span>
                                                <div class="card-text-customed">
                                                    {{!empty($category->price) && !is_null($category->price) ? 'PAID' : 'FREE'}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('model.exam', ['c' => $category->uuid]) }}"
                                            class="btn text-white fw-700 btn-detail"
                                            {{-- class="btn btn-success fw-700" --}}
                                            style="box-sizing: border-box;border-radius: 10px;">See Detail</a>
                                    </div>
                                </div>
                            </div>
                          </div>
                        @endforeach
                    </div>
                </div>
                <div class="py-5 py-md-1 text-center d-flex justify-content-center">
                    <p class="text-center">
                        {{ $exam_categories->withQueryString()->links('vendor.pagination.custom') }}</p>
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

        </div>
    </div>

    {{-- /************************* Sweet Alert ******************************/ --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
        integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
        integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- /*******************************************************/ --}}

    <script>
        var loginAlert = document.getElementsByClassName('logInAlert');

        for (var i = 0; i < loginAlert.length; i++) {
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script src="/js/new-dashboard/iconify-icons.js"></script>
