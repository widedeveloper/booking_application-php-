<?php

/**
 * Set the configuration options.
 */

// Production Config
if ( $_SERVER['SERVER_NAME'] == 'yourDomain.com' ) {
    define('_API_BASE_DOMAIN', 'https://api.booker.com');
    define('_CLIENT_ID', 'your_clientID');
    define('_CLIENT_SECRET', 'your_clientID');
    define('_GRANT_TYPE', 'client_credentials');
    define('_SCOPE', 'customer');
    define('_SUBSCRIPTION_KEY', 'Subscription_key');
    define('_APPLICATION_FOLDER', '/booking');
    define('_PROJECT_PATH', $_SERVER['DOCUMENT_ROOT'] . _APPLICATION_FOLDER);
    // Set the time zone
    date_default_timezone_set('US/Eastern');
}
// Dev Config
else {
    define('_API_BASE_DOMAIN', 'https://api-staging.booker.com');
   define('_CLIENT_ID', 'your_clientID');
    define('_CLIENT_SECRET', 'your_clientID');
    define('_GRANT_TYPE', 'client_credentials');
    define('_SCOPE', 'customer');
    define('_SUBSCRIPTION_KEY', 'Subscription_key');
    define('_APPLICATION_FOLDER', '/booking');
    define('_PROJECT_PATH', $_SERVER['DOCUMENT_ROOT'] . _APPLICATION_FOLDER);
    // Set the time zone
    date_default_timezone_set('US/Eastern');
} 