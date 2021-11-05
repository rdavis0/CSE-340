<?php
/**
 * This is the PHP Motors Controller
 */

 // Create or access session
 session_start();
 
require_once 'library/connections.php';
require_once 'model/main-model.php';
require_once 'library/functions.php';

$classifications = getClassifications();
// var_dump($classifications);
//     exit;

// Build navigation bar
$navList = buildNavList();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

if(isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action){
    case 'something':
        break;
    default:
        include 'view/home.php';
}
?>