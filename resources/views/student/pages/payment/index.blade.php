@extends('student.layouts.default', [
'title'=>'Payment',
'pageName'=>'Payment',
'secondPageName'=>'Payment'
])

@section('content')
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        <div class="page-section">
            <div class="container page__container">
                <div class="page-separator">
                    <div class="page-separator__text">Payment List</div>
                </div>
                <div class="row card-group-row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="flex" style="max-width: 100%">
                            <div class="card m-0">
                                <div class="table-responsive">
                                    <table class="table mb-0 thead-border-top-0 table-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Course</th>
                                                <th>Contact</th>
                                                <th>Trx id</th>
                                                <th>Payment Type</th>
                                                <th>Amount</th>
                                                <th>Payment Account Number</th>
                                                <th>Days For</th>
                                                <th>Accepted</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="search">
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->email }}</td>
                                                    <td>{{ $payment->course->title }}</td>
                                                    <td class="text-50">{{ $payment->contact }}</td>
                                                    <td class="text-50">{{ $payment->trx_id }}</td>
                                                    <td class="text-50">{{ $payment->payment_type }}</td>
                                                    <td class="text-50">{{ $payment->amount }}</td>
                                                    <td class="text-50">0{{ $payment->payment_account_number }}
                                                    </td>
                                                    <td class="text-50">{{ $payment->days_for }}</td>
                                                    <td class="text-50">
                                                        @if ($payment->accepted == 1)
                                                            <p class="badge badge-success">Accepted</p>
                                                        @else
                                                            <p class="badge badge-warning">Waiting</p>
                                                        @endif
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
    <!-- // END Header Layout Content -->
@endsection
