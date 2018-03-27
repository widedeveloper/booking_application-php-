<?php

class Logout extends Request
{

    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {
        
        if ( empty($_SESSION['user_access_token']) ) {
            $message['result'] = 'success';
            return $message;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/logout?access_token={$_SESSION['user_access_token']}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}"
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close ($ch);
        
        // Delete the user session
        $check = json_decode($response, true);
        if ( $check['IsSuccess'] == true ) {
            session_destroy();
        }
        
        return $response;


    }
}
