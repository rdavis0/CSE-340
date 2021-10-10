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
            <form class='sign-in-form'>
                <label>Email <br><input type='email'></label><br>
                <label>Password <br><input type='password'></label><br>
                <input type="submit" class='btn sign-in-btn' value="Sign in">
            </form>
            <p><a href="/phpmotors/accounts/index.php?action=register">Not a member yet?</a></p>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>