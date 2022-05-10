@extends('admin.layouts.default', [
'title'=> 'Coupon',
'pageName'=> 'Coupon',
'secondPageName' => 'Coupon'
])

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            max-width: 2%;
        }
    </style>
    @include('admin.pages.model_exam.coupon.create')
    <table class="table table-responsive table-striped">

        @if(count($coupons) > 0)
            <thead>
            <tr>
                <th class="fit">#</th>
                <th class="fit">Name</th>
                <th class="fit">Type</th>
                <th class="fit">Amount</th>
                <th class="fit">Used</th>
                <th class="fit">Validated Till</th>
                <th class="fit">Created at</th>
                <th class="fit">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($coupons as $coupon)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $coupon->name }}</td>
                <td>{{$coupon->fixed}}</td>
                <td>{{$coupon->amount}}</td>
                <td>{{$coupon->coupon_uses_count}}</td>
                <td>{{date('F j, Y, g:i a', strtotime($coupon->validated_till))}}</td>
                <td>{{ date('F j, Y, g:i a', strtotime($coupon->created_at)) }}</td>
                <td>
                    @include('admin.pages.model_exam.coupon.delete')
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Coupon Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($coupons->hasPages())
        <div class="pagination-wrapper">
            {{ $coupons->links() }}
        </div>
    @endif
@endsection
