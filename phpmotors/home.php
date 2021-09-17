<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <header>
            <?php require_once './common/header.php'; ?>
        </header>
        <nav id='nav'>
            <?php require_once './common/nav.php'; ?>
        </nav>
        <main>
            <h1>Welcome to PHP Motors!</h1>
            <section class='feature-list'>
                <h2>DMC Delorean</h2>
                <ul>
                    <li>3 Cupholders</li>
                    <li>Superman doors</li>
                    <li>Fuzzy dice!</li>
                </ul>
            </section>
            <figure class='delorean-img'>
                <img src="/phpmotors/images/delorean.jpg" alt="delorean">
            </figure>
            <button>Own Today</button>
            <section class='reviews'>
                <h1>DMC Delorean Reviews</h1>
                <ul>
                    <li>"So fast it's almost like travelin in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80s livin' and I love it!" (5/5)</li>
                </ul>
            </section>
            <section class='upgrades'>
                <h1>Delorean Upgrades</h1>
                <figure id='upgrade-flux'>
                    <img src="/phpmotors/images/upgrades/flux-cap.png">
                    <figcaption>Flux Capacitor</figcaption>
                </figure>
                <figure id='upgrade-decals'>
                    <img src="/phpmotors/images/upgrades/flame.jpg">
                    <figcaption>Flame Decals</figcaption>
                </figure>
                <figure id='upgrade-stickers'>
                    <img src="/phpmotors/images/upgrades/bumper_sticker.jpg">
                    <figcaption>Bumper Stickers</figcaption>
                </figure>
                <figure id='upgrade-hubcaps'>
                    <img src="/phpmotors/images/upgrades/hub-cap.jpg">
                    <figcaption>Hub Caps</figcaption>
                </figure>
            </section>
        </main>
        <footer id='footer'>
            <?php require_once './common/footer.php'; ?>
        </footer>
    </div>
</body>