<?php

namespace AndyP\oauth\gcal;


class gcal
{



    public function __construct()
    {



        /**
         * Initialise the custom ACF field type
         * oAuth Button for gCAL.
         */
        new \AndyP\oauth\gcal\acf\acf_gcal_oauth_button();



        /**
         * Google sends back a 'state' field with
         * the ajax eendpoint in it. We need to 
         * intercept this before it hits the endpoint,
         * parse it for an 'action' field and add
         * as a parameter.
         */
        new \AndyP\oauth\gcal\ajax\intercept_state();



        /**
         * Create the AJAX endpoints for Google to call
         * and the Javascript to access.
         */
        new \AndyP\oauth\gcal\ajax\oauth_callback();
        new \AndyP\oauth\gcal\ajax\reset_callback();
        new \AndyP\oauth\gcal\ajax\status_callback();


    }



}