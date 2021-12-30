@extends('admin.layouts.default', [
                                    'title'=>'Intermediary Level', 
                                    'pageName'=>'Edit Intermediary Level', 
                                    'secondPageName'=>'Edit Intermediary Level'
                                 ])

@section('content')
   @livewire('intermediary-level.edit', ['categories' => $categories, 'intermediary_level_slug' => $intermediary_level_slug])
@endsection