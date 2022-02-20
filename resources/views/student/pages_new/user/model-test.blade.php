@extends('student.pages_new.user.profile')

@section('content')
    <div id="info-detail" class="row mx-auto my-5">
        <div id="info-left-option" class="d-flex flex-column justify-content-center my-3 col-md-3 mx-md-5 px-0">
            <div class="d-flex flex-column justify-content-center mx-auto border px-5 my-3" id="journey-cart">
                <h5 class="fw-800 mx-auto">Amazing!</h5>
                <span class="iconify-inline mx-auto" data-icon="openmoji:man-mountain-biking" data-width="36" data-height="36"></span>
                <p class="fw-500 mx-auto" id="day-count">
                    You are on a 16 Day streak
                </p>
            </div>
            <div class="" id="category-selection">

            </div>
            {{-- subject selection part --}}
            <div class="" id="subject-selection">

            </div>
            {{-- subject selection part ends --}}
        </div>
        <div style="height: auto" id="info-middle-option" class=" my-3 col-md-3 px-0">
            <div id="strength-title" class="strength-weakness-title-common">
                <h2>Strength</h2>
{{--                <div>--}}
{{--                    <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>--}}
{{--                </div>--}}
            </div>
            <div class="p-3" id="strength-body">
                <div class="strength-weakness-cq-mcq" id="">
                    <div>
                        <h5 class="fw-600">MCQ</h5>
                    </div>
                    <div class=" text-black" id="mcq_strength">
                        @foreach($mcq_tags as $tag)
                            @if($tag->percentage_scored >= 90)
                                <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">{{$tag->name}}</p>
                            @endif
                        @endforeach
                            Strength will be shown here.
                    </div>
                    <div>
                        <a href="{{route('tag.analysis,index',['type' => 'strength'])}}" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="info-right-option" class="my-3 col-md-3 mx-md-5 px-0">
            <div id="weakness-title" class="strength-weakness-title-common">
                <h2>Weakness</h2>
{{--                <div>--}}
{{--                    <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>--}}
{{--                </div>--}}
            </div>
            <div class="p-3" id="weakness-body">
                <div class="strength-weakness-cq-mcq" id="">
                    <h5 class="fw-600">MCQ</h5>
                </div>
                <div class="text-black" id="mcq_weakness">
                    @foreach($mcq_tags as $tag)
                        @if($tag->percentage_scored <= 60)
                            <p id="checkTags" class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">
                                <a href="/" class="text-decoration-none">{{$tag->name}}</a>
                            </p>
                        @endif
                    @endforeach
                        <div id="showWeakness">Weakness will be shown here.</div>
                </div>
                <div>
                    <a href="{{route('tag.analysis,index',['type' => 'weakness'])}}" style="text-decoration: none; color: black; font-weight:600;">
                        See More
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    if( !$('#checkTags').is(':empty') ) {
        $('#showWeakness').show()
    } else {
        $('#showWeakness').css('display','none')
    }
</script>
<script src="{{ asset('/js/new-dashboard/iconify-icons.js') }}"></script>
