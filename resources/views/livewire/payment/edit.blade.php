<div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit Payment </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="updatePayment">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Student</label>
                                            <select class="form-control" wire:model="studentId" disabled>
                                                <option value="{{ $students->id }}">{{ $students->name }}
                                                </option>
                                            </select>
                                            @error('studentId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course</label>
                                            <select class="form-control" wire:model="courseId" disabled>
                                                <option value="{{ $courses->id }}">{{ $courses->title }}
                                                </option>
                                            </select>
                                            @error('courseId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="days"> Days </label>
                                            <input type="text" wire:model="days"
                                                class="form-control @error('days') is-invalid @enderror"
                                                id="days" placeholder="Enter how many days the amount is for">
                                            @error('days')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="trxId"> Trx id</label>
                                            <input type="text" wire:model="trxId"
                                                class="form-control @error('trxId') is-invalid @enderror"
                                                id="trxId" placeholder="Enter payment trxId">
                                            @error('trxId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="paymentType">Payment type</label>
                                            <select class="form-control" wire:model="paymentType">
                                                <option value="" selected>Select Payment Type</option>
                                                <option value="bkash">Bkash</option>
                                                <option value="nogod">Nogod</option>
                                                <option value="rocket">Rocket</option>
                                            </select>
                                            @error('paymentType')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="amount"> Amount </label>
                                            <input type="text" wire:model="amount"
                                                class="form-control @error('amount') is-invalid @enderror"
                                                id="amount" placeholder="Enter amount">
                                            @error('amount')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="accountNumber"> Account Number </label>
                                            <input type="text" wire:model="accountNumber"
                                                class="form-control @error('accountNumber') is-invalid @enderror"
                                                id="accountNumber" placeholder="Enter account number">
                                            @error('accountNumber')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="javascript:history.back()"><button type="button" class="btn btn-danger">Back</button></a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
