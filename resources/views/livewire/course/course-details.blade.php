<div class="row">
    @foreach ($lectures as $lecture)
        @if ($lecture)
            <div class="col-md-6">
                <p>
                    {{-- <iframe src="https://player.vimeo.com/video/{{ $lecture->url}}" width="440" 
                        height="260" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" 
                        allowfullscreen></iframe> --}}
                    <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/{{ $lecture->url}}"
                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; 
                    clipboard-write; encrypted-media; gyroscope;
                    picture-in-picture" allowfullscreen></iframe>

                </p>
            </div>
        @else
            <p>
                <img src="https://previews.123rf.com/images/arcady31/arcady311303/arcady31130300032/18519959-vector-oops-symbol.jpg" alt="No videos found!!">
            </p>
        @endif
    @endforeach
</div>