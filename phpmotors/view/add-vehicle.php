<?php 
    // Check rights
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1) {
        header('Location: /phpmotors');
    }

    // Build classification list 
    $classificationList = "<label>Classification<br>
        <select id='classifications' name='classifications'>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'";
        if(isset($classificationId)){
            if($classification['classificationId'] === $classificationId) {
                $classificationList .= ' selected ';
            }
        }
        $classificationList .= ">$classification[classificationName]</option>";
    }
    $classificationList .= "</select>";
?><!DOCTYPE html>
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
                    <input type="text" name="invMake" id="make" required
                    <?php if(isset($invMake)){echo "value='$invMake'";}  ?>>
                </label><br>
                <label>Model<br>
                    <input type="text" name="invModel" id="model" required
                    <?php if(isset($invModel)){echo "value='$invModel'";}  ?>>
                </label><br>
                <label>Description<br>
                    <textarea required name="invDesc" id="desc"><?php if(isset($invDesc)) echo $invDesc; ?></textarea>
                </label><br>
                <label>Price<br>
                    <input type='number' name="invPrice" id="price" required
                    <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>>
                </label><br>
                <label>Stock<br>
                    <input type='number' name="invStock" id="stock" required
                    <?php if(isset($invStock)){echo "value='$invStock'";}  ?>>
                </label><br>
                <label>Color<br>
                    <input type='text' name="invColor" id="color" required
                    <?php if(isset($invColor)){echo "value='$invColor'";}  ?>>
                </label><br>
                <input type="submit" class='btn' value="Add">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="addVehicle">
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>