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

## How to use in app

Once the OAUTH has been authenticated, a transient will be created like this for a week:

```php
set_transient( GCAL_GOOGLE_TRANSIENT_NAME, $this->refresh_token, WEEK_IN_SECONDS );
```

So to access the refresh_token, you can call the transient name and use it on a client object.

For the simplest setup and make a call, this example would work:

```php

public function get_events()
{

    // client
    $client  = new \Google_Client();
    $client->setAuthConfig(GCAL_GOOGLE_APPLICATION_CREDENTIALS);
    $client->addScope(GCAL_GOOGLE_APPLICATION_SCOPE);
    $client->setAccessType('offline');
    $client->setApiFormatV2(TRUE);
    $client->refreshToken(get_transient(GCAL_GOOGLE_TRANSIENT_NAME));

    //service
    $service = new \Google_Service_Calendar($client);
    $calendarId = 'primary';
    $optParams = array(
        'maxResults' => 10,
        'orderBy' => 'startTime',
        'singleEvents' => true,
        'timeMin' => date('c'),
    );

    // call
    $results = $service->events->listEvents($calendarId, $optParams);
    $events = $results->getItems(); 

}
```


## Changelog

- v 0.1.1
Updated to change transient length to 0.

- v 0.1.0 
Initial