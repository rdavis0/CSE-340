<head>
    <style>
        html {
            font-family: monospace;
            font-size: 32
        }
    </style>
</head>

<?php
    $my_password = "unbreak@ble";
    $hash1 = password_hash($my_password, PASSWORD_DEFAULT);
    
    $another_password = "easy1";
    $hash2 = password_hash($another_password, PASSWORD_DEFAULT);

    echo("User password <b>$my_password</b> was hashed:<br>$hash1 <br><br>");
    echo("User password <b>$another_password</b> was hashed:<br>$hash2");

?>