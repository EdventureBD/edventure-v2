@extends('admin.layouts.default', [
'title'=> 'Role & Permission',
'pageName'=> 'Role & Permission',
'secondPageName' => 'Role & Permission'
])

@section('content')
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }

        /******** Checkbox color change on selected *****************/
        input[type="checkbox"] {
            line-height: 2.1ex;
            height: 20px;
            width: 20px;
            filter: invert(30%) hue-rotate(37.75deg) brightness(1.7);
        }
        /*********** Checkbox color change on selected **************/
    </style>
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>`
        </div>
    @endif

    @include('admin.pages.role_permission.create')

    <table class="table table-responsive table-striped">

        @if(count($roles) > 0)
            <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">Name</th>
                <th class="fit" scope="col">Permissions</th>
                <th class="fit" scope="col">Created At</th>
                <th class="fit" scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($roles as $role)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="#viewPermission{{$role->id}}"
                       data-toggle="modal"
                       title="Create new group">
                        <button class="btn btn-sm btn-outline-primary">view</button>
                    </a>
                    <div class="modal fade" id="viewPermission{{$role->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-light">
                                    <div class="modal-body">
                                        <ul>
                                            @foreach($role->permissions as $permission)
                                                <li>{{\App\Enum\Permission::List[$permission->name]}}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="modal-footer justify-content-end">
                                        <button type="button"
                                                class="btn btn-outline-secondary"
                                                data-dismiss="modal">Close
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>{{ date('F j, Y, g:i a', strtotime($role->created_at)) }}</td>
                <td>
                    @include('admin.pages.role_permission.edit')
                    @include('admin.pages.role_permission.delete')
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Role Found</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($roles->hasPages())
        <div class="pagination-wrapper">
            {{ $roles->withQueryString()->links() }}
        </div>
    @endif
@endsection

