<?php

class FindLocations extends Request
{
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {      
        
        $body = '{
          "UsePaging": true,
          "PageNumber": 1,
          "PageSize": 10,
          "SortBy": [
            {
              "SortBy": "Name",
              "SortDirection": 1
            }
          ],
          "BusinessName": null,
          "FeatureLevel": null,
          "BrandAccountName": null,
          "access_token": "' . $params["token"]. '",
          "BrandID": null
        }';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/locations");
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