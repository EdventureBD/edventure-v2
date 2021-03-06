<x-landing-layout headerBg="white">
    <style>
        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
            color: #FA9632 !important;

        }
        .nav-link:hover {
            color: #6400c8
        }
        .nav-link {
            color: #6400c8;
            font-weight: bold;
        }
    </style>
    <div class="mt-5 pt-5 p-5">
        <div class="container">
            <nav>
                <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
                    <a class="nav-link active"
                       id="nav-profile-tab"
                       data-toggle="tab"
                       href="#pdf"
                       role="tab"
                       aria-controls="pdf"
                       aria-selected="false">Explanation Pdf</a>

                    <a class="nav-link"
                       id="nav-home-tab"
                       data-toggle="tab"
                       href="#video"
                       role="tab"
                       aria-controls="video"
                       aria-selected="true">Explanation Video</a>

                </div>
            </nav>
            <div class="tab-content mt-3" id="nav-tabContent">
                <div class="tab-pane col-md-12 fade"
                     id="video"
                     role="tabpanel"
                     aria-labelledby="video-tab">
                    @if($tag->solution_video)
                        <iframe
                            style="overflow:hidden;height:450px;width:100%;top:0;left:0;right:0;bottom:0"
                            id="iframe"
                            src="https://www.youtube-nocookie.com/embed/{{$tag->solution_video}}"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @else
                        <div class="my-5 py-5">
                            <div style="font-size: 50px; color: #653092" class="d-flex justify-content-center mt-md-5 pt-md-5">
                                <i class="fa fa-video-slash"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <p>No Explanation Video Available</p>
                            </div>
                        </div>


                    @endif
                </div>
                <div class="tab-pane col-md-12 fade show active"
                     id="pdf"
                     role="tabpanel"
                     aria-labelledby="pdf-tab">
                    @if($tag->solution_pdf)
                        <embed
                            @if(Request::is('profile/course/pdf_and_video/*'))
                                src="{{ asset($tag->solution_pdf) }}"
                            @else
                                src="{{ Storage::url('tagsSolutionPdf/'.$tag->solution_pdf) }}"
                            @endif
                               style="overflow:hidden;height:550px;width:100%;top:0;left:0;right:0;bottom:0"
                               type="application/pdf">
                    @else
                        <div class="my-5 py-5">
                            <div style="font-size: 50px; color: #653092" class="d-flex justify-content-center mt-md-5 pt-md-5">
                                <i class="fa fa-file-pdf"></i>
                            </div>
                            <div class="d-flex justify-content-center">
                                <p>No Explanation Pdf Available</p>
                            </div>
                        </div>


                    @endif
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>
