<?php
// Check rights
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1) {
    header('Location: /phpmotors');
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Manage Vehicles</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <script defer src="../js/inventory.js"></script>
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
        <main>
            <h1>Manage Vehicles</h1>
            <p><a href="/phpmotors/vehicles/index.php?action=addVehicleView">Add Vehicle</a></p>
            <p><a href="/phpmotors/vehicles/index.php?action=addClassificationView">Add Classification</a></p>
            <?php
                if (isset($message)) {
                    echo $message;
                }
                if (isset($classificationList)) {
                    echo '<h2>Vehicles By Classification</h2>';
                    echo '<p>Choose a classification to see those vehicles</p>';
                    echo $classificationList;
                }
            ?>
            <noscript>
                <p class='error'><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>