<?php

class ResetPassword
{

    private $subscription_key;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request() {
    
        $body = '{
            "Key": "string",
            "Password": "string",
            "access_token": "string"
        }';
  
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/password/reset");
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