<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | <?php if($vehicle) echo $vehicleName ?></title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1><?php echo $vehicleName ?></h1>
            <?php 
                if(isset($message)) echo $message; 
                if(isset($vehicleDetailsDisplay)) echo $vehicleDetailsDisplay; 
                ?>
            <section class='reviews-section'>
                <h2>Customer Reviews</h2>
                <?php 
                    if(isset($_SESSION['reviewsMessage'])) echo $_SESSION['reviewsMessage'];
                    if(isset($reviewForm)) echo $reviewForm;
                    if(isset($reviewsDisplay)) echo $reviewsDisplay;
                    else echo "<p class='first-review-prompt'>Be the first to write a review.</p>";
                ?>

            </section>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>
<?php 
    unset($message);
    unset($_SESSION['reviewsMessage']);
?>
