<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eDventure</title>
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: sans-serif;

            }
            body {
                background: linear-gradient(#3f51b5,#000);
            }
            .main {
                width: 550px;
                height: 100vh;
                margin: 0 auto;
                position: relative;
                overflow: hidden;
                background: #fdfdfd;
            }
            .swiper-container {
                height: 350px;
            }
            .swiper-wrapper {
                align-items: center;
            }
            .swiper-slide {
                width: 200px;
                height: 200px;
                border-radius: 7px;
            }

            .swiper-slide img{
                width: 200px;
                height: 200px;
                border-radius: 7px;
            }
            .swiper-slide-active {
                transform: scale(1.2);
                transition: .4s;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1453728013993-6d66e9c9123a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dmlld3xlbnwwfHwwfHw%3D&w=1000&q=80" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://media.istockphoto.com/photos/lens-image-dslr-manhattan-downtown-city-new-york-hand-picture-id901169654?k=20&m=901169654&s=612x612&w=0&h=BEzK22AQ7PrtCrIrIL92l7YvENVBLqE7Qurxu4m5iD4=" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/1421/road-nature-hand-path.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://media.istockphoto.com/photos/photography-camera-lens-concept-picture-id843408508?k=20&m=843408508&s=612x612&w=0&h=s4rhaeVZJ2nn2Aa2hQLK6ZX4NTmbHnb-ZfjsBSZUsdY=" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://media.istockphoto.com/photos/lense-picture-id1264340404?k=20&m=1264340404&s=612x612&w=0&h=F95ZhcKlyy1ZTSj7AeZnXKN6O5EWe-otedcQc31wkVw=" alt="">
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".swiper-container", {
                slidesPerView: 'auto',
                spaceBetween: 30,
                centeredSlides: true,
                grabCursor: true,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        </script>
    </body>
</html>
