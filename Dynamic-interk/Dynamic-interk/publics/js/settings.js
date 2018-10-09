var Elmt = function () {
  this.structures = {};
  this.manyElements = function (elems) {

    if( elems == Array ){
      var allElm = '';
      for (var i = 0; i < elems.length; i++) {
        allElm += elems[i];
      }
      return allElm;

    }else if( typeof elems === 'object' && !Array.isArray( elems ) ){
      // Agregar en caso de ser un objeto.      
      var returned = '';
      for ( k in elems ){
        if( !elems.hasOwnProperty( k ) ) continue;

        returned += elems[ k ];
      }
      

      return returned;
    }
  }

  /**
   * Crear un mapeo de elementos previos para su futuro uso.
   * @param id : El nombre unico de la escrutura a usar
   * @param structure : La estructura que se usara, puede ingresar string o array
   */
  this.createCroqs = function (id, sctructure) {
    if (!(id in this.structures)) {
      var archive = '';

      if (sctructure === Array) {
        // If is a array

        archive = this.manyElements(sctructure);
      } else if (typeof sctructure == 'string') {
        // If is a string

        archive = sctructure;
      } else if (typeof sctructure == 'object') {


        // if is object (not array)
        for (var k in sctructure) {
          if (!sctructure.hasOwnProperty(k)) return;

          archive += sctructure[k];
        }
      }
      this.structures[id] = archive;
    }
  }

  /**
   * Obtener el mapeo previo de estrctura de elementos para su respectivo uso.
   * @param { string } id : Nombre unico de la escturura.
   */
  this.getCroqs = function (id) {
    if (this.structures.hasOwnProperty(id)) {
      return this.structures[id];
    }
  }
  /**
   * Devuelve un string de atributos html listos para agregar a un elemento HTML
   * 
   * @param {object} obj Attrs para implementar.
   * @param {strig} exc Elemento a ser exculuido. Generalmente al momento de ejecutar esta funcion, en el parametro obj, es necesario enviar tambien el elemento HTML envolvente. Y claramente, no es deseable llevar un atributo HTML elem con valor div. 
   */
  this.createAttrs = function (obj, exc) {
    var attrs = '';
    for (var k in obj) {
      if (!obj.hasOwnProperty(k)) continue;
      if (obj[k] == exc) continue;

      attrs += ' ' + k + '="' + obj[k] + '"';
    }
    return attrs;
  }

  this.createInput = function (attrs) {
    var html = '<input';
    html += this.createAttrs(attrs);
    html += ' >';
    return html;
  }

  this.createElement = function (content, attrs = {elem: 'div' }) {
    
    var element = '<' + attrs.elem;
    element += this.createAttrs(attrs, attrs.elem);
    element += ' >' + content + '</' + attrs.elem + '>';
    return element;

  }
}


// Funciones adicionales

function clickToAfter( ){
  
  if (jQuery('.ajax_page_selected').length > 0 ) {
    jQuery('#dyn_search_top_page').val('');
    // Si anteriormente se ha seleccioado la pagina topping, se removera
    if (jQuery('.dyn_topping_selected').length > 0) {
      jQuery('.dyn_topping_selected').remove();
    }
    var Elm = new Elmt;


    var select = jQuery('.ajax_page_selected'),
      props = {
        title: Elm.createElement(select.children('.dyn_ajax_title').text()),
        id: Elm.createInput({
          type: 'hidden',
          value: select.children('.dyn_ajax_id').val(),
          name: 'dynil_top_selected'
        })
      },
      allStr = Elm.createElement(Elm.manyElements(props), { class: 'dyn_topping_selected', elem: 'div' });

    jQuery('.dyn_topping_respond').after(allStr);

  }
  // Remover todo el contenido de la tabla de seleccion topping ( Despleglable de input text principal )
  jQuery('.dyn_topping_respond').empty();
}
/**
 * 
 * @param {elements} elements 
 * Clase principal de settings.
 */
var Sets = function (elements) {
  this.theElements = new Elmt();
  this.$el = jQuery(elements);

  this.defaults = {
    clicking: false,
    start: 0,
    cloneObject: null,
    elemLength: jQuery(elements).length,
    previus: false,
    nextius: false,
    test: 'first'

  }
  var objSets = this,
    theElems = this.theElements,
    defaults = objSets.defaults,
    vals = 0,
    recx = false,
    minVal = 0;

  this.mouseMove = function (direction = 'prev') {

    this.$el.mousedown(function () {

      if (defaults.elemLength < 2) {
        return;
      }

      objSets.defaults.clicking = true;

      var thatEl = jQuery(this);
      thatEl.prev().length > 0 ? defaults.previus = true : false;
      thatEl.next().length > 0 ? defaults.nextius = true : false;

      if (direction == 'prev' && defaults.previus) {
        objSets.defaults.start = jQuery(this).prev().position().top;

      } else if (direction == 'next' && defaults.nextius) {
        objSets.defaults.start = jQuery(this).next().position().top;
      }

      var cloned = objSets.defaults.cloneObject = jQuery(this).clone();

    });

    jQuery(document).mouseup(function () {

      defaults.clicking = false;

      var cloned = objSets.defaults.clicking;
      if (cloned != null) {
        // jQuery('.bd_clone').remove();
      }

    });

    this.$el.mousemove(function (e) {


      if (!objSets.defaults.clicking) return false;

      var cloned = objSets.defaults.cloneObject;

      cloned.css({
        "position": "absolute",
        "left": (e.pageX - (jQuery('#wpbody').offset().left) - (cloned.width() / 2)),
        "top": (e.pageY - (jQuery('#wpbody').offset().top) - (cloned.height() / 2))

      }).addClass('bd_clone').prop('disabled', true);
      jQuery(this).after(cloned);

      console.log(this);

      var ePage = e.pageY - (jQuery('#wpbody').offset().top),
        starting = objSets.defaults.start,
        dir = direction == 'prev' ? jQuery(this).prev() : jQuery(this).next();

      if (starting >= ePage && defaults.previus) {
        defaults.start = dir.position().top;
        console.log('box Changed');
      }
      console.log("|ePage| => " + ePage + " and |Starting| => " + starting);
    });
  } 

  /**
   * function Move Text
   * Se usara esta funcion para mover los elementos (paginas) seleccionadas en la seccion de settings de plugin, por medio de integers.
   */
  this.move_text = function (that) {

    var $that = jQuery(that);
    var int = $that.val()
    var op = {
      dir: 'after',
      parent: $that.parent(),

    }
    
    if (this.$el.children('.val_priority').length == 0) {

      op.parent.prependTo(jQuery('.dynil_setter_pages'));


    } else {

      var $elem = this.$el = jQuery('.dyn_page_bd'),
        childrens = $elem.children('.val_priority');
      childrens.each(function () {

        /**
         * Se comenzara un bucle para leer cada valor agregado previamente.
         * Buscar un valor de prioridad para ser ingresado una nueva prioridad.
         */

        // Elemento actual.
        op.th = jQuery(this);

        // Valor de prioridad actual
        op.th_int = parseInt(op.th.text());

        // Elemento padre actual
        op.th_parent = op.th.parent();

        // Pos (Posicion) de elemento padre actual
        var pos = {
          next: op.th_parent.next(),
          prev: op.th_parent.prev()
        }

        /**
         * Posicion de valores anteriores y siguientes
         */
        pos.next_children = pos.next.children('.val_priority');
        pos.prev_children = pos.prev.children('.val_priority');

        //  Si existe en un valor despues de el valor actual
        if (pos.next_children.length > 0) {
          // En caso que el valor a ingresar sea mayor o igual a el valor actual y adicionalmente que el siguiente valor, sea mayor a el valor a ingresar 
          if (int >= op.th_int && parseInt(pos.next_children.text()) >= int) {

            recx = op.th_parent;
            vals = parseInt(recx.children('.val_priority').text());

          } else if (int <= op.th_int && (parseInt(pos.prev.length) == 0 || parseInt(pos.prev_children.text() >= int))) {

            recx = op.th_parent;
            vals = parseInt(recx.children('.val_priority').text());
            op.dir = 'before';

          }
          // Si no existe un valor despues de el valor actual
        } else {
          /**
           * Aplicando en caso de el valor a ingresar sea menor a el valor actual
           */
          if (op.th_int < int) {
            recx = op.th_parent;
            vals = parseInt(recx.children('.val_priority').text());
          }

        }

      });

    }
    if (op.dir == 'after') {

      $that.parent().insertAfter(recx);

    } else if (op.dir == 'before') {

      $that.parent().insertBefore(recx);
    }
    
    $that.after(theElems.createElement(int, {
      'elem': 'span',
      'class': 'val_priority dyn_chance'
    }));
    
    $that.after(theElems.createInput({
      type: 'hidden',
      name: "priority_vals[]",
      value: int
    }));
    $that.remove();
  }

  this.toInput = function (elem, add, callback = function () { }) {
    var elem = jQuery(elem);
    elem.next('input[name="priority_vals[]"]').remove();
    var input = theElems.createInput({
      'value': elem.html(),
      'type': 'text',
      "class": 'dyn_input_change',
    });
    
    elem.after([input, add]);
    elem.remove();
    callback();

  }

  this.inCode = function (elm, add, callback = function () { }) {
    var this_el = jQuery(elm);
    var text = this_el.text();
    var inpt = theElems.createInput({
      "value": text,
      "type": 'text',
      "class": 'dyn_input_change'
    });
    this_el.after([inpt, add]);
    this_el.remove();
    callback();

  }

  /**
   * @since 1.0
   * Encargada de ejecutar el codigo ajax en la ventana modal, para que el usuario pueda seleccionar la pagina con menos busqueda para ser procesada.
   */
  this.text_ajax = function () {

    // Input text de busqueda
    var input = jQuery('#dyn_search_top_page');
    input.keypress(function(e){
      if (e.keyCode == 13) {
        e.preventDefault();
      }

    })
    input.keyup(function ( e ) { 
          
      
      // En caso de oprimir la tecla "borrar (bacspace)" o "escape", se borrara el contenido de la tabla
      if (e.keyCode == 8 || e.keyCode == 27 ){
        jQuery('.dyn_topping_respond').empty();
      }else if (e.keyCode == 40) {
        
        if (jQuery('.ajax_page_selected').length > 0) {
          var names_select = jQuery('.ajax_page_selected');
          names_select.next().toggleClass('ajax_page_selected');
          names_select.removeClass('ajax_page_selected');
        } else {
          jQuery('.dyn_topping_respond').children().first().toggleClass('ajax_page_selected');
        }

      } else if (e.keyCode == 38) {
        if (jQuery('.ajax_page_selected').length > 0) {
          var names_select = jQuery('.ajax_page_selected');
          names_select.prev().toggleClass('ajax_page_selected');
          names_select.removeClass('ajax_page_selected');
        }
      }else if( e.keyCode == 13){
        clickToAfter();
      }else{
        if (jQuery(this).val().length > 3) {
          /**
           * Creando la llamada ajax para regresar las paginas a seleccionar.
           */
          var reqs = new Ajax_request({
            data: {
              action: 'show_setting_page',
              name: input.val()
            },
            success: function (e) {
              if (jQuery('.dyn_topping_respond').children().length > 0) {
                jQuery('.dyn_topping_respond').empty();
              }
              jQuery('.dyn_topping_respond').append(e);
              objSets.process_the_ajax();
            }
          });
  
          reqs.exec();
        }

      }

    })


  }

  /**
   * Al momento de buscar las paginas, con fin de seleccionar la pagina prioritaria, se despeglara un menu de las paginas relacionadas, lo cual permitira ( con click, o enter ) seleccionar la pagina deseada.
   * Agregar funcionalidad en el momento de seleccionar la pagina prioritaria.
   * 
   * Tal como el mouseover o al oprimir teclas de direcciones, enter y escape.
   */
  this.process_the_ajax = function () {
    jQuery('.names_pages').hover(function () {
      
      jQuery('.ajax_page_selected').removeClass('ajax_page_selected');
      jQuery(this).addClass('ajax_page_selected');
      

    }).click(function(){
      clickToAfter();
      
    });
  }

}