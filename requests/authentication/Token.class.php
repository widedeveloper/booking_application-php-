<?php

class Token extends Request
{
    public function __construct() {
        parent::__construct();
    }
    
    public function request() {       

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v5/auth/connect/token");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/x-www-form-urlencoded",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type={$this->grant_type}&client_id={$this->client_id}&client_secret={$this->client_secret}&scope={$this->scope}");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
       
        curl_close ($ch);
        return $response;    
    }    
}