@extends('admin.layouts.default', [
                                    'title'=>'Batch', 
                                    'pageName'=>'Batch', 
                                    'secondPageName'=>'Batch'
                                ])

@section('css1')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    {{-- BATCH LECTURE START --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Batch: <span style="color: lightskyblue">{{ $batch->title }}</span></h1> <br>
                            <h1 class="card-title">Course: <span style="color: lightskyblue">{{ $batch->course->title }}</span></h1>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="row">
                           <div class="col-md-12">
                                <button class="btn btn-info float-right mt-2 mb-2 mr-2" data-toggle="modal" data-target="#course-topic">
                                    <i class="fas fa-plus-square"></i>
                                    Add batch lecture
                                </button>
                                <div class="modal fade" id="course-topic">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                @livewire('batch-lecture.create', ['batch' => $batch])
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                           </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: auto;" >
                            <table class="table table-bordered table-striped example1">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Batch</th>
                                        <th>Course</th>
                                        <th>Topic</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($batch_lectures as $batch_lecture)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                               {{ $batch->title }}
                                            </td>
                                            <td>
                                               {{ $batch_lecture->courseTitle }}
                                            </td>
                                            <td>
                                               {{ $batch_lecture->courseTopicsTitle }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Batch</th>
                                        <th>Course</th>
                                        <th>Topic</th>
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
    {{-- BATCH LECTURE END --}}
    <!-- /.content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Students</h1>

                            <div class="card-tools">
                               <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                               </button>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                                <div class="modal fade" id="courseLecture">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                           </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;" >
                            <table class="table table-bordered table-striped example1">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        {{-- <th>Contact</th> --}}
                                        <th>Indeividual Batch Days</th>
                                        <th>Reamining Batch Days</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->student->name }}</td>
                                            <td>{{ $student->student->email }}</td>
                                            {{-- <td>{{ $student->user->studentDetails->contact }}</td> --}}
                                            <td>{{ $student->individual_batch_days }}</td>
                                            <td>
                                                @php
                                                    echo $student->accessed_days - $student->individual_batch_days. ' days';
                                                @endphp
                                            </td>
                                            <td>
                                                <input type="checkbox" class="customControlInput" id="single-col-{{ $student->id }}" data-id="{{ $student->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $student->status ? 'checked' : '' }} >
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        {{-- <th>Contact</th> --}}
                                        <th>Indeividual Batch Days</th>
                                        <th>Reamining Batch Days</th>
                                        <th>Status</th>
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
                        url: "{{ route('changeStudentStatus') }}",
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
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
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
