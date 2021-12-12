<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Edit Review</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1><?php echo $carName; ?> Review</h1>
            <?php 
                if(isset($message)) {
                    echo $message;
                }
                if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
            ?>
                <form method='post' action='/phpmotors/reviews/' class='review-edit-form'>
                    <label for='reviewText'>Your review - 
                    <?php echo $reviewDate; ?></label>
                    <textarea name='reviewText' id='reviewText' class='review-text-edit' required><?php echo $reviewText; ?></textarea><br>
                    <div class='buttons'>
                        <input type='submit' class='btn' value='Update'>
                        <a class='cancel-link' href='../accounts/'>Cancel</a>
                    </div>
                    <input type='hidden' name='action' value='updateReview'>
                    <input type='hidden' name='reviewId' value=<?php echo $reviewId ?>>
                </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>
<?php unset($_SESSION['message'])?>