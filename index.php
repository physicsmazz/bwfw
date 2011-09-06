<?php
require_once 'includes/config.inc.php';
?>

<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
<head>
<link href='http://fonts.googleapis.com/css?family=Tenor+Sans&v1' rel='stylesheet' type='text/css'>    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Better Ways For Women - Feminine Products</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/libs/modernizr.min.js"></script>
<?php
require_once ('includes/analytics.inc.php');
    ?>
</head>
<body>
<div id="noJs">
    You must have JavaScript installed.
</div>
<div id="container">
<?php require_once 'includes/header.inc.php'; ?>

    <div id="mainPage">
        <aside id="leftCol">
        </aside>
        <article id="mainInfo">
            <h2>Evarra, the evolution of feminine cleanliness</h2>
            <p>Evarra is the evolution of feminine cleanliness. No longer are women limited in their choices for vaginal
                hygiene...finally a new, safer and more effective option is available. Evarra is for women who desire
                frequent, safer and more intimate vaginal cleansing.
            </p>
            <p>All too often existing "feminine hygiene" or "feminine cleanliness" products have mainly masked or merely
                perfumed over the symptoms of odor or discharge.
            </p>
            <p>Evarra was primarily developed to give women the option to clean deeper, more often and without the risks
                of many other products that are currently on the market.
            </p>
            <p>Lately we are learning more and more about the sensitive and intricate nature of vaginal secretions and their
                purpose in not only feminine health but for reproduction.
            </p>
            <p>Evarra is a specially designed device for removing mucus and other secretions that gather under the cervix in
                the vaginal canal. Typically these substances migrate down the vaginal canal and either exit the vagina and
                end up as discharge or in some cases pool(such as during sleep) and give women a clogged and less than fresh
                feeling. Before evarra it was difficult and frustrating to try to remedy these conditions. Now with evarra
                it is quick, safe and easy to achieve new levels of vaginal cleanliness.
            </p>
        </article>
        <article id="comingSoon">
            <h3>Please be patient while we get our site up and running.</h3>
            <h4>Enter your email below to sign up for our mailing list.</h4>
            <form action="sendMail.php" method="post">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
                <button type="submit" id="signUpBtn">Sign Up</button>
            </form>
        </article>
        <img id="evarraLogo" src="imgs/evarra_logo.png" alt="Evarra">
    </div>

<?php
$admin = false;
$ui = false;
require_once('includes/jquery.inc.php');
?>
<script src="js/script.js"></script>

<!--[if lt IE 7 ]>
<script src="js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
<![endif]-->
</body>
</html>