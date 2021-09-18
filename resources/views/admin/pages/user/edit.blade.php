@extends('admin.layouts.default', [
                                    'title'=>'User', 
                                    'pageName'=>'Edit user', 
                                   'secondPageName'=>'Edit user'
                                ])

@section('content')
    @livewire('user.edit', [
        'user' => $user
    ])
@endsection