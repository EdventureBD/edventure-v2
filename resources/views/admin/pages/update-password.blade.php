@extends('admin.layouts.default', [
'title'=>'Update Password',
'pageName'=>'Update Password',
'secondPageName'=>'Update Password'
])

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form style="margin-left: 10%" action="{{route('admin.update.password.submit')}}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <div class="col-sm-8">
                <div class="input-group mb-2 mr-sm-2">
                    <input type="password"
                           name="current_password"
                           class="form-control"
                           id="current_password"
                           placeholder="Current Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><i id="current_icon" class="fas fa-eye-slash"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-8">
                <div class="input-group mb-2 mr-sm-2">
                    <input type="password"
                           name="password"
                           class="form-control"
                           id="password"
                           placeholder="New Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><i id="new_icon" class="fas fa-eye-slash"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-8">
                <div class="input-group mb-2 mr-sm-2">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           id="password_confirmation"
                           placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><i id="confirm_icon" class="fas fa-eye-slash"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-outline-success submitBtn">Update</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js2')
    <script>
        $(function () {
            $(".submitBtn").prop("disabled", true);
        })


        $('#current_password,#password,#password_confirmation').on('change keyup', function() {
            if($('#current_password').val() === '' || $('#password').val() === '' || $('#password_confirmation').val() === '') {
                $(".submitBtn").prop("disabled", true);
            } else {
                $(".submitBtn").prop("disabled", false);
            }
        })

        $('#current_icon').on('click', function() {
            toggle('current_password','current_icon')
        })

        $('#new_icon').on('click', function() {
            toggle('password','new_icon')
        })

        $('#confirm_icon').on('click', function() {
            toggle('password_confirmation','confirm_icon')
        })



        function toggle(inputId,iconId){
            if($('#'+inputId).attr("type") === 'text') {
                $('#'+iconId).removeClass()
                $('#'+iconId).addClass('fas fa-eye-slash')
                $('#'+inputId).attr("type", 'password');
            } else {
                $('#'+iconId).removeClass()
                $('#'+iconId).addClass('fas fa-eye')
                $('#'+inputId).attr("type", 'text');
            }
        }
    </script>
@endsection
