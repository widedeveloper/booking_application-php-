<?php

class CreateItinerary extends Request
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {
        
        date_default_timezone_set('US/Eastern');

        $datetime = strtotime($params['StartDateTime']) . "000";
        
        if($params['creditCardType']!=""){
            $params['PostalCode'] = $_SESSION['customerData']['CustomerCreditCards'][$params['creditCardType']]['CreditCard']['Address']['Zip'];
            $params['ExpirationDate'] = $_SESSION['customerData']['CustomerCreditCards'][$params['creditCardType']]['CreditCard']['ExpirationDate'];
            $params['NameOnCard'] = $_SESSION['customerData']['CustomerCreditCards'][$params['creditCardType']]['CreditCard']['NameOnCard'] ;
            $params['CardNumber'] =  $_SESSION['customerData']['CustomerCreditCards'][$params['creditCardType']]['CreditCard']['Number'] ;
            $params['SecurityCode'] = $_SESSION['customerData']['CustomerCreditCards'][$params['creditCardType']]['CreditCard']['SecurityCode'];
            $params['CC_Type'] = $_SESSION['customerData']['CustomerCreditCards'][$params['creditCardType']]['CreditCard']['Type']['Name'];
            $params['CC_Type_ID'] = $_SESSION['customerData']['CustomerCreditCards'][$params['creditCardType']]['CreditCard']['Type']['ID'];
       
        } else {
            $exp_date= explode("/",$params['ExpDate']);
            $expdate = $exp_date[1]."-".$exp_date[0]."-00";
            $expdate = strtotime($expdate)."000";
            $params['ExpirationDate'] = "/Date(".$expdate."-0400)/";
        }
        
        $guest_json = "";
        $guestsCount = count($params['guests']);
   
       
        $i = 0;
        foreach ( $params['guests'] as $guest ) {
         
            $guestname = explode("/",$guest);
           
            $guest_json .= '{
              "ID": null,
              "TreatmentID": ' . $params['TreatmentId'] . ',
              "EmployeeID": null,
              "Employee2ID": null,
              "IsStaffSelected": true,
              "StartDateTime": "/Date(' . $datetime . '-0400)/",
              "Guest": {
              "FirstName": "'.trim($guestname[0]).'",
              "LastName": "'.trim($guestname[1]).'",
                "Phone": "",
                "Email": "",
                "IsPrimaryPayer": false,
                "AllowReceiveEmails": true
              }
            }';
            
            if ( $i != $guestsCount - 1 ) {
                $guest_json .= ",";
            }
            
            $i++;
        }
        $body = '{
          "LocationID": ' . $params['locationID'] . ',
          "GroupName": "Amanu_",
          "ItineraryItems": [
            {
              "TreatmentID": ' . $params['TreatmentId'] . ',
              "EmployeeID": null,
              "Employee2ID": null,
              "IsStaffSelected": true,
              "StartDateTime": "/Date(' . $datetime . '-0400)/",
              "Guest": {
                "CustomerID": '.$_SESSION['customerData']['ID'] .',
                "ID": null,
                "FirstName": "'.$_SESSION['customerData']['FirstName'].'",
                "LastName": "'.$_SESSION['customerData']['LastName'].'",
                "Phone": "",
                "Email": "'.$_SESSION['customerData']['Email'].'",
                "IsPrimaryPayer": true,
                "AllowReceiveEmails": true,
                "HomePhone": "'.$_SESSION['customerData']['CellPhone'].'",
                "MobilePhone": "'.$_SESSION['customerData']['CellPhone'].'"
              }
            },
        ' . $guest_json . '
          ],
          "AppointmentPayment": {
            "PaymentItem": {
              "Method": {
                "ID": 1,
                "Name": "Credit Card"
              },
              "CreditCard": {
                "Type": {
                  "ID": '.$params['CC_Type_ID'].',
                  "Name": "'.$params['CC_Type'].'"
                },
                "Number": "' . $params['CardNumber'] . '",
                "NameOnCard": "' . $params['NameOnCard'] . '",
                "ExpirationDate": "'.$params['ExpirationDate'].'",
                "SecurityCode": "' . $params['SecurityCode'] . '",
                "BillingZip": "' . $params['PostalCode'] . '"
              },
              "Amount": {
                "Amount": 0,
                "CurrencyCode": ""
              }
            },
            "CouponCode": null
          },
          "access_token": "' . $_SESSION['user_access_token'] . '"
        }';
                  
      
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/itinerary/create");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Cache-Control" => "no-cache",
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close ($ch);
      
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

}