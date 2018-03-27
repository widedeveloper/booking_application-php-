<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('config/config.php');




try{   
    
    include('config/autoloader.php');
    
            $get_token = new Token();
            $_token = json_decode($get_token->request(), true);
         
            if ( !empty($_token['access_token']) ) {
                $token = $_token['access_token'];
                $_SESSION['access_token'] = $token;
            } else {
                // redirect the user
            }
        

        // Instantiate the class & process the request
        $process = new GetCustomer;
        $customer = json_decode($process->request(), true);
        if (!$customer['IsSuccess']){
            header("Location: /booking/myaccount.php");
        }
    
   // print_r($customer);
       
        $_SESSION['customerData'] = $customer['Customer']['Customer'];

        // var_dump($_SESSION['customerData']);
        
    
} catch ( Exception $e ) {
    $message['failure'] = $e->getMessage();
}