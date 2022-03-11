@extends('admin.layouts.default', [
'title'=>'User',
'pageName'=>'User',
'secondPageName'=>'User'
])

@section('css1')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    {{-- @livewire('user.index', ['type' => $type]) //WITHOUT DATA TABLE --}}

    {{-- WITH DATA TABLE --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User List</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('usersExportCSV') }}" class="btn btn-info">
                                            <i class="fas fa-download"></i>&nbsp;&nbsp;
                                            Export Users
                                        </a>
                                        <button class="btn btn-info" type="button" data-toggle="modal"
                                            data-target="#modal-default">
                                            <i class="fas fa-upload"></i>&nbsp;&nbsp; Import user
                                        </button>
                                        <div class="modal fade" id="modal-default">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Import User Excel</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('userImportCSV') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Choose file:</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="file"
                                                                            class="custom-file-input" id="exampleInputFile">
                                                                        <label class="custom-file-label"
                                                                            for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                                @error('file')
                                                                    <p style="color: red;">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                Import User
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <a href="{{ route('user.index') }}">
                                            <button class="btn btn-info"><i class="fas fa-users"></i> All </button>
                                        </a>
                                        <a href="{{ route('allAdmin') }}">
                                            <button class="btn btn-info"><i class="fas fa-users-cog"></i> Admin </button>
                                        </a>
                                        <a href="{{ route('allTeacher') }}">
                                            <button class="btn btn-info"><i class="fas fa-chalkboard-teacher"></i> Teacher
                                            </button>
                                        </a>
                                        <a href="{{ route('allStudent') }}">
                                            <button class="btn btn-info"><i class="fas fa-user-graduate"></i> Student
                                            </button>
                                        </a>
                                        <a href="{{ route('user.create') }}">
                                            <button class="btn btn-info"><i
                                                    class="fas fa-plus-square"></i>&nbsp;&nbsp;User</button>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Image</th>
                                        <th>Class</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}<br> {{ $user->phone }}</td>
                                            <td>
                                                @if ($user->user_type == 1)
                                                    Admin
                                                @elseif(($user->user_type) == 2)
                                                    Teacher
                                                @else
                                                    Student
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($user->image))
                                                    <img src="{{ $user->image }}"
                                                        class="product-image-thumb" alt="{{ $user->name }}"
                                                        height="70px !important" srcset="">
                                                @else
                                                    @if ($user->user_type == 1)
                                                        <img src="{{ asset('/img/landing/admin.png') }}"
                                                            class="product-image-thumb" alt="Admin" height="70px !important"
                                                            srcset="">
                                                    @elseif(($user->user_type) == 2)
                                                        <img src="https://cdn0.iconfinder.com/data/icons/scenarium-vol-11/128/042_teacher_blackboard_teaching_school-256.png"
                                                            class="product-image-thumb" alt="teacher"
                                                            height="70px !important" srcset="">
                                                    @else
                                                        <img src="https://www.flaticon.com/premium-icon/icons/svg/2995/2995620.svg"
                                                            class="product-image-thumb" alt="student"
                                                            height="70px !important" srcset="">
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{$user->studentDetails ? \App\Enum\EducationLevel::Level[$user->studentDetails->class] : 'n/a' }}</td>
                                            <td>{{ $user->created_at->format('d M y - g:i A') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="mr-1" href="{{ route('user.edit', $user->id) }}"
                                                        title="Edit {{ $user->title }}">
                                                        <button class="btn btn-info"><i
                                                                class="far fa-edit"></i></button>
                                                    </a>
                                                    @if (auth()->user()->id != $user->id)
                                                        <a class="mr-1" href="#deleteUser{{ $user->id }}"
                                                            data-toggle="modal" title="Delete {{ $user->title }}">
                                                            <button class="btn btn-danger"><i
                                                                    class="far fa-trash-alt"></i></button>
                                                        </a>
                                                        <div class="modal fade" id="deleteUser{{ $user->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content bg-danger">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            Delete @if ($user->user_type == 1)
                                                                                Admin
                                                                            @elseif(($user->user_type) == 2)
                                                                                Teacher
                                                                            @else
                                                                                Student
                                                                            @endif {{ $user->name }}
                                                                        </h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
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
                                                                            action="{{ route('user.destroy', $user->id) }}"
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
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Image</th>
                                        <th>Created</th>
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
    {{-- WITH DATA TABLE --}}
    <!-- /.content -->
@endsection

@section('js1')
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            $('.customControlInput').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                // console.log(id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "changeUserStatus",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success);
                    }
                });
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
@endsection
