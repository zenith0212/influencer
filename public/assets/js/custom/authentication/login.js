function validateForm( $form ) {
    if ( $form.length ) {
        let validateForm = $form.validate({
            rules: {
                name_en: {
                    required: true
                },
                description_en: {
                    required: true
                },
                amount: {
                    required: true
                },
                plan_duration: {
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
                    success:function(response){
                        $('#loader').hide();
                        if(response.status){
                            $('#loader').hide();
                            url.indexOf('/update') === -1 ? data_insert_notification() : data_update_notification(),
                            $('#plansTable').DataTable().ajax.reload();
                            $form.parents('.modal').modal('hide');
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