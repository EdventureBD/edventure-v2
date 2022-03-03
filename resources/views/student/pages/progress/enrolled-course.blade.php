@extends('student.layouts.default', [
'title'=>'Courses',
'pageName'=>'Courses',
'secondPageName'=>'Courses'
])

@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
            <div class="mdk-drawer-layout__content">
                <div class="page-section">
                    <div class="container page__container">
                        <div class="page-separator">
                            <div class="page-separator__text">Enrolled Courses</div>
                        </div>
                        <div class="row card-group-row">
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="flex" style="max-width: 100%">
                                    <div class="card m-0">
                                        <div class="table-responsive">
                                            <table class="table mb-0 thead-border-top-0 table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Course</th>
                                                        <th>Batch</th>
                                                        <th>Teacher</th>
                                                        <th>Enrolled On</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list" id="search">
                                                    @foreach ($batchStudentEnrollment as $batchStudentEnrollment)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex flex-column">
                                                                    <a href="{{ route('analysis', [auth()->user()->id, $batchStudentEnrollment->course->slug]) }}"
                                                                        class="mb-0">
                                                                        <strong class="js-lists-values-employee-name">
                                                                            {{ $batchStudentEnrollment->course->title }}
                                                                            <small
                                                                                class="h6 form-text text-white btn btn-info btn-sm">Click
                                                                                to see the progress.</small>
                                                                        </strong>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="{{ route('batch-lecture', $batchStudentEnrollment->batch->slug) }}">
                                                                    {{ $batchStudentEnrollment->batch->title }}
                                                                </a>
                                                            </td>
                                                            <td class="text-50">
                                                                {{ $batchStudentEnrollment->batch->teacher->name }}
                                                            </td>
                                                            <td class="text-50">
                                                                {{ $batchStudentEnrollment->created_at->format('d M Y') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- // END Header Layout Content -->
@endsection
