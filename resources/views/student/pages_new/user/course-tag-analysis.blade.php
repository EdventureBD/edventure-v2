<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/css/tooltip.css">
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
        .page-item.active .page-link {
            background-color: #fa9632;
            border-color: #fa9632;
        }
    </style>
    <div class="pt-5">
        <div class="mt-5 px-md-5">
            <div class="mb-md-5 pb-md-5">
                <h3>{{str_replace('_', ' ', ucwords($type))}}</h3>

                <table id="tableData" class="table table-striped table-responsive align-content-center">
                    <thead>
                    <tr>
                        <td class="fit col">Course</td>
                        <td class="fit col">Performance Review</td>
                        <td class="fit col">Accuracy
                            <span style="color: #fa9632"
                                  class=""
                                  data-toggle="tooltip"
                                  data-placement="right"
                                  title="Percentage value of the Performance Review">
                                <i class="fa fa-info-circle"></i>
                            </span>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($type == 'mcq_weakness')
                        @foreach($tags['mcq_content_tags'] as $tag)
                            @if($tag->percentage_scored < 80)
                                <tr>
                                    <td><a href="{{route('course.tag.pdf_and_video', $tag->id)}}">{{$tag->title}}</a></td>
                                    <td>{{$tag->tag_scored_marks}} correct out of {{$tag->tag_total_marks}} answers</td>
                                    <td>{{$tag->percentage_scored}} %</td>
                                </tr>
                            @endif
                        @endforeach
                    @elseif($type == 'cq_weakness')
                        @foreach($tags['cq_content_tags'] as $tag)
                            @if($tag->percentage_scored < 80)
                                <tr>
                                    <td><a href="{{route('course.tag.pdf_and_video', $tag->id)}}">{{$tag->title}}</a></td>
                                    <td>{{$tag->tag_scored_marks}} correct out of {{$tag->tag_total_marks}} answers</td>
                                    <td>{{$tag->percentage_scored}} %</td>
                                </tr>
                            @endif
                        @endforeach
                    @elseif($type == 'mcq_strength')
                        @foreach($tags['mcq_content_tags'] as $tag)
                            @if($tag->percentage_scored >= 80)
                                <tr>
                                    <td><a href="{{route('course.tag.pdf_and_video', $tag->id)}}">{{$tag->title}}</a></td>
                                    <td>{{$tag->tag_scored_marks}} correct out of {{$tag->tag_total_marks}} answers</td>
                                    <td>{{$tag->percentage_scored}} %</td>
                                </tr>
                            @endif
                        @endforeach
                    @elseif($type == 'cq_strength')
                        @foreach($tags['cq_content_tags'] as $tag)
                            @if($tag->percentage_scored >= 80)
                                <tr>
                                    <td><a href="{{route('course.tag.pdf_and_video', $tag->id)}}">{{$tag->title}}</a></td>
                                    <td>{{$tag->tag_scored_marks}} correct out of {{$tag->tag_total_marks}} answers</td>
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

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#tableData').DataTable()
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
