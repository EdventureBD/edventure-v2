@extends('admin.layouts.default', [
                                    'title'=>'Course Details', 
                                    'pageName'=>'Course Details', 
                                   'secondPageName'=>'Course Details'
                                ])

@section('content')
   <!-- Main content -->
   <section class="content">

      <!-- Default box -->
      <div class="card">
         <div class="card-header">
               <h3 class="card-title">Course: <span style="color: rgb(18, 160, 61)">{{ $course->title }}</span></h3>

               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                     title="Collapse">
                     <i class="fas fa-minus"></i></button>
               </div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                  <div class="row">
                        <div class="col-md-12">
                           <h3 class="text-primary">
                              <i class="fas fa-paint-brush"></i> Course: {{ $course->title }} 
                           </h3>
                        </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">All Topics</h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div id="accordion">
                                 <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                 <div class="card card-primary">
                                    @foreach ($course_topics as $course_topic)
                                       <div class="card-header">
                                          <h4 class="card-title">
                                             <a data-toggle="collapse" data-parent="#accordion" href="#{{ $course_topic->title }}{{ $course_topic->id }}">
                                                {{ $course_topic->title }}
                                             </a>
                                          </h4>
                                       </div>
                                       <div id="{{ $course_topic->title }}{{ $course_topic->id }}" class="panel-collapse collapse">
                                          <div class="card-body">
                                             {{-- @livewire('course.course-details', ['course_topic' => $course_topic], key($course_topic->id)) --}}
                                             <div class="row">
                                                @foreach ($lectures as $lecture)
                                                   @if ($lecture)
                                                         <div class="col-md-6">
                                                            <p>
                                                               <iframe src="https://player.vimeo.com/video/{{ $lecture->url}}" width="440" height="260" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                                            </p>
                                                         </div>
                                                   @else
                                                         <p>
                                                            <img src="https://previews.123rf.com/images/arcady31/arcady311303/arcady31130300032/18519959-vector-oops-symbol.jpg" alt="No videos found!!">
                                                         </p>
                                                   @endif
                                                @endforeach
                                             </div>
                                          </div>
                                       </div>
                                    @endforeach
                                 </div>
                                    {{-- <div class="card card-primary">
                                       <div class="card-header">
                                          <h4 class="card-title">
                                             <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                             Collapsible Group Item #1
                                             </a>
                                          </h4>
                                       </div>
                                       <div id="collapseOne" class="panel-collapse collapse in">
                                          <div class="card-body">
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                             3
                                             wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                             laborum
                                             eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                             nulla
                                             assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                             nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                             beer
                                             farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                             labore sustainable VHS.
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card card-danger">
                                       <div class="card-header">
                                          <h4 class="card-title">
                                             <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                             Collapsible Group Danger
                                             </a>
                                          </h4>
                                       </div>
                                       <div id="collapseTwo" class="panel-collapse collapse">
                                          <div class="card-body">
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                             3
                                             wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                             laborum
                                             eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                             nulla
                                             assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                             nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                             beer
                                             farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                             labore sustainable VHS.
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card card-success">
                                       <div class="card-header">
                                          <h4 class="card-title">
                                             <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                             Collapsible Group Success
                                             </a>
                                          </h4>
                                       </div>
                                       <div id="collapseThree" class="panel-collapse collapse">
                                          <div class="card-body">
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                             3
                                             wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                             laborum
                                             eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                             nulla
                                             assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                             nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                             beer
                                             farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                             labore sustainable VHS.
                                          </div>
                                       </div>
                                    </div> --}}
                              </div>
                           </div>
                           <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
            </div>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->

   </section>
   <!-- /.content -->
@endsection
