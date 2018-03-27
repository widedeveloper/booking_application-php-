<?php

class ForgotPasswordCustom
{
    
    private $subscription_key;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request() {
        
        $body = '{
            "Email": "string",
            "Firstname": "string",
            "LocationID": 0,
            "BrandID": 0,
            "BaseUrlOfHost": "string",
            "SupressQueryString": true,
            "access_token": "string"
        }';
  
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/forgot_password/custom");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close ($ch);
        return $response;
        
    }

}