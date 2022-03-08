@extends('admin.pages.model_exam.payments.index')
@section('content')
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
        .select2-purple .select2-container--default span span{
            padding-top: auto;
            padding-bottom: auto;
            height: 2.35rem;
        }
    </style>
    <div class="d-flex">
        <a id="courseBtn" href="{{route('model.exam.payment.category')}}" class="text-decoration-none">
            <div style="{{request()->is('admin/model-exam/payment/category') ? 'background: #FA9632 ; color: white; border: 1px solid #FA9632 !important' : 'background: white ; color: black; border: 1px solid #FA9632 !important'}}"
                 class="px-4 py-2 border my-auto fw-600" id="course-option">
                Category
            </div>
        </a>
        <a href="{{route('model.exam.payment.exam')}}" class="text-decoration-none">
            <div style="{{request()->is('admin/model-exam/payment/exam') ? 'background: #FA9632 ; color: white; border: 1px solid #FA9632 !important' : 'background: white ; color: black; border: 1px solid #FA9632 !important'}}"
                 class="px-4 py-2 border my-auto fw-600" id="model-test-option">
                Exams
            </div>
        </a>
    </div>
    @include('admin.pages.model_exam.payments.filter')
    <table class="table table-responsive table-striped">

        @if(count($category_payments) > 0)
            <thead>
                <tr>
                    <th class="fit" scope="col">#</th>
                    <th class="fit" scope="col">Student</th>
                    <th class="fit" scope="col">Email</th>
                    <th class="fit" scope="col">Phone</th>
                    <th class="fit" scope="col">Category</th>
                    <th class="fit" scope="col">Amount</th>
                    <th class="fit" scope="col">Tnx</th>
                    <th class="fit" scope="col">Platform</th>
                    <th class="fit" scope="col">Payment On</th>
                </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($category_payments as $payment)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $payment->user->name }}</td>
                <td>{{ $payment->user->email }}</td>
                <td>{{ $payment->user->phone }}</td>
                <td>{{ $payment->examCategory->name }}</td>
                <td>{{ $payment->singlePayment->amount }}</td>
                <td>{{ $payment->singlePayment->tnx_id }}</td>
                <td>{{ $payment->singlePayment->platform }}</td>
                <td>{{ date('j/m/y, g:i a', strtotime($payment->created_at)) }}</td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Payment Found For Category</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($category_payments->hasPages())
        <div class="pagination-wrapper">
            {{ $category_payments->withQueryString()->links() }}
        </div>
    @endif
@endsection
