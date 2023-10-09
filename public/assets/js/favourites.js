
$(document).ready(function() {
	if ( $('#table-favourite-influencers-list').length ) {
		$table = $('#table-favourite-influencers-list').DataTable({
		  	processing: true,
	        serverSide: true,
	        filter: true,
	        searching: false,
	        lengthChange: false,
			"ajax": {
		        "url": URL_FAVOURITE_INFLUENCER_LIST,
		        'data': function(data){
		            var search_string = $('#search_influencer').val();
		            data.search_string = search_string;
		        }
		    },
			columns: [
				{
					data: 'image',
				    class: 'text-center',
					mRender : function ( data, type, row, meta ) {
						console.log(data);
					    return `<img src= "${data}" onerror="this.src='${defaultImgUrl}'" height="50" />`;
					}
				},
				{
					data: 'nickname',
					class: 'text-capitalize text-center'
				},
				{
				    data: 'country',
				    class: 'text-capitalize'
				},
				{
				    data: 'follower_count',
				    class: 'text-capitalize'
				},
				{
				    data: 'following_count',
				    class: 'text-capitalize'
				},
				{
				    data: 'like_count',
				    class: 'text-capitalize'
				},
				{
					data: null,
					className: "dt-center editor-delete",
	                orderable: false,
	                mRender : function ( data, type, row ) {
                        return `
                            <div class="action-btns justify-content-center">
                                <a href="${URL_INFLUENCER_VIEW + '/' + row.id}" class="view-btn" title="View Product">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
	                            </a>
                            </div>
                        `;
	                },
				},
				
			],
			fnDrawCallback: function( settings, start, end, max, total, pre ) {
			    $('#total-favourite-influencers-count').html(this.fnSettings().fnRecordsTotal());
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

$('#search_influencer').bind("keyup change", function(){
    $table .ajax.reload();
});