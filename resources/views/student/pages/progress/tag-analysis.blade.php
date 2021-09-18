@extends('student.layouts.default', [
'title'=>'Analysis',
'pageName'=>'Analysis',
'secondPageName'=>'Analysis'
])

@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">

        <div class="pt-32pt">
            <div
                class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                <div class="flex d-flex flex-column flex-sm-row align-items-center">
                    <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                        <h2 class="mb-0">Content tag analysis</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container page__container page-section">

            <div class="page-separator">
                <div class="page-separator__text">Analysis</div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a href="{{ route('analysis', [auth()->user()->id, $course->slug]) }}">
                        <button type="button"
                            class="btn btn-secondary {{ request()->is('progress/*/overall') ? 'active' : '' }}">Overall</button>
                    </a>
                    <a href="{{ route('mcqAnalysis', [auth()->user()->id, $course->slug]) }}">
                        <button type="button"
                            class="btn btn-secondary {{ request()->is('progress/*/mcq') ? 'active' : '' }}">MCQ</button>
                    </a>
                    <a href="{{ route('cqAnalysis', [auth()->user()->id, $course->slug]) }}">
                        <button type="button"
                            class="btn btn-secondary {{ request()->is('progress/*/cq') ? 'active' : '' }}">CQ</button>
                    </a>

                </div> &nbsp;
            </div>

            <div class="card mb-0">
                <div class="table-responsive">
                    <table class="table table-nowrap table-flush">
                        <thead>
                            <tr class="text-uppercase small">
                                <th>
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-course">Content Tag</a>
                                </th>
                                <th class="text-center w-50">
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-fees">Progress</a>
                                </th>
                                <th class="text-center">
                                    <a href="javascript:void(0)" class="sort"
                                        data-sort="js-lists-values-revenue">Percentage</a>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @livewire('student.user.analysis', ['course' => $course, 'type' => $type], key($course->id))
                        </tbody>
                    </table>
                </div>
            </div>

            <h2 class="mt-4">Strength and Weakness</h2>
            <div class="card mb-0">
                <div class="table-responsive">
                    @livewire('student.user.strength-and-weakness', ['course' => $course, 'type' => $type],
                    key($course->id))
                </div>
            </div>
        </div>

    </div>
    <!-- // END Header Layout Content -->
@endsection
