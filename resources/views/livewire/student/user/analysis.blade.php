@foreach ($questionContentTags as $questionContentTag)
    <tr>
        <td>
            <div class="media flex-nowrap align-items-center">
                <a href="instructor-edit-course.html" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                    <img src="{{ asset('student/public/images/paths/angular_routing_200x168.png') }}" alt="course"
                        class="avatar-img rounded">
                    <span class="overlay__content"></span>
                </a>
                <div class="media-body">
                    <p class="text-body js-lists-values-course">
                        <strong>{{ $questionContentTag->contentTag->title }}</strong>
                    </p>
                </div>
            </div>
        </td>
        {{-- @livewire('student.user.analysis-specific', ['questionContentTag' => $questionContentTag],
        key($questionContentTag->id)) --}}
        @if ($type == 'overall')
            @livewire('student.user.analysis-specific', ['questionContentTag' => $questionContentTag, 'type' => $type],
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
    </tr>
@endforeach
