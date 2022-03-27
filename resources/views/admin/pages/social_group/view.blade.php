<a class="mr-1 btn btn-outline-info btn-sm"
   href="#viewTag{{ $tag->id }}"
   data-toggle="modal"
   title="{{ $tag->name }}">
    <i class="far fa-eye"></i>
</a>

<div class="modal fade"
     id="viewTag{{ $tag->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h4 style="font-size: larger" class="badge badge-info badge-lg">
                        {{ $tag->name }}
                    </h4>
                    <br>
                    <small>
                        Topic: {{$tag->examTopic->name}}
                    </small>
                    <br>
                    <small>
                        Topic: {{$tag->examTopic->examCategory->name}}
                    </small>
                </div>

                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active"
                           id="nav-home-tab"
                           data-toggle="tab"
                           href="#video{{$tag->id}}"
                           role="tab"
                           aria-controls="video"
                           aria-selected="true">Solution Video</a>
                        <a class="nav-link"
                           id="nav-profile-tab"
                           data-toggle="tab"
                           href="#pdf{{$tag->id}}"
                           role="tab"
                           aria-controls="pdf"
                           aria-selected="false">Solution Pdf</a>
                    </div>
                </nav>
                <div class="tab-content mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active"
                         id="video{{$tag->id}}"
                         role="tabpanel"
                         aria-labelledby="video-tab">
                        @if($tag->solution_video)
                            <iframe
                                style="overflow:hidden;height:340px;width:100%;top:0;left:0;right:0;bottom:0"
                                id="iframe"
                                src="https://www.youtube-nocookie.com/embed/{{$tag->solution_video}}"
                                title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        @else
                            <p>No Video Uploaded</p>
                        @endif
                    </div>
                    <div class="tab-pane fade"
                         id="pdf{{$tag->id}}"
                         role="tabpanel"
                         aria-labelledby="pdf-tab">
                        @if($tag->solution_pdf)
                            <embed src="{{Storage::url('tagsSolutionPdf/'.$tag->solution_pdf)}}"
                                   style="overflow:hidden;height:340px;width:100%;top:0;left:0;right:0;bottom:0"
                                   type="application/pdf">
                        @else
                            <p>No pdf Uploaded</p>
                        @endif
                    </div>
                </div>

{{--                <div class="row">--}}
{{--                    <div class="col-md-6">--}}

{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}

{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
