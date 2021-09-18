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
                            <h3 class="card-title">Create live class</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" wire:submit.prevent="saveLiveClass">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="title"> Live class name </label>
                                            <input type="text" wire:model="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                id="title" placeholder="Enter your live class name">
                                            @error('title')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="batch">Batch</label>
                                            <select class="form-control" wire:model="batchId">
                                                <option value="" selected>Select Batch</option>                                                
                                                @foreach($batches as $batch)
                                                    <option value="{{ $batch->id}}">{{ $batch->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('batchId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group mt-5 ml-2">
                                            <input type="checkbox" id="checkboxPrimary4" wire:model="isSpecial">
                                            <label for="checkboxPrimary4">
                                                Special Live
                                            </label>                                       
                                        @error('isSpecial')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="courseName">Topic</label>
                                            <select class="form-control" wire:model="topicId"  @if($isSpecial) disabled @endif>
                                                <option value="" selected>Select Topic</option>
                                                @foreach($topics as $topic)
                                                    <option value="{{ $topic->id }}">{{ $topic->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('topicId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="startDate">Start Date</label>
                                            <input class="form-control" type="date" wire:model="startDate" id="startDate">
                                        </div>
                                        @error('startDate')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="startTime">Start Time</label>
                                            <input class="form-control" type="time" wire:model="startTime" id="startTime">
                                        </div>
                                        @error('startTime')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-form-label" for="showLinkLimitTime">Link Visible limit</label>
                                            <input class="form-control" type="time" wire:model="showLinkLimitTime" id="showLinkLimitTime" @if($isAlwaysShow) disabled @endif>
                                        </div>
                                        @error('showLinkLimitTime')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>                       
                            
                                <div class="row">                                    
                                    <div class="col-md-9 form-group">
                                        <label class="col-form-label" for="liveLink">Live Class URL</label>
                                        <input type="text" wire:model="liveLink"
                                            class="form-control @error('liveLink') is-invalid @enderror"
                                            id="liveLink" placeholder="Enter your live class url">
                                        @error('liveLink')
                                            <p style="color: red;">{{ $message }}</p>
                                        @enderror
                                    </div> 
                                    <div class="col-md-3">                                    
                                        <div class="form-group mt-5">
                                                <input type="checkbox" id="isAlwaysShow" wire:model="isAlwaysShow">
                                                <label for="isAlwaysShow">
                                                    Link Always Visible 
                                                </label>                                         
                                            @error('isAlwaysShow')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>                                    
                                    </div>                                                      
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
