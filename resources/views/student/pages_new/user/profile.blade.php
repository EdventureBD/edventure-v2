
<x-landing-layout headerBg="white">
    {{-- custom css linked --}}
    <link rel="stylesheet" href="{{ asset('/css/new-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- custom css linked --}}
    <style>
        /*a.disabled {*/
        /*    pointer-events: none;*/
        /*    color: #ccc;*/
        /*}*/
    </style>
    <div id="parent-div" class="mt-md-5 pt-5 p-5">
        <div id="info-part" class="d-md-flex justify-content-around align-items-middle">

            <div class="d-md-flex justify-content-start">
                    <div class="d-md-flex">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                    <label id="imageLabel" for="image"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url({{auth()->user()->image ?
                                                                    \Illuminate\Support\Facades\Storage::url('studentImage/'.auth()->user()->image) :
                                                                    asset('/img/profile.png')}});">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-top ml-3">
                        <div class="d-flex">
                            <h3 class="fw-600">{{ $user->name }}</h3><span class="iconify-inline" data-icon="emojione-monotone:hand-with-fingers-splayed" data-width="36" data-height="36"></span>
                        </div>
                        <div class="w-100 h-0 border border-gray m-0 p-0 horizontal-line"></div>
                        @yield('mini-header')
                    </div>
            </div>
            <div class="d-flex max-h-10 justify-content-center mt-md-5 pt-5">
                <a href="{{route('profile')}}" class="text-decoration-none">
{{--                <a id="courseBtn" href="javascript:void(0)" class="text-decoration-none">--}}
                    <div style="{{request()->is('profile') ? 'background: #FA9632 ; color: white; border: 1px solid #FA9632 !important' : 'background: white ; color: black; border: 1px solid #FA9632 !important'}}"
                            class="px-4 py-2 border my-auto fw-600" id="course-option">
                        Course
                    </div>
                </a>
                <a href="{{route('profile.modelTest')}}" class="text-decoration-none">
                    <div style="{{request()->is('profile/model-test') ? 'background: #FA9632 ; color: white; border: 1px solid #FA9632 !important' : 'background: white ; color: black; border: 1px solid #FA9632 !important'}}"
                            class="px-4 py-2 border my-auto fw-600" id="model-test-option">
                        Model Test
                    </div>
                </a>
            </div>
        </div>
        <div class="">
        @yield('content')
        </div>
    </div>
</x-landing-layout>
{{--    /************************* Sweet Alert ******************************/--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--    /*******************************************************/--}}
<script type="text/javascript">
    if ( $(window).width() < 821 ) {
        $('#imageLabel').show();
    } else {
        $('#imageLabel').hide();
    }

    $('#courseBtn').click(function () {
        Swal.fire({
            icon: 'info',
            title: 'Surprise!!',
            text: 'Coming Soon..',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
    });

    $('.avatar-upload').mouseover(function () {
        $('#imageLabel').show();
    });
    $('.avatar-upload').mouseout(function () {
        $('#imageLabel').hide();
    });
    $('#image').change(function(){

        let reader = new FileReader();
        reader.onload = (e) => {
            let formData = new FormData();
            formData.append("image", $('input[name=image]')[0].files[0]);
            formData.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url : window.location.origin+"/profile/image/upload",
                type: "POST",
                data : formData,
                mimeType: "multipart/form-data",
                processData: false,
                contentType: false,
                success: function(res) {
                    if(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Nice',
                            text: 'Your Photo Uploaded Successfully',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops..',
                        text: JSON.parse(jqXHR.responseText).errors.image[0],
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    })
                }
            });
        }
        reader.readAsDataURL(this.files[0]);


    });
</script>
