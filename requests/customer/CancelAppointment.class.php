<?php

class CancelAppointment extends Request
{

    
    public function __construct() {
        parent::__construct();
    }

    public function request($params) {
       
        date_default_timezone_set('US/Eastern');   
        $body = '{
            "access_token": "'.$_SESSION["user_access_token"].'",
            "ID": '.$params["appointmentID"].',
            "SkipItemsForOtherAppointmentsInGroup": false,
            "CancellationReasonID": null,
            "ShowAppointmentIconFlags": true,
            "AppointmentCancellationType": {
              "ID": 1,
              "Name": "Full appointment value"
            },
            "RequireCancellationReason": false,
            "IncludeFieldValuesInResults": false
        }';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . '/v4.1/customer/appointment/cancel');
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