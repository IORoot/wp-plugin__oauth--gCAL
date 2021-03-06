<?php

namespace AndyP\oauth\gcal\ajax;

class intercept_state
{


    public function __construct()
    {
        /**
         * Does a base64_decode on the $_REQUEST['state'] data.
         */
        add_action('init', array($this, '_decode_state'), 9);
    }


    /*
    * This is specifically for the GOOGLE OAUTH SERVER.
    *
    * It returns a 'state' parameter with a base64, json encoded array
    * of key-pairs that need to be added to the $_REQUEST array.
    *
    * Decodes Data from $state query arg and adds them to $_REQUEST. This must happen
    * before admin-ajax.php checks for the 'action' value.
    *
    */

    public function _decode_state()
    {
        if (!is_admin()  || !defined('DOING_AJAX') || !is_user_logged_in()) {
            return;
        }

        if (!isset($_REQUEST['state']) || !is_string($_REQUEST['state'])) {
            return;
        }

        $data = base64_decode($_REQUEST['state']);

        if (false === $data) {
            return;
        }

        $data = json_decode($data, true);

        if (!is_array($data)) {
            return;
        }

        $_REQUEST = array_merge($_REQUEST, $data);
    }


}