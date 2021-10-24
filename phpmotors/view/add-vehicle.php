<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Add Vehicle</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1>Add Vehicle</h1>
            <p>All fields are required</p>
            <?php 
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <form class='add-vehicle-form' method="post" action="/phpmotors/vehicles/index.php">
                <?php echo $classificationList; ?></label><br>
                <label>Make<br>
                    <input type="text" name="invMake" id="make"></label><br>
                <label>Model<br>
                    <input type="text" name="invModel" id="model"></label><br>
                <label>Description<br>
                    <textarea name="invDesc" id="desc"></textarea></label><br>
                <label>Price<br>
                    <input type='number' name="invPrice" id="price"></label><br>
                <label>Stock<br>
                    <input type='number' name="invStock" id="stock"></label><br>
                <label>Color<br>
                    <input type='text' name="invColor" id="color"></label><br>
                <input type="submit" class='btn' value="Add">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="addVehicle">
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>