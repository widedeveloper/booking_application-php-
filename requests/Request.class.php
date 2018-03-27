<?php

// We need:
// - sudo pear install HTTP_Request2
// - apt-get php-pear install

class Request
{

    /** 
     * Protected variables.
     */
    protected $api_base_domain;
    protected $subscription_key;
    protected $grant_type;
    protected $client_id;
    protected $client_secret;
    protected $scope;
    
    public function __construct() {
        
        // Set parent config values
        $this->api_base_domain  = _API_BASE_DOMAIN;
        $this->subscription_key = _SUBSCRIPTION_KEY;
        $this->grant_type       = _GRANT_TYPE;
        $this->client_id        = _CLIENT_ID;
        $this->client_secret    = _CLIENT_SECRET;
        $this->scope            = _SCOPE;
    
    }


}