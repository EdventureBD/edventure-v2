<div>
    <div class="btn-group">
        {{ $batch_running_days }} &nbsp; &nbsp;
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#up{{ $batch_id }}">
            <i class="fas fa-arrow-up"></i>
        </button>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#down{{ $batch_id }}">
            <i class="fas fa-arrow-down"></i>
        </button>
    </div>
    <div class="modal fade" id="up{{ $batch_id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Increase batch running days</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to increase the batch running days??</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="up" class="btn btn-primary" data-dismiss="modal">Increase</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="down{{ $batch_id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Decrease batch running days</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to decrease the batch running days??</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="down" class="btn btn-primary" data-dismiss="modal">Decrease</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
