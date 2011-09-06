<?php
require_once 'includes/config.inc.php';
$mysql = new Mysql();
try {
    $catArr = $mysql->getCategories();
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
    <title>Best Price Bed Bug Mattress Covers - Categories</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-ui-1.8.9.custom.css">
    <script src="js/libs/modernizr.min.js"></script>
<?php
//require_once ('includes/analytics.inc.php');
    ?>
</head>
<body>
<div id="noJs">
    You must have JavaScript installed.
</div>
<div id="container">
    <div id="topLine"></div>
    <div id="secondLine"></div>
    <div id="thirdLine"></div>
    <div id="fourthLine"></div>
    <div id="shortLine"></div>
    <div id="innerContainer" class="categoriesPage">
        <?php require_once 'includes/header.inc.php'; ?>
        <?php require_once 'includes/leftCol.inc.php'; ?>
        <div id="mainPage">
            <h3 class="scriptFont">Select a specific product below</h3>

            <div id="prodDiv">
                <?php foreach($catArr as $catId=>$category){
                    echo<<<HEREDOC
                <div class="prod">
                    <img src="imgs/categories/{$catId}.jpg" alt="{$category['name']}">
                    <div class="itemName">{$category['name']}</div>
                    <div class="itemPrice">Starting at \${$category['lowest_price']}</div>
                    <div class="itemSelect">
                        <a class="selectBtn" href="products.php?category={$catId}">SELECT</a>
                    </div>
                </div>
HEREDOC;
            } ?>

                <div id="restEaseText">
                 Rest Ease Encasements
                    <br>
Designed to place an impenetrable barrier between bed bugs and your mattress, our advanced material technology  is waterproof yet still completely breathable. It offers absolute bite proof protection against bed bugs and dust mites, and also acts as an allergen barrier limiting exposure to dust, dead skin, pet dander and pollen.
                    <br>
You can also rest assured with our Stay Tight Sleep Tight advanced closure technology, insuring complete protection for you and your mattress by completely sealing the encasement opening. This  system prevents bed bugs from entering or exiting the mattress encasement.
                    <br>
Rest Ease Encasements – Protection for those who matter.
                </div>
            </div>
        </div>


<?php require_once 'includes/footer.inc.php'; ?>
    </div>
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