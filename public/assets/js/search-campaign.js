$('#search').on('click', function() {
    $("#search_campaign").valid({
        rules: {
            'name': {
                 minlength:20
            },
        },
        messages: {
            'name': {
                minlength: "Minimum length exceeds"
            },
        },
    });
});

$("#search_campaign").validate({
      submitHandler: function (form) {
        let url =  window.CONFIG.ROUTES.search_campaign
        let text = $("#name").val();
        
        $.ajax({
        url: url,
        type: 'get',
        data: {
            text: text
        },
        dataType: 'json',
        complete: function(response) {
            console.log(response);
            $('#get_list').empty();
            $('#kt_social_feeds_more_posts_btn').hide();
            $('.campaign_total').empty();
            $('#kt_project_users_card_pane').empty();
            $('#get_list').append(response.responseJSON.html);
        }
     })
      }
});

$('#search_connected_campaign').on('click', function() {
    $("#search_connected_campaign").valid({
        rules: {
            'search_connected_campaign': {
                 minlength:20
            },
        },
        messages: {
            'name': {
                minlength: "Minimum length exceeds"
            },
        },
    });
});

$("#search_connected_campaign").validate({
      submitHandler: function (form) {
        let url =  window.CONFIG.ROUTES.search_connected_campaign
        let text = $("#search_connected_name").val();
        
        $.ajax({
        url: url,
        type: 'get',
        data: {
            text: text
        },
        dataType: 'json',
        complete: function(response) {
            console.log(response);
            $('#get_list').empty();
            $('#kt_social_feeds_more_posts_btn').hide();
            $('.campaign_total').empty();
            $('#kt_project_users_card_pane').empty();
            $('#get_list').append(response.responseJSON.html);
        }
     })
      }
});
