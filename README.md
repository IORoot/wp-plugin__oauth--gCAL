# OAUTH Google Google Calendar Implementation Plugin.

For Wordpress and ACF.

More info on the oAuth process here: https://ioroot.com/wordpress-oauth-and-ajax/  

## Dependencies
- [google-api-php-client](https://github.com/googleapis/google-api-php-client)
- google-api-php-client-services


More info at:                                                           
- https://dev.to/ioroot/google-oauth-wordpress-youtube-service-api-4ko6    
- https://ioroot.com/wordpress-oauth-and-ajax/                             
- https://github.com/IORoot/wp-plugin__oauth-demo        


## Credentials 
1. Make sure that you have downloaded the crendials json file from the google api console.
1. Saved it in the root of the project called client_secret.json
1. The .gitignore is listing that file (so you don't add it to git!)
1. `define('GCAL_GOOGLE_APPLICATION_CREDENTIALS', __DIR__.'/client_secret.json');`

