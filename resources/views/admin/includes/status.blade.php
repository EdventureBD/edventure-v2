<div class="row">
    @if(session()->has('status'))
        <div class="col-md-12">
            <div class="card bg-gradient-success">
                <div class="card-header">
                    <h3 class="card-title"><b>{{ session('status') }}</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
            </div>
            <!-- /.card -->
        </div>
    @elseif(session()->has('failed'))
        <div class="col-md-12">
            <div class="card bg-gradient-danger">
                <div class="card-header">
                    <h3 class="card-title"><b>{{ session('failed') }}</b></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @elseif(session()->has('warning'))
        <div class="col-md-12">
            <div class="card bg-gradient-warning">
                <div class="card-header">
                    <h3 class="card-title"><b>{{ session('warning') }}</b></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>
@endif
</div>
