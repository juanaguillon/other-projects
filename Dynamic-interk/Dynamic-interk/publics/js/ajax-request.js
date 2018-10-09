
var Ajax_request = function( data_ ){	
	
	this.data = data_	

}


Ajax_request.prototype.exec = function( ){
	var ajax_default = {
		url: 'admin-ajax.php',
		type: 'post'			
	}

	var all_ajax = Object.assign( ajax_default, this.data );	
	jQuery.ajax( all_ajax );

}

function capitalizeFirstLetter( str ){
	return str[0].toUpperCase() + str.slice( 1 );
}
