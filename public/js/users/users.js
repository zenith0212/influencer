         $(window).on('load',function(){
            setTimeout(function(){ // allowing 3 secs to fade out loader
            $('.page-loader').fadeOut('slow');
            },1000);
         });

  
    $(document).ready(function(){
      // DataTable Brand start
        $url =  window.CONFIG.ROUTES.brand_users;
        $('.brand_users_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: $url,
            columns: [
                { 
                    data: 'logo' ,
                    render:function(data){
                        if(data == null){
                            let img_src = window.CONFIG.public_assets+'assets/media/avatars/blank.png';
                            return "<div class='symbol symbol-circle symbol symbol-label'><img src="+img_src+" class='w-100'/></div>"
                        }else{
                            let src = window.CONFIG.public_assets+'storage/brandLogo/'+data;
                            return "<div class='symbol symbol-circle symbol symbol-label'><img src="+src+" class='w-100'/></div>"
                        }
                    }
                },
                { data: 'title' },
                // { data: 'category'},
                { data: 'email' },
                { data: 'address' },
                {
                    data: null,
                    className: "dt-center editor-delete",
                    orderable: false,
                    "mRender" : function ( data, type, row ) {
                        $edit_route = window.CONFIG.ROUTES.edit_brand_users;
                        return `<a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-brands" href="javascript:void(0)" data-url="${$edit_route + '/' + data.id}" data-toggle="editmodal" data-target="#myEditModal"> <span class="svg-icon svg-icon-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                            </svg>
                        </span> </a> 
                            <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" href="javascript:delete_brand_record('${data.id}');" class="delete btn btn-delete" title="Delete"> <span class="svg-icon svg-icon-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                            </svg>
                        </span> </a>`
                    }
                },
            ],
            columnDefs: [
                { className: 'text-center', targets: [0,1,2,3,4] },
            ],
            aaSorting: [[1, 'asc']]
        });
      // DataTable Brand end

     
    });

    $(document).ready(function(){
          // DataTable Influeners start
          $influencer_url =  window.CONFIG.ROUTES.influencer_users;
          $('.influencers_users_table').DataTable({
              processing: true,
              serverSide: true,
              "searching": true,
              "bFilter" : false,
              ajax: $influencer_url,
              columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: '',
                },
                 { 
                        data: 'media_profile' ,
                        render:function(data,type,row,meta){
                            return "<div class='symbol symbol-circle symbol symbol-label'><img src="+data+" class='w-100'/></div>"
                        
                    }
                  },
                  { 
                    data: 'name' , "orderable": true ,
                    render: function(data,type,row,meta){
                        let link = window.CONFIG.ROUTES.view_influencer+"/"+ row.id;
                        return '<div class="d-flex flex-column"><a href="'+link+'" class="text-gray-800 text-hover-primary mb-1">'+data+'</a><span>'+row.email+'</span></div>';
                    }
                  },
                  { data: 'country' },
                  { 
                    data: 'followers',
                    render: function(data){
                        return '<span class="svg-icon svg-icon-2"><svg class="svg-icon" viewBox="0 0 20 20"><path d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path></svg></span>' + " <b>" +data+"</b>"
                    }
                  },
                  { data: 'engement' },
                  {
                      data: null,
                      className: "dt-center editor-delete",
                      orderable: false,
                      "mRender" : function ( data, type, row ) {
                          return `<a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" href="javascript:delete_record('${data.id}');" class="delete btn btn-delete" title="Delete"> <span class="svg-icon svg-icon-3">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                  <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                  <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                              </svg>
                          </span> </a>`
      
                      }
                  },
              ],
              rowReorder: true,
              columnDefs: [
                { className: 'text-center', targets: [0,1,3,4,5] },
              ],
              aaSorting: [[2, 'asc']],
          });
         // DataTable Influeners end
    })

    function delete_record(id) {
        $delete_url = window.CONFIG.ROUTES.delete_influencer
        console.log($delete_url);
        delete_confirmation('Are you sure you want to delete this record?').then(function (response) {
            if (response['isConfirmed']) {
                 $.ajax({
                    url: $delete_url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        id: id,
                    },
                    success: function ( response ) {
                        console.log(response);
                        if ( response.status ) {
                            delete_notification( response.message );
                            $('.influencers_users_table').DataTable().ajax.reload();
                        } else {
                           error_notification( response.message );
                        }
                        
                    },
                    error: function ( response ) {
                        error_notification();
                    }
                })
            }
        });
    }

    function delete_brand_record(id) {
        $delete_url = window.CONFIG.ROUTES.delete_brand+'/'+id
        console.log($delete_url);
        delete_confirmation('Are you sure you want to delete this record?').then(function (response) {
            if (response['isConfirmed']) {
                 $.ajax({
                    url: $delete_url,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id,
                    },
                    success: function ( response ) {
                        console.log(response);
                        if ( response.status ) {
                            delete_notification( response.message );
                            $('.brand_users_table').DataTable().ajax.reload();
                        } else {
                           error_notification( response.message );
                        }
                        
                    },
                    error: function ( response ) {
                        error_notification();
                    }
                })
            }
        });
    }

    $(document).on('click', '.edit-brands',function(e) {
        e.preventDefault();
        let edit_brand_url = $(this).attr('data-url');
        let $this = $(this);
        $this.addClass('pe-none');
        if ( edit_brand_url ) {
            $.ajax({
                url: edit_brand_url,
                type: 'get',
                dataType: 'json',
                complete: function(response) {
                    let resp = response.responseJSON;
                    console.log(resp);
                    if ( resp ) {
                        if ( resp.status ) {
                            make_modal( 'edit-brand-modal', resp.data.view, true );
                            validateForm( $('.edit-brand-form') );
                        } else {
                            error_notification_add( resp.message );
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

    function validateForm( $form ) {
        if ( $form.length ) {
            let validateForm = $form.validate({
                rules: {
                    name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    work_email: {
                        required: true
                    },
                    company_name: {
                        required: true
                    }
                },
                submitHandler: ( form ) => {
                    try {
                        let url = $form.attr('action');
                        var formData = new FormData(form);
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
                                    $('.brand_users_table').DataTable().ajax.reload();
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

    $(document).ready(function(){

    // Add event listener for opening and closing details
    $('#influencers_users_table tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var table = $('#influencers_users_table').DataTable();
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            console.log("open");
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
           
        }
    });

        function format(d) {

            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>Total Likes :</td>' +
            '<td><span class="svg-icon svg-icon-2"><svg class="svg-icon" viewBox="0 0 20 20"><path d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61"></path></svg></span>' +
            d.likes +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Total Views :</td>' +
            '<td><span class="svg-icon svg-icon-2"><svg class="svg-icon" viewBox="0 0 20 20"><path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path></svg></span>' +
            d.views +
            '</td>' +
            '</tr>' +
            '</table>';

    }


     // DataTable Brand start
     $url =  window.CONFIG.ROUTES.registed_influencers;
     $('.registered_influencers_table').DataTable({
         processing: true,
         serverSide: true,
         ajax: $url,
         columns: [
             { 
                 data: 'logo' ,
                 render:function(data){
                     if(data == null){
                         let img_src = window.CONFIG.public_assets+'assets/media/avatars/blank.png';
                         return "<div class='symbol symbol-circle symbol symbol-label'><img src="+img_src+" class='w-100'/></div>"
                     }else{
                         let src = window.CONFIG.public_assets+'storage/media_profile/'+data;
                         return "<div class='symbol symbol-circle symbol symbol-label'><img src="+src+" class='w-100'/></div>"
                     }
                 }
             },
             { data: 'name' },
             // { data: 'category'},
             { data: 'email' },
             // { data: 'nickname' },
             { data: 'link' },
             {
                 data: null,
                 className: "dt-center editor-delete",
                 orderable: false,
                 "mRender" : function ( data, type, row ) {
                     $edit_route = window.CONFIG.ROUTES.edit_brand_users;
                     return `
                         <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" href="javascript:delete_brand_record('${data.id}');" class="delete btn btn-delete" title="Delete"> <span class="svg-icon svg-icon-3">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                             <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                             <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                         </svg>
                     </span> </a>`
                 }
             },
         ],
         columnDefs: [
             { className: 'text-center', targets: [0,1,2,3,4] },
         ],
         aaSorting: [[1, 'asc']]
     });
   // DataTable Brand end



})