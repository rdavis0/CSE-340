<?php

/**
 * Reviews Controller
 */

// Create or access session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

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
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        if (empty($reviewText)) {
            $reviewsMessage = '<p class="error">Please add some review text.</p>';
            include '../view/vehicle-detail.php';
            exit;
        }

        // Add review and check result of operation
        $result = saveReview($clientId, $invId, $reviewText);

        if ($result === 1) {
            $reviewsMessage = "<p>Thank you for your review. You may view it below.</p>";
            include '../view/vehicle-detail.php';
            exit;
        } else {
            $message = "<p class='error'>Whoops! Couldn't save the review. Please try again.</p>";
            include '../view/vehicle-detail.php';
            exit;
        }
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
