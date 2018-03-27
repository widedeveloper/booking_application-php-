<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../config/config.php');

try{
    include('../config/autoloader.php');

    if ( !empty($_POST['type']) ) {
        
        // Set the class
        $class = $_POST['type'];
        
        session_start();
        
        ### TODO: Token expiriry ###
        
        // Make sure we have a token
       /* if ( isset($_SESSION['access_token']) == false ) {
            $token = $_SESSION['access_token'];
        } else {*/
            // Token
            $get_token = new Token();
            $_token = json_decode($get_token->request(), true);
         
            if ( !empty($_token['access_token']) ) {
                $token = $_token['access_token'];
                $_SESSION['access_token'] = $token;
            } else {
                $message['failure'] = 'no token';
                echo json_encode($message);
                exit();
            }
            
       // }
        
        if ( $_POST['type'] == 'ForgotPassword' ) {
            $params['firstname'] = $_POST['firstname']; 
            $params['email'] = $_POST['email']; 
        }
                
        // Set the request params
        $params = $_POST;
        $params['token'] = $token;
        
        ### TODO: Session/cache location IDs ###
        
        // Find locations
        $get_locations = new FindLocations();
        $_locations = $get_locations->request($params);
        $_locations = json_decode($_locations, true);
        // print_r($_locations); exit();
        // foreach ( $_locations['Results'] as $_location ) {
        //     $location_ids[] = $_location['ID'];
        // }

        $CurrencyCode = $_locations['Results'][0]['CurrencyCode'];
        $cultureName = $_locations['Results'][0]['CultureName'];
        $location_id = $_locations['Results'][0]['ID'];

        $params['locationID'] = $_SESSION['locationID']= $location_id;
        $params['currencyCode'] = $CurrencyCode;
        $params['cultureName'] = $_SESSION['cultureName']= $cultureName;     

        
        // Instantiate the class & process the request
        $process = new $class();
        $response = $process->request($params);
        
        if ( is_array($response) ) {
            echo json_encode($response);
            exit();
        }
        
        echo $response;
        exit();

    } else {
        $message['failure'] = 'missing type';
        echo json_encode($message);
        exit();
    }
    
} catch ( Exception $e ) {
    $message['failure'] = $e->getMessage();
    echo json_encode($message);
    exit();
}