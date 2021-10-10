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
            <form class='register-form'>
                <label>First Name <br><input></label><br>
                <label>Last Name <br><input></label><br>
                <label>Email <br><input type='email'></label><br>
                <label>Password <br><input type='password'></label><br>
                <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</p>
                <input type="submit" class='btn register-btn' value="Register">
            </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'; ?>
    </div>
</body>