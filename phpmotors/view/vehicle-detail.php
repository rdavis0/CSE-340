<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <?php 
        if($vehicle)
            $vehicleName = "$vehicle[invMake] $vehicle[invModel]"; 
            $invId = "$vehicle[invId]";
    ?>
    <title>PHP Motors | <?php if($vehicle) echo $vehicleName ?></title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1><?php if($vehicle) echo $vehicleName ?></h1>
            <?php 
                if(isset($message)){
                    echo $message; }
                if(isset($vehicleDetailsDisplay)){
                    echo $vehicleDetailsDisplay;
                }
                ?>
            <section class='reviews-section'>
                <h2>Customer Reviews</h2>
                <?php 
                if(isset($reviewsMessage)){
                    echo $reviewsMessage;
                } 
                // If logged in, show review form
                    if(isLoggedIn()) {
                        echo buildReviewForm($invId, $_SESSION['clientData']);
                    } else { // show login link
                        echo "<p>Please <a href='/phpmotors/accounts/index.php?action=login'>sign in</a> to leave a review.</p>";    
                    }
                // Show reviews if they exist
                    $reviews = getReviewsByInvId($invId);
                    if(empty($reviews)) { 
                        echo "<p>Be the first to write a review!</p>";
                    } else {
                        
                    }
                ?>
            </section>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>
<?php 
    unset($message);
    unset($reviewsMessage);
?>
