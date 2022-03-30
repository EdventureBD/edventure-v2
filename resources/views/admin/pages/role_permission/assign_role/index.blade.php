@extends('admin.layouts.default', [
'title'=> 'Assign New Role',
'pageName'=> 'Assign New Role',
'secondPageName' => 'Assign New Role'
])

@section('content')
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
        div .select2 .selection .select2-selection{
            padding-top: auto;
            padding-bottom: auto;
            height: 2.35rem;
        }
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

    @include('admin.pages.role_permission.assign_role.create')

    <table class="table table-responsive table-striped">

        @if(count($users_with_roles) > 0)
            <thead>
            <tr>
                <th class="fit" scope="col">#</th>
                <th class="fit" scope="col">User</th>
                <th class="fit" scope="col">Email</th>
                <th class="fit" scope="col">Role</th>
                <th class="fit" scope="col">Action</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($users_with_roles as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        {{$role->name}}
                    @endforeach
                </td>
                <td>
                    @if($user->roles[0]->name == 'Super Admin')
                        <i style="font-weight: bolder; color: #fa9632;font-size: 28px;" class="fas fa-crown"></i>
                    @else
                        @include('admin.pages.role_permission.assign_role.delete')
                    @endif
                </td>
            </tr>
        @empty
            <div class="d-flex justify-content-center">
                <p>No Role Assigned</p>
            </div>
            <div class="d-flex justify-content-center">
                <img src="{{asset('admin/notFound.svg')}}" width="193" height="130" />
            </div>


        @endforelse
        </tbody>
    </table>
    @if ($users_with_roles->hasPages())
        <div class="pagination-wrapper">
            {{ $users_with_roles->withQueryString()->links() }}
        </div>
    @endif
@endsection

@section('js2')
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
@endsection
