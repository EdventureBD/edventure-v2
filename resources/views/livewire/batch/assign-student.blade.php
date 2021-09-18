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
                            <h3 class="card-title">Assign Student to a Batch</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="enrollToBatch">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($show)
                                            <div class="form-group">
                                                <label class="col-form-label">Batch <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="batchId" disabled>
                                                    <option value="{{ $batches->id }}">{{ $batches->title }}</option>
                                                </select>
                                                @error('batchId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label class="col-form-label">Batch <span class="must-filled">*</span></label>
                                                <select class="form-control" wire:model="batchId">
                                                    <option value="" selected>Select Btach</option>
                                                    @foreach($batches as $batch)
                                                        <option value="{{ $batch->id }}">{{ $batch->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('batchId')
                                                    <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTitle"> Course <span class="must-filled">*</span></label>
                                            <input type="text" wire:model="courseTitle" class="form-control @error('courseTitle') is-invalid @enderror" id="courseTitle" placeholder="Student name" disabled>
                                            @error('courseTitle')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTitle"> Student <span class="must-filled">*</span></label>
                                            <input type="text" wire:model="studentName" class="form-control @error('studentName') is-invalid @enderror" id="courseTitle" placeholder="Enter course name" disabled>
                                            @error('studentName')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseTitle"> Days For<span class="must-filled">*</span></label>
                                            <input type="text" wire:model="days_for" class="form-control @error('days_for') is-invalid @enderror" id="courseTitle" placeholder="Enter how many days the student is paying for">
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                Enter here how many days he is paying for
                                            </small>
                                            @error('days_for')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label" for="notes">Notes</label>
                                    <textarea type="text" wire:model="notes" rows="3" class="form-control @error('notes') is-invalid @enderror" id="notes" placeholder="Enter any notes about this student. If exist"></textarea>
                                    @error('notes')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Assign</button>
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
