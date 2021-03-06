<?php

namespace AndyP\oauth\gcal\client;

class google_client
{


	/**
	 * The Google_Client object
	 *
	 * @var Google_Client
	 */
	private $client;


	/**
	 * auth_url
	 * 
	 * This holds the google URL to 
	 * make the request for an auth token.
	 *
	 * @var string
	 */
	private $auth_url;





	public function __construct()
	{
		$this->create_client();
		
	}


	public function get_client()
	{
		return $this->client;
	}

	public function get_auth_url()
	{
		return $this->auth_url;
	}



    /**
	 * google_client
	 * 
	 * Initialise and generate a new google_client object.
	 *
	 * @return void
	 */
	private function create_client()
	{


		/**
		 * Create new Google Client Object
		 */
		$this->client = new \Google_Client();


		/**
		 * Use the constant to set the Authentication
		 * Config.
		 */
		$this->client->setAuthConfig(GCAL_GOOGLE_APPLICATION_CREDENTIALS);


		/**
		 * Set the permissions we want to request from the user
		 */
		$this->client->addScope(GCAL_GOOGLE_APPLICATION_SCOPE);


		/**
		 * Needed to get refresh_token every time we make a request
		 */
		$this->client->setPrompt('consent'); 


		/**
		 * Use to get a refresh token.
		 */
		$this->client->setAccessType('offline');


		/**
		 * Turn on for better Errors.
		 */
		$this->client->setApiFormatV2(TRUE);
	}


	/**
	 * set_callback_action
	 * 
	 * The "action" parameter tells the admin-ajax.php system which 
	 * Action to run.
	 * In this case, the action "GCAL_oauth" which is defined
	 * as an AJAX endpoint in the /actions/oauth_callback.php file
	 * using the :
	 * 
	 * add_action( 'wp_ajax_GCAL_oauth', 'GCAL_oauth' );
	 * 
	 * action.
	 */

	public function set_ajax_callback_endpoint($ajax_method)
	{


		/**
		 * Set the action parmater to point to the ajax method.
		 * The 'action' is a URL parameter that will be
		 * passed in the request to GCAL.
		 */
		$args = array(
			'action' => $ajax_method,
		);


		/**
		 * Format the array so that it can be correctly
		 * passed in the request to the oAuth server.
		 */
		$state = base64_encode( json_encode( $args ) );


		/**
		 * Set the client to have this new action parameter.
		 */
		$this->client->setState($state);
	}





	public function create_authentication_url()
	{
		/**
		 * Create the Authentication URL based off the state and client
		 * details.
		 */
		$this->auth_url = $this->client->createAuthUrl();

    }
    

}