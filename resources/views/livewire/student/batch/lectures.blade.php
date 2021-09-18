<div>
    @forelse($courseLectures as $courseLecture)
        <div class="accordion__menu-link">
            <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                <i class="material-icons icon-16pt">play_circle_outline</i>
            </span>
            <a class="flex" href="{{ route('topic_lecture', [$batch->slug, $courseLecture->slug]) }}">
                {{ $courseLecture->title }}
                <span class="material-icons float-right text-primary">play_arrow</span>
            </a>
        </div>
    @empty
        <div class="accordion__menu-link">
            <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                <i class="fad fa-empty-set"></i>
            </span>
            <a class="flex" href="#">No lectures found </a>
        </div>
    @endforelse
    <p class="h6" style="text-align: center;">Exams or Assignment</p>
    @forelse($exams as $exam)
        <div class="accordion__menu-link">
            <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                <i class="fad fa-pen"></i>
            </span>
            {{-- <a class="flex" href="{{ route('question', [$batch->slug, $courseLecture->slug, $exam->slug]) }}"> --}}
            <a class="flex" href="{{ route('question', [$batch->slug, $exam->slug]) }}">
                {{ $exam->title }}
                <span class="float-right text-primary">{{ $exam->exam_type }}</span>
            </a>
        </div>
    @empty
        <div class="accordion__menu-link">
            <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                <i class="fad fa-empty-set"></i>
            </span>
            <a class="flex" href="#">No exams found </a>
        </div>
    @endforelse
</div>
