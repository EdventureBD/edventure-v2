@extends('student.layouts.default', [
'title'=>'Preview Course',
'pageName'=>'Preview Course',
'secondPageName'=>'Preview Course'
])

@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content">
        <div class="container page__container page-section">
            <div class="row mb-32pt">
                <div class="col-lg-4">
                    <div class="page-separator">
                        <div class="page-separator__text">Enoll Course: <span
                                class="badge badge-primary">{{ $course->title }}</span></div>
                    </div>
                    <p class="card-subtitle text-70 mb-16pt mb-lg-0">
                        Before paying please check how much you have to pay for this course.You can pay via
                    </p>
                    <div class="mb-4">
                        @forelse ($paymentsNumber as $paymentsNumber)
                            @if ($paymentsNumber->bkash)
                                <div class="d-flex align-items-center mb-2">
                                    <p class="avatar avatar-xs mr-8pt">
                                        <img src="https://www.logo.wine/a/logo/BKash/BKash-Icon2-Logo.wine.svg" alt="bkash"
                                            class="avatar-img rounded-circle">
                                    </p>
                                    <p class="flex mr-2 text-body h4"><strong>Bkash</strong></p>
                                    <span class="text-70 mr-2 h3">{{ $paymentsNumber->bkash }}</span>
                                </div>
                            @endif
                            @if ($paymentsNumber->nogod)
                                <div class="d-flex align-items-center mb-2">
                                    <p class="avatar avatar-xs mr-8pt">
                                        <img src="https://download.logo.wine/logo/Nagad/Nagad-Logo.wine.png" alt="nogod"
                                            class="avatar-img rounded-circle">
                                    </p>
                                    <p class="flex mr-2 text-body h4"><strong>Nagad</strong></p>
                                    <span class="text-70 mr-2 h3">{{ $paymentsNumber->nogod }}</span>
                                </div>
                            @endif
                            @if ($paymentsNumber->rocket)
                                <div class="d-flex align-items-center mb-2">
                                    <p class="avatar avatar-xs mr-8pt">
                                        <img src="https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png"
                                            alt="rocket" class="avatar-img rounded-circle">
                                    </p>
                                    <p class="flex mr-2 text-body h4"><strong>Rocket</strong></p>
                                    <span class="text-70 mr-2 h3">{{ $paymentsNumber->rocket }}</span>
                                </div>
                            @endif
                        @empty
                            <p>No payment number</p>
                        @endforelse
                    </div>
                    <p>After successfull payment fill up the form (Right side) carefully.</p>
                </div>
                <div class="col-lg-8 d-flex align-items-center">
                    <div class="flex" style="max-width: 100%">
                        @livewire('student.course.enroll', [
                        'course' => $course,
                        'studentDetails' => $studentDetails
                        ], key(auth()->user()->id))
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // END Header Layout Content -->
@endsection
