<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Login</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'; ?>
        <main>
            <h1>Sign in</h1>
            <?php 
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                if (isset($message)) {
                    echo $message;
                }
            ?>
            <form method="post" action="/phpmotors/accounts/" class='sign-in-form'>
                <label>Email <br><input name='clientEmail' type='email' required
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
                </label><br>
                <label>Password <br><input name='clientPassword' type='password' id="pw" required
                    pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                </label><br>
                <p class='pw-req'>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</p>
                <input type="submit" class='btn sign-in-btn' value="Sign in">
                <input type="hidden" name="action" value="doLogin">
            </form>
            <p><a href="/phpmotors/accounts/index.php?action=registration">Not a member yet?</a></p>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>
</html>
