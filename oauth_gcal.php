<?php
/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - ACF - OAUTH for Google Calendar
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🔌PLUGIN</strong> | ACF oAuth for Google Calendar
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

define( 'ANDYP_GCALOAUTH_PATH', __DIR__ );
define( 'ANDYP_GCALOAUTH_URL', plugins_url( '/', __FILE__ ) );
define( 'GCAL_GOOGLE_APPLICATION_CREDENTIALS', __DIR__.'/client_secret.json');
define( 'GCAL_GOOGLE_APPLICATION_SCOPE',       "https://www.googleapis.com/auth/calendar");
define( 'GCAL_GOOGLE_TRANSIENT_NAME',          "GCAL_OAUTH_REFRESH_TOKEN");


//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';


// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';


// ┌─────────────────────────────────────────────────────────────────────────┐
// │                                Initialise                               │
// └─────────────────────────────────────────────────────────────────────────┘
if (file_exists(ANDYP_GCALOAUTH_PATH. '/client_secret.json')) {
    new AndyP\oauth\gcal\gcal;
}