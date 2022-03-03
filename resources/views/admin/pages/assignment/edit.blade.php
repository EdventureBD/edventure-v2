@extends('admin.layouts.default', [
                                    'title'=>'Assignment', 
                                    'pageName'=>'Edit Assignment', 
                                    'secondPageName'=>'Edit Assignment'
                                ])

@section('content')
    @livewire('assignment.edit', ['assignment' => $assignment])
@endsection