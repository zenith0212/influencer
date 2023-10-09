var defaultImgUrl = "{{ asset('/assets/media/avatars/default_img.png') }}";
// Total Campaigns List
let $total_campaign_table = $('#totalCampaign').DataTable({
    "searching": false,
    "lengthChange": false,
    processing: true,
    serverSide: true,
    filter: true,
    // ajax: get_campaign,
    "ajax": {
        "url": get_campaign,
        'data': function(data){
            var search_string = $('#search_keyword').val();
            data.search_string = search_string;
        }
    },
    columns: [
        {
            data: null,
            class:'text-center',
            mRender: function ( data, type, row ) {
                return `<div class="d-flex align-items-center"><img src="${data.thumbnail_image}" height="50" alt="" onerror="this.src='${defaultImgUrl}'"> ${data.name_en}</div>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<p> $ ${data.amount}</p>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<a href="${data.detail_url}" target="_blank">${data.total_products}</a>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<a href="${data.detail_url}" target="_blank">${data.total_influencer}</a>`
            },
        },
        {
            data: 'created_at',
        },
        {
            data: 'status',
        },
        {
            data: null,
            className: "dt-center editor-delete",
            orderable: false,
            mRender : function ( data, type, row ) {
                if(data.is_completed){
                    return `
                        <div class="action-btns justify-content-center">
                            <button type="button" class="view-btn" onclick="redirect('${data.detail_url}')">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    `;
                } else {
                    return `
                        <div class="action-btns justify-content-center">
                            <button type="button" class="view-btn" onclick="redirect('${data.detail_url}')">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button type="button" class="edit-btn" type="button" onclick="redirect('${data.edit_url}')">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button type="button" class="delet-btn" onclick="delete_record('${data.id}')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        }
    ],
    "drawCallback": function( settings, start, end, max, total, pre ) {
        $('.total-campaign-count').text(this.fnSettings().fnRecordsTotal());
    },
});

// Total Active Campaigns List
let $active_campaign_table = $('#activeCampaignList').DataTable({
    "searching": false,
    "lengthChange": false,
    processing: true,
    serverSide: true,
    filter: true,
    ajax: get_active_campaign,
    columns: [
        {
            data: null,
            class:'text-center',
            mRender: function ( data, type, row ) {
                return `<div class="d-flex align-items-center"><img src="${data.thumbnail_image}" height="50" alt="" onerror="this.src='${defaultImgUrl}'"> ${data.name_en}</div>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<p>$ ${data.amount}</p>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<a href="${data.detail_url}" target="_blank">${data.total_products}</a>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<a href="${data.detail_url}" target="_blank">${data.total_influencer}</a>`
            },
        },
        {
            data: 'created_at',
        },
        {
            data: null,
            className: "dt-center editor-delete",
            orderable: false,
            mRender : function ( data, type, row ) {
                return `
                    <div class="action-btns justify-content-center">
                        <button type="button" class="view-btn" onclick="redirect('${data.detail_url}')">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" class="edit-btn" type="button" onclick="redirect('${data.edit_url}')">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button type="button" class="delet-btn" onclick="delete_record('${data.id}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                `;
            }
        }
    ],
    "drawCallback": function( settings, start, end, max, total, pre ) {
        $('.total-active-campaign-count').text(this.fnSettings().fnRecordsTotal());
    },
});


//dashboard total active campaign

let $active_campaign_table_dashboard = $('#activeCampaignList-dashboard').DataTable({
    "searching": false,
    "lengthChange": false,
    processing: true,
    serverSide: true,
    filter: false,
    info: false,
    ajax: get_active_campaign,
    columns: [
        {
            data: null,
            class:'text-center',
            mRender: function ( data, type, row ) {
                return `<div class="d-flex align-items-center"><img src="${data.thumbnail_image}" height="50" alt="" onerror="this.src='${defaultImgUrl}'"> ${data.name_en}</div>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<p>$ ${data.amount}</p>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<a href="${data.detail_url}" target="_blank">${data.total_products}</a>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<a href="${data.detail_url}" target="_blank">${data.total_influencer}</a>`
            },
        },
        {
            data: 'created_at',
        },
        {
            data: null,
            className: "dt-center editor-delete",
            orderable: false,
            mRender : function ( data, type, row ) {
                return `
                    <div class="action-btns justify-content-center">
                        <button type="button" class="view-btn" onclick="redirect('${data.detail_url}')">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" class="edit-btn" type="button" onclick="redirect('${data.edit_url}')">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button type="button" class="delet-btn" onclick="delete_record('${data.id}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                `;
            }
        }
    ],
    // "drawCallback": function( settings, start, end, max, total, pre ) {
    //     $('.total-active-campaign-count').text(this.fnSettings().fnRecordsTotal());
    // },
});

// Total Completed Campaigns List
let $completed_campaign_table = $('#completedCampaignList').DataTable({
    "searching": false,
    "lengthChange": false,
    processing: true,
    serverSide: true,
    filter: true,
    ajax: get_completed_campaign,
    columns: [
        {
            data: null,
            class:'text-center',
            mRender: function ( data, type, row ) {
                return `<div class="d-flex align-items-center"><img src="${data.thumbnail_image}" height="50" alt=""> ${data.name_en}</div>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<p>$ ${data.amount}</p>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<a href="${data.detail_url}" target="_blank">${data.total_products}</a>`
            },
        },
        {
            data: null,
            class: 'text-center',
            mRender: function ( data, type, row ) {
                return `<a href="${data.detail_url}" target="_blank">${data.total_influencer}</a>`
            },
        },
        {
            data: 'created_at',
        },
        {
            data: null,
            className: "dt-center editor-delete",
            orderable: false,
            mRender : function ( data, type, row ) {
                return `
                    <div class="action-btns justify-content-center">
                        <button type="button" class="view-btn" onclick="redirect('${data.detail_url}')">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                `;
            }
        }
    ],
    "drawCallback": function( settings, start, end, max, total, pre ) {
        $('.total-completed-campaign-count').text(this.fnSettings().fnRecordsTotal());
    },
});

function delete_record(id) {
    delete_confirmation('Are you sure you want to delete this record?').then(function (response) {
        if (response['isConfirmed']) {
            $.ajax({
                url: delete_campaign,
                type: 'DELETE',
                dataType: 'json',
                data: { 'id': id },
                success: function (response) {
                    if (response.status) {
                        delete_notification(response.message);
                        $total_campaign_table.ajax.reload();
                        $active_campaign_table.ajax.reload();
                        $completed_campaign_table.ajax.reload();
                    } else {
                        error_notification(response.message);
                    }
                },
                error: function (response) {
                    error_notification();
                }
            })
        }
    });
}

function redirect(url) {
    window.location.href = url;
}

$('#search_keyword').bind("keyup change", function(){
    $total_campaign_table.ajax.reload();
});
