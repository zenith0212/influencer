$('#search').on('click', function() {
    $("#search_product").valid({
        rules: {
            'name': {
                required: true
            },
        },
        messages: {
            'name': {
                required: "Please enter any keyword"
            },
        },
    });
});

$("#search_product").validate({
          submitHandler: function (form) {
            let url =  window.CONFIG.ROUTES.search_product
            $.ajax({    
            url: url,
            type: 'get',
            data: {
                text: $("#name").val()
            },
            dataType: 'json',
            complete: function(response) {
                console.log(response);
                $('#get_list').empty();
                $('#kt_social_feeds_more_posts_btn').hide();
                $('.product_total').empty();
                $('#kt_project_users_card_pane').empty();
                $('#get_list').append(response.responseJSON.html);
            }
        })
          }
     });