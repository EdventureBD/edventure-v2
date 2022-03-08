<x-landing-layout headerBg="white">
    <!-- Header Layout Content -->
    <div class="page-section container py-6">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="text-sm text-center">Course : <b>{{$course->title}}</b></h2>
                <p class="text-xsm text-center">Your Batch : <b>{{$batch->title}}</b></p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- @if($errors->any())
                <div class="alert alert-danger">
                <h4>{{$errors->first()}}</h4>
                </div>
                @endif --}}
                <form action="{{route('payment.process', $course)}}" method="POST" class="pt-5">
                    @csrf
                    <div class="form-group pl-0">
                        <label for="name">Student Name</label>
                        <input type="text" class="form-control" name="name" value="{{$student->name}}"  disabled>
                    </div>
                    <div class="form-group pl-0">
                        <label for="phone">Student phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$student->phone}}"  disabled>
                    </div>
                    <div class="form-group pl-0">
                        <label for="months">Enrolled months</label>
                        <input id="enrolMonths" type="number" min="{{$enroll_months}}" max="{{ $course->duration }}" class="form-control" name="months" value="{{$enroll_months}}" />
                    </div>
                    <div class="form-group pl-0">
                        <label for="coursePrice">Payable Amount</label>
                        <input type="number" name="course_price" id="coursePrice" min="{{$enroll_months*$course->price}}" class="form-control" value="{{$enroll_months*$course->price}}" readonly />
                    </div>
                    <button class="btn d-inline-block mt-4 fw-800 text-xxsm text-white bg-purple mb-3 px-4" type="submit">Submit</button>
                </form>
            </div>
        </div>
        
    </div>
    {{-- <script>
        function calculatePrice(e)
        {
            var months = parseInt(e.value) >= e.min ? parseInt(e.value) : e.min;
            var max_months = parseInt("<?php echo $course->duration; ?>");
            if (months > max_months) months = max_months;
            var price = parseInt("<?php echo $course->price; ?>");
            var totalPrice = months * price;
            document.getElementById("enrolMonths").value = months;
            document.getElementById("coursePrice").value = totalPrice;
        }
    </script> --}}
</x-landing-layout>
