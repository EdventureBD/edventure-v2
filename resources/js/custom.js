$('.course-category-js').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  variableWidth: true,
  infinite:false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        infinite:false,
        autoplaySpeed: 3000,
         variableWidth: true,
      }
    }
  ]
});



$('.slick-carousel').slick({
    centerMode: true,
    centerPadding: '0px',
    slidesToShow: 3,
    dots: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 1,
          dots: true
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1,
          dots: true
        }
      }
    ]
  });

  //init bootstrap custom upload
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });


