<?php
require_once 'includes/config.inc.php';
$type = $_GET['type'];
$catId = $_GET['category'];
switch($type){
    case 'mattress':
        $catId = 1;
        break;
    case 'crib encasements':
        $catId = 4;
        break;
    case 'travel solutions':
        $catId = 5;
        break;
    case 'student solutions':
        $catId = 6;
        break;
}

$mysql = new Mysql();
try {
    $prodArr = $mysql->getProductsByCatId($catId);
    $mattressSizeArr = $mysql->getSizesByCatId($catId);
    $catInfo = $mysql->getCategoryInfo($catId);
    $depthArr = $mysql->getDepth($catId);
} catch (EmailException $e) {
    $php->error($e,'$e');
    echo ("Error caught: {$e->getMessage()}");
}


//i need
//name, cat des, sizes, depths, cat long desc, cat large image

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
    <title>Best Price Bed Bug Mattress Covers Products Page</title>
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
<!--    <div id="thirdLine"></div>-->
    <div id="fourthLine"></div>
    <div id="shortLine"></div>
    <div id="innerContainer" class="productPage">
        <?php require_once 'includes/header.inc.php'; ?>
        <?php require_once 'includes/leftCol.inc.php'; ?>
        <div id="mainProd">
            <h3 class="scriptFont">Select a specific product below</h3>

            <div id="prodDiv">
                <?php
                    echo<<<HEREDOC
                <div class="prodType">
                    <div id="prodTop">
                        <img id="prodImageLarge" src="imgs/categories/{$catInfo['id']}_large.jpg" alt="{$catInfo['name']}">
                        <div id="prodPurchase">
                            <div id="itemName">{$catInfo['name']}</div>
                            <div id="itemDescription">Rest Ease Encasements feature their advanced barrier material technology and include the Stay Tight Sleep Tight closure system. These products offer complete protection against bed pests. Accurately measuring and using the correct encasement will ensure a proper fit and complete protection for those who matter.</div>
                            <div id="itemSelect">
                                <form id="prodForm">
HEREDOC;
                                    echo("<select name='size' id='size'><option value=''>Choose Your Mattress(s) Size</option>");
                                        foreach($mattressSizeArr as $mattressSize){
                                            echo ("<option value='{$mattressSize['name']}'>{$mattressSize['description']}</option>");
                                        }
                                    echo("</select>");
                                    echo("<select name='depth' id='depth'><option value=''>Choose Your Mattress(s) Depth</option>");
                                        foreach($depthArr as $depth){
                                            echo ("<option value='{$depth}'>{$depth}\"</option>");
                                        }
                                    echo("</select>");
                            ?>
                                    <input type="text" name="qty" id="qty" value="1">
                                    <label for="qty">Quantity</label>
                                    <br>
                                    <input type="hidden" name="catId" id="catId" value="<?php echo ($catInfo['id']); ?>">
                                    <button id="addToCartBtn" type="submit">Add To Cart</button>
                                </form>
                            </div>  <!-- end #itemSelect -->
                        </div> <!-- end #prodPurchase -->
                    </div> <!-- end #prodTop -->
                    <div id="prodBottom">
                        <?php 
                        echo ($catInfo['description_long']);
                        ?>
                   </div><!--end #prodBottom -->
                </div><!-- end#prodType -->
            </div><!--end #prodDiv -->
            <div id="peopleAlsoBought">
                <h3 class="scriptFont">People who bought this product also bought</h3>
                <ul>
                    <li><a href="products.php?category=3"><img src="imgs/categories/3.jpg" alt="Pillow Encasement">Pillow Encasement</a></li>
                    <li><a href="products.php?category=2"><img src="imgs/categories/2.jpg" alt="Box Spring Encasement">Box Spring Encasement</a></li>
                    <li><a href="products.php?category=5"><img src="imgs/categories/5.jpg" alt="Travel Solutions">Travel Solutions</a></li>
                </ul>
            </div><!-- end #peopleAlsoBought -->
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