@extends('admin.layouts.default', [
                                    'title'=>'Add Batch to Islands', 
                                    'pageName'=>'Add Batch to Islands', 
                                    'secondPageName'=>'Add Batch to Islands'
                                ])

@section('content')
    @livewire('batch-lecture.create')
@endsection