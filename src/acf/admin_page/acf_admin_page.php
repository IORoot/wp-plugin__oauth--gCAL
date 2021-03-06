<?php

namespace AndyP\oauth\gcal\acf;

/**
 * Include ACF into plugin.
 * 
 */

class oauth_admin_page {

    public function __construct()
    {
        $this->create_child_menu();
    }

    private function create_child_menu()
    {
        // Create New Menu
        if( function_exists('acf_add_options_page') ) {
            
            $args = array(

                'page_title' => 'oAuth gCal',
                'menu_title' => '🔑 oAuth gCal',
                'menu_slug' => 'oauthgcal',
                'capability' => 'manage_options',
                'position' => '1',
                'parent_slug' => 'andyp',
                'icon_url' => 'dashicons-screenoptions',
                'redirect' => true,
                'post_id' => 'options',
                'autoload' => false,
                'update_button'		=> __('Update', 'acf'),
                'updated_message'	=> __("Options Updated", 'acf'),
            );

            /**
             * Create a new options page.
             */
            acf_add_options_sub_page($args);
            
        }
    }
}