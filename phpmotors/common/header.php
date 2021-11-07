<header class='site-header'>
    <div class='site-logo'>
        <img src="/phpmotors/images/site/logo.png" alt="php motors logo">
    </div>
    <div class='header-right'>
    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
            echo "<a href='/phpmotors/accounts'>{$_SESSION['clientData']['clientFirstname']}</a> | 
            <a href='/phpmotors/accounts/index.php?action=logout'>Log out</a>";
        } else {
            echo "<a href='/phpmotors/accounts/index.php?action=login'>My Account</a>";
        }
        ?>
    </div>
</header>
<nav class='site-nav'><?php echo $navList; ?></nav>

