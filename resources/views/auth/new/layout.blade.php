<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edventure | Signup</title>
        {{-- cdn links for css starts  --}}
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
        {{-- cdn links for css starts --}}
        {{-- font awesome cdn --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

        {{-- font awesome cdn --}}

        {{-- custom css link starts  --}}
        <link rel="stylesheet" href="/css/new-multistep-signup.css">
        {{-- custom css link ends  --}}

        <style>
            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            input[type="number"] {
                -moz-appearance: textfield;
            }
        </style>
    </head>
    <body>
        @yield('content')


        <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

        {{-- <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script> --}}
        {{-- custom js link  --}}
        <script src="/js/new-multistep-signup.js"></script>
    </body>
</html>
@yield('js')
