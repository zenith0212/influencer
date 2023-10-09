 function validateRatingsForm( $form ) {
    if ( $form.length ) {
        let validateForm = $form.validate({
            rules: {
               star_ratings : {
                    required: true
               },
               review_en : {
                  required:true
               }
            },
            submitHandler: ( form ) => {
                let url                 =  $form.attr('action');
                var id                  = $(this).attr('data-id');
                var campId              = $(this).attr('data-campaign_id');
                var userType            = $(this).attr('data-user_type');
                var brand_id            = $(this).attr('data-brand_id');
                
                let data = $('form').serialize();
                $('#loader').show();
                $.ajax({
                    url:  url,
                    type: url.indexOf('/update') === -1 ? 'POST' : 'PUT',
                    dataType: 'json',
                    data: data,
                    beforeSend: function() { $('.loading').removeClass('d-none'); $('.loading').show(); },
                    success:function(response){
                         $('.loading').hide();
                        if(response.status) {
                             $('.loading').hide();
                            location.reload(true);
                             data_rating_notification();
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


   $(document).on('click', '#ratingBtn',function(e) {
   e.preventDefault();
   let add_ratings_url = $(this).attr('data-url');
   let $this = $(this);
   var id                  = $(this).attr('data-id');
   var campId              = $(this).attr('data-campaign_id');
   var userType            = $(this).attr('data-user_type');
   var rating_type         = $(this).attr('data-rating_type');
   $this.addClass('pe-none');
   if ( add_ratings_url ) {
        $.ajax({
            url: add_ratings_url,
            type: 'get',
            dataType: 'json',
            data : {
                'id' : id,
                'campId' : campId,
                'userType' : userType,
                'rating_type': rating_type
            },
            complete: function(response) {
                let resp = response.responseJSON;
                if ( resp ) {
                    if ( resp.status ) {
                        make_modal( 'add-ratings-modal', resp.data.view, true );
                        validateRatingsForm( $('.add_ratings_form') );
                    } else {
                        error_notification_add();
                    }
                }
            },
            error: function (response) {
                error_notification_add();
            }
        }).always(function(){
            $this.removeClass('pe-none');
        });
    }
});

   $(document).on('click', '#InfluencerratingBtn',function(e) {
   e.preventDefault();
   let add_ratings_url      = $(this).attr('data-url');
   let $this = $(this);
   var id                  = $(this).attr('data-id');
   var campId              = $(this).attr('data-campaign_id');
   var userType            = $(this).attr('data-user_type');
   var brand_id            = $(this).attr('data-brand_id');

   $this.addClass('pe-none');
   if ( add_ratings_url ) {
        $.ajax({
            url: add_ratings_url,
            type: 'get',
            dataType: 'json',
            data : {
                'id' : id,
                'campId' : campId,
                'userType' : userType,
                'brand_id' : brand_id
            },
            complete: function(response) {
                let resp = response.responseJSON;
                if ( resp ) {
                    if ( resp.status ) {
                        make_modal( 'add-ratings-modal', resp.data.view, true );
                        validateRatingsForm( $('.add_ratings_form') );
                    } else {
                        error_notification_add();
                    }
                }
            },
            error: function (response) {
                error_notification_add();
            }
        }).always(function(){
            $this.removeClass('pe-none');
        });
    }
});

function data_rating_notification(){
    let data = $('table').attr('name') ? $('table').attr('name') : 'Data';
    return Swal.fire({
        background: '#def5e5',
        iconHtml: '<div class="icon success"><svg width="24" height="24" id="Layer_1" style="enable-background:new 0 0 128 128;" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><circle fill="#fff0" cx="64" cy="64" r="64"></circle></g><g><path fill="#3EBD61" d="M54.3,97.2L24.8,67.7c-0.4-0.4-0.4-1,0-1.4l8.5-8.5c0.4-0.4,1-0.4,1.4,0L55,78.1l38.2-38.2   c0.4-0.4,1-0.4,1.4,0l8.5,8.5c0.4,0.4,0.4,1,0,1.4L55.7,97.2C55.3,97.6,54.7,97.6,54.3,97.2z"></path></g></svg></div>',
        color: '#395144',
        iconColor: '#395144',
        closeButtonColor: '#395144',
        toast: true,
        icon: 'success',
        title: 'Ratings shared Successfully!',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 5000,
        allowOutsideClick: false,
        showCloseButton: true,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
        customClass: {
            closeButton: 'success-close',
            container: 'success-container',
            timerProgressBar: 'success-progress',
        }
    });
}
