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
<!--    <link href='http://fonts.googleapis.com/css?family=Tenor+Sans&v1' rel='stylesheet' type='text/css'>-->
    <meta charset="utf-8">
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
    <?php
        $page = 'home';
        require_once 'includes/header.inc.php';
    ?>

    <div id="mainPage">
        <div id="mainTop">
            <img id="logo" src="imgs/logo.png" alt="Better Ways for Women">

            <div id="textBox">
                <p>Better ways for women was founded for the soul purpose of discovering and bringing about new ideas
                    and solutions to enhance a woman's needs. However, to do so with a more natural and organic
                    approach. Inspiration for our approach came from our general dissatisfaction and the lack of
                    improvements in women's care products and practices. Take a look for example at the feminine hygiene
                    products on the market today. Those combined with the accepted practices for women's hygiene haven’t
                    changed in decades and their effectiveness left quite a bit to be desired from our point of view. So
                    in response to that, Better Ways For Women developed evarra&trade;. Evarra&trade; is the most innovative and
                    effective device ever created to help women achieve new levels in feeling ultimately the cleanest
                    and freshest they can, and doing so without the use of any chemicals whatsoever. From our research
                    most women rely on their fingers as their best means for vaginal cleansing so evarra&trade; was
                    specifically designed to be used in conjunction with and as an extension of the hand. Simply put, a
                    better way for women.
                </p>
               <p>Thank you for visiting our website, we invite you to skip ahead to our "products" page to get a more
                    in depth look at evarra. We hope you appreciate our approach to this and hopefully many more new and
                    great ideas. Thank you once again and come back soon!
                </p>
            </div>
        </div>
        <div id="mainBottom">
            <img id="evarraLogo" src="imgs/evarra_logo.png" alt="Evarra">
            <div id="images">
                <div id="imageLeft"><img src="imgs/photo_left.jpg" alt=""></div>
                <div id="imageCenter"><img src="imgs/photo_center.jpg" alt=""></div>
                <div id="imageRight"><img src="imgs/photo_right.jpg" alt=""></div>
            </div>

            <form id="mailingListForm" action="sendMail.php" method="post">
                <label for="email">JOIN OUR MAILING LIST</label>
                <input type="email" name="email" id="email">
                <button type="submit" id="signUpBtn">Sign Up</button>
            </form>
            <div id="evarraText">
                <h3>Evarra, the evolution of feminine cleanliness</h3>
                <p>Evarra is the evolution of feminine cleanliness. No longer are women limited in their choices for vaginal hygiene...finally a new, safer and more effective option is available. Evarra is for women who desire frequent, safer and more intimate vaginal cleansing.</p>
            </div>
        </div>
        <?php
            require_once 'includes/footer.inc.php';
        ?>

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