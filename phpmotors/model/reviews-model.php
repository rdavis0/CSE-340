<?php

/**
 *    Reviews Model
 */

// Insert a new review 
function saveReview($clientId, $invId, $reviewText) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
        VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Get reviews by inventory id
function getReviewsByInvId($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT reviews.reviewText, reviews.reviewDate, 
                CONCAT(SUBSTRING(clients.clientFirstname, 1, 1), clients.clientLastname) AS screenName 
            FROM reviews  
            INNER JOIN clients ON reviews.clientId = clients.clientId
            WHERE invId = :invId
            ORDER BY reviews.reviewDate DESC;';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

// Get reviews by client id
function getReviewsByClientId($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewDate, r.reviewId, r.invId,
        CONCAT(i.invMake, " ", i.invModel) AS carName
	    FROM reviews r 
	    INNER JOIN inventory i 
        ON r.invId = i.invId
        WHERE clientId = :clientId
        ORDER BY r.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

function getReviewById($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewDate, r.reviewText,  
        CONCAT(i.invMake, " ", i.invModel) AS carName
        FROM reviews r 
        INNER JOIN inventory i 
        ON r.invId = i.invId
        WHERE reviewId = :reviewId;';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $review;
}

function updateReview($reviewId, $reviewText) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText
        WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function deleteReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
?>