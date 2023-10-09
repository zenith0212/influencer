"use strict";

let $table;
$(document).ready(function() {
	if ( $('#table-product-list').length ) {
		$table = $('#table-product-list').DataTable({
		  	processing: true,
	        serverSide: true,
	        filter: true,
	        searching: false,
	        lengthChange: false,
			"ajax": {
		        "url": URL_PRODUCT,
		        'data': function(data){
		            var search_string = $('#search_product').val();
		            data.search_string = search_string;
		            console.log(URL_PRODUCT,data.search_string,search_string);
		        }
		    },
			columns: [
				{
					data: 'image',
				    class: 'text-center',
					mRender : function ( data, type, row, meta ) {
					    return `<img src= "${data}" onerror="this.src='${defaultImgUrl}'" height="50" />`;
					}
				},
				{
				    data: 'name_en',
				    class: 'text-capitalize'
				},
				{
					data: 'category',
					class: 'text-capitalize text-center'
				},
				{
					data: 'price',
					class: 'text-capitalize text-center'
				},
				{
					data: 'created_at',
					class: 'text-capitalize text-center'
				},
				{
					data: null,
					className: "dt-center editor-delete",
	                orderable: false,
	                mRender : function ( data, type, row ) {
                        return `
                            <div class="action-btns justify-content-center">
                                <a href="${URL_PRODUCT_VIEW + '/' + row.id}" class="view-btn" title="View Product">
                                    <i class="fa-solid fa-eye"></i>
                                </button>

                                <a href="${URL_PRODUCT_EDIT + '/' + row.id}" class="edit-btn" title="Edit Product">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <a href="javascript: void(0);" data-xid="${row.id}" data-url="${URL_PRODUCT_DELETE + '/' + row.id}" class="delet-btn delete-product" title="Delete Product">
	                                <i class="fa-solid fa-trash"></i>
	                            </a>
                            </div>
                        `;
	                },
				},
				
			],
			fnDrawCallback: function( settings, json ) {
			    $('#total-products-count').html(this.fnSettings().fnRecordsTotal());
		  	}
    	});
	}

	if ( $('.js-example-basic-single').length ) {
		$('.js-example-basic-single').select2();
	}
	
	if ( $('.js-example-basic-multiple').length ) {
		$('.js-example-basic-multiple').select2();
	}
});

$('#search_product').bind("keyup change", function(){
	console.log($('#search_product').val());
    $table.ajax.reload();
});


$(document).on('click', '.delete-product', function(event) {
	event.preventDefault();
	let id = $(this).attr('data-xid');	
	let $delete_url = $(this).attr('data-url');
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
                            delete_notification(response.message);
                            $('#table-product-list').DataTable().ajax.reload();
                        } else {
                           // error_notification( response.message );
                        	error_notification();
                        }	
                        
                    },
                    error: function ( response ) {
                    }
                })
            }
        });

	// event.preventDefault();
	// let id = $(this).attr('data-xid');
	// let url = $(this).attr('data-url');
	// if ( id && url ) {
	// 	let callback = () => {
	// 		$.ajax({
	// 			url: url,
	// 			type: 'DELETE',
	// 			dataType: 'json',
	// 			data: {
	// 				id: id,
	// 			},
	// 			beforeSend: () => {},
	// 			success: function ( response ) {
    //                 console.log(response);
    //                 if ( response.status ) {
    //                     delete_notification( response.message );
    //                     $('.influencers_users_table').DataTable().ajax.reload();
    //                 } else {
    //                    error_notification( response.message );
    //                 }
                    
    //             },
    //             error: function ( response ) {
    //                 error_notification();
    //             }
	// 		})
	// 	};
	// 	// swalConfirmation("You wan't be ablt to revert this product!");
	// }
});

// for product details page
if ( $('.mySwiper').length ) {
	var swiper = new Swiper(".mySwiper", {
	    spaceBetween: 10,
	    slidesPerView: 'auto',
	    freeMode: true,
	    watchSlidesProgress: true,
	    loopedSlides: 5,
	    breakpoints: {
	        640: {
	            loopedSlides: 3,
	            spaceBetween: 10,
	        },
	        768: {
	            loopedSlides: 4,
	            spaceBetween: 15,
	        },
	        1024: {
	            loopedSlides: 5,
	            spaceBetween: 20,
	        },
	    },
	});

	var swiper2 = new Swiper(".mySwiper2", {
	    zoom: true,
	    centeredSlides: true,
	    navigation: {
	        nextEl: ".swiper-button-next",
	        prevEl: ".swiper-button-prev",
	    },
	    thumbs: {
	        swiper: swiper,
	    },
	});
}


// $(document).ready(function() {
// 	if ( $('#table-sample-request-list').length ) {
// 		$table = $('#table-sample-request-list').DataTable({
// 		  	processing: true,
// 	        serverSide: true,
// 	        filter: true,
// 	        searching: false,
// 	        lengthChange: false,
// 	        "ajax": {
// 		        "url": URL_PRODUCT_SAMPLE,
// 		        'data': function(data){
// 		            var search_string = $('#search_sample_product').val();
// 		            data.search_string = search_string;
// 		        }
// 		    },
// 			columns: [
// 				{
// 					data: 'image',
// 				    class: 'text-center',
// 					mRender : function ( data, type, row, meta ) {
// 					    return `<img src= "${data}"  height="50" />`;
// 					}
// 				},
// 				{
// 				    data: 'name_en',
// 				    class: 'text-capitalize'
// 				},
// 				{
// 					data: 'campaign_name',
// 					class: 'text-capitalize text-center'
// 				},
// 				{
// 					data: 'influencer_name',
// 					class: 'text-capitalize text-center'
// 				},
// 				{
// 					data: null,
// 					className: "dt-center editor-delete",
// 	                orderable: false,
// 	                mRender : function ( data, type, row ) {
// 	                	console.log(data.product_status);
//                         if(data.product_status ==  0 ) {
//                         	return `
//                            		<div class="status status-pause">No status available</div>
//                          	`}
//                         else if(data.product_status ==  1 ) {
//                         return `
//                            	<div class="status status-requested">Requested</div>
//                          `}
//                         else if(data.product_status ==  2 ) {
//                         return `
//                            	<div class="status status-active">Shipped</div>
//                          `}
//                         else if(data.product_status ==  3 ) {
//                         return `
//                            	<div class="status status-completed">Delivered</div>
//                          `}
//                         else {
//                         return `
//                            	<div class="status status-pause ">Waiting for the response</div>
//                          `}
// 	                },
// 				},
// 				{
// 					data: null,
// 					className: "dt-center editor-delete",
// 	                orderable: false,
// 	                mRender : function ( data, type, row ) {
// 	                	console.log('row',row);
//                         return `
//                             <div class="action-btns justify-content-center">
//                                 <a href="/brand/product-details/`+row.id+`/campaign_id=`+row.campaign_id+`" class="view-btn" title="View Product">
//                                     <i class="fa-solid fa-eye"></i> </a>
//                                 </button>
//                             </div>
//                         `;
// 	                },
// 				},
				
// 			],
// 			fnDrawCallback: function( settings, start, end, max, total, pre ) {
// 			    $('#table-sample-request-count').html(this.fnSettings().fnRecordsTotal());
// 		  	}
//     	});
// 	}

// 	if ( $('.js-example-basic-single').length ) {
// 		$('.js-example-basic-single').select2();
// 	}
	
// 	if ( $('.js-example-basic-multiple').length ) {
// 		$('.js-example-basic-multiple').select2();
// 	}
// });

// $('#search_sample_product').bind("keyup change", function(){
// 	console.log($('#search_sample_product').val());
//     $table.ajax.reload();
// });

$(document).ready(function() {
	if ( $('#table-sample-request-list').length ) {
		$table = $('#table-sample-request-list').DataTable({
		  	processing: true,
	        serverSide: true,
	        filter: true,
	        searching: false,
	        lengthChange: false,
			"ajax": {
		        "url": URL_PRODUCT_SAMPLE,
		        'data': function(data){
		            var search_string = $('#search_sample_product').val();
		            data.search_string = search_string;
		        }
		    },
			columns: [
				{
					data: 'image',
				    class: 'text-center',
					mRender : function ( data, type, row, meta ) {
					    return `<img src= "${data}"  height="50" />`;
					}
				},
				{
				    data: 'name_en',
				    class: 'text-capitalize'
				},
				{
					data: 'campaign_name',
					class: 'text-capitalize text-center'
				},
				{
					data: 'influencer_name',
					class: 'text-capitalize text-center'
				},
				{
					data: null,
					className: "dt-center editor-delete",
	                orderable: false,
	                mRender : function ( data, type, row ) {
	                	console.log(data.product_status);
                        if(data.product_status ==  0 ) {
                        	return `
                           		<div class="status status-pause">No status available</div>
                         	`}
                        else if(data.product_status ==  1 ) {
                        return `
                           	<div class="status status-requested">Requested</div>
                         `}
                        else if(data.product_status ==  2 ) {
                        return `
                           	<div class="status status-active">Shipped</div>
                         `}
                        else if(data.product_status ==  3 ) {
                        return `
                           	<div class="status status-completed">Delivered</div>
                         `}
                        else {
                        return `
                           	<div class="status status-pause ">Waiting for the response</div>
                         `}
	                },
				},
				{
					data: null,
					className: "dt-center editor-delete",
	                orderable: false,
	                mRender : function ( data, type, row ) {
	                	console.log('row',row);
                        return `
                            <div class="action-btns justify-content-center">
                                <a href="/brand/product-details/`+row.id+`/campaign_id=`+row.campaign_id+`" class="view-btn" title="View Product">
                                    <i class="fa-solid fa-eye"></i> </a>
                                </button>
                            </div>
                        `;
	                },
				},
				
			],
			fnDrawCallback: function( settings, start, end, max, total, pre ) {
			    $('#table-sample-request-count').html(this.fnSettings().fnRecordsTotal());
		  	}
    	});
	}

	if ( $('.js-example-basic-single').length ) {
		$('.js-example-basic-single').select2();
	}
	
	if ( $('.js-example-basic-multiple').length ) {
		$('.js-example-basic-multiple').select2();
	}
});

$('#search_sample_product').bind("keyup change", function(){
    $table .ajax.reload();
});

// $(document).ready(function(){
//     $("#form-create-product").validate({
//         rules: {
//             'product_main_image': {
//                 required: true
//             },
// 			'name_en': {
//                 required: true
//             },
//             'keyword_en': {
//                 required: true
//             },
//             'category_id': {
//             	required: true
//             },
//             'product_link': {
//             	required: true
//             },
//             'price': {
//             	required: true
//             },
//             'short_description_en': {
//             	required: true
//             },
//             'description_en': {
//             	required: true
//             }
//         },
//         messages: {
//             'product_main_image': {
//                 required: "This field is required."
//             },
// 			'name_en': {
//                 required: "This field is required."
//             },
//             'keyword_en': {
//                 required: "This field is required."
//             },
//             'category_id': {
//                 required: "This field is required."
//             },
//             'product_link': {
//                 required: "This field is required."
//             },
//             'price': {
//                 required: "This field is required."
//             },
//             'description_en': {
//                 required: "This field is required."
//             },
//             'short_description_en': {
//                 required: "This field is required."
//             },
//         },
//     });
// });
