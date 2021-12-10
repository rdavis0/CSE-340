<?php

/**
 * Accounts Controller
 */

// Create or access session
session_start();

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
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'login':
        include "../view/login.php";
        break;
    case 'registration':
        include "../view/register.php";
        break;
    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        // I opted not to trim password as the user may want spaces at the beginning or end of their pw
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $clientEmail = checkEmail($clientEmail);
        $isValidPassword = checkPassword($clientPassword);

        // Check for existing email
        $emailExists = checkExistingEmail($clientEmail);
        if ($emailExists) {
            $message = "<p class='error'>An account with that email already exists. Please log in.</p>";
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($isValidPassword)) {
            $message = '<p class="error">Please fill in empty fields</p>';
            include '../view/register.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Register client and check result of operation
        $regResult = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        if ($regResult === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering, $clientFirstname. Please use your email and password to log in.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p class='error'>Whoops! The registration failed. Please try again.</p>";
            include '../view/register.php';
            exit;
        }
        break;
    case 'doLogin':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $clientEmail = checkEmail($clientEmail);
        $isValidPassword = checkPassword($clientPassword);

        if (empty($clientEmail) || empty($isValidPassword)) {
            $message = '<p class="error">Please provide a valid email and password.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword'] ?? false);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="error">Please check your email and password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
    case 'logout':
        unset($_SESSION['loggedin']);
        session_destroy();
        header('Location: /phpmotors');
        exit;
    case 'updateView':
        include '../view/client-update.php';
        exit;
    case 'update':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_STRING));
        
        // Check if email was changed
        if($clientEmail != $_SESSION['clientData']['clientEmail']) {
            // Check email validity
            $clientEmail = checkEmail($clientEmail);

            // Check for existing email
            $emailExists = checkExistingEmail($clientEmail);
            if ($emailExists) {
                $message = "<p class='error'>An account with that email already exists. Please use a different email.</p>";
                include '../view/client-update.php';
                exit;
            }
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = '<p class="error">Please fill in empty fields</p>';
            include '../view/client-update.php';
            exit;
        }  
        
        $updateResult = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail);

        if ($updateResult === 1) {
            $_SESSION['message'] = "<p>The update was successful.</p>";
            $_SESSION['clientData'] = getClientById($clientId);
            header('Location: /phpmotors/accounts');
            exit;
        } else {
            $_SESSION['message'] = "<p class='error'>There was an error with the update. No values were changed. Please try again.</p>";
            header('Location: /phpmotors/accounts');
            exit;
        }
        exit;
    case 'updatePwd':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        
        $isValidPassword = checkPassword($clientPassword);

        // Check for errors
        if (!$isValidPassword) {
            $message = '<p class="error">The password was invalid. Please check the password requirements and try again.</p>';
            include '../view/client-update.php';
            exit;
        }  
        
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
        $updateResult = updateClientPw($clientId, $hashedPassword);

        if ($updateResult === 1) {
            $_SESSION['message'] = "<p>Password update was successful.</p>";
            $_SESSION['clientData'] = getClientById($clientId);
            header('Location: /phpmotors/accounts');
            exit;
        } else {
            $_SESSION['message'] = "<p class='error'>There was an error with the update. Password was not changed. Please try again.</p>";
            header('Location: /phpmotors/accounts');
            exit;
        }
        exit;
    default:
        include '../view/admin.php';
        break;
}
