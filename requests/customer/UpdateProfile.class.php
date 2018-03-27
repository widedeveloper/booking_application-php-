<?php

class UpdateProfile extends Request 
{

    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {
    
        $body = '{
            "LocationID": '.$params['locationID'].',
            "CustomerID": '.$_SESSION['customerData']['ID'].',
            "Email": "'.$_SESSION['customerData']['Email'].'",
            "NewPassword": "'.$params['password'].'",
            "OldPassword": "'.$_SESSION['pass'].'",
            "access_token": "'.$_SESSION['user_access_token'].'"
        }';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/customer/password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close ($ch);

        $result = json_decode($response,true);
        if($result['IsSuccess']){
            $_SESSION['pass'] = $params['password'];
        }
        return $response;
      
    }

}