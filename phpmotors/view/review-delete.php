<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Delete Review</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1>Delete <?php echo $carName; ?> Review</h1>
            <?php if(isset($message)) {
                    echo $message;
            }?>
            <p class='error'>Deleting a review is permanent. Are you sure you want to delete this review?</p>
            <form method='post' action='/phpmotors/reviews/' class='review-delete-form'>
                <label for='reviewText'>Your review</label><br>
                <span><?php echo $reviewDate; ?></span><br>
                <p name='reviewText' class='review-delete-text'><?php echo $reviewText; ?></p>
                <input type='submit' class='btn' value='Delete'>
                <a class='cancel-link' href='../accounts/'>Cancel</a>
                <input type='hidden' name='action' value='deleteReview'>
                <input type='hidden' name='reviewId' value=<?php echo $reviewId ?>>
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>