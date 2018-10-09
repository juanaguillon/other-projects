Object.size = function( element ){

	var size = 0, key;

	for ( key in element ){
		if ( element.hasOwnProperty( key ) ){
			size++;
		}
	}

	return size;
		
}
var dyn_show_table = function( els, place , propy = {last_index: 'tr' , class_search: 'dyn_tr_second'} ){

	this.els = els;
	var tr_push = '',
			trcheck = 0;
	
	
	for ( var i in this.els ){

		var itm = this.els[i],
		 		incr = 0,
		 		tr_class;		 

		if( jQuery( place ).children().length > 0){
			if ( jQuery( place ).find( propy.last_index ).last().hasClass( propy.class_search ) ){			
				if ( trcheck == 0){
					tr_class = 'dyn_tr_first';
					trcheck = 1;
				}else{
					tr_class = 'dyn_tr_second';
					trcheck = 0;
				}
			}else{
				if ( trcheck == 0){
					tr_class = 'dyn_tr_second';
					trcheck = 1;
				}else{
					tr_class = 'dyn_tr_first';
					trcheck = 0;
				}
			}		
		}else{
			if ( trcheck == 0){
				tr_class = 'dyn_tr_first';
				trcheck = 1;
			}else{
				tr_class = 'dyn_tr_second';
				trcheck = 0;
			}
		}

		tr_push += '<tr class="' + tr_class + '">';
		
		for ( var val in itm ){

			if ( (Object.size( itm ) - 1) > incr ){
				tr_push += '<td class="dynil_result_list bortd">' + itm[val] + '</td>';
			}else{
				tr_push += '<td class="dynil_result_list">' + itm[val] + '</td>';
			}
			incr++
		}
		tr_push += '</tr>';		
	}		
	
	this.tr_ = tr_push;
	jQuery( place ).append( this.tr_ );

}

