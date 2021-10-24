<x-landing-layout headerBg="white">
    <div class="page-section border-bottom-2 py-5 bg-light-gray">
        <div class="container page__container w-50">
            <h3 class="text-center text-sm mb-3 fw-600">Topic-Wise Analysis</h3>
            <div class="page-separator">
                <div class="page-separator__text bg-purple-light text-center bradius-10 py-3 d-inline-block w-100 text-gray text-sm fw-700">{{$course->title}}</div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                        @forelse ($course_topics as $topic)
                            <div class="accordion__item ">
                                <div class="row no-gutters accordion__toggle bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600 {{ $loop->iteration == 1 ? 'collapsed' : '' }}  " data-toggle="collapse" data-target="#course-toc-{{ $topic->id }} " data-parent="#parent">
                                    <div class="col-11 d-inline-flex title align-items-center">
                                        <span class="">{{ $topic->title }} </span>
                                    </div>
                                    <div class="col-1 text-right">
                                        <span class="d-inline-block text-gray text-sm">
                                            <span class="arrow-up text-gray"><i class="fas fa-angle-up"></i></span>
                                            <span class="arrow-down text-gray"><i class="fas fa-angle-down"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="accordion__menu collapse {{ $loop->iteration == 1 ? 'show' : '' }} "
                                    id="course-toc-{{ $topic->id }}">
                                    @php
                                    // dd($tag_details['cq_tag_details']);
                                        $atag_details = request()->type == "mcq" ? $tag_details['mcq_tag_details'] : $tag_details['cq_tag_details'];
                                    @endphp
                                    @foreach($atag_details as $tag=>$details)
                                        @if($details['topic_id'] == $topic->id)
                                        <div class="accordion__menu-link d-flex justify-content-between align-items-center bg-light-gray mt-3 py-3 px-3 bradius-15 bshadow text-dark fw-600">
                                            <a class="flex text-dark" href="">
                                                {{$tag}}
                                            </a>
                                            <div>{{$details['score'] ?? $details['score']}}%</div>
                                        </div>
                                        @endif
                                    @endforeach
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
</x-landing-layout>