// $('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
//     var next = $(this).next();
//     if (!next.length) {
//       next = $(this).siblings(':first');
//     }
//     next.children(':first-child').clone().appendTo($(this));
  
//     for (var i=0;i<4;i++) {
//       next=next.next();
//       if (!next.length) {
//         next=$(this).siblings(':first');
//       }
//       next.children(':first-child').clone().appendTo($(this));
//     }
//   });

$('.slick-carousel').slick({
    centerMode: true,
    centerPadding: '0px',
    slidesToShow: 3,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });