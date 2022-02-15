@extends('admin.layouts.default', [
'title'=>'Update Password',
'pageName'=>'Update Password',
'secondPageName'=>'Update Password'
])

@section('content')
    <form autocomplete="off">
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
                           name="new_password"
                           class="form-control"
                           id="new_password"
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
                           name="confirm_password"
                           class="form-control"
                           id="confirm_password"
                           placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><i id="confirm_icon" class="fas fa-eye-slash"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js2')
    <script>
        $('#current_icon').on('click', function() {
            toggle('current_password','current_icon')
        })

        $('#new_icon').on('click', function() {
            toggle('new_password','new_icon')
        })

        $('#confirm_icon').on('click', function() {
            toggle('confirm_password','confirm_icon')
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
