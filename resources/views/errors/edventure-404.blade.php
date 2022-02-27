
<!DOCTYPE html>
<html>
<head>
    <title>404 Error Page In Bootstrap 4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style type="text/css">

        h1{
            text-align: center;
            font-size: 190px;
            font-weight: 400;
            margin: 0;
        }
        .fa{
            font-size: 120px;
            text-align: center;
            display: block;
            padding-top: 100px;
            margin: 0 auto;
            color: #A93226;
        }
        #error p{
            text-align: center;
            font-size: 36px;
            color: #4A235A;
        }
        a.back{
            text-align: center;
            margin: 0 auto;
            display: block;
            text-decoration: none;
            font-size: 16px;
            background: #653092;
            border-radius: 10px;
            width: 10%;
            padding-left: 0.5rem !important;
            padding-bottom: 0.5rem !important;
            padding-right: 0.5rem !important;
            padding-top: 0.5rem !important;
            margin-top: 1.5rem !important;
            margin-bottom: 1rem !important;
            color: #fff;
            font-weight: 800;
            cursor: pointer;

        }
        footer p{
            text-align: center;
        }
        a.w3hubs{
            text-decoration: none;
            color: #A93226;
        }
        @media(max-width: 550px){
            a.back{
                width: 20%;
            }
        }
        @media(max-width: 425px){
            h1{
                padding-top: 20px;
            }
            .fa{
                padding-top: 100px;
            }
        }
    </style>
</head>
<body>
<section id="error">
    <div class="content">
        <img src="{{ asset('img/landing/giphy.gif') }}" alt=""
             class="img-fluid mx-auto d-block mt-4">
        <a class="back" href="{{ route('home') }}">Go to home</a>
    </div>
</section>
<footer>
    @include('landing.footer')
</footer>
</body>
</html>

{{--    <div class="page-section">--}}
{{--        <div class="container page-content">--}}
{{--            <div class="row">--}}
{{--                <div class="page-separator">--}}
{{--                    <div class="page-separator__text"></div>--}}
{{--                </div>--}}
{{--                <div class="row card-group-row mb-lg-8pt">--}}
{{--                    <img src="{{ asset('img/landing/giphy.gif') }}" alt=""--}}
{{--                         class="img-fluid mx-auto d-block mt-4">--}}
{{--                </div>--}}
{{--                <div class="page-separator text-center">--}}
{{--                    <a class="btn text-xxsm text-white bg-purple fw-800 px-2 py-2 w-20 mb-3 mt-4" href="{{ route('home') }}"></i> Go to home</a>--}}
{{--                    <div class="page-separator__text"></div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}


