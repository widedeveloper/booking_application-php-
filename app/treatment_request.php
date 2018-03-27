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
        // Find locations
    $params['token'] = $token;
    $get_locations = new FindLocations();
    $_locations = $get_locations->request($params);
    $_locations = json_decode($_locations, true);       

    $_SESSION['currencyCode'] = $_locations['Results'][0]['CurrencyCode'];
    $_SESSION['cultureName'] = $_locations['Results'][0]['CultureName'];
    $_SESSION['locationID'] = $_locations['Results'][0]['ID']; 
    
    // Instantiate the class & process the request
    $process = new FindTreatments;
    $data = json_decode($process->request(),true);
    
    if($data['IsSuccess']){
        $response= array();
        foreach($data['Treatments'] as $item){
            if(!isset($response["".$item["Category"]['ID']])){
                $response["".$item["Category"]['ID']] = array();
                $response["".$item["Category"]['ID']]['Category']=$item['Category'];
                $response[''.$item["Category"]['ID']]['subCategory']= array();
            }
            $response[''.$item["Category"]['ID']]['subCategory'][] = array(
                'treatmentId'=> $item['ID'],
                'isActive'=>$item['IsActive'],
                'name'=> $item['Name'],
                'subcategoryId'=> $item['SubCategory']['ID'],
                'subcategoryName'=> $item['SubCategory']['Name']
            );
        }    

    }
    
    if(count($response)>0) {
        $_SESSION['treatments'] = $response;
    }        
    
} catch ( Exception $e ) {
    $message['failure'] = $e->getMessage();
}