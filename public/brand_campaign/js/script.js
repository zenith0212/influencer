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
01.on hover dropdown
==========================*/

$(".onhover-dropdown").on("click", function () {
  $(this).children(".onhover-dropdown-menu").toggleClass("active");
});


/*=====================
02. add class on sidebar in resposnive
==========================*/

$(window)
  .bind("resize", function () {
    if ($(this).width() > 991) {
      $(".main-canvas").removeClass("offcanvas offcanvas-start");
    } else {
      $(".main-canvas").addClass("offcanvas offcanvas-start");
    }
  })
  .trigger("resize");


/*=====================
04. initalize select2 juery
==========================*/


$(document).ready(function() {
    $('#campaign-list').DataTable({
        "searching": false,
        "lengthChange": false,
        "order": []
    });
    $('#active-list').DataTable({
        "searching": false,
        "lengthChange": false,
        "order": []
    });
    $('#completed-list').DataTable({
        "searching": false,
        "lengthChange": false,
        "order": []
    });

    $('#connectedInfluencers').DataTable({
        "searching": true,
        "pageLength": 20,
        "lengthChange": false,
        "orderable": true
    });
});

