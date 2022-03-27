@extends('admin.layouts.default', [
'title'=> 'Social Group',
'pageName'=> 'Social Group',
'secondPageName' => 'Social Group'
])

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
        .select2-purple .select2-container--default span span{
            padding-top: auto;
            padding-bottom: auto;
            height: 2.35rem;
        }
    </style>

    @include('admin.pages.social_group.create')

    <table class="table table-responsive table-striped">

        @if(count($lists) > 0)
            <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Title</th>
                <th class="fit" scope="col">Banner</th>
                <th class="fit" scope="col">Go To</th>
                <th class="fit" scope="col">Created at</th>
                <th class="fit" scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($lists as $list)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $list->title }}</td>
                <td><img height="200" width="200" class="img-fluid" src="{{Storage::url('socialBanner/'.$list->banner)}}" alt="{{$list->title}}"></td>
                <td><a target="_blank" href="{{ $list->link }}" style="font-size: 30px; color: mediumpurple"><i class="fas fa-location-arrow"></i></a></td>
                <td>{{ $list->created_at }}</td>
                <td>
                    @include('admin.pages.social_group.delete')
                    @include('admin.pages.social_group.edit')
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Data Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($lists->hasPages())
        <div class="pagination-wrapper">
            {{ $lists->withQueryString()->links() }}
        </div>
    @endif

@endsection
@section('js2')
    <script>
        $('#banner').change(function(){
            preview = $('#imagePreview');
            let reader = new FileReader();
            reader.onload = (e) => {
                preview.css('background-image', 'url('+e.target.result +')');
                preview.css('height', '200px');
                preview.css('background-position', 'center center');
                preview.css('background-size', 'cover');
            }
            reader.readAsDataURL(this.files[0]);
        });

        var bannerEdit = document.getElementsByClassName('banner-edit');

        for(var i = 0; i < bannerEdit.length; i++) {
            (function(index) {
                bannerEdit[index].addEventListener("change", function() {
                    preview = $('.imagePreview-edit');
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        preview.css('background-image', 'url('+e.target.result +')');
                        preview.css('height', '200px');
                        preview.css('background-position', 'center center');
                        preview.css('background-size', 'cover');
                    }
                    reader.readAsDataURL(this.files[0]);

                })
            })(i);
        }
        // $('#banner-edit').change(function(){
        //     preview = $('#imagePreview-edit');
        //     let reader = new FileReader();
        //     reader.onload = (e) => {
        //         console.log(e.target.result)
        //         preview.css('background-image', 'url('+e.target.result +')');
        //         preview.css('height', '200px');
        //         preview.css('background-position', 'center center');
        //         preview.css('background-size', 'cover');
        //     }
        //     reader.readAsDataURL(this.files[0]);
        // });
    </script>
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $('.select2').select2()--}}
{{--        })--}}

{{--        function fetchData(id) {--}}
{{--            let url = window.location.origin +'/admin/exam-tags/'+id;--}}

{{--            $.ajax({--}}
{{--                type: "GET",--}}
{{--                url: url,--}}
{{--                success: function(response){--}}
{{--                    $("#tag_name"+id).val(response.name);--}}
{{--                    $("#topic"+id).val(response.exam_topic_id).trigger('change');--}}
{{--                },--}}
{{--                error: function(e){--}}
{{--                    console.log(e)--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>--}}
@endsection
