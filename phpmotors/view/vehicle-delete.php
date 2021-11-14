<?php
// Check rights
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1) {
    header('Location: /phpmotors');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | <?php if (isset($invInfo['invMake'])) {
                            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        <main>
            <h1><?php if (isset($invInfo['invMake'])) {
                            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
            <p>Confirm vehicle deletion. This cannot be undone.</p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form class='add-vehicle-form' method="post" action="/phpmotors/vehicles/">
                <label>Make<br>
                    <input readonly name="invMake" id="invMake" 
                    <?php if (isset($invInfo['invMake'])) {
                            echo "value='$invInfo[invMake]'";} ?>>
                </label><br>
                <label>Model<br>
                    <input readonly name="invModel" id="model" 
                        <?php if (isset($invInfo['invModel'])) {
                            echo "value='$invInfo[invModel]'";} ?>>
                </label><br>
                <label>Description<br>
                    <textarea readonly name="invDesc" id="desc"><?php 
                        if (isset($invInfo['invDescription'])) {
                            echo $invInfo['invDescription'];} ?></textarea>
                </label><br>
                <input type="submit" class='btn' value="Delete Vehicle">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                            echo $invInfo['invId'];} ?>">
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</body>