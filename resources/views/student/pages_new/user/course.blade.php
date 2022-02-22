@extends('student.pages_new.user.profile')


@section('mini-header')
    <div class="d-flex justify-content-between">
        <div class="d-flex flex-column fw-800 mr-3">
            <div>
                Courses
            </div>
            <div class="mx-auto">
                {{ $enrolled_course_count }}
            </div>
        </div>
        <div class="d-flex flex-column fw-800 ml-3 justify-content-center">
            <div>
                Completed
            </div>
            <div class="mx-auto">
                {{ $completed_course_count }}
            </div>
        </div>
    </div>
@endsection
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
{{--                <div class="mx-auto mt-3 d-flex justify-content-between border py-2" type="button" data-toggle="collapse" data-target="#categories" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                    <div>--}}
{{--                        <h6 class="fw-500" id="category-selection-text">Select Test Category</h6>--}}
{{--                    </div>--}}
{{--                    <div id="category-selection-icon">--}}
{{--                        <span class="iconify-inline" data-icon="ic:sharp-less-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span>--}}
{{--                        --}}{{-- <span class="iconify-inline d-none" data-icon="ic:baseline-greater-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span> --}}
{{--                    </div>--}}
{{--                </div>--}}
                {{-- category part --}}
{{--                <div class="mx-auto category-progress collapse text-white" id="categories">--}}
{{--                    <div class="category-name">--}}
{{--                        <div class="d-flex">--}}
{{--                            <h5 class="fw-600 pl-4">--}}
{{--                                Medical Admission--}}
{{--                            </h5>--}}
{{--                        </div>--}}
{{--                        <div class="progress">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="category-link-icon">--}}
{{--                        <span class="iconify-inline" data-icon="ei:external-link" data-width="36" data-height="36" data-rotate="90deg" data-flip="horizontal"></span>--}}
{{--                    </div>--}}
{{--                </div>--}}
                {{-- category part ends  --}}
            </div>
            {{-- subject selection part --}}
            <div class="" id="subject-selection">
                <div class="mx-auto mt-3 d-flex justify-content-between border py-2" type="button" data-toggle="collapse" data-target="#subjectschoicing" aria-expanded="false" aria-controls="collapseExample">
                    <div>
                        <h6 class="fw-500" id="subject-selection-text">Choose Subject</h6>
                    </div>
                    <div id="subject-selection-icon">
                        <span class="iconify-inline" data-icon="ic:sharp-less-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span>
                        {{-- <span class="iconify-inline d-none" data-icon="ic:baseline-greater-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span> --}}
                    </div>
                </div>
                <div class="mx-auto subjects collapse text-white" id="subjectschoicing">
                    <div class="d-flex">
                        <h5 class="fw-600">Chemistry</h5>
                    </div>
                    <div>
                        <h5 class="fw-600">
                            45%
                        </h5>
                    </div>
                </div>
            </div>
            {{-- subject selection part ends --}}
        </div>
        <div id="info-middle-option" class=" my-3 col-md-3 px-0">
            <div id="strength-title" class="strength-weakness-title-common">
                <h2>Strength</h2>
                <div>
                    <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>
                </div>
            </div>
            <div class="p-3" id="strength-body">
                <div class="strength-weakness-cq-mcq" id="">
                    <div>
                        <h5 class="fw-600">MCQ</h5>
                    </div>
                    <div class=" text-black" id="mcq_strength">
                        @foreach ($mcq_content_tags as $mcq_content_tag)
                            @if($mcq_content_tag->percentage_scored != 'no data')
                                @if($mcq_content_tag->percentage_scored > 80)
                                    <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">{{ $mcq_content_tag->title }}</p>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
                </div>
                <div class="w-100 h-0 border border-gray my-3 py-0 px-5" id="horizontal-line"></div>
                <div class="strength-weakness-cq-mcq" id="">
                    <div>
                        <h5 class="fw-600">CQ</h5>
                    </div>
                    <div class=" text-black" id="cq_strength">
                        @foreach ($cq_content_tags as $cq_content_tag)
                            @if($cq_content_tag->percentage_scored != 'no data')
                                @if($cq_content_tag->percentage_scored > 80)
                                    <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">{{ $cq_content_tag->title }}</p>
                                @endif
                            @endif
                        @endforeach
                        {{-- <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Maxwell</p> --}}
                    </div>
                    <div>
                        <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="info-right-option" class="my-3 col-md-3 mx-md-5 px-0">
            <div id="weakness-title" class="strength-weakness-title-common">
                <h2>Weakness</h2>
                <div>
                    <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>
                </div>
            </div>
            <div class="p-3" id="weakness-body">
                <div class="strength-weakness-cq-mcq" id="">
                    <h5 class="fw-600">MCQ</h5>
                </div>
                <div class="text-black" id="mcq_weakness">
                    @foreach ($mcq_content_tags as $mcq_content_tag)
                        @if($mcq_content_tag->percentage_scored !== 'no data')
                            @if($mcq_content_tag->percentage_scored < 20)
                                <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">{{ $mcq_content_tag->title }}</p>
                            @endif
                        @endif
                    @endforeach
                    {{-- <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Plunk</p> --}}
                </div>
                <div>
                    <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                        See More
                    </a>
                </div>
                <div class="w-100 h-0 border border-gray my-3 py-0 px-5" id="horizontal-line"></div>
                <div class="strength-weakness-cq-mcq" id="">
                    <h5 class="fw-600">CQ</h5>
                </div>
                <div class="text-black" id="cq_weakness">
                    @foreach ($cq_content_tags as $cq_content_tag)
                        @if($cq_content_tag->percentage_scored !== 'no data')

                            @if($cq_content_tag->percentage_scored < 20)
                                <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">{{ $cq_content_tag->title }}</p>
                            @endif
                        @endif
                    @endforeach
                    {{-- <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Pythagoras</p> --}}
                </div>
                <div>
                    <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                        See More
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div>
            <span class="iconify mr-5" data-icon="fa-solid:angle-left"></span>
        </div>
        <div>
            <span class="iconify ml-5" data-icon="fa-solid:angle-right"></span>
        </div>
    </div>
@endsection

{{-- icon's script part linked --}}
<script src="{{ asset('/js/new-dashboard/iconify-icons.js') }}"></script>
{{-- icon's script part linked --}}

{{-- frontend script part --}}
<script>
    const courseButtonAction = () => {
        categorySelectionText.innerText = "Select Course";
        subjectSelectionText.innerText = "Choose Subject";
        courseOption.setAttribute("style", "background: #FA9632 ; color: white;");
        modelTestOption.setAttribute("style", "background: white ; color: black;");
    }

    const modelTestButtonAction = () => {
        categorySelectionText.innerText = "Select Test Category";
        subjectSelectionText.innerText = "Choose Subject";
        modelTestOption.setAttribute("style", "background: #FA9632 ; color: white;");
        courseOption.setAttribute("style", "background: white ; color: black;");
    }

    let categorySelectionText = document.getElementById("category-selection-text");
    let subjectSelectionText = document.getElementById("subject-selection-text");
    let courseOption = document.getElementById("course-option");
    courseOption.addEventListener("click",courseButtonAction);

    let modelTestOption = document.getElementById("model-test-option");
    modelTestOption.addEventListener("click",modelTestButtonAction);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    fetchCourseOption()
    $(document).on('click', '#course-option', function(){
        fetchCourseOption()
    });

    function fetchCourseOption() {
        $('#category-selection').html('');
        var html = ' <div class="mx-auto mt-3 d-flex justify-content-between border py-2" type="button" data-toggle="collapse" data-target="#categories" aria-expanded="false" aria-controls="collapseExample"> <div> <h6 class="fw-500" id="category-selection-text">Select Course</h6> </div> <div id="category-selection-icon"> <span class="iconify-inline" data-icon="ic:sharp-less-than" data-width="25" data-height="25" data-rotate="90deg" data-flip="horizontal"></span> </div> </div> ';

        $.ajax({
            url: '{{ route("ajax-get-courses") }}',
            type: 'GET',
            data: {},
            success: function(response)
            {
                // console.log(response);
                var enrolled_courses = response;

                if (enrolled_courses.length > 0)
                {
                    jQuery.each(enrolled_courses, function(index, enrolled_course)
                    {
                        // html += '<option value="' + enrolled_courses.id + '">' + enrolled_courses.title + '</option>';
                        html += '<div class="mx-auto category-progress collapse text-white" id="categories" data-id="' + enrolled_course.id + '" > <div class="category-name"> <div class="d-flex"> <h5 class="fw-600 pl-4">'  + enrolled_course.title +  '</h5> </div> <div class="progress"> </div> </div> <div class="category-link-icon"> <span class="iconify-inline" data-icon="ei:external-link" data-width="36" data-height="36" data-rotate="90deg" data-flip="horizontal"></span> </div> </div> ';
                    });

                    $('#category-selection').append(html);
                }

            }
        });
    }
</script>

<script>
    $(document).on('click', '#categories', function(){
        var course_id = $( this ).data('id');
        $('#mcq_strength').html('');
        $('#cq_strength').html('');
        $('#mcq_weakness').html('');
        $('#cq_weakness').html('');

        // console.log("SELECT HIT");
        // console.log( course_id );

        $.ajax({
            url: '{{ route("ajax-get-strengths-and-weaknesses") }}',
            type: 'GET',
            data: { course_id: course_id },
            success: function(response)
            {
                // console.log(response);

                var mcq_tags = response.mcq_content_tags;
                var cq_tags = response.cq_content_tags;

                // console.log(mcq_tags);
                // console.log(cq_tags);

                if (mcq_tags.length > 0){

                    mcq_strength_tags_html = '';
                    mcq_weakness_tags_html = '';
                    jQuery.each(mcq_tags, function(index, mcq_tag)
                    {
                        if(mcq_tag.percentage_scored != "no data"){
                            if(mcq_tag.percentage_scored > 80){
                                mcq_strength_tags_html += '<p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' + mcq_tag.title + '</p>';
                            }
                            else if(mcq_tag.percentage_scored < 20){
                                mcq_weakness_tags_html += '<p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' + mcq_tag.title + '</p>';
                            }
                        }
                    });

                    $('#mcq_strength').append(mcq_strength_tags_html);
                    $('#mcq_weakness').append(mcq_weakness_tags_html);
                }

                if (cq_tags.length > 0){

                    cq_strength_tags_html = '';
                    cq_weakness_tags_html = '';
                    jQuery.each(cq_tags, function(index, cq_tag)
                    {
                        if(cq_tag.percentage_scored != "no data"){
                            if(cq_tag.percentage_scored > 80){
                                cq_strength_tags_html += '<p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' + cq_tag.title + '</p>';
                            }
                            else if(cq_tag.percentage_scored < 20){
                                cq_weakness_tags_html += '<p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' + cq_tag.title + '</p>';
                            }
                        }
                    });

                    $('#cq_strength').append(cq_strength_tags_html);
                    $('#cq_weakness').append(cq_weakness_tags_html);
                }

            }
        });
    });
</script>
{{-- frontend script part ends --}}
