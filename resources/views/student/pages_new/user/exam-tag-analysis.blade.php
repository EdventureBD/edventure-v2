<x-landing-layout headerBg="white">
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            max-width: 2%;
            border: 1px solid rgba(0, 0, 0, 0.185);
            text-align: center;
            font-weight: bold;
        }
        tbody td {
            border: 1px solid rgba(0, 0, 0, 0.185);
            text-align: center
        }
    </style>
    <div class=" pt-5">
        <div class="mt-5 pt-5 p-5">
            <div class="container mb-md-5 pb-md-5">
                @if($tag_type == 'weakness')
                    <h2>Weakness Analysis</h2>
                @else
                    <h2>Strength Analysis</h2>
                @endif

                <table class="table table-striped table-responsive align-content-center">
                    <thead>
                    <tr>
                        <td class="fit col">Tags</td>
                        <td class="fit col">Success Rate</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($tag_type == 'weakness')
                        @foreach($tags as $tag)
                            @if($tag->percentage_scored <= 60)
                                <tr>
                                    <td><a href="{{route('tag.solution', $tag->id)}}">{{$tag->name}}</a></td>
                                    <td>{{$tag->percentage_scored}} %</td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        @foreach($tags as $tag)
                            @if($tag->percentage_scored >= 90)
                                <tr>
                                    <td><a href="{{route('tag.solution', $tag->id)}}">{{$tag->name}}</a></td>
                                    <td>{{$tag->percentage_scored}} %</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-landing-layout>
