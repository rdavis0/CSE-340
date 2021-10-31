<?php
/**
 * This is the PHP Motors Accounts Controller
 */
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();
// var_dump($classifications);
//     exit;

// Build navigation bar
$navList = buildNavList();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

switch ($action){
    case 'login':
        include "../view/login.php";
        break;
    case 'registration':
        include "../view/register.php";
        break;
    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_STRING));
        // I opted not to trim password as the user may want spaces at the beginning or end of their pw
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_EMAIL);

        $clientEmail = checkEmail($clientEmail);
        $isValidPassword = checkPassword($clientPassword);
        
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($isValidPassword)){
            $message = '<p class="error">Please fill in empty fields</p>';
            include '../view/register.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Register client and check result of operation
        $regResult = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        
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
    case 'doLogin':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_STRING));
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_EMAIL);

        $clientEmail = checkEmail($clientEmail);
        $isValidPassword = checkPassword($clientPassword);

        if(empty($clientEmail) || empty($isValidPassword)){
            $message = '<p class="error">Please fill in empty fields</p>';
            include '../view/login.php';
            exit; 
        }
        break;
    default:
        break;
}
