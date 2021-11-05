<?php
/**
 * This is the Vehicles Controller
 */

 // Create or access session
 session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../library/functions.php';

// var_dump($classifications);
//     exit;

// Build navigation bar
$navList = buildNavList();

// Get classif array
$classifications = getClassifications();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

switch ($action) {
    case 'addVehicleView':
        include "../view/add-vehicle.php";
        break;
    case 'addClassificationView':
        include "../view/add-classification.php";
        break;
    case 'addVehicle':
        $classificationId = filter_input(INPUT_POST, 'classifications', FILTER_SANITIZE_STRING);
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDesc = trim(filter_input(INPUT_POST, 'invDesc', FILTER_SANITIZE_STRING));
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
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
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
        
        // Check for missing data
        if(empty($classificationName)) {
            $message = '<p class="error">Please fill in empty fields</p>';
            include '../view/add-classification.php';
            exit; 
        }

        // Add classification and check result of operation
        $result = addClassification($classificationName);
        
        if($result === 1){
            $message = null;
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
