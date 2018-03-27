<?php

class CreateCustomerAndUserAccount extends Request
{
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {
             
        date_default_timezone_set('US/Eastern');  

        $smsCheck = ($params['SMScheckedStatus'] == "checked")?'true':'false';
       
        // Birthdate is not required
        if ( !empty($params['birthday']) ) {
            $datearr= explode("/",$params['birthday']);
            $birthdate = $datearr[2] . "-" . $datearr[0] . "-" . $datearr[0];
            $birthdate = strtotime($birthdate)."000";
            $params['birthdate'] = "/Date(".$birthdate."-0400)/";
        } else {
            $params['birthdate'] = "";
        }

        $body = '{
            "Password": "' . $params['password'] . '",
            "FirstName": "' . $params['firstName'] . '",
            "LastName": "' . $params['lastName'] . '",
            "CellPhone": "' . $params['phone'] . '",
            "AllowReceiveSMS": '.$smsCheck.',
            "Email": "' . $params['email'] . '",
            "DateOfBirth": "' . $params['birthdate'] . '",
            "access_token": "' . $params['token'] . '",
            "LocationID": "' . $params['locationID'] . '"
        }';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/customer/account");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $err = curl_close ($ch);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        return $response;
        }
    }
 

}