<?php

namespace AndyP\oauth\gcal\ajax;


class status_callback
{

    
    public function __construct()
    {
        /**
         * AJAX Callback used to clear all tokens.
         */
        add_action( 'wp_ajax_gcal_status', array($this,'gcal_status') );
    }


    public function gcal_status() {
    
        if (get_transient(GCAL_GOOGLE_TRANSIENT_NAME) == false)
        {
            wp_send_json_success( false, 200 );
            wp_die();
        }
    
        wp_send_json_success( true, 200 );
        wp_die();
    }

}




