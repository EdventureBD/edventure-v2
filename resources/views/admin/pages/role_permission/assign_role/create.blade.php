<div style="justify-content: right;display: flex; text-align: end" class="mt-4">
    <a href="#assignRole"
       data-toggle="modal"
       title="Assign new Role">
        <button class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Assign new Role</button>
    </a>
</div>

<div class="modal fade" id="assignRole">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <form action="{{route('role.assign.create')}}" method="POST">
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3 col-md-6 mt-4">
                            <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                                <select
                                    name="user"
                                    class="select2 form-control"
                                    id="query_admin_selected"
                                    data-placeholder="Choose Admin"
                                    data-dropdown-css-class="select2-purple"
                                    style="width: 100%; margin-top: -8px !important;">
                                    @foreach ($users as $user)
                                        <option value=""></option>
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-6 mt-4">
                            <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                                <select
                                    name="role"
                                    class="select2 form-control"
                                    id="query_role_selected"
                                    data-placeholder="Choose Role"
                                    data-dropdown-css-class="select2-purple"
                                    style="width: 100%; margin-top: -8px !important;">
                                    @foreach ($roles as $role)
                                        <option value=""></option>
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-dismiss="modal">Close
                    </button>
                    <button type="submit"
                            class="btn btn-outline-success">Assign
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
