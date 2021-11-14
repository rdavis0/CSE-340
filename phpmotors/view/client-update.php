<?php
    if (!$_SESSION['loggedin']) {
        header('Location: /phpmotors');
    }
    $clientData = $_SESSION['clientData'];
    $clientFirstname = $clientData['clientFirstname'];
    $clientLastname = $clientData['clientLastname'];
    $clientEmail = $clientData['clientEmail'];
    $clientId = $clientData['clientId'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Manage Account</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1>Manage Account</h1>
            <h2>Update Account</h2>
            <?php 
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <form class='account-update-form' method="post" action="/phpmotors/accounts/index.php">
                <label>First Name <br>
                    <input type="text" name="clientFirstname" id="fname" required
                        <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}?>>
                </label><br>
                <label>Last Name <br>
                    <input type="text" name="clientLastname" id="lname" required
                    <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>>
                </label><br>
                <label>Email <br>
                    <input type='email' name="clientEmail" id="email" required
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
                </label><br>
                <input type="submit" class='btn update-acct-btn' value="Update Info">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="clientId" value="<?php echo $clientId; ?>">
            </form>
            <h2>Update Password</h2>
            <?php 
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <form class='password-update-form' method="post" action="/phpmotors/accounts/index.php">
                <label>Password <br>
                    <input type='password' name="clientPassword" id="pw" required
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                </label><br>
                <p class='pw-req'>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</p>
                <p>Your current password will be changed.</p>
                <input type="submit" class='btn update-pwd-btn' value="Update Password">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updatePwd">
                <input type="hidden" name="clientId" value="<?php echo $clientId; ?>">
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>