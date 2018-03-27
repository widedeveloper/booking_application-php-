<?php

class CreateIncompleteAppointment extends Request
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {
      
        date_default_timezone_set('US/Eastern');
        $datetime = strtotime($params['startDatetime'])."000";
       
        $body = '{
            "LocationID": '.$params["locationID"].',
            "ItineraryTimeSlot": {
                    "StartDateTime": "/Date('.$datetime.'-0400)/",
                    "IsPackage": false,
                    "PackageID": null,
                    "CurrentPackagePrice": {
                    "Amount":  0.0,
                    "CurrencyCode": "USD"
                },
                "TreatmentTimeSlots": [
                    {
                        "TreatmentID": '.$params['serviceID'].',
                        "StartDateTime":"/Date('.$datetime.'-0400)/",                        
                        "Duration":  60,
                        "EmployeeID": null,
                        "Employee2ID": null,
                        "RoomID": null,
                        "PrefferedStaffGender": null,
                        "EmployeeWasRequested": false
                    }
                          ],
                "PrefferedStaffGender": null
            },
            "access_token": "' . $_SESSION['user_access_token'] . '"
        }';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/appointment/createincomplete");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Cache-Control: no-cache",
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close ($ch);
    
        $_response = json_decode($response, true);
        return $response;
    }
    
}