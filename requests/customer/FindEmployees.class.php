<?php

class FindEmployees
{
    
    private $subscription_key;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request() {    
       
        $body = '{
            "UsePaging": true,
            "PageNumber": 0,
            "PageSize": 0,
            "SortBy": [
                {
                "SortBy": "string",
                "SortDirection": "Ascending"
                }
            ],
            "IgnoreFreelancers": true,
            "OnlyIncludeActiveEmployees": true,
            "TreatmentID": 0,
            "LocationID": 0,
            "access_token": "string"
        }';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/employees");
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