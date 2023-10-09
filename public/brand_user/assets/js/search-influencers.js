$(document).ready(function(){
   /*  $("#search_influencers").validate({
        rules: {
            'search_name': {
                required: true
            },
        },
        messages: {
            'search_name': {
                required: "Please enter any keyword"
            },
        },
    }); */

 

   
    $('#search').on('click',function(e){
        e.preventDefault();
        let url =  window.CONFIG.ROUTES.search_influencers
        $.ajax({    
            url: url,
            type: 'get',
            data: {
                text: $("#search_name").val(),
                category : $('#category').val(),
                name : $('#name').val(),
                country : $('#country').val(),
                max : $('#max').val(),
                min : $('#min').val(),
                min_rate : $('#kt_slider_basic_min').text(),
                max_rate : $('#kt_slider_basic_max').text()
            },
            dataType: 'json',
            beforeSend: function() {
                $('.loading').removeClass('d-none');
                $('.loading').show();
            },
            complete: function(response) {
                console.log(response);
                $('#remove-row').remove();
                $('.card-container').hide();
                $('.loading').hide();
                $('#get_list').empty();
                $('.tab-content').empty();
                if(response.responseJSON.total){
                    $('#total_count_data').html(response.responseJSON.total + ' Records found.');
                }else{
                    $('#total_count_data').html('No Records found.');
                }
              
                $('#get_list').append(response.responseJSON.html);
                
                
            }
        })
    })
})