<x-landing-layout headerBg="white">
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            max-width: 2%;
        }
    </style>
    <div class="mt-5 pt-5 p-5">
            <div class="container">
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
                                    <td>{{$tag->name}}</td>
                                    <td>{{$tag->percentage_scored}} %</td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        @foreach($tags as $tag)
                            @if($tag->percentage_scored >= 90)
                                <tr>
                                    <td>{{$tag->name}}</td>
                                    <td>{{$tag->percentage_scored}} %</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
    </div>

</x-landing-layout>
