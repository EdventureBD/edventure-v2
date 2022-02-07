
<x-landing-layout headerBg="white">
    <div class="page-section">
        <div class="container">
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
{{--            <div class="py-5 py-md-1 text-center d-flex justify-content-center">--}}
{{--                <p class="text-center">{{ $exam_category->links('vendor.pagination.custom') }}</p>--}}
{{--            </div>--}}
            @if(count($exam_topics) > 0 )
                <div class="py-4">
                    <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700">Topics</div>
                </div>
            {{Illuminate\Support\Facades\Cache::get('exam_topic')}}
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
                        <div class="col-md-3 mb-4">
                            <div class="single-exam text-center mx-auto p-4 mb-md-0">
                                <h5 class="text-center text-sm mt-2">{{ $exam->title }} </h5>
                                <p class=" text-center text-md mt-2 fw-600 text-price">{{number_format($exam->exam_price)}}৳</p>
                                <div class=" text-center d-block">
                                    <a href="{{ route('model.exam.paper.mcq', $exam->id) }}"  class="btn btn-outline text-purple mt-2">Go To Exam</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        @endif
    </div>
    </div>
</x-landing-layout>
