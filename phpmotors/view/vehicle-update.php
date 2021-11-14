<?php
// Check rights
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1) {
    header('Location: /phpmotors');
}

// Build classification list 
$classificationList = "<label>Classification<br>
        <select id='classifications' name='classifications'>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
        }
    } elseif(isset($invInfo['classificationId'])) {
        if($classification['classificationId'] === $invInfo['classificationId']) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= "</select>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | <?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                            echo "Modify $invInfo[invMake] $invInfo[invModel]";
                        } elseif (isset($invMake) && isset($invModel)) {
                            echo "Modify $invMake $invModel";
                        } ?></title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        <main>
            <h1>Modify Vehicle</h1>
            <p>All fields are required</p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form class='add-vehicle-form' method="post" action="/phpmotors/vehicles/index.php">
                <?php echo $classificationList; ?></label><br>
                <label>Make<br>
                    <input type="text" name="invMake" id="invMake" required 
                        <?php if(isset($invMake)){ echo "value='$invMake'"; } 
                            elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                </label><br>
                <label>Model<br>
                    <input type="text" name="invModel" id="model" required 
                        <?php if (isset($invModel)) { echo "value='$invModel'"; }
                            elseif(isset($invInfo['invModel'])) { echo "value='$invInfo[invModel]'"; }?>>
                </label><br>
                <label>Description<br>
                    <textarea required name="invDesc" id="desc"><?php 
                        if (isset($invDesc)) { echo $invDesc; } 
                            elseif(isset($invInfo['invDescription'])) { echo $invInfo['invDescription']; }?></textarea>
                </label><br>
                <label>Price<br>
                    <input type='number' name="invPrice" id="price" required 
                        <?php if (isset($invPrice)) { echo "value='$invPrice'";}
                            elseif(isset($invInfo['invPrice'])) { echo "value='$invInfo[invPrice]'"; }?>>
                </label><br>
                <label>Stock<br>
                    <input type='number' name="invStock" id="stock" required 
                        <?php if (isset($invStock)) { echo "value='$invStock'"; }
                            elseif(isset($invInfo['invStock'])) { echo "value='$invInfo[invStock]'"; }?>>
                </label><br>
                <label>Color<br>
                    <input type='text' name="invColor" id="color" required 
                        <?php if (isset($invColor)) { echo "value='$invColor'";}
                            elseif(isset($invInfo['invColor'])) { echo "value='$invInfo[invColor]'"; }?>>
                </label><br>
                <input type="submit" class='btn' value="Save">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                        elseif(isset($invId)){ echo $invId; } ?>">
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</body>