<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <?php 
        if($vehicle)
            $vehicleName = "$vehicle[invMake] $vehicle[invModel]"; 
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
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>