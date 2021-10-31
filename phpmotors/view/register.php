<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Register</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1>Register</h1>
            <p>All fields are required</p>
            <?php 
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <form class='register-form' method="post" action="/phpmotors/accounts/index.php">
                <label>First Name <br>
                    <input type="text" name="clientFirstname" id="fname" required
                        <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>>
                </label><br>
                <label>Last Name <br>
                    <input type="text" name="clientLastname" id="lname" required
                    <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>>
                </label><br>
                <label>Email <br>
                    <input type='email' name="clientEmail" id="email" required
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
                </label><br>
                <label>Password <br>
                    <input type='password' name="clientPassword" id="pw" required
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                </label><br>
                <p class='pw-req'>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</p>
                <input type="submit" class='btn register-btn' value="Register">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="register">
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>