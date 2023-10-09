 function validateForm( $form ) {
    if ( $form.length ) {
        let validateForm = $form.validate({
            rules: {
                apply_reason_en: {
                    required: true
                }
            },
            submitHandler: ( form ) => {
                let url = $form.attr('action');
                $('#loader').show();
                $.ajax({
                    url:  url,
                    type: url.indexOf('/update') === -1 ? 'POST' : 'PUT',
                    dataType: 'json',
                    data: $form.serializeArray(),
                    beforeSend: function() { $('.loading').removeClass('d-none'); $('.loading').show(); },
                    success:function(response){
                         $('.loading').hide();
                        if(response.status) {
                             $('.loading').hide();
                            location.reload(true);
                             data_applied_notification();
                            // $form.parents('.modal').modal('hide');
                        }else{
                        }
                    },
                    error:function(error){
                        $('#loader').hide();
                        validateForm.showErrors(error.responseJSON.errors);
                    }
                });
            },
        });
    }
}


// $(document).on('click', '#apply-form-btn',function(e) {
//        $('.loading').removeClass('d-none'); $('.loading').show();
//     });

// $(document).on('click', '#apply-btn',function(e) {
//         e.preventDefault();
//         let apply_reason_url = $(this).attr('data-url');
//         let campaign_id = $(this).attr('data-id');
//         let identifier = $(this).attr('data-identifier');
//         let $this = $(this);
//         $this.addClass('pe-none');
//         if ( apply_reason_url ) {
//             $.ajax({
//                 url: apply_reason_url,
//                 type: 'get',
//                 data: {
//                     'apply_reason_url' : apply_reason_url,
//                     'campaign_id' : campaign_id,
//                     'identifier' : identifier
//                 },
//                 dataType: 'json',
//                 complete: function(response) {
//                     let resp = response.responseJSON;
//                     if ( resp ) {
//                         if ( resp.status ) {
//                             make_modal( 'apply-reason-modal', resp.data.view, true );
//                             // $('.loading').hide();
//                             validateForm( $('.apply-reason-form') );
//                         }
//                     }
//                 },
//                 error: function (response) {
//                     error_notification_add();
//                 }
//             }).always(function(){
//                 $this.removeClass('pe-none');
//             });
//         }
//     });

// function data_applied_notification(){
//     let data = $('table').attr('name') ? $('table').attr('name') : 'Data';
//     return Swal.fire({
//         background: '#def5e5',
//         iconHtml: '<div class="icon success"><svg width="24" height="24" id="Layer_1" style="enable-background:new 0 0 128 128;" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><circle fill="#fff0" cx="64" cy="64" r="64"></circle></g><g><path fill="#3EBD61" d="M54.3,97.2L24.8,67.7c-0.4-0.4-0.4-1,0-1.4l8.5-8.5c0.4-0.4,1-0.4,1.4,0L55,78.1l38.2-38.2   c0.4-0.4,1-0.4,1.4,0l8.5,8.5c0.4,0.4,0.4,1,0,1.4L55.7,97.2C55.3,97.6,54.7,97.6,54.3,97.2z"></path></g></svg></div>',
//         color: '#395144',
//         iconColor: '#395144',
//         closeButtonColor: '#395144',
//         toast: true,
//         icon: 'success',
//         title: 'Data Applied Successfully!',
//         animation: false,
//         position: 'top-right',
//         showConfirmButton: false,
//         timer: 3000,
//         allowOutsideClick: false,
//         showCloseButton: true,
//         timerProgressBar: true,
//         didOpen: (toast) => {
//             toast.addEventListener('mouseenter', Swal.stopTimer)
//             toast.addEventListener('mouseleave', Swal.resumeTimer)
//         },
//         customClass: {
//             closeButton: 'success-close',
//             container: 'success-container',
//             timerProgressBar: 'success-progress',
//         }
//     });
// }

 $('#campaignsTable').DataTable({
     processing: true,
     serverSide: true,
    "filter": true, 
     ajax: get_campaign_route,
     columns: [
        {  
            data: 'thumbnail_image',
            "mRender" : function ( data, type, row, meta ) {
                return `<img src= "${imagePath + '/' + data}"  onerror="this.src='${defaultImgUrl}'" height=\"50\" height=\"50\"/>`;
            }
        },
        { data: 'name_en' , class: 'text-capitalize text-center'},
        { data: 'brand_name' , class: 'text-capitalize text-center'},
        { 
            "render": function ( data, type, row ) {
                if(row.is_sample_required == 1) {
                    return `<span class="ms-2 badge badge-light-success fw-semibold text-center"> Yes </span>`;   
                }
                else {
                   return `<span class="ms-2 badge badge-light-danger fw-semibold text-center"> No </span>`;  
                }
                
            },
        },
        { 
            "render": function ( data, type, row ) {
                console.log(row.campaign_is_active);
                if(row.campaign_is_active == 1) {
                    return `<span class="ms-2 badge badge-light-success fw-semibold text-center"> Active </span>`;   
                }
                else {
                    return `<span class="ms-2 badge badge-light-danger fw-semibold text-center"> Not Active </span>`; 
                }
                
            },
        },
        { data: 'total_influencers_required' , class: 'text-center'},
        {
            data: null,
            orderable: false,
            "mRender" : function ( data, type, row ) {
                return `<a class="view-productsss text-center menu-link {{ is_active_menu(['campaigns.index']) }}" href="${view_route + '/' + data.id}">
                          <span class="svg-icon svg-icon-3 text-center">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg>
                          </span>
                       </a>`
            }
        },
     ]
  });



