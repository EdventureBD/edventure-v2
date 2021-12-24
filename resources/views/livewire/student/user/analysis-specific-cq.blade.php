<td class="text-center text-70">
    <div class="flex">
        <div class="progress" style="height: 15px;">
            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $percent }}%;"
                aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>
    </div>
</td>
<td class="text-center text-70">
    <div class="text-70">
        <small>{{ $percent }}%</small>
        {{-- <small>{{ $questionContentTag->content_tag_id }}->{{ $gainMarks }}->{{ $totalQuestionMarks }}->{{ $percent }}%</small> --}}
        {{-- <small>{{ $percent }}%</small> --}}
    </div>
</td>
