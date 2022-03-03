{{-- @foreach ($questionContentTags as $questionContentTag)
    @if ($type == 'overall')
        @livewire('student.user.strength-and-weakness-specific', ['questionContentTag' => $questionContentTag,
        'type' => $type],
        key($questionContentTag->id))
    @elseif($type == "mcq")
        @livewire('student.user.analysis-specific-mcq', ['questionContentTag' => $questionContentTag, 'type' =>
        $type],
        key($questionContentTag->id))
    @elseif($type == "cq")
        @livewire('student.user.analysis-specific-cq', ['questionContentTag' => $questionContentTag, 'type' =>
        $type],
        key($questionContentTag->id))
    @endif
@endforeach --}}


<div>
    <h2>Strength</h2>
    @foreach ($questionContentTags as $questionContentTag)
        @if ($type == 'overall')
            @livewire('student.user.strength-and-weakness-specific.strength-specific', ['questionContentTag' =>
            $questionContentTag, 'type' => $type], key($questionContentTag->id))

        @elseif($type == "mcq")
            @livewire('student.user.strength-and-weakness-specific.strength-specific-mcq', ['questionContentTag' =>
            $questionContentTag, 'type' => $type], key($questionContentTag->id))

        @elseif($type == "cq")
            @livewire('student.user.strength-and-weakness-specific.strength-specific-cq', ['questionContentTag' =>
            $questionContentTag, 'type' => $type], key($questionContentTag->id))
        @endif
    @endforeach

    <h2>Weakness</h2>
    @foreach ($questionContentTags as $questionContentTag)
        @if ($type == 'overall')
            @livewire('student.user.strength-and-weakness-specific.weakness-specific', ['questionContentTag' =>
            $questionContentTag, 'type' => $type], key($questionContentTag->id))

        @elseif($type == "mcq")
            @livewire('student.user.strength-and-weakness-specific.weakness-specific-mcq', ['questionContentTag' =>
            $questionContentTag, 'type' => $type], key($questionContentTag->id))

        @elseif($type == "cq")
            @livewire('student.user.strength-and-weakness-specific.weakness-specific-cq', ['questionContentTag' =>
            $questionContentTag, 'type' => $type], key($questionContentTag->id))
        @endif
    @endforeach
</div>
