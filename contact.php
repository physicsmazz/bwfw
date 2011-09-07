<?php
require_once 'includes/config.inc.php';
try {

} catch (EmailException $e) {
    echo ("Error caught: {$e->getMessage()}");
}


?>

<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Better Ways for Women</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-ui-1.8.9.custom.css">
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
        $page = 'contact';
        require_once 'includes/header.inc.php'; ?>
            <form id="contactForm" action="sendMail.php">
                <div id="leftInput">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                    <label for="phone">Tel #</label>
                    <input type="text" name="phone" id="phone">
                </div>
                <div id="rightInput">
                    <label for="message" class="floatRight">Additional Information</label>
                    <textarea name="message" id="message"></textarea>
                </div>
                <div id="bottomInput">
                    <p id="contactMethodLabel">Preferred method of contact</p>
                    <input type="radio" name="contactType" id="byEmail" value="email"><label for="byEmail">email</label>
                    <br>
                    <input type="radio" name="contactType" id="byPhone" value="phone"><label for="byPhone">telephone</label>
                    <button id="sendBtn" type="submit">SEND</button>
                </div>
            </form>
<?php require_once 'includes/footer.inc.php'; ?>
 </div><!-- end container -->

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