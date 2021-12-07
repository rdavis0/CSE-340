<?php

/**
 * Reviews Controller
 */

// Create or access session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';

// Build navigation bar
$navList = buildNavList();

// Get classif array
$classifications = getClassifications();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'addReview':
        break;
    case 'editReviewView':
        break;
    case 'updateReview':
        break;
    case 'deleteReviewView':
        break;
    case 'deleteReview':
        break;
    default:
        if($_SESSION['loggedin']) include "../view/admin.php";
        else include "../view/home.php";
        break;
}
