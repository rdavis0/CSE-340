<?php
/**
 * This is the PHP Motors Accounts Controller
 */
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';

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

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

switch ($action){
    case 'login':
        include "../view/login.php";
        break;
    case 'registration':
        include "../view/register.php";
        break;
    case 'register':
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');
        
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
            $message = '<p class="error">Please fill in empty fields</p>';
            include '../view/register.php';
            exit; 
        }

        // Register client and check result of operation
        $regResult = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
        
        if($regResult === 1){
            $message = "<p>Thanks for registering, $clientFirstname. Please use your email and password to log in.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p class='error'>Whoops! The registration failed. Please try again.</p>";
            include '../view/register.php';
            exit;
        }
        break;
    default:
        break;
}
