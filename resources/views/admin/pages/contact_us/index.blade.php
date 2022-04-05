@extends('admin.layouts.default', [
    'title'=>'Contacted Us',
    'pageName'=>'Contacted Us',
    'secondPageName'=>'Contacted Us'
])

@section('content')
    <style>
        *{
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body{
            background-color: salmon;
        }

        .container{
            width: 80%;
            min-height: 100vh;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;

            margin-left: auto;
            margin-right: auto;
        }

        .center{
            /*-webkit-box-align: center;*/
            /*-ms-flex-align: center;*/
            align-items: center;
            /*-webkit-box-pack: center;*/
            -ms-flex-pack: center;
            /*justify-content: center;*/
        }

        .card {
            background-color: white;
            width: 100%;
            /*min-height: 250px * 1.618;*/

            display: -webkit-box;

            display: -ms-flexbox;

            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            padding: 20px;
            margin: 5px;

            -webkit-box-shadow: -20px -20px 0px 0px (salmon, 5%);

            box-shadow: -20px -20px 0px 0px (salmon, 5%);
            border-radius: 20px;

            -webkit-animation-name: shadow-show; /* Safari 4.0 - 8.0 */
            -webkit-animation-duration: 1.5s; /* Safari 4.0 - 8.0 */
            animation-name: shadow-show;
            animation-duration: 1.5s;

            -webkit-transition-timing-function: cubic-bezier(0.795, 0.000, 0.165, 1.000);
            -o-transition-timing-function: cubic-bezier(0.795, 0.000, 0.165, 1.000);
            transition-timing-function: cubic-bezier(0.795, 0.000, 0.165, 1.000); /* custom */
        }

        .card h1,h2,h3,h4,h5{
            margin: 0;
            padding: 0 0 15px 0;
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 30px;
            color: #282828;
        }

        .card hr{
            display: block;
            border: none;
            height: 3px;
            background-color: salmon;
            margin: 0px;

            -webkit-animation-name: line-show; /* Safari 4.0 - 8.0 */
            -webkit-animation-duration: 0.3s; /* Safari 4.0 - 8.0 */
            animation-name: line-show;
            animation-duration: 0.3s;
            -webkit-transition-timing-function: cubic-bezier(0.795, 0.000, 0.165, 1.000);
            -o-transition-timing-function: cubic-bezier(0.795, 0.000, 0.165, 1.000);
            transition-timing-function: cubic-bezier(0.795, 0.000, 0.165, 1.000); /* custom */
        }

        .card p{
            margin: 15px 0px 0px 0px;
            font-family: 'Noto Sans KR', sans-serif;
            font-weight: 100;
            letter-spacing: -0.25px;
            line-height: 1.25;
            font-size: 16px;
            word-break: break-all;
            word-wrap: pre-wrap;
            color: #282828;

            -webkit-animation-name: p-show; /* Safari 4.0 - 8.0 */
            -webkit-animation-duration: 1.5s; /* Safari 4.0 - 8.0 */
            animation-name: p-show;
            animation-duration: 1.5s;
        }

        .card button {
            border: none;
            background-color: salmon;
            width: 50%;
            margin: 10px auto;
            padding: 10px 30px;
            color: white;
            font-family: 'Noto Sans KR', sans-serif;
            text-transform: uppercase;
        }

        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes line-show {
            from {margin: 0px 100px;}
            to {margin: 0px;}
        }

        /* Standard syntax */
        @keyframes line-show {
            from {margin: 0px 100px;}
            to {margin: 0px;}
        }

        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes p-show {
            from {color: white;}
            to {color: #222222;}
        }

        /* Standard syntax */
        @keyframes p-show {
            from {color: white;}
            to {color: #222222;}
        }

        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes shadow-show {
            from {
                -webkit-box-shadow: 0px 0px 0px 0px #e0e0e0;
                box-shadow: 0px 0px 0px 0px #e0e0e0;
            }
            to {
                -webkit-box-shadow: -20px -20px 0px 0px (salmon, 5%);
                box-shadow: -20px -20px 0px 0px (salmon, 5%);
            }
        }

        /* Standard syntax */
        @keyframes shadow-show {
            from {-webkit-box-shadow: 0px 0px 0px 0px #e0e0e0;box-shadow: 0px 0px 0px 0px #e0e0e0;}
            to {-webkit-box-shadow: -20px -20px 0px 0px (salmon, 5%);box-shadow: -20px -20px 0px 0px (salmon, 5%);}
        }

        .page-item.active .page-link {
            background-color: salmon;
            border-color: salmon;
        }

    </style>


    <div class="center">
        <div class="row">
        @forelse($contacted_list as $list)

                <div class="col-md-4">
                    <div class="card">
                        <h2>{{$list->name}}</h2>
                        <div style="display:flex; justify-content: space-between">
                            <span>{{$list->email}}</span>
                            <span>{{date('F jS, Y', strtotime($list->created_at))}}</span>
                        </div>

                        <hr/>
                        <p>{{$list->message}}</p>
                    </div>
                </div>

        @empty
            <div class="d-flex justify-content-center">
                <p>No Exam Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130"/>
            </div>
        @endforelse
        </div>

    </div>
    <div>
        @if ($contacted_list->hasPages())
            <div class="pagination-wrapper">
                {{ $contacted_list->withQueryString()->links() }}
            </div>
        @endif
    </div>

@endsection
