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
  
    $('.btn-next').on('click', function() {
      
      var currentStepNum = $('#checkout-progress').data('current-step');
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
      /*if(nextStepNum == 5){
        $(this).addClass('disabled');
      }*/
      $('.checkout-progress').removeClass('.step-' + currentStepNum).addClass('.step-' + (currentStepNum + 1));
      
      currentStep.removeClass('active').addClass('valid');
      currentStep.find('span').addClass('opaque');
      currentStep.find('.fa.fa-check').removeClass('opaque');
      
      nextStep.addClass('active');
      progressBar.removeAttr('class').addClass('step-' + nextStepNum).data('current-step', nextStepNum);
    });
    
    $('.btn-submit').on('click',function(){
      $('.btn-submit').toggle('disabled');
      $('.btn-prev').toggle();
      var currentStepNum = $('#checkout-progress').data('current-step');
      var currentStep = $('.step.step-' + currentStepNum);
      currentStep.removeClass('active').addClass('valid');
      currentStep.find('.fa.fa-check').removeClass('opaque');
    });
    
    $('.btn-prev').on('click', function() {
      
      var currentStepNum = $('#checkout-progress').data('current-step');
      var prevStepNum = (currentStepNum - 1);
      var currentStep = $('.step.step-' + currentStepNum);
      var prevStep = $('.step.step-' + prevStepNum);
      var progressBar = $('#checkout-progress');
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
    $('#js-add-influencer').select2({
      templateResult: formatState,
      templateSelection: formatState
    }); 
  
    // datepicker 
    $('#campaign-start-date').bootstrapMaterialDatePicker({
      time: false,
      clearButton: true
    });
  
    $('#campaign-end-date').bootstrapMaterialDatePicker({
      time: false,
      clearButton: true
    });
  
    $('#application_date').bootstrapMaterialDatePicker({
      time: false,
      clearButton: true
    });

  });
  
  function formatState (state) {
    if (!state.id) {
      return state.text;
    }
  
    var baseUrl = "/assets/images/icon/";
    var $state = $(
      '<span class=""><img class="img-flag" /> <span></span></span>'
    );
  
    // Use .text() instead of HTML string concatenation to avoid script injection issues
    $state.find("span").text(state.text);
    $state.find("img").attr("src", baseUrl + "/" + state.element.value.toLowerCase() + ".png");
  
    return $state;
  };
  
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
  
          input.addEventListener( 'change', function( e )
          {
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
  
  
  $(document).on('click', '.check-only-one', function() {      
    $('input[type="checkbox"]').not(this).prop('checked', false);      
  });
  
  
  
  /*=====================
  05. initalize ck editor jquery
  ==========================*/
  
  ClassicEditor
  .create( document.querySelector( '#editor' ))
  .catch( error => {
      console.error( error );
  });
  