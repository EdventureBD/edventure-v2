@extends('student.layouts.default', [
                                    'title'=>'Batch Exam',
                                    'pageName'=>'Batch Exam',
                                    'secondPageName'=>'Batch Exam'
])

@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        <div class="bg-primary pb-lg-64pt py-32pt">
            <div class="container page__container">
                <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
                    <h1 class="text-white flex m-0">Course : {{ $batch->course->title }}</h1>
                </div>
                <p class="hero__lead measure-hero-lead text-white-50">
                    {{-- Topic : {{ $courseLecture->title }} <br> --}}
                    Batch : {{ $batch->title }} <br>
                    Exam : {{ $exam->title }} <br>
                    Marks : {{ $exam->marks }}
                </p>
            </div>
        </div>
        <div class="jumbotron jumbotron-fluid">
            <div class="container d-flex justify-content-center">
                @if ($exam->exam_type == 'MCQ')
                    <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt w-50">
                        <div class="table-responsive">
                            <table class="table mb-0 thead-border-top-0 table-nowrap">
                                {{-- <thead>
                                    <tr>
                                        <th>Name: </th>
                                        <tr>{{ auth()->user()->name }}</tr>
                                    </tr>
                                </thead> --}}
                                <tbody class="list" id="projects">
                                    <tr>
                                        <th>Name: </th>
                                        <td>{{ auth()->user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total: </th>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <th>Gained: </th>
                                        <td>{{ $canAttempt->gain_marks }}</td>
                                    </tr>
                                    <tr>
                                        <th>Percentage: </th>
                                        <td>
                                            @php
                                                echo round($canAttempt->gain_marks*100/10)
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Highest: </th>
                                        <td>{{ $max }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lowest: </th>
                                        <td>{{ $min }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    @if (!$show)
                        <h1 class="display-5" style="text-align: center">Your submitted answer is being reviewed. Please wait</h1>
                    @else
                        <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt w-50">
                            <div class="table-responsive">
                                <table class="table mb-0 thead-border-top-0 table-nowrap">
                                    <tbody class="list" id="projects">
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{ auth()->user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total: </th>
                                            <td>{{ $totalNumber }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gained: </th>
                                            <td>{{ $canAttempt->gain_marks }}</td>
                                        </tr>
                                        <tr>
                                            <th>Percentage: </th>
                                            <td>
                                                @php
                                                    echo round($canAttempt->gain_marks*100/$totalNumber)
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Highest: </th>
                                            <td>{{ $max }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lowest: </th>
                                            <td>{{ $min }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <!-- // END Header Layout Content -->

    <!-- Strong point and weak point Start -->
    {{-- <div class="mdk-header-layout__content page-content ">
        <div class="container page__container page-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-separator">
                        <div class="page-separator__text">Strong</div>
                    </div>
                    <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
                        <div class="table-responsive">
                            <table class="table mb-0 thead-border-top-0 table-nowrap">
                                <thead>
                                    <tr>
                                        <th>Strong Point</th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="projects">
                                    @forelse ($analysis as $analysis)
                                        <tr>
                                            @if ($analysis->gain_marks == 1)
                                                <td>{{ $analysis->contentTag }}</td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Strong Point</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="page-separator">
                        <div class="page-separator__text">Weak</div>
                    </div>
                    <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
                        <div class="table-responsive">
                            <table class="table mb-0 thead-border-top-0 table-nowrap">
                                <thead>
                                    <tr>
                                        <th>Weak Point</th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="projects">
                                    @forelse ($weakAnalysis as $weakAnalysis)
                                        <tr>
                                            @if ($weakAnalysis->gain_marks == 0)
                                                <td>{{ $weakAnalysis->contentTag }}</td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Weak Point</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div> --}}
    <!-- // END of Strong point and weak point -->

    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        <div class="container page__container page-section">
            <div class="page-separator">
                <div class="page-separator__text">Exam: {{ $exam->title }}&nbsp;&nbsp; | Exam Type: {{ $exam->exam_type }}&nbsp;</div>
            </div>

            <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
                <div class="table-responsive">
                    <table class="table mb-0 thead-border-top-0 table-nowrap">
                        <thead>
                            <tr>
                                <th>SL. No</th>
                                <th>Question</th>
                                <th>Gain Marks</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="projects">
                            @foreach($detailsResult as $details_result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if ($exam->exam_type == 'MCQ')
                                        <td title="View questions">{{ $details_result->question->question }}</td>
                                    @elseif(($exam->exam_type == 'CQ'))
                                        <td title="View questions">{{ $details_result->cqQuestion->question }}</td>
                                    @elseif(($exam->exam_type == 'Assignment'))
                                        <td title="View questions">{{ $details_result->assignment->question }}</td>
                                    @endif
                                    <td class="text-center">{{ $details_result->gain_marks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- // END Header Layout Content -->
@endsection