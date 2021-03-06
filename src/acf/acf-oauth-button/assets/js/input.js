(function($){
	
	
	/**
	*  initialize_field
	*
	*  This function will initialize the $field.
	*
	*  @date	30/11/17
	*  @since	5.6.5
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function initialize_field( $field ) {
		
		var $button = $field.find('.andyp-oauth__button-gcal');
		var $trash  = $field.find('.andyp-oauth__button-gcal--trash');

		/**
		 * Get the current status of the button.
		 */
		check_button_status($button, $trash);

		/**
		 * Event - Click button
		 */
		$button.on( 'click', function(){
            oauth_do_request($button, $trash);
		});

		/**
		 * Event - Click trash button
		 */
		$trash.on( 'click', function(){
            reset_transients($button, $trash);
		});
		
	}
	

	

	/**
	 * Opens new window
	 * 
	 * Uses ajax_object.auth_url which contains the URL from PHP.
	 */

	function oauth_do_request($button, $trash) {
		var $win = window.open( gcaloauth.auth_url, "_blank", "width=600,height=600" );
		wait_for_window_close($win, $button, $trash);
	}


	function wait_for_window_close($win, $button, $trash)
	{

		var check = setInterval( function() {

			// popup was closed
			if( $win.closed ) {

				// stop the check once window closed.
				clearInterval( check );

				// force a button check
				check_button_status( $button, $trash );

			}

		}, 500 );

	}




	/**
	 * Get current status from server.
	 */
	/**
	 * Get current status from server.
	 */
	function check_button_status($button, $trash){

		$.ajax({
			url 		: gcaloauth.ajax_url,
			dataType 	: 'json',
			data 		:	{
				action 			: 'gcal_status',
			}
		})

		.done( function( status ){

			if (status.data == true){
				$button.addClass('enabled');
				$button.html("Logged In");
				$trash.addClass('enabled');
			}

			if (status.data == false){
				$button.removeClass('enabled');
				$button.html("Login with gcal");
				$trash.removeClass('enabled');
			}

		} );
		

	}


	/**
	 * Trash button pressed
	 * 
	 * Reset the transients and updaate the button.
	 */
	function reset_transients($button, $trash)
	{
		$.ajax({
			url 		: gcaloauth.ajax_url,
			dataType 	: 'json',
			data 		:	{
				action 			: 'gcal_reset',
			}
		})

		.done( function( status ){

			if (status.data == true){
				$button.removeClass('enabled');
				$button.html("Login with gcal");
				$trash.removeClass('enabled');
			}

		} );
	}



	/*
	*  ready & append (ACF5)
	*
	*  These two events are called when a field element is ready for initizliation.
	*  - ready: on page load similar to $(document).ready()
	*  - append: on new DOM elements appended via repeater field or other AJAX calls
	*
	*  @param	n/a
	*  @return	n/a
	*/
	if( typeof acf.add_action !== 'undefined' ) {
		acf.add_action('ready_field/type=oAuthgcal', initialize_field);
		acf.add_action('append_field/type=oAuthgcal', initialize_field);

	}

})(jQuery);
