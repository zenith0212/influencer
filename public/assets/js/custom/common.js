"use strict";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});

$(document).ready(function(){
    $('.loading').hide();
    var sub_menu = $( ".menu-sub-accordion .menu-item a" ).hasClass("active");
    if(sub_menu){
        $('.active').parent().parent().parent().addClass('hover show');
    }

        var menu = $(".side-nav-level .a" ).hasClass("active");
        if(menu){
            console.log('here');
            $('.active').parent().parent().find('side-nav-link').removeClass('collapsed');
        }
})

/* MRA */

let swalConfirmation = ( message = "You won't be able to revert this!", confirmButtonText = "Yes, delete!", cancelButtonText = 'No, cancel' ) => {
    return Swal.fire({
        text: message,
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        customClass: {
            confirmButton: "btn fw-bold btn-danger custom-button-css",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    });
};
