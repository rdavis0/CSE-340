<?php
    if(!$_SESSION['loggedin']) {
        header('Location: /phpmotors');
    }
    $clientData = $_SESSION['clientData'];
    $clientFirstname = $clientData['clientFirstname'];
    $clientLastname = $clientData['clientLastname'];
    $clientEmail = $clientData['clientEmail'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Admin</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <?php if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
            }?>
            <h1><?php echo $clientFirstname . " " . $clientLastname; ?></h1>
            <p>You are logged in.</p>
            <?php
            echo "<ul>
                    <li>First name: {$clientFirstname}</li>
                    <li>Last name: {$clientLastname}</li>
                    <li>Email: {$clientEmail}</li>
                </ul>";
            ?>
            <h2>Account Management</h2>
            <p>Click below to update your account information or password</p>
            <p><a href='/phpmotors/accounts/index.php?action=updateView'>Update Account Information</a></p>
            <?php
                if($clientData['clientLevel'] > 1) {
                    echo "<h2>Inventory Management</h2>
                    <p>Click below to manage vehicle inventory</p>
                    <p><a href='/phpmotors/vehicles'>Vehicle Management</a></p>";
                }
            ?>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>

