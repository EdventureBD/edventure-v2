<x-landing-layout>
    <style>
        .examBtn{
            border-radius: 25px;
            /*background: #6400c8;*/
            background: white;
            color: #6400c8;
            border-color: #6400c8;
        }
        .examBtn:hover{
            background: #6400c8;
            color: white;
            border-color: #6400c8;
        }
        :root {
            --border-color: #D7DBE3;
            font-family: -apple-system, BlinkMacSystemFont, 'Roboto', 'Open Sans', 'Helvetica Neue', sans-serif;
            --green: #0CD977;
            --red: #FF1C1C;
            --pink: #FF93DE;
            --purple: #5767ED;
            --yellow: #FFC61C;
            --rotation: 0deg;
        }

        body {
            overflow: hidden;
        }

        @keyframes scaleCup {
            0% {
                transform: scale(0.6);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes confettiRain {
            0% {
                opacity: 1;
                margin-top: -100vh;
                margin-left: -200px;
            }

            100% {
                opacity: 1;
                margin-top: 100vh;
                margin-left: 200px;
            }
        }

        .confetti {
            opacity: 0;
            position: absolute;
            width: 1rem;
            height: 1.5rem;
            transition: 500ms ease;
            animation: confettiRain 5s infinite;
        }

        #confetti-wrapper {
            overflow: hidden !important;
        }
    </style>
    <div id="confetti-wrapper"></div>
   <div class="container my-5">
       <div class="my-5 py-5 d-flex justify-content-center">
            <div id="successfully_submitted_section">
                <h1 class="text-success"><i class="far fa-check-circle"></i>  Thanks.</h1>
                <div class="d-flex text-purple">
                    <h5>Your script has been submitted successfully!</h5>
                </div>

                <div class="d-flex mt-5">
                    <a class="btn btn-sm" style="background: #FA9632; color: white; border-radius: 25px"
                       href="{{route('student.model.test.result')}}">Let's see your performance!</a>
                </div>
                @if(count($topics) > 0)
                    <div class="d-flex mt-3">
                        <div>
                            Related Exam :
                        </div>
                        <div class="row">
                            @foreach($topics as $topic)

                            <div class="ml-4">
                                <a href="{{route('model.exam',['c' => $topic->examCategory->uuid])}}"
                                   class="examBtn btn btn-sm btn-outline-primary">
                                    {{$topic->name}}
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
       </div>

   </div>
</x-landing-layout>
<script>
    for(i=0; i<100; i++) {
        // Random rotation
        var randomRotation = Math.floor(Math.random() * 360);
        // Random Scale
        var randomScale = Math.random() * 1;
        // Random width & height between 0 and viewport
        var randomWidth = Math.floor(Math.random() * Math.max(document.documentElement.clientWidth, window.innerWidth || 0));
        var randomHeight =  Math.floor(Math.random() * Math.max(document.documentElement.clientHeight, window.innerHeight || 500));

        // Random animation-delay
        var randomAnimationDelay = Math.floor(Math.random() * 15);
        console.log(randomAnimationDelay);

        // Random colors
        var colors = ['#0CD977', '#FF1C1C', '#FF93DE', '#5767ED', '#FFC61C', '#8497B0']
        var randomColor = colors[Math.floor(Math.random() * colors.length)];

        // Create confetti piece
        var confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.top=randomHeight + 'px';
        confetti.style.right=randomWidth + 'px';
        confetti.style.backgroundColor=randomColor;
        // confetti.style.transform='scale(' + randomScale + ')';
        confetti.style.obacity=randomScale;
        confetti.style.transform='skew(15deg) rotate(' + randomRotation + 'deg)';
        confetti.style.animationDelay=randomAnimationDelay + 's';
        document.getElementById("confetti-wrapper").appendChild(confetti);
    }
</script>
