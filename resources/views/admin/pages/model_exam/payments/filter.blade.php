<form action="">
    <div class="row">
        <div class="col-sm-4 mt-4">
            <div class="select2-purple d-flex align-middle py-0 pb-md-5">
                @if(request()->is('admin/model-exam/payment/category'))
                <select
                        class="select2 form-control"
                        name="query[category]"
                        data-placeholder="Choose Category"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                    @foreach ($categories as $category)
                        <option value=""></option>
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @else
                    <select
                        class="select2 form-control"
                        name="query[exam]"
                        data-placeholder="Choose Exam"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                        @foreach ($exams as $exam)
                            <option value=""></option>
                            <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
        <div class="col-sm-3 mt-4">
            <input type="text" name="query[student]" placeholder="Student name/email/phone" class="form-control">
        </div>

        <div class="col-sm-3 mt-4">
            <input type="text" name="query[tnx]" placeholder="Transaction Id" class="form-control">
        </div>

        <div class="d-flex col-sm-2 justify-content-between mt-4">
            <div class="mx-md-3">
                <button type="submit" class="btn btn-outline-primary">Find</button>
            </div>
{{--            <div>--}}
{{--                <a href="{{route('exam.tags.index')}}" class="btn btn-outline-secondary">Clear</a>--}}
{{--            </div>--}}
        </div>

    </div>
</form>
