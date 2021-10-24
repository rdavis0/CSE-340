<?php
/**
 * This is the Vehicles Controller
 */
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';

$classifications = getClassifications();
// var_dump($classifications);
//     exit;

// Build a navigations bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])
    ."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
// echo $navList;
// exit;

// Build classification list 
$classificationList = "<label>Classification<br>
    <select id='classifications' name='classifications'>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value=$classification[classificationId]>$classification[classificationName]</option>";
}
$classificationList .= "</select>";


$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

switch ($action) {
    case 'addVehicleView':
        include "../view/add-vehicle.php";
        break;
    case 'addClassificationView':
        include "../view/add-classification.php";
        break;
    case 'addVehicle':
        $classificationId = filter_input(INPUT_POST, 'classifications');
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDesc = filter_input(INPUT_POST, 'invDesc');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');
        $invImage = "/images/no-image.png";
        $invThumb = "/images/no-image.png";
        
        // DEBUG echo $classificationId, $invMake, $invModel, $invDesc, $invPrice, $invStock, $invColor, $invImage, $invThumb;
        
        // Check for missing data
        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDesc) || 
            empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p class="error">Please fill in all fields</p>';
            include '../view/add-vehicle.php';
            exit; 
        }

        // Add vehicle and check result of operation
        $result = addVehicle($invMake, $invModel, $invDesc, $invImage, $invThumb, $invPrice, $invStock, $invColor, $classificationId);
        
        if($result === 1){
            $message = "<p>$invMake $invModel added to inventory</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p class='error'>Whoops! Couldn't add the vehicle. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }    
        break;
    case 'addClassification':
        $classificationName = filter_input(INPUT_POST, 'classificationName');
        
        // Check for missing data
        if(empty($classificationName)) {
            $message = '<p class="error">Please fill in empty fields</p>';
            include '../view/add-classification.php';
            exit; 
        }

        // Add classification and check result of operation
        $result = addClassification($classificationName);
        
        if($result === 1){
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p class='error'>Whoops! Couldn't add the registration. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }    
        break;
    default:
        include "../view/vehicle-management.php";
        break;
}
