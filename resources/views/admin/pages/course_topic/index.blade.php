@extends('admin.layouts.default', [
                                    'title'=>'Course Topic', 
                                    'pageName'=>'Course Topic', 
                                    'secondPageName'=>'Course Topic'
                                ])

@section('css1')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Course Topics</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <a href="{{ route('course-topic.create') }}">
                                    <button class="btn btn-info"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Course Topic</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    @livewire('course-topic.index')
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
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            $('.customControlInput').change(function() {
                if(confirm("Do you want to change the status?")){
                    var status = $(this).prop('checked') == true ? 1 : 0; 
                    var id = $(this).data('id');     
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "changeCourseTopicStatus",
                        data: {'status': status, 'id': id},
                        success: function(data){
                            console.log(data.success);
                        }
                    });
                } else {
                    if($("#single-col-"+$(this).data('id')).prop("checked") == true){
                         $("#single-col-"+$(this).data('id')).prop('checked', false);
                    }
                    else if($("#single-col-"+$(this).data('id')).prop("checked") == false){
                         $("#single-col-"+$(this).data('id')).prop('checked', true);
                    }
                }
            })
        })
    </script>
    <!-- DataTables -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}">
    </script>
@endsection

@section('js2')
    <script>
        $(function () {
            $(".example1").DataTable();
            $('.example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });

    </script>
@endsection
