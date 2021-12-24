@extends('admin.layouts.default', [
                                    'title'=>'Payment', 
                                    'pageName'=>'Edit Payment', 
                                    'secondPageName'=>'Edit Payment'
                                ])

@section('content')
    @livewire('payment.edit', [
        'payment' => $payment
    ])
@endsection