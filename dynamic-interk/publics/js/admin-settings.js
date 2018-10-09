jQuery(function( $ ){
  var Element = new Elmt();
  var sett = new Sets($('.dyn_page_bd')); 

  // Botones en la seccion de "Propridad de paginas."
  function firsIn( ){
        
    $('.change_text').click(function () {
      
      var elm = $(this).prev('input');
      $(this).next('.cancel_text').remove();
      $(this).remove();
      sett.move_text(elm);
      return false;
    });    

    $('.cancel_text').click(function () {
      
      var elm = $(this).parent().children('input.dyn_input_change');
      $(this).prev('.change_text').remove();
      $(this).remove();
      sett.move_text(elm);
      return false;
    });
  }

  // Botones en la estructura secundaria.
  // Cancelar operacion y guardar.
  
  function sec_int( current ){

    function get_the_code( elem  ){

      var proccess = [
        Element.createElement( elem , {
          elem: 'code',
          class: 'dyn_val_str dyn_chance'
        })
      ];
      
      return Element.manyElements( proccess )
      
    }
    var current_value = $(current);
    $('.change_text').click(function () {     

      var elm = $(this).parent().children('input:text');
      $(this).parent().children('input:hidden').val( elm.val() );
      $(this).next('.cancel_text').remove();
      $(this).remove();  
      elm.after( get_the_code( elm.val() ) ); 
      elm.remove();  
      return false;
    });

    $('.cancel_text').click(function () {

      var elm = $(this).parent().children('input:text');
      $(this).prev('.change_text').remove();
      $(this).remove();
      elm.after( get_the_code( $(current_value).text() )); 
      elm.remove();        
      return false;
    });
  }

  sett.text_ajax();
  

  var prefEl = {
    button_save:  Element.createElement( Messages.save, {
      "elem": 'button',
      "class": 'button-save change_text'
    }),
    button_cancel: Element.createElement(Messages.cancel, {
      "class": "button-cc cancel_text",
      "elem": 'button'
    })    
  }
  
  Element.createCroqs( 'save_cancel', prefEl );  
  
  $('.dyn_page_bd').children(':text').change( function( ){

    if ( isNaN( parseInt( jQuery(this).val() ) ) ) {
      alert(Messages.noNumbers);
      $( this ).val('').focus();
      return;
    }          
    sett.move_text( this );    
  }); 
  
  if( $('.val_priority').length > 0 ){

    $('.val_priority').dblclick( function( ){
      
      
      sett.toInput(this, Element.getCroqs('save_cancel'), firsIn );     
    });
    
  }

  $('.dyn_val_str').dblclick( function( ){
    var objC = this;
    sett.inCode( this, Element.getCroqs( 'save_cancel'), function( ){
      sec_int( objC );
    } );
  })
  

  $('#dyn_submit_setter').click( function( ){
    document.form_insert_pages.submit();
  });
});