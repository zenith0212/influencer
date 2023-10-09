/*-----------------------------------------------------------------------------------

 Webiste Name: Top Brand Mate
 Description: This is E-commerce website
 Author: Narola infotech

----------------------------------------------------------------------------------- */

// 01.on scroll add class 
// 02.Pre loader
// 03.Pre loader
// 01.Pre loader
// 01.Pre loader


/*=====================
01.on scroll add class 
==========================*/



/*=====================
02.  on scroll add class 
==========================*/

$(".onhover-dropdown").on("click", function () {
  $(this).children(".onhover-dropdown-menu").toggleClass("active");
});


$(window)
  .bind("resize", function () {
    console.log($(this).width());
    if ($(this).width() > 991) {
      $(".main-canvas").removeClass("offcanvas offcanvas-start");
    } else {
      $(".main-canvas").addClass("offcanvas offcanvas-start");
    }
  })
  .trigger("resize");