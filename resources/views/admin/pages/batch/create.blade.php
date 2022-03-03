@extends('admin.layouts.default', [
                                    'title'=>'Batch', 
                                    'pageName'=>'Create Batch', 
                                    'secondPageName'=>'Create Batch'
                                   ])

@section('content')
    @livewire('batch.create')
@endsection