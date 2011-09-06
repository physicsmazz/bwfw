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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Best Price Bed Bug Mattress Covers</title>
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
    <div id="innerContainer"><?php
        $page = 'home';
        require_once 'includes/header.inc.php'; ?>
    <?php require_once 'includes/leftCol.inc.php'; ?>
    <div id="mainPage">
        <div id="rightColText">
            <h3>Bed Bugs and Mattresses</h3>
            <p>Discovering bed bugs on a mattress in your hotel or in your own home can be an unpleasant, even traumatic, experience. Sometimes the actual bed bugs are never seen, instead you may awake with a peculiar red rash that you regrettably discover is from bed bug bites. In either case bed bug sufferers usually seek the fastest, most effective solution to put this issue behind them and prevent it from ever happening again. At Best Price BedBug Mattress Covers we believe the answer is to use a mattress cover or encasement to put an impenetrable barrier between the intruders and your mattress.</p>
            <p>
                A number of health effects may occur due to bed bugs including skin rashes, psychological effects and allergic symptoms.
                Diagnosis involves both finding bed bugs and the occurrence of compatible symptoms. Treatment is otherwise symptomatic.
            </p>
            <p>A mattress encasement is so effective because it works on two levels. First it seals in any existing pests preventing further infestation. Second a mattress encasement also effectively seals your mattress against any additional pests attempting to make your mattress their home. It will continue to perform this task into the future insuring your home or your facility remains bed bug free. Many of our customers do not have any current pests but buy our products for this preventative reason alone.     </p>
            <p>We specialize in providing encasements for mattresses to our commercial customers. Many large scale hotel chains depend on our products to protect their customers and to protect their service reputations.  Our clients expect and receive discrete service.</p>

            <p>This doesn’t mean we sacrifice our customer service to our residential clients. We are the only authorized web retailer for the Rest Ease product line, and serve as their sole outlet to the public. Buying direct gives you the opportunity to take advantage of the same high quality products and discrete service we offer our commercial partners at a discounted direct to you price. Quality meets affordability.</p>
        </div>

        <div id="mainCommercial">
            <a class="commercialLogin" id="commercialLink" href="commercialLogin.php">Commercial Encasements</a>
            <a class="commercialLogin" href="commercialLogin.php"><img src="imgs/commercialimage.jpg" alt="Commericial Image"><div class="insetShadow"></div></a>
        </div>
        <div id="mainResidential">
            <a id="residentialLink" href="categories.php">Residential Encasements</a>
            <a href="categories.php"><img src="imgs/residentialimage.jpg" alt="Residential Image"><div class="insetShadow"></div></a>
        </div>
        <div id="bottomProducts">
            <h3 class="scriptFont">Select a specific encasement or solutions protection kit below to see more.</h3>
            <div id="productLinks">
                <ul>
                    <li>
                        <a id="pillowLink" href="products.php?cat=4">Pillow Encasements</a>
                        <a id="pillowImage" href="products.php?cat=4"></a>
                    </li>
                    <li>
                        <a id="mattressLink" href="products.php?cat=1">Mattress Encasements</a>
                        <a id="mattressImage" href="products.php?cat=1"></a>
                    </li>
                    <li>
                        <a id="solutionLink" href="products.php?cat=6">Solution Kits</a>
                        <a id="solutionImage" href="products.php?cat=6"></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>


<?php require_once 'includes/footer.inc.php'; ?>
    </div>
 </div><!-- end container -->

<?php
$admin = false;
$ui = true;
require_once('includes/jquery.inc.php');
?>
<script src="js/script.js"></script>

<!--[if lt IE 7 ]>
<script src="js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
<![endif]-->
</body>
</html>