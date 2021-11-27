@extends('admin.layouts.default', [
'title'=>'Images',
'pageName'=>'Images',
'secondPageName'=>'Images'
])

@section('css1')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Images</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('upload-image.create') }}">
                                            <button class="btn btn-info"><i class="fas fa-plus-square"></i> Upload </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Image</th>
                                        <th>Image Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ $image->image}}" data-toggle="lightbox"
                                                    data-title="{{ $image->title }}" data-gallery="gallery">
                                                    <img src="{{ $image->image }}"
                                                        class="img-fluid mb-2 rounded" alt="{{ $image->title }}"
                                                        width="150px" height="150px" />
                                                </a>
                                            </td>
                                            <td>{{ $image->title }}</td>
                                            <td>
                                                <input type="text" readonly value="{{ asset($image->image) }}"
                                                    id="copy{{ $image->id }}" style="width: 100%;" />
                                                <button value="copy" onclick="copyFunction('copy{{ $image->id }}')"
                                                    type="button" class="btn btn-block btn-info">
                                                    <i class="fas fa-copy"></i> Copy
                                                </button>
                                            </td>
                                            <td>
                                                <a href="#deleteImage{{ $image->id }}" data-toggle="modal"
                                                    title="Delete {{ $image->title }}">
                                                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </a>
                                                <div class="modal fade" id="deleteImage{{ $image->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete image</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure??</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-outline-light"
                                                                    data-dismiss="modal">Close</button>
                                                                <form
                                                                    action="{{ route('upload-image.destroy', $image->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="btn btn-outline-light">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Image</th>
                                        <th>Image Link</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js1')
    <!-- DataTables -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- Ekko Lightbox -->
    <script src="{{ asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
@endsection

@section('js2')
    <!-- Filterizr-->
    <script src="{{ asset('admin/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })

    </script>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });

    </script>
    <script>
        /* function copyFunction(id) {
       console.log(id);
       var copyText = document.getElementById(id);
       console.log(copyText);
       var select = copyText.select();
       var copied = document.execCommand("copy");
       if (copied){
        alert("Copied the text: " + copyText.value);
       }
      } */

        function copyFunction(id) {
            console.log(id);
            var copyText = document.getElementById(id);
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Copied the text: " + copyText.value);
        }

    </script>
@endsection
