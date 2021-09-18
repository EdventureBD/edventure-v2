@extends('student.layouts.default', [
        'title'=>'Preview Course',
        'pageName'=>'Preview Course',
        'secondPageName'=>'Preview Course'
])

@section('content')
    <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">
            <div class="page-section bg-primary border-bottom-2">
                <div class="container page__container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-md-6 mb-24pt mb-lg-0">
                                    <p class="text-white-70 mb-0"><strong>Prepared for</strong></p>
                                    <h2 class="text-white">{{ auth()->user()->name }}</h2>
                                    <p class="text-white-50">640 Joy Bypass Suite 448<br>Germany</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-white-70 mb-0"><strong>Prepared by</strong></p>
                                    <h2 class="text-white">eDventure</h2>
                                    <p class="text-white-50">32 Noah Cliffs Suite 626, Romania<br>Tax ID RO18880609</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 text-lg-right d-flex flex-lg-column mb-24pt mb-lg-0 border-bottom border-lg-0 pb-16pt pb-lg-0">
                            <div class="flex">
                                <p class="text-white-70 mb-8pt"><strong>Invoice</strong></p>
                                <p class="text-white-50">
                                    {{ date('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-section container page__container">
                <div class="page-separator">
                    <div class="page-separator__text">Invoice Summary</div>
                </div>
                <div class="card table-responsive mb-24pt">
                    <table class="table table-flush table--elevated">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th style="width: 60px;" class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="mb-0"><strong>Course</strong></p>
                                    <p class="text-50">{{ $course->title }}</p>
                                </td>
                                <td class="text-right"><strong>{{ $payments->amount }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-16pt">
                    <p class="text-70 mb-8pt"><strong>Invoice paid</strong></p>
                    <div class="media">
                        <div class="media-left mr-16pt">
                            @if (($payments->payment_type) == 'Bkash')
                                <img src="https://www.logo.wine/a/logo/BKash/BKash-Icon2-Logo.wine.svg" alt="Bkash" width="38" />
                            @elseif(($payments->payment_type) == 'Nogod')
                                <img src="https://www.vhv.rs/dpng/d/496-4962280_nagad-logo-transparent-bkash-logo-png-png-download.png" alt="Nogod" width="38" />
                            @elseif(($payments->payment_type) == 'Rocket')
                                <img src="https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png" alt="Rocket" width="38" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <!-- // END Header Layout Content -->
@endsection