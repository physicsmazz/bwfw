<?php
require_once 'includes/config.inc.php';

try {
//    $prodArr = $mysql->getProductsByCatId($catId);
//    $mattressSizeArr = $mysql->getSizesByCatId($catId);
//    $catInfo = $mysql->getCategoryInfo($catId);
//    $depthArr = $mysql->getDepth($catId);
} catch (EmailException $e) {
//    $php->error($e,'$e');
//    echo ("Error caught: {$e->getMessage()}");
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
    $page = 'product';
    require_once 'includes/header.inc.php'; ?>
        <div id="mainProd">
            <div id="prodDiv">
                <div id="imageDiv">
                    <img id="mainImage" src="" alt="Main Image">
                    <div id="imageViews">
                        <img src="" alt="small image"><img src="" alt="small image"><img src="" alt="small image">
                    </div>
                </div>
                <div id="textDiv">
                    <form id="addProductForm" action="">
                        <ul>
                            <li><a id="detailsLink" href="">Details</a></li>
                            <li><a id="reviewsLink" href="">Reviews</a></li>
                        </ul>
                        <p id="productDetails">
                        Product Details
                        </p>

                        <div id="colorSelector">
                            <img src="" alt=""><img src="" alt=""><img src="" alt="">
                        </div>
                        <label for="qty">Qty:</label>
                        <input type="text" name="qty" id="qty" value="1">
                        <br>
                        <button type="submit" id="addBtn">Add Product</button>
                </div>
            </div><!--end #prodDiv -->
</div> <!-- end #mainProd -->
<?php require_once 'includes/footer.inc.php'; ?>
 </div><!-- end container -->
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