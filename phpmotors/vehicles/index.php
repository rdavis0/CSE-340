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
if ($action == NULL) {
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
        if (
            empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDesc) ||
            empty($invPrice) || empty($invStock) || empty($invColor)
        ) {
            $message = '<p class="error">Please fill in all fields</p>';
            include '../view/add-vehicle.php';
            exit;
        }

        // Add vehicle and check result of operation
        $result = addVehicle($invMake, $invModel, $invDesc, $invImage, $invThumb, $invPrice, $invStock, $invColor, $classificationId);

        if ($result === 1) {
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
        if (empty($classificationName)) {
            $message = '<p class="error">There was an error. Please check all fields and try again.</p>';
            include '../view/add-classification.php';
            exit;
        }

        // Add classification and check result of operation
        $result = addClassification($classificationName);

        if ($result) {
            $message = null;
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p class='error'>Whoops! Couldn't add the registration. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
        /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classifications', FILTER_SANITIZE_STRING);
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDesc = trim(filter_input(INPUT_POST, 'invDesc', FILTER_SANITIZE_STRING));
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $invImage = "/images/no-image.png";
        $invThumb = "/images/no-image.png";
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Check for missing data
        if (
            empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDesc) ||
            empty($invPrice) || empty($invStock) || empty($invColor)
        ) {
            $message = '<p class="error">There was an error. Please check all fields and try again.</p>';
            include '../view/vehicle-update.php';
            exit;
        }

        // Update vehicle and check result of operation
        $updateResult = updateVehicle($invMake, $invModel, $invDesc, $invImage, $invThumb, $invPrice, $invStock, $invColor, $classificationId, $invId);

        if ($updateResult) {
            $message = "<p>$invMake $invModel updated successfully.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles');
            exit;
        } else {
            $message = "<p class='error'>Whoops! Couldn't update the vehicle. Please check all fields and try again.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    case 'deleteVehicle':
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Delete vehicle and check result of operation
        $deleteResult = deleteVehicle($invId);

        if ($deleteResult) {
            $message = "<p>$invMake $invModel deleted successfully.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles');
            exit;
        } else {
            $message = "<p>Whoops! $invMake $invModel could not be deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
            include '../view/classification.php';
        }
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include "../view/vehicle-management.php";
        break;
}
