<?php

class CreateAppointment extends Request
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function request($params) {

        date_default_timezone_set('US/Eastern');

        $datetime = strtotime($params['StartDateTime'])."000";


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

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_base_domain . "/v4.1/customer/appointment/create");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Cache-Control: no-cache",
            "Content-Type: application/json",
            "Ocp-Apim-Subscription-Key: {$this->subscription_key}",
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
            "ItineraryTimeSlotList": [{
                "CurrentPackagePrice": {
                    "Amount": 0,
                    "CurrencyCode": "' . $params['currencyCode'] . '"
                },
                "IsPackage": false,
                "PackageID": null,
                "StartDateTime": "/Date(' . $datetime . '-0400)/",
                "TreatmentTimeSlots": [{
                    "CurrentPrice": {
                        "Amount": 0,
                        "CurrencyCode": "' . $params['currencyCode'] . '"
                    },
                    "EmployeeID": null,
                    "StartDateTime": "/Date(' . $datetime . '-0400)/",
                    "TreatmentID": ' . $params['TreatmentId'] . ',
                    "Employee2ID": null,
                    "PrefferedStaffGender": null,
                    "EmployeeWasRequested": false
                }],
                "PrefferedStaffGender": null
            }],
            "AppointmentPayment": {
                "PaymentItem": {
                    "Method": {
                        "ID": 1
                    },
                    "CreditCard": {
                        "BillingZip": "' . $params['PostalCode'] . '",
                        "ExpirationDate": "'.$params['ExpirationDate'].'",
                        "NameOnCard": "' . $params['NameOnCard'] . '",
                        "Number": "' . $params['CardNumber'] . '",
                        "SecurityCode": "' . $params['SecurityCode'] . '",
                        "Type": {
                            "ID": "'.$params['CC_Type_ID'].'",
                            "Name": "'.$params['CC_Type'].'"
                        }
                    }
                },
                "CouponCode": null
            },
            "Customer": {
                "ID": '.$_SESSION['customerData']['ID'] .',
                "Address": {
                    "City": "",
                    "Country": {
                        "ID": 1,
                        "Name": ""
                    },
                    "State": "",
                    "Street1": "",
                    "Street2": "",
                    "Zip": ""
                },
                "DateOfBirth": null,
                "Email": "' . $_SESSION['customerData']['Email'] . '",
                "FirstName": "' . $_SESSION['customerData']['FirstName'] . '",
                "GenderID": null,
                "HomePhone": "' . $_SESSION['customerData']['CellPhone'] . '",
                "LastName": "' . $_SESSION['customerData']['LastName'] . '",
                "MobilePhone": "' . $_SESSION['customerData']['CellPhone'] . '",
                "MobilePhoneCarrierID": null,
                "PreferredCommunicationMethodID": null,
                "SendEmail": null,
                "SendSMS": null,
                "WorkPhone": "' . $_SESSION['customerData']['CellPhone'] . '",
                "CountryID": null
            },
            "Notes": "",
            "IncompleteAppointmentID": ' . $params['IncompleteAppointmentID'] . ',
            "LocationID": ' . $params['locationID'] . ',
            "access_token": "' . $_SESSION['user_access_token'] . '"
           
        }');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close ($ch);
        
        // Delete the user session
        $check = json_decode($response, true);
        if ( $check['IsSuccess'] == true ) {

        }
        
        return $response;
        
    }

}