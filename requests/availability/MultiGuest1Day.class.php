<?php

class MultiGuest1Day extends Request
{

    // private $subscription_key;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {
        
        $itineraries = "";
        
        $people = (int) $params['multi'] + 1;
        
        $i = 1;
        while ( $i <= $people) {
            $itineraries .= '{
                      "serviceId": ' . $params['serviceId'] . ',
                      "employeeId": null,
                      "employeeGenderId": null
                }';
            if ( $i != $people ) {
                $itineraries .= ',';
            }
            $i++;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://api-staging.booker.com/v5/realtime_availability/multiguest/1day/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer {$params['token']}",
            "Cache-Control: no-cache",
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}"
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '
        {
            "locationId": ' . $params['locationID'] . ',
            "fromDateTime": "' . $params['date'] . '",
            "itineraries": [
                ' . $itineraries . '
            ]
        }');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close ($ch);
        
        return $response;

    }

}