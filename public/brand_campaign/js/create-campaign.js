/*-----------------------------------------------------------------------------------

 Webiste Name: Top Brand Mate
 Description: This is E-commerce website
 Author: Narola infotech

----------------------------------------------------------------------------------- */

// 01.on scroll add class
// 02.Pre loader
// 03.Pre loader
// 01.Pre loader
// 01.Pre loader


  /*=====================
  03. step process
  ==========================*/

    let theEditor;
    $( function() {
        initProducts();

        ClassicEditor
        .create( document.querySelector( '#terms_and_condition_en' ))
        .then(editor => {
            theEditor = editor;
        })
        .catch( error => {
            console.error( error );
        });

        $('[data-toggle="tooltip"]').tooltip()

        $('#btn_add_product').on('click', function(){
            $('#btn_refresh').removeClass('d-none');
        })
    } );

    function getDataFromTheEditor() {
        return theEditor.getData();
    }

    $('.btn-next').on('click', function() {
        var currentStepNum = $('#checkout-progress').data('current-step');
        $('#hidden_step_num').val(currentStepNum);
        var isAjax = true;

        if(currentStepNum == 1){
            $('#name_en').next('p').addClass('d-none');
            if($.trim($('#name_en').val()) == ""){
                isAjax = false;
                $('#name_en').next('p').removeClass('d-none');
                return false;
            }
        } else if(currentStepNum == 2) {
            var isDivVisible = $('.product-section').is(":visible");
            if(!isDivVisible) {
                var prodArr = $('#select_products').val();
                $('.error-product').addClass('d-none');
                if(prodArr.length <= 0) {
                    isAjax = false;
                    $('.error-product').removeClass('d-none');
                    return false;
                }
            } else {

            }
        } else if(currentStepNum == 3) {
            $('#hidde_tc').val(getDataFromTheEditor());
            $('.error-sample-video, .error-fan-volume, .error-thumbnail, .error-live-stream, .error-target-region, .error-on-going, .error-terms-condition, .error-traceable-link').addClass('d-none');
            $('#amount, #total_influencers_required, #budget_for_each_influencer, #application_till_date, #application_start_date, #application_end_date').next('p').addClass('d-none');

            if(!$(":checkbox[name='is_sample_required']", $(".create_campaign_form")).is(":checked")) {
                isAjax = false;
                $('.error-sample-video').removeClass('d-none');
                scrollTop();
                return false;
            }
            if($('#fan_volumes').val() == "") {
                isAjax = false;
                scrollTop();
                $('.error-fan-volume').removeClass('d-none');
                return false;
            }
            if($.trim($('#amount').val()) == "") {
                isAjax = false;
                scrollTop();
                $('#amount').next('p').removeClass('d-none');
                return false;
            }
            if($.trim($('#total_influencers_required').val()) == "") {
                isAjax = false;
                scrollTop();
                $('#total_influencers_required').next('p').removeClass('d-none');
                return false;
            }
            if($.trim($('#budget_for_each_influencer').val()) == "") {
                isAjax = false;
                scrollTop();
                $('#budget_for_each_influencer').next('p').removeClass('d-none');
                return false;
            }
            var fileExtension = ['png', 'jpg', 'jpeg'];
            if( document.getElementById("image").files.length == 0 ) {
                isAjax = false;
                scrollTop();
                $('.error-thumbnail').removeClass('d-none');
                return false;
            }else if($.inArray(document.getElementById("image").files[0].type.split('/').pop().toLowerCase(), fileExtension) == -1){
                isAjax = false;
                error_notification_add('Select only jpg, jpeg and png files!');
                return false;
            }
            if(!$(":checkbox[name='is_video']", $(".create_campaign_form")).is(":checked")) {
                isAjax = false;
                scrollTop();
                $('.error-live-stream').removeClass('d-none');
                return false;
            }
            if($.trim($('#application_till_date').val()) == "") {
                isAjax = false;
                scrollTop();
                $('#application_till_date').next('p').removeClass('d-none');
                return false;
            }
            if($('#target_region').val() == "") {
                isAjax = false;
                $('.error-target-region').removeClass('d-none');
                return false;
            }
            if(getDataFromTheEditor() == "") {
                isAjax = false;
                $('.error-terms-condition').removeClass('d-none');
                return false;
            }
            if($('#traceable_link').val() == ""){
                isAjax = false;
                $('.error-traceable-link').removeClass('d-none');
                return false;
            } else if(!isValidURL($('#traceable_link').val())){
                isAjax = false;
                $('#traceable_link').next('p').removeClass('d-none');
                return false;
            }
            if(!$(":checkbox[name='campaign_is_active']", $(".create_campaign_form")).is(":checked")) {
                isAjax = false;
                $('.error-on-going').removeClass('d-none');
                return false;
            }
            if($('#application_start_date').val() == "") {
                isAjax = false;
                $('#application_start_date').next('p').removeClass('d-none');
                return false;
            }
            if(!$('#ongoing_yes').is(":checked") && $('#application_end_date').val() == "") {
                isAjax = false;
                $('#application_end_date').next('p').removeClass('d-none');
                return false;
            }
            var tillDate = new Date($('#application_till_date').val());
            var startDate = new Date($('#application_start_date').val());
            var endDate = new Date($('#application_end_date').val());
            if(startDate > tillDate){
                isAjax = false;
                error_notification_add('Start date is not greater then Accept Or Reject Till Date!');
                return false;
            }
            if(startDate > endDate){
                isAjax = false;
                error_notification_add('Select end date greater then start date!');
                return false;
            }
        }

        var nextStepNum = (currentStepNum + 1);
        var currentStep = $('.step.step-' + currentStepNum);
        var nextStep = $('.step.step-' + nextStepNum);
        var progressBar = $('#checkout-progress');
        $('.btn-prev').removeClass('disabled');
        $('#section'+currentStepNum).toggle();
        $('#section'+nextStepNum).toggle();
        if(nextStepNum == 4) {
            $(this).toggle();
            $('.btn-submit').toggle();
        }

        $('.checkout-progress').removeClass('.step-' + currentStepNum).addClass('.step-' + (currentStepNum + 1));

        currentStep.removeClass('active').addClass('valid');
        currentStep.find('span').addClass('opaque');
        currentStep.find('.fa.fa-check').removeClass('opaque');

        nextStep.addClass('active');
        progressBar.removeAttr('class').addClass('step-' + nextStepNum).data('current-step', nextStepNum);

        ajaxCall(isAjax);
    });

    var elm;
    function isValidURL(u){
        if(!elm){
            elm = document.createElement('input');
            elm.setAttribute('type', 'url');
        }
        elm.value = u;
        return elm.validity.valid;
    }

    $("#total_influencers_required, #amount").keyup(function(){
        var val             = parseFloat($("#total_influencers_required").val());
        var amount          = parseFloat($('#amount').val());
        var eachInfPrice    = parseFloat(amount / val);
        $('#budget_for_each_influencer').val(eachInfPrice.toFixed(2));
    });

    $('.btn-submit').on('click',function(){
        $('.error-sample-video, .error-fan-volume, .error-thumbnail, .error-live-stream, .error-target-region, .error-on-going, .error-terms-condition').addClass('d-none');
        $('#total_influencers_required, #budget_for_each_influencer, #application_till_date, #application_start_date, #application_end_date').next('p').addClass('d-none');

        var scrapInfArr     = $('#add_influencer').val();
        var normalInfArr    = $('#add_emails').val();
        $('.error-product').addClass('d-none');
        if(scrapInfArr.length <= 0 && normalInfArr.length <= 0) {
            isAjax = false;
            error_notification_add('Select atleat one influencer!');
            return false;
        }
        var currentStepNum    = $('#checkout-progress').data('current-step');
        $('#hidden_step_num').val(currentStepNum);
        var currentStep       = $('.step.step-' + currentStepNum);

        currentStep.removeClass('active').addClass('valid');
        currentStep.find('.fa.fa-check').removeClass('opaque');
        ajaxCall(true);
    });

    function ajaxCall(isAjax){
        if(isAjax){
            $('.loading').show();
            $('.loading').removeClass('d-none');
            var formData = new FormData($('.create_campaign_form')[0]);
            $.ajax({
                url: store_route,
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                complete: function(response) {
                    $('.loading').hide();
                    let res = response.responseJSON;
                    if ( res ) {
                        if ( res.status ) {
                            if(!res.is_edit)
                                $('#hidden_id').val(res.id)
                            if(res.step_num == 4) {
                                data_insert_notification(res.message);
                                setInterval(() => {
                                    window.location.href = res.redirect_url
                                }, 2000);
                            }
                        } else {
                            error_notification_add( res.message );
                        }
                    }
                },
                error: function (response) {
                    $('.loading').hide();
                    error_notification('Something went wrong!');
                }
            });
        }
    }

    function scrollTop(){
        $('html, body').animate({
            scrollTop: $("#checkout-progress").offset().top
        }, 1000);
    }

    $('.btn-prev').on('click', function() {

      var currentStepNum    = $('#checkout-progress').data('current-step');
      var prevStepNum       = (currentStepNum - 1);
      var currentStep       = $('.step.step-' + currentStepNum);
      var prevStep          = $('.step.step-' + prevStepNum);
      var progressBar       = $('#checkout-progress');

      $('.btn-next').removeClass('disabled');
      $('#section'+currentStepNum).toggle();
      $('#section'+prevStepNum).toggle();
      if(currentStepNum == 4){
        $('.btn-submit').toggle();
        $('.btn-next').toggle();
      }
      if(currentStepNum == 1) {
        return false;
      }
      if(prevStepNum == 1){
        $(this).addClass('disabled');
      }
      $('.checkout-progress').removeClass('.step-' + currentStepNum).addClass('.step-' + (prevStepNum));

      currentStep.removeClass('active');
      prevStep.find('span').removeClass('opaque');
      prevStep.find('.fa.fa-check').addClass('opaque');

      prevStep.addClass('active').removeClass('valid');
      progressBar.removeAttr('class').addClass('step-' + prevStepNum).data('current-step', prevStepNum);
    });

  /*=====================
  04. initalize select2 juery
  ==========================*/
  $(document).ready(function() {
    // select2
    $('.js-example-basic-single').select2();
    $('.js-example-basic-multiple').select2();

    $('#add_influencer').select2({
        minimumInputLength: 3,
        ajax: {
            url: api_url,
            data: function (params) {
                var query = {
                    search: params.term,
                }
                return query;
            },
            processResults: function (data) {
                $("#add_influencer").html('')
                if(data.status && data.searchData.length > 0){
                    $.each(data.searchData, function(key, value) {
                        $('#add_influencer').append(`<option value="${value.id}" data-img_url="${value.media_profile}">${value.nickname}</option>`);
                    });
                    $('#add_influencer').select2({
                        templateResult: formatState,
                        templateSelection: formatState
                    });
                }
            }
        }
    });

    // datepicker
    $('#application_start_date').bootstrapMaterialDatePicker({
      time: false,
      clearButton: true,
      minDate: new Date()
    });

    $('#application_end_date').bootstrapMaterialDatePicker({
      time: false,
      clearButton: true,
      minDate: new Date()
    });

    $('#application_till_date').bootstrapMaterialDatePicker({
      time: false,
      clearButton: true,
      minDate: new Date()
    });

  });

  function initProducts(clicked = false){
    $.ajax({
        url: all_products,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                $("#select_products").html('')
                if(response.status && response.products.length > 0){
                    $.each(response.products, function(key, value) {
                        $('#select_products').append(`<option value="${value.product_id}" data-img_url="${value.product_img}">${value.product_name}</option>`);
                    });
                    $('#select_products').select2({
                        templateResult: formatStateProducts,
                        templateSelection: formatStateProducts
                    });
                    if(clicked)
                        data_insert_notification('Product refreshed successfully and append it in dropdown!');
                }
            } else {
                // error_notification(response.message);
            }
        },
        error: function (response) {
            error_notification();
        }
    })
  }

  $('#btn_refresh').on('click', function() {
    initProducts(true);
  })

  function formatStateProducts (state) {
    if (!state.id) {
      return state.text;
    }

    var optionImg = $(state.element).attr('data-img_url');
    var $state = $(
      '<span class=""><img class="img-flag" height="40"/> <span></span></span>'
    );

    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").text(state.text);
    $state.find("img").attr("src", optionImg);

    return $state;
  };

  function formatState (state) {
    if (!state.id)
        return state.text;

    var optionImg   = $(state.element).attr('data-img_url');
    var $state      = $('<span class=""><img class="img-flag" /> <span></span></span>');

    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").text(state.text);
    $state.find("img").attr("src", optionImg);

    return $state;
}

  /*=====================
  05. initalize select2 juery
  ==========================*/

  'use strict';

  ( function ( document, window, index )
  {
      var inputs = document.querySelectorAll( '.inputfile' );
      Array.prototype.forEach.call( inputs, function( input )
      {
          var label	 = input.nextElementSibling,
              labelVal = label.innerHTML;

          input.addEventListener( 'change', function( e ){
              var fileName = '';
              if( this.files && this.files.length > 1 )
                  fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
              else
                  fileName = e.target.value.split( '\\' ).pop();

              if( fileName )
                  label.querySelector( 'span' ).innerHTML = fileName;
              else
                  label.innerHTML = labelVal;
          });

          // Firefox bug fix
          input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
          input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
      });
  }( document, window, 0 ));


  /*=====================
  05. custome js for chcek box
  ==========================*/


  $(document).on('click', '.check-only-one-sample-video', function() {
    $('.check-only-one-sample-video').not(this).prop('checked', false);
  });

  $(document).on('click', '.check-only-one-on-going', function() {
    var val = $(this).val();
    $('.campaign-end-date-portion').show();
    if(val == 1) $('.campaign-end-date-portion').hide();
    $('.check-only-one-on-going').not(this).prop('checked', false);
  });

  $(document).on('click', '.check-only-one-live-streaming', function() {
    $('.check-only-one-live-streaming').not(this).prop('checked', false);
  });

  $('#image').change(
    function () {
        var fileExtension = ['png', 'jpg', 'jpeg'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            isAjax = false;
            error_notification_add('Select only jpg, jpeg and png files!');
            return false;
        } else {
            const [file] = image.files
            if (file) {
                preview_image.src = URL.createObjectURL(file)
            }
          }
});
