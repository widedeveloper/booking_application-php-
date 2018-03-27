<?php

class DeleteIncompleteAppointment extends Request
{
  
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params ) {
        // This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
        require_once 'HTTP/Request2.php';

        $request = new Http_Request2($this->api_base_domain . '/v4.1/customer/appointment/deleteincomplete');
        $url = $request->getUrl();

        $headers = array(
            // Request headers
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->subscription_key,
        );

        $request->setHeader($headers);

        $parameters = array(
            // Request parameters
        );

        $url->setQueryVariables($parameters);

        $request->setMethod(HTTP_Request2::METHOD_DELETE);

        // Request body
        $request->setBody('{
          "LocationID": ' . $params['locationID'] . ',
          "IncompleteAppointmentID": ' . $params['IncompleteAppointmentID'] . ',
          "access_token": "' . $_SESSION['user_access_token'] . '"
        }');

        try
        {
            $response = $request->send();
            echo $response->getBody();
        }
        catch (HttpException $ex)
        {
            echo $ex;
        }
    }



}