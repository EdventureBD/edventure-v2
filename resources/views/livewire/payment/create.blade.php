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
                            <h3 class="card-title">Create Payment {{ $batch }} {{ $student }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="savePayment">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Course Category</label>
                                            <select class="form-control" wire:model="categoryId"
                                                @if ($batchHas) disabled @endif>
                                                @if ($batchHas)
                                                    <option value="{{ $categories->id }}" selected>
                                                        {{ $categories->title }}
                                                    </option>
                                                @else
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('categoryId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Course</label>
                                            <select class="form-control" wire:model="courseId"
                                                @if ($batchHas) disabled @endif>
                                                @if ($batchHas)
                                                    <option value="{{ $courses->id }}">{{ $courses->title }}
                                                    </option>
                                                @else
                                                    <option value="" selected>Select Course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->title }}
                                                        </option>
                                                    @endforeach
                                                @endif
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
                                            <label class="col-form-label" for="batch">Batch</label>
                                            <select class="form-control" wire:model="batchId"
                                                @if ($batchHas) disabled @endif>
                                                @if ($batchHas)
                                                    <option value="{{ $batches->id }}" selected>
                                                        {{ $batches->title }}
                                                    </option>
                                                @else
                                                    <option value="">Select batch</option>
                                                    @if ($batches)
                                                        @foreach ($batches as $batch)
                                                            <option value="{{ $batch->id }}">{{ $batch->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                            @error('batchId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Student</label>
                                            <select class="form-control" wire:model="studentId"
                                                @if ($batchHas) disabled @endif>
                                                @if ($batchHas)
                                                    <option value="{{ $students->student_id }}">
                                                        {{ $students->student->name }}
                                                    </option>
                                                @else
                                                    <option value="" selected>Select Student</option>
                                                    @if ($students)
                                                        @foreach ($students as $student)
                                                            <option value="{{ $student->student_id }}">
                                                                {{ $student->student->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                            @error('studentId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mt-5 ml-2">
                                            <input type="checkbox" id="checkboxPrimary4" wire:model="free">
                                            <label for="checkboxPrimary4">
                                                Free
                                            </label>
                                            @error('isSpecial')
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
                                                class="form-control @error('days') is-invalid @enderror" id="days"
                                                placeholder="Enter how many days the amount is for">
                                            @error('days')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="trxId"> Trx id</label>
                                            <input type="text" wire:model="trxId"
                                                class="form-control @error('trxId') is-invalid @enderror" id="trxId"
                                                placeholder="Enter payment trxId" @if ($free) disabled @endif>
                                            @error('trxId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="paymentType">Payment type</label>
                                            <select class="form-control" wire:model="paymentType"
                                                @if ($free) disabled @endif>
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
                                                class="form-control @error('amount') is-invalid @enderror" id="amount"
                                                placeholder="Enter amount" @if ($free) disabled @endif>
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
                                                id="accountNumber" placeholder="Enter account number"
                                                @if ($free) disabled @endif>
                                            @error('accountNumber')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="javascript:history.back()"><button type="button"
                                            class="btn btn-danger">Back</button></a>
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
