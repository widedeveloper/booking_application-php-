<?php

class GetCustomerAppointments extends Request
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {       

        $from = "";
        $to = "";

        $curl = curl_init();
        $parameters = array(
            // Request parameters
            'count' => '10',
            'excludeEnrollmentAppointments' => 'False',
            'fromStartDate' => $from,
            'pageNumber' => '1',
            'toStartDate' => $to,
        );
        $query = http_build_query($parameters);

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->api_base_domain . '/v4.1/customer/customer/'.$_SESSION['customerData']['ID'].
          '/appointments?access_token='.$_SESSION['user_access_token'].
          '&only_active=false&includeDependentAppointments=true&onlyClasses=null&sortDirection=&sortBy=&'.$query,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Ocp-Apim-Subscription-Key: " . $this->subscription_key,
          ),
        ));

        $response = curl_exec($curl);       
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }
    
}