<x-landing-layout headerBg="white">
    <div class="mt-5 pt-5 p-5">
        <div class="container">
            <nav>
                <div class="nav nav-tabs d-flex justify-content-between" id="nav-tab" role="tablist">
                    <a class="nav-link active"
                       id="nav-home-tab"
                       data-toggle="tab"
                       href="#video"
                       role="tab"
                       aria-controls="video"
                       aria-selected="true">Solution Video</a>
                    <a class="nav-link"
                       id="nav-profile-tab"
                       data-toggle="tab"
                       href="#pdf"
                       role="tab"
                       aria-controls="pdf"
                       aria-selected="false">Solution Pdf</a>
                </div>
            </nav>
            <div class="tab-content mt-3" id="nav-tabContent">
                <div class="tab-pane col-md-12 fade show active"
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
                        <div style="font-size: 50px; color: #653092" class="d-flex justify-content-center">
                            <i class="fa fa-video-slash"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <p>No Solution Video Found</p>
                        </div>


                    @endif
                </div>
                <div class="tab-pane col-md-12 fade"
                     id="pdf"
                     role="tabpanel"
                     aria-labelledby="pdf-tab">
                    @if($tag->solution_pdf)
                        <embed src="{{Storage::url('tagsSolutionPdf/'.$tag->solution_pdf)}}"
                               style="overflow:hidden;height:550px;width:100%;top:0;left:0;right:0;bottom:0"
                               type="application/pdf">
                    @else
                        <div style="font-size: 50px; color: #653092" class="d-flex justify-content-center">
                            <i class="fa fa-file-pdf"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <p>No Solution pdf Found</p>
                        </div>


                    @endif
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>
