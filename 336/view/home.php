<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/session.php'; ?>
<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
    </head>
    <body>
        <div class="flex-container-home">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
            
            <div class="main_child">
                <main>
                    <h1>Welcome to Acme!</h1>
                    <div class="main_hero">
                        <ul>
                            <li><h2>Acme&nbsp;Rocket</h2></li>
                            <li>- Quick lighting fuse</li>
                            <li>- NHTSA approved seat belts</li>
                            <li>- Mobile launch stand included</li>
                            <li id="actionli"><a href="#"><img id="actionbtn" alt="Add to cart button" src="/images/site/iwantit.gif"></a></li>
                        </ul>
                    </div>
                    <div class="aside-container">
                    <aside class="aside2">
                    <h3>Acme Rocket Reviews</h3>
                        <ul>
                            <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                            <li>"That thing was fast!" (4/5)</li>
                            <li>"Talk about fast delivery." (5/5)</li>
                            <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                            <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                        </ul>
                    </aside>
                    <aside class="aside1">
                        <h3>Featured Recipes</h3>
                        <ul class="recipes-flex-container">
                            <li><img src="/images/recipes/bbqsand.jpg" alt="bbq sandwich"><a href="#">Pulled Roadrunner BBQ</a></li>
                            <li><img src="images/recipes/potpie.jpg" alt="pot pie"><a href="#">Roadrunner Pot Pie</a></li>
                            <li><img src="images/recipes/soup.jpg" alt="soup"><a href="#">Roadrunner Soup</a></li>
                            <li><img src="images/recipes/taco.jpg" alt="taco"><a href="#">Roadrunner Tacos</a></li>
                        </ul>
                    </aside>
                    </div>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
