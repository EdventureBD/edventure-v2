@extends('admin.layouts.default', [
'title'=>'Assignment',
'pageName'=>'Create Assignment',
'secondPageName'=>'Create Assignment'
])

@section('content')
    @livewire('exam.assignment', ['exam'=>$exam])
@endsection
