if('#contentTable') {
    $('#contentTable').DataTable({
        processing: true,
        serverSide: true,
        filter: true,
        ajax: categoryRoute,
        columns: [
        { data: 'title_en',  class: 'text-capitalize text-center' },
        { data: 'keyword_en',  class: 'text-capitalize text-center' },
        { data: 'description_en',  class: 'text-capitalize text-center' },
        {
            data: null,
            className: "dt-center editor-delete text-center",
            orderable: false,
            "mRender" : function ( data, type, row ) {
                return `<a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-content text-center" href="javascript:void(0)" data-url="${edit_route + '/' + data.id}" data-id="${data.id}" data-toggle="editmodal" data-target="#myEditModal"> <span class="svg-icon svg-icon-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                    </svg>
                </span> </a> 
                 `

            }
        },
     ]
  });
}

function validateForm( $form ) {
    if ( $form.length ) {
        let validateForm = $form.validate({
            rules: {
                title_en: {
                    required: true
                },
                keyword_en: {
                    required: true
                },
                description_en: {
                    required: true
                }
            },
            submitHandler: ( form ) => {
                try {
                    let url = $form.attr('action');
                    var formData = new FormData(form);
                    // console.log(formData);
                    $.ajax({
                        url:  url,
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(response){
                            $('#loader').hide();
                            if(response.status){
                                $('#loader').hide();
                                url.indexOf('/update') === -1 ? data_insert_notification(response.message) : data_update_notification(response.message),
                                $('#contentTable').DataTable().ajax.reload();
                                $form.parents('.modal').modal('hide');
                            } else {
                                error_notification_add( response.message );
                            }
                        },
                        error:function(error){
                            $('#loader').hide();
                            validateForm.showErrors(error.responseJSON.errors);
                        }
                    });
                }
                catch(error) {
                    console.log(error);
                }
                
            },
        });
    }
}

$(document).on('click', '.content-add-btn',function(e) {
    e.preventDefault();
    let add_url = $(this).attr('data-url');
    let $this = $(this);
    $this.addClass('pe-none');
    if ( add_url ) {
        $.ajax({
            url: add_url,
            type: 'get',
            dataType: 'json',
            complete: function(response) {
                let resp = response.responseJSON;
                if ( resp ) {
                    if ( resp.status ) {
                        make_modal('add-content-modal', resp.data.view, true,null);
                        validateForm( $('.add_content_form') );
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

$(document).on('click', '.edit-content',function(e) {
    e.preventDefault();
    let edit_url = $(this).attr('data-url');
    let $this = $(this);
    $this.addClass('pe-none');
    if ( edit_url ) {
        $.ajax({
            url: edit_url,
            type: 'get',
            dataType: 'json',
            complete: function(response) {
                let resp = response.responseJSON;
                if ( resp ) {
                    if ( resp.status ) {
                        make_modal( 'edit-content-modal', resp.data.view, true );
                        validateForm( $('.edit-content-form') );
                    } else {
                        error_notification_add()
                    }
                }
            },
            error: function (response) {
                error_notification();
            }
        }).always(function(){
            $this.removeClass('pe-none');
        });
    }        
})