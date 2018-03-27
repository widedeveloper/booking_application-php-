<?php

class UpdateCustomer extends Request
{

    public function __construct() {
        parent::__construct();
    }

    public function request($params) {
       
        date_default_timezone_set('US/Eastern');
        $datearr= explode("/",$params['birthday']);
        $birthdate = $datearr[2] . "-" . $datearr[0] . "-" . $datearr[1];
        $birthdate = strtotime($birthdate)."000";
        $params['birthdate'] = "/Date(".$birthdate."-0400)/";       

       
        $body = '{
            "LocationID": '.$params['locationID'].',
            "FirstName": "'.$params['firstName'].'",
            "LastName": "'.$params['lastName'].'",
            "Email": "'.$_SESSION['customerData']['Email'].'",
            "CellPhone": "'.$params['phone'].'", 
            "DateOfBirth":"'.$params['birthdate'].'",
            "access_token":"'.$_SESSION['user_access_token'].'"
        }';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . '/v4.1/customer/customer/'.$_SESSION['customerData']['ID'].'');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        // curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close ($ch);

        return $response;
    }
    
}