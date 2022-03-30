@extends('admin.layouts.default', [
                                    'title'=>'User',
                                    'pageName'=>'Create User',
                                    'secondPageName'=>'Create User'
                                ])

@section('content')
    @livewire('user.create')
@endsection

@section('js2')
    <script>
        console.log($('#user_type').val())
        $('#user_type').on('change', function () {
            console.log($('#user_type').val())

            if($('#user_type').val() == 2) {
                $('#teacher_div').removeClass('d-none')
            } else {
                $('#teacher_div').addClass('d-none')
            }

        })
    </script>
@endsection
