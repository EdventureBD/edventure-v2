<div class="row card-group-row mb-lg-8pt">
    <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
        data-toggle="popover" data-trigger="click">

        <div class="card-body align-items-center">
            <div class=" ">
                <div class="">
                    <div class="questionMCQ " style="padding: 20px;">
                        <div>
                            <h3>{{ $index }}. {{ $question->question }}</h3>
                        </div>
                        <br>
                        @if ($question->image)
                        <div class="image-of-question" style="padding-top: 30px; padding-bottom: 30px; ">
                            <div class="" style="">
                                <img src="{{ Storage::url($question->image) }}" class="img-wh11-quiz" alt=""
                                    style="height: auto; width: 50%; ">
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="custom-control custom-radio QAoptions" style="padding-bottom: 10px;">
                                    <input type="radio" id="radioStacked{{ $question->id }}"
                                        value="{{ $question->field1 }}" name="{{ $question->id }}"
                                        {{ $question->answer == 1 ? 'checked':'' }} />
                                    <label for="radioStacked{{ $question->id }}">A)
                                        {{ $question->field1 }}
                                        {{-- @if($question->answer == 1)
                                            @foreach ($answers as $answer)
                                                @if ($answer == $question->field1)
                                                    @if ($answer == $specific)
                                                        <span class="text-info">Right(Your answer)</span>
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </label>
                                </div>
                                <div class="custom-control custom-radio QAoptions" style="padding-bottom: 10px;">
                                    <input type="radio" id="radioStacked{{ $question->id }}"
                                        value="{{ $question->field2 }}" name="{{ $question->id }}"
                                        {{ $question->answer == 2 ? 'checked':'' }} />
                                    <label for="radioStacked{{ $question->id }}">B)
                                        {{ $question->field2 }}
                                        {{-- @if($question->answer == 2)
                                            @foreach ($answers as $answer)
                                                @if ($answer == $question->field2)
                                                    @if ($answer == $specific)
                                                        <span class="text-info">Right(Your answer)</span>
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="custom-control custom-radio QAoptions" style="padding-bottom: 10px;">
                                    <input type="radio" id="radioStacked{{ $question->id }}"
                                        value="{{ $question->field3 }}" name="{{ $question->id }}"
                                        {{ $question->answer == 3 ? 'checked':'' }} />
                                    <label for="radioStacked{{ $question->id }}">C)
                                        {{ $question->field3 }}
                                        {{-- @if($question->answer == 3)
                                            @foreach ($answers as $answer)
                                                @if ($answer == $question->field3)
                                                    @if ($answer == $specific)
                                                        <span class="text-info">Right(Your answer)</span>
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </label>
                                </div>
                                <div class="custom-control custom-radio QAoptions" style="padding-bottom: 10px;">
                                    <input type="radio" id="radioStacked{{ $question->id }}"
                                        value="{{ $question->field4 }}" name="{{ $question->id }}"
                                        {{ $question->answer == 4 ? 'checked':'' }} />
                                    <label for="radioStacked{{ $question->id }}">D)
                                        {{ $question->field4 }}
                                        {{-- @if($question->answer == 4)
                                            @foreach ($answers as $answer)
                                                @if ($answer == $question->field4)
                                                    @if ($answer == $specific)
                                                        <span class="text-info">Right(Your answer)</span>
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <p class="text-info"> Answer: 
                            {{ $question->answer == 1 ? $specific :'' }}
                            {{ $question->answer == 2 ? $specific :'' }}
                            {{ $question->answer == 3 ? $specific :'' }}
                            {{ $question->answer == 4 ? $specific :'' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
