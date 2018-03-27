<?php

class BookItinerary extends Request
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {
        
        $body = '{
            "GroupName": "Amanu_",
            "ID": ' . $params['groupId'] . ',
            "RequireCustomerAddress": false,
            "access_token": "' . $_SESSION['user_access_token'] . '"
        }';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/itinerary/{$params['groupId']}/book");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Cache-Control" => "no-cache",
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close ($ch);
      
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

}