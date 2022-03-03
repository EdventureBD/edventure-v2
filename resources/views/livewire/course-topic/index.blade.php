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
                            <h3 class="card-title">Topic</h3>
                        </div>                      
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="courseCategory">Category</label>
                                        <select class="form-control" wire:model="categoryId" id="courseCategory">
                                            <option value="" selected>Select course category</option>
                                            @foreach($categories as $category)
                                                <option wire:key="{{ $category->slug.$category->id }}" value="{{ $category->id }}">{{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                                

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="intermediateLevel">Intermediary Levels</label>
                                        <select class="form-control" wire:model="intermediaryLevelId" id="intermediateLevel">
                                            <option value="" selected>Select Intermediary Level</option>
                                                @foreach($intermediaryLevels as $intermediaryLevel)
                                                    <option wire:key="{{ $intermediaryLevel->slug.$intermediaryLevel->id }}" value="{{ $intermediaryLevel->id }}">{{ $intermediaryLevel->title }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="courseName">Course</label>
                                        <select class="form-control" wire:model="courseId">
                                            <option value="" selected>Select Course</option>
                                            @foreach($courses as $course)
                                                <option wire:key="{{ $course->slug.$course->id }}" value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="col-form-label" for="courseName"></label> <br>
                                        <button wire:click="show" class="btn btn-primary center" @if (!($show)) disabled @endif>Show</button>
                                    </div>
                                    
                                </div> --}}
                            </div>
                            @if ($topics)
                                <div class="table-responsive p-0" style="height: auto;" >
                                    <table class="table table-bordered table-striped example1">
                                        <thead>
                                            <tr>
                                                <th>SL. No</th>
                                                <th>Name</th>
                                                <th>Course Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($topics as $topic)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $topic->title }}</td>
                                                    <td>{{ $topic->name }}</td>
                                                    <td>
                                                        <input type="checkbox" class="customControlInput" id="single-col-{{ $topic->id }}" data-id="{{ $topic->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $topic->status ? 'checked' : '' }} >
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="mr-1" href="{{ route('course-topic.edit', $topic->slug) }}" title="Edit {{ $topic->title }}">
                                                                <button class="btn btn-info"><i class="far fa-edit"></i></button>
                                                            </a>
                                                            <a class="mr-1" href="#deleteTopic{{ $topic->id }}" data-toggle="modal" title="Delete {{ $topic->title }}">
                                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                            </a>
                                                            <div class="modal fade" id="deleteTopic{{ $topic->id }}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-danger">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Delete {{ $topic->title }} Topic</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Are you sure??</p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                            <form action="{{ route('course-topic.destroy', $topic->slug) }}" method="POST">
                                                                                @csrf
                                                                                @method('delete')
                                                                                    <button type="submit" class="btn btn-outline-light">Delete</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="py-16 text-center" colspan="5">No Records found!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SL. No</th>
                                                <th>Name</th>
                                                <th>Course Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            @endif
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
