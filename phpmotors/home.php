<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>PHP Motors | Home</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>

<body>
    <div class='main-container'>
        <?php require_once './common/header.php'; ?>
        <?php require_once './common/nav.php'; ?>
        <main>
            <h1>Welcome to PHP Motors!</h1>
            <section class='above-the-fold'>
                <div class='feature-list'>
                    <h2>DMC Delorean</h2>
                    <ul>
                        <li>3 Cupholders</li>
                        <li>Superman doors</li>
                        <li>Fuzzy dice!</li>
                    </ul>
                </div>
                <figure class='delorean-img'>
                    <img src="/phpmotors/images/delorean.jpg" alt="delorean">
                </figure>
                <button class='btn own-today'>Own Today</button>
            </section>
            <div class='below-the-fold'>
                <section class='reviews'>
                    <h2>DMC Delorean Reviews</h2>
                    <ul>
                        <li>"So fast it's almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80s livin' and I love it!" (5/5)</li>
                    </ul>
                </section>
                <section class='upgrades'>
                    <h2>Delorean Upgrades</h2>
                    <div class='upgrade-list'>
                        <a href='#'>
                            <figure id='upgrade-flux'>
                                <div class='upgrade-container'>
                                    <img src="/phpmotors/images/upgrades/flux-cap.png" alt="">
                                </div>
                                <figcaption>Flux Capacitor</figcaption>
                            </figure>
                        </a>
                        <a href='#'>
                            <figure id='upgrade-decals'>
                                <div class='upgrade-container'>
                                    <img src="/phpmotors/images/upgrades/flame.jpg" alt="">
                                </div>
                                <figcaption>Flame Decals</figcaption>
                            </figure>
                        </a>
                        <a href='#'>
                            <figure id='upgrade-stickers'>
                                <div class='upgrade-container'>
                                    <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="">
                                </div>
                                <figcaption>Bumper Stickers</figcaption>
                            </figure>
                        </a>
                        <a href='#'>
                            <figure id='upgrade-hubcaps'>
                                <div class='upgrade-container'>
                                    <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="">
                                </div>
                                <figcaption>Hub Caps</figcaption>
                            </figure>
                        </a>
                    </div>
                </section>
            </div>
        </main>
        <?php require_once './common/footer.php'; ?>
    </div>
</body>