<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Add Classification</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1>Add Classification</h1>
            <?php 
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <form class='add-classification-form' method="post" action="/phpmotors/vehicles/index.php">
                <label>Classification Name<br>
                    <input type="text" name="classificationName" id="classificationName"></label><br>
                <input type="submit" class='btn add-btn' value="Add">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="addClassification">
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>