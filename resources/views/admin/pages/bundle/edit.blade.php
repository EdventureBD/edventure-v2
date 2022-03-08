@extends('admin.layouts.default', [
                                    'title'=>'Bundle', 
                                    'pageName'=>'Bundle',
                                    'secondPageName'=>'Edit Bundle'
                                ])

@section('content')
    {{-- <h1> HEnlo  </h1> --}}
    @livewire('bundle.edit', ['bundle' => $bundle])
@endsection