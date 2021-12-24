<div>
    @forelse($courseLectures as $courseLecture)
        <div class="accordion__menu-link d-flex justify-content-between align-items-center bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600">
            {{-- <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                <i class="material-icons icon-16pt">play_circle_outline</i>
            </span> --}}
            <a class="flex text-dark fw-600" href="{{ route('topic_lecture', [$batch->slug, $courseLecture->slug]) }}">
                {{ $courseLecture->title }}
                {{-- <span class="material-icons float-right text-primary">play_arrow</span> --}}
            </a>
            <a href="#" class="d-inline-block text-dark ml-4 bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">View Lecture</a>
        </div>
    @empty
        <div class="accordion__menu-link">
            <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                <i class="fad fa-empty-set"></i>
            </span>
            <a class="flex" href="#">No lectures found </a>
        </div>
    @endforelse
    <p class="h6 pt-3" style="text-align: center;">Exams or Assignment</p>
    @forelse($exams as $exam)
        <div class="accordion__menu-link d-flex justify-content-between align-items-center bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600">
            {{-- <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                <i class="fad fa-pen"></i>
            </span> --}}
            {{-- <a class="flex" href="{{ route('question', [$batch->slug, $courseLecture->slug, $exam->slug]) }}"> --}}
             <a class="flex text-dark" href="{{ route('question', [$batch->slug, $exam->slug]) }}">
                {{ $exam->title }}
            </a>
            <span class="text-dark bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">{{ $exam->exam_type }}</span>
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
