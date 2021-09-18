<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> Payments number </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" wire:submit.prevent="savePaymentsNumber">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="bkash">Bkash</label>
                                <input type="tel" wire:model="bkash" class="form-control @error('bkash') is_invalid @enderror" id="bkash"
                                    placeholder="Baksh number">
                                @error('bkash')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nogod">Nagad</label>
                                <input type="tel" wire:model="nogod" class="form-control @error('nogod') is_invalid @enderror" id="nogod"
                                    placeholder="Nogod number">
                                @error('nogod')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rocket">Rocket</label>
                                <input type="tel" wire:model="rocket" class="form-control @error('rocket') is_invalid @enderror" id="rocket"
                                    placeholder="Rocket number">
                                @error('rocket')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="javascript:history.back()"><button type="button" class="btn btn-danger">Back</button></a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
