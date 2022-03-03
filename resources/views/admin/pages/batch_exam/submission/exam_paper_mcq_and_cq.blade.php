@extends('admin.layouts.default', [
         'title' => 'Exam Result',
         'pageName'=>'Exam Result', 
         'secondPageName'=>'Exam Result'
      ])

@section('css1')
   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                           <h3 class="card-title">MCQ Section</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body table-responsive p-0" style="height: auto;" >
                           <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                       <th class="text-center">SL. No</th>
                                       <th class="text-center">Student</th>
                                       <th class="text-center">Batch</th>
                                       <th class="text-center">Exam</th>
                                       <th class="text-center">Exam Type</th>
                                       <th class="text-center">Gain Marks</th>
                                       <th class="text-center">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($mcq_exam_results as $exam_result)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td class="text-center">{{ $exam_result->student->name }}</td>
                                          <td class="text-center">{{ $exam_result->batch->title }}</td>
                                          <td class="text-center">{{ $exam_result->exam->title }}</td>
                                          <td class="text-center">
                                             <span
                                                   class="badge 
                                                               {{ $exam_result->exam->exam_type == 'Pop Quiz' ? 'bg-secondary' : '' }}
                                                               {{ $exam_result->exam->exam_type == 'Topic End Exam' ? 'bg-info' : '' }}
                                                               ">
                                                   {{ $exam_result->exam->exam_type }} (MCQ)
                                             </span>
                                          </td>
                                          <td class="text-center">{{ $exam_result->gain_marks }}</td>
                                          <td class="text-center">
                                             <a href="{{ route('seeDetailsMcqOnly', [
                                                   'batch' => $exam_result->batch,
                                                   'student' => $exam_result->student,
                                                   'exam' => $exam_result->exam,
                                                   'exam_type' => $exam_result->exam->exam_type
                                             ]) }}">See Details</a>
                                          </td>
                                       </tr>
                                 @endforeach
                              </tbody>
                              <tfoot>
                                 <tr>
                                       <th class="text-center">SL. No</th>
                                       <th class="text-center">Student</th>
                                       <th class="text-center">Batch</th>
                                       <th class="text-center">Exam</th>
                                       <th class="text-center">Exam Type</th>
                                       <th class="text-center">Gain Marks</th>
                                       <th class="text-center">Action</th>
                                 </tr>
                              </tfoot>
                           </table>
                     </div>
                     <!-- /.card-body -->


                     <div class="card-header">
                        <h3 class="card-title">CQ Section</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body table-responsive p-0" style="height: auto;">
                        <table id="example3" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th class="text-center">SL. No</th>
                                    <th class="text-center">Student</th>
                                    <th class="text-center">Batch</th>
                                    <th class="text-center">Exam</th>
                                    <th class="text-center">Exam Type</th>
                                    <th class="text-center">Checked</th>
                                    <th class="text-center">Gain Marks</th>
                                    <th class="text-center">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($student_exam_attempts as $student_exam_attempt)
                                    <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td class="text-center">{{ $student_exam_attempt->student->name }}</td>
                                          <td class="text-center">{{ $batch->title }}</td>
                                          <td class="text-center">{{ $student_exam_attempt->exam->title }}</td>
                                          <td class="text-center">
                                             <span
                                             class="badge 
                                                         {{ $student_exam_attempt->exam->exam_type == 'Pop Quiz' ? 'bg-secondary' : '' }}
                                                         {{ $student_exam_attempt->exam->exam_type == 'Topic End Exam' ? 'bg-info' : '' }}
                                                         ">

                                                {{ $student_exam_attempt->exam->exam_type }} (CQ)
                                             </span>
                                          </td>
                                          <td class="text-center">
                                             @foreach ($cq_exam_results as $exam_result)
                                                @if ($exam_result->student_id == $student_exam_attempt->student_id)
                                                   @if($exam_result->checked)
                                                      Yes
                                                   @else
                                                      No
                                                   @endif
                                                @endif
                                             @endforeach
                                          </td>
                                          <td class="text-center">
                                             @foreach ($cq_exam_results as $exam_result)
                                                @if ($exam_result->student_id == $student_exam_attempt->student_id)
                                                      {{ $exam_result->gain_marks }}
                                                @endif
                                             @endforeach
                                          </td>
                                          <td class="text-center">
                                             <a
                                                href="{{ route('seeDetailsCqOnly', [
                                                'batch' => $batch,
                                                'student' => $student_exam_attempt->student,
                                                'exam' => $student_exam_attempt->exam,
                                                'exam_type' => $student_exam_attempt->exam->exam_type,
                                             ]) }}">See
                                                Details</a>
                                          </td>
                                    </tr>
                                 @endforeach
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th class="text-center">SL. No</th>
                                    <th class="text-center">Student</th>
                                    <th class="text-center">Batch</th>
                                    <th class="text-center">Exam</th>
                                    <th class="text-center">Exam Type</th>
                                    <th class="text-center">Checked</th>
                                    <th class="text-center">Gain Marks</th>
                                    <th class="text-center">Action</th>
                                 </tr>
                              </tfoot>
                        </table>
                     </div>
                  </div>
                  <!-- /.card -->
               </div>
         </div>
         <!-- /.row -->
      </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
@endsection

@section('js1')
   <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
   <!-- DataTables -->
   <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
   <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}">
   </script>
@endsection

@section('js2')
   <script>
      $(function () {
         $("#example1").DataTable();
         $("#example3").DataTable();
         $('#example2').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": true,
               "info": true,
               "autoWidth": false,
         });
      });

   </script>
@endsection
