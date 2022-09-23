jQuery(function($){
 
	/*
	 * Load More
	 */
	$('#loadmore').click(function(){
 
		$.ajax({
			url : shop_loadmore_params.ajaxurl, // AJAX handler
           // dataType : "html",
			data : {
                
				'action': 'loadmorebutton', // the parameter for admin-ajax.php
				'query': shop_loadmore_params.posts, // loop parameters passed by wp_localize_script()
				'page' : shop_loadmore_params.current_page // current page
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				$('#loadmore').text('Loading...'); // some type of preloader
			},
			success : function( posts ){
                console.log(posts);
				if( posts ) {
                    
					$('#loadmore').text( 'More posts' );
					$('.shop_archive').append( posts ); // insert new posts
					shop_loadmore_params.current_page++;
 
					//if ( shop_loadmore_params.current_page == shop_loadmore_params.max_page ) 
						//$('#loadmore').hide(); // if last page, HIDE the button
 
				} else {
					$('#loadmore').hide(); // if no data, HIDE the button as well
				}
			}
		});
		return false;
	});
 
});