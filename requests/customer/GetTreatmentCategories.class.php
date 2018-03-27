<?php

class GetTreatmentCategories extends Request
{

    // private $subscription_key;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->api_base_domain . '/v4.1/customer/treatment_categories?access_token='.$_SESSION["access_token"].'&location_id='.$_SESSION["locationID"].'&culture_name='.$_SESSION["cultureName"].'&excludeclassesandworkshops=false&isaddon=false&excludeMembersOnly=false',
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