$(document).on('click', '.view-products',function(e) {
    e.preventDefault();
    let view_route = $(this).attr('data-url');
    let $this = $(this);
    // $this.addClass('pe-none');
    if ( view_route ) {
        $.ajax({
            url: view_route,
            type: 'get',
            dataType: 'json',
            complete: function(response) {
                let resp = response.responseJSON;
                if ( resp ) {
                    if ( resp.status ) {
                        console.log("oh yes");
                        make_modal( 'view-products', resp.data.view, true );
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
});

 $('#productsTable').DataTable({
         processing: true,
         serverSide: true,
        "filter": true, 
         ajax: get_products_route,
         columns: [
            {  
                data: 'thumbnail_image',
                "mRender" : function ( data, type, row, meta ) {
                    return `<img src= "${data}" onerror="this.src='${defaultImgUrl}'" height=\"50\"/ width=\"50\"/>`;
                }
            },
            { data: 'name_en' , class: 'text-capitalize text-center'},
            { data: 'product_brand', class: 'text-capitalize text-center' },
            { data: 'product_category', class: 'text-capitalize text-center'},
            { 
                "render": function ( data, type, row ) {
                    console.log(row.is_available);
                    if(row.is_available == 1) {
                        return `<span class="ms-2 badge badge-light-success fw-semibold text-center"> Available </span>`;   
                    }
                    else {
                       return `<span class="ms-2 badge badge-light-danger fw-semibold text-center"> Not Available </span>`;  
                    }
                    
                },
            },
            { 
                "render": function ( data, type, row ) {
                    console.log(row.is_featured);
                    if(row.is_featured == 1) {
                        return `<span class="ms-2 badge badge-light-success fw-semibold text-center"> Featured </span>`;   
                    }
                    else {
                        return `<span class="ms-2 badge badge-light-danger fw-semibold text-center"> Not Featured </span>`; 
                    }
                    
                },
            },
            {
                data: null,
                orderable: false,
                "mRender" : function ( data, type, row ) {
                    return `<a class="view-productsss" href="${view_route + '/' + data.id}">
                              <span class="svg-icon svg-icon-3">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg>
                              </span>
                           </a>`
                }
            },
         ]
      });
