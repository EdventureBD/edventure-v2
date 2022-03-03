@extends('admin.layouts.default', [
                                    'title'=>'Payment', 
                                    'pageName'=>'Create Payment', 
                                    'secondPageName'=>'Create Payment'
                                ])

@section('content')
    @livewire('payment.create')
@endsection