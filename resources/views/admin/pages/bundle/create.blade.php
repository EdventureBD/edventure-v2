@extends('admin.layouts.default', [
                                    'title'=>'Bundle', 
                                    'pageName'=>'Bundle', 
                                    'secondPageName'=>'Create Bundle'
                                ])

@section('content')
    @livewire('bundle.create', ['intermediary_levels' => $intermediary_levels])
@endsection