<?php

namespace AndyP\oauth\gcal\ajax;


class oauth_callback
{

    private $client;


    private $auth_token;


    private $refresh_token;


    /** 
     * AJAX Callback for completion of OAUTH.
     * 
     * Google will call this endpoint.
     * Sets up an AJAX callback by using a wp_ajax_
     * prefix on the action name.
     */
    public function __construct()
    {
        add_action( 'wp_ajax_gcaloauth', array($this, 'gcal_oauth') );
    }


    public function gcal_oauth() 
    {

        $this->auth_token = $_REQUEST['code'];
        $this->get_refresh_token();

        $output = '<div class="oauth__succeed">';

            $output .= '<h1>Request Succeeded</h1>';

            $output .= "<p>5min Auth Code = "  .$_REQUEST['code'] . "</p>";
            $output .= "<p>Callback Action = _wp_ajax_".$_REQUEST['action'] . "</p>";
            $output .=  "<p>State = ".$_REQUEST['state'] . "</p>";

            $data = base64_decode($_REQUEST['state']);
            $data = json_decode($data, true);
            $output .=  "<p>Data from State = ". $data['action'] . "</p>";
            
            $output .=  "<p>Scope = ".$_REQUEST['scope'] . "</p>";
            $output .=  "<p>Please now close this window.</p>";

        $output .= '</div>';

        echo $output;
    
        wp_die(); // this is required to return a proper response
        
    }


    private function get_refresh_token()
    {

        $client = new \AndyP\oauth\gcal\client\google_client();
		$this->client = $client->get_client();

        $this->client->authenticate($this->auth_token);

        $this->refresh_token = $this->client->getRefreshToken();

        set_transient( GCAL_GOOGLE_TRANSIENT_NAME, $this->refresh_token, WEEK_IN_SECONDS );

    }
}