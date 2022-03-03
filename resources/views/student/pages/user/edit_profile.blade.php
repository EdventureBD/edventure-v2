@extends('student.layouts.default', [
                                    'title'=>'Edit Profile', 
                                    'pageName'=>'Edit Profile', 
                                    'secondPageName'=>'Edit Profile'
                                ])

@section('content')
<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">
    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center">
                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Account</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="">Account</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit Account
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Basic Information</div>
        </div>
        @livewire('student.user.edit-profile', ['user' => $user])
    </div>

</div>
<!-- // END Header Layout Content -->
@endsection
