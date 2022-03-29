@extends('admin.layouts.default', [
                                    'title'=>'Settings',
                                    'pageName'=>'Settings',
                                    'secondPageName'=>'Settings'
                                ])

@section('css1')
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-edit"></i>
            Change your settings here
        </h3>
    </div>
    <div class="card-body">
        <h4>Profile settings</h4>
        <div class="row">
            <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active" id="change-password-tab" data-toggle="pill" href="#change-password"
                        role="tab" aria-controls="change-password" aria-selected="true">Change Password</a>
                    <a class="nav-link" id="change-profile-picture-tab" data-toggle="pill" href="#change-profile-picture"
                        role="tab" aria-controls="change-profile-picture" aria-selected="false">Change Profile picture</a>
                    @can('settings')
                        <a class="nav-link" id="paymentsNumber-tab" data-toggle="pill" href="#paymentsNumber"
                            role="tab" aria-controls="paymentsNumber" aria-selected="false">Payments Number</a>
                    @endcan
                    {{-- <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings"
                        role="tab" aria-controls="settings" aria-selected="false">Settings</a> --}}
                </div>
            </div>
            <div class="col-7 col-sm-9">
                <div class="tab-content" id="tabContent">
                    <div class="tab-pane text-left fade show active" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                        @livewire('settings.changepassword')
                    </div>
                    <div class="tab-pane fade" id="change-profile-picture" role="tabpanel" aria-labelledby="change-profile-picture-tab">
                        @livewire('settings.change-profile-picture')
                    </div>
                    @can('settings')
                        <div class="tab-pane fade" id="paymentsNumber" role="tabpanel" aria-labelledby="paymentsNumber-tab">
                            @livewire('settings.payments-number')
                        </div>
                    @endcan
                    {{-- <div class="tab-pane fade" id="settings" role="tabpanel"
                        aria-labelledby="settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                        ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                        Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                        interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                        consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                        Praesent imperdiet accumsan ex sit amet facilisis.
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
<!-- /.card -->
@endsection

@section('js1')
@endsection

@section('js2')
@endsection
