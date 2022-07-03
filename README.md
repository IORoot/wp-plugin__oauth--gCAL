
<div id="top"></div>

<div align="center">

<div style="filter: invert(36%) sepia(76%) saturate(5503%) hue-rotate(217deg) brightness(97%) contrast(89%);">
<img src="https://cdn.jsdelivr.net/npm/@mdi/svg@6.7.96/svg/calendar-month.svg" style="width:200px;"/>
</div>

<h3 align="center">Google Calendar OAuth Button</h3>

<p align="center">
    New component for ACF. Connects to Google OAuth for access to Google Calendar.
</p>    
</div>

##  1. <a name='TableofContents'></a>Table of Contents


* 1. [Table of Contents](#TableofContents)
* 2. [About The Project](#AboutTheProject)
	* 2.1. [Built With / Dependencies](#BuiltWithDependencies)
	* 2.2. [Installation](#Installation)
* 3. [Usage](#Usage)
	* 3.1. [Credentials](#Credentials)
	* 3.2. [How to use in your app / plugin](#Howtouseinyourappplugin)
* 4. [Customising](#Customising)
* 5. [Contributing](#Contributing)
* 6. [License](#License)
* 7. [Contact](#Contact)
* 8. [Changelog](#Changelog)



##  2. <a name='AboutTheProject'></a>About The Project

Used to create a new ACF Component button that connects your account to Google Calendar via OAuth. 

For a deep-dive on the oAuth process within wordpress, check my blog post here: https://ioroot.com/posts/wordpress-oauth  

More info at:                                                           
- https://dev.to/ioroot/google-oauth-wordpress-youtube-service-api-4ko6    
- https://ioroot.com/wordpress-oauth-and-ajax/                             
- https://github.com/IORoot/wp-plugin__oauth-demo    

<p align="right">(<a href="#top">back to top</a>)</p>


###  2.1. <a name='BuiltWithDependencies'></a>Built With / Dependencies

This project was built with the following frameworks, technologies and software.

* [google-api-php-client](https://github.com/googleapis/google-api-php-client)
* [ACF Pro](https://advancedcustomfields.com/)
* [Composer](https://getcomposer.org/)
* [PHP](https://php.net/)
* [Wordpress](https://wordpress.org/)

<p align="right">(<a href="#top">back to top</a>)</p>



###  2.2. <a name='Installation'></a>Installation

These are the steps to get up and running with this plugin.

1. Clone the oauth repo into your wordpress plugin folder
```bash
git clone https://github.com/IORoot/wp-plugin__oauth--gCAL ./wp-content/plugins/gcal-oauth
```
1. Use Google API Console and create a new project. The project must include the "Google Calendar API".

1. Generate an "OAuth 2.0 Client ID".
    1. Authorised JavaScript origins = https://londonparkour.com
    1. Authorised redirect URIs = https://londonparkour.com/wp-admin/admin-ajax.php

    (replace for you own domains)

1. Download a credentials JSON file for the generated project.

1. Place the `client_secret.json` file into the root of the `./wp-content/plugins/gcal-oauth` folder. Make sure it's called `client_secret.json`.

1. Run `composer install` in the `./wp-content/plugins/gcal-oauth` folder to install dependencies.

1. Activate the plugin.

The `gcal-oauth` plugin is used to add a new ACF component that is a button to connect to the Google OAUTH servers.


<p align="right">(<a href="#top">back to top</a>)</p>

##  3. <a name='Usage'></a>Usage

This is a component only. You can use it with ACF panels or when using other plugins that require this component.

###  3.1. <a name='Credentials'></a>Credentials 
1. Make sure that you have downloaded the crendials json file from the google api console.
1. Saved it in the root of the project called client_secret.json
1. The .gitignore is listing that file (so you don't add it to git!)
1. `define('GCAL_GOOGLE_APPLICATION_CREDENTIALS', __DIR__.'/client_secret.json');`

###  3.2. <a name='Howtouseinyourappplugin'></a>How to use in your app / plugin

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


##  4. <a name='Customising'></a>Customising

None.

<p align="right">(<a href="#top">back to top</a>)</p>


##  5. <a name='Contributing'></a>Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue.
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



##  6. <a name='License'></a>License

Distributed under the MIT License.

MIT License

Copyright (c) 2022 Andy Pearson

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

<p align="right">(<a href="#top">back to top</a>)</p>



##  7. <a name='Contact'></a>Contact

Author Link: [https://github.com/IORoot](https://github.com/IORoot)

<p align="right">(<a href="#top">back to top</a>)</p>


##  8. <a name='Changelog'></a>Changelog

- v 0.1.1
Updated to change transient length to 0.

- v 0.1.0 
Initial
