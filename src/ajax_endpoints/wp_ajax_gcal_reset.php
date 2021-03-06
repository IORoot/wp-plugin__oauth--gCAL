<?php

namespace AndyP\oauth\gcal\ajax;


class reset_callback
{

    
    public function __construct()
    {
        /**
         * AJAX Callback used to clear all tokens.
         */
        add_action( 'wp_ajax_gcal_reset', array($this,'gcal_reset') );
    }


    public function gcal_reset() {
        delete_transient( GCAL_GOOGLE_TRANSIENT_NAME );
        wp_send_json_success( true, 200 );
        wp_die(); // this is required to return a proper response
    }

}


