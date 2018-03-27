<?php

class Availability1Day extends Request
{
    
    // private $subscription_key;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {
        
        $curl = curl_init();
        $parameters = array(
            'LocationId' => $params['locationID'],
            'fromDateTime' => $params['date'],
            'IncludeEmployees' => 'true',
            'serviceId[]' => $params['serviceId'],
            'employeeId' => null,
            'employeeGenderId' => null,
        );
        $query = http_build_query($parameters);

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->api_base_domain . '/v5/realtime_availability/availability/1day?'.$query,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Authorization: Bearer ". $params["token"],
            "Ocp-Apim-Subscription-Key: " . $this->subscription_key,
          ),
        ));

        $response = curl_exec($curl);       
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response,true);
            echo json_encode($result);
        }
    
    }


}