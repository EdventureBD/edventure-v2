@extends('admin.layouts.default', [
                                    'title'=>'Programs', 
                                    'pageName'=>'Edit Program', 
                                    'secondPageName'=>'Edit Program'
                                 ])

@section('content')
   @livewire('intermediary-level.edit', ['categories' => $categories, 'intermediary_level_slug' => $intermediary_level_slug])
@endsection