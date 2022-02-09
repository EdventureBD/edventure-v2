
@if(session()->has('success'))
    <div class="col-md-12 mt-7">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successful!</strong> {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@elseif(session()->has('failed'))
    <div class="col-md-12 mt-7">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> {{session('failed')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@elseif(session()->has('warning'))
    <div class="col-md-12 mt-7">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> {{session('warning')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

