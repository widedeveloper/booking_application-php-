<?php

class FindTreatments extends Request
{
   
    public function __construct() {
        parent::__construct();
    }
    
    public function request() {   

        $body = '{
            "LocationID": '.$_SESSION["locationID"].',
            "CategoryID": null,
            "SubCategoryID": null,
            "EmployeeID": null,
            "AllowOnGiftCertificateSale": false,
            "UsePaging": true,
            "PageNumber": 1,
            "PageSize":100,         
            "ExcludeClassesAndWorkshops": true,
            "OnlyClassesAndWorkshops": true,
            "SkipLoadingRoomsAndEmployees": true,
            "DurationTypeID": null,
            "ExcludeCoupleServices": true,
            "ExcludeMembersOnly": true,
            "IncludeEmployeeTreatment": true,
            "RoomID": null,
            "BrandID": null,
            "access_token": "'.$_SESSION['access_token'].'"}
        }';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/treatments");
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