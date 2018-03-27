<?php

class Login extends Request
{
    public function __construct() {
        parent::__construct();
    }

    public function request($params) {     
      
        $body = '{
          "LocationID": "' . $params['locationID'] . '",
          "Email": "' . $params['email'] . '",
          "Password": "' . $params['password'] . '",
          "BrandID": 0,
          "client_id": "' . $this->client_id . '",
          "client_secret": "' . $this->client_secret . '",
          "grant_type": ""
        }';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/customer/login");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close ($ch);
      
        $data = json_decode($response, true);
        $token = $data['access_token'];
        
        if ( !empty($token) ) {
            //Session                 
            $_SESSION['user_access_token'] = $token;  
            $_SESSION['timestamp'] =  (time() + $data['expires_in'])*1000;
            $_SESSION['customerID'] = $data['Customer']['CustomerID'];
            $_SESSION['pass'] = $params['password'];
            $message['result'] = 'success';

            return json_encode($message);
            exit();
        } else {
            $message['result'] = $data['error'];
            return json_encode($message);
        }       
    }

}