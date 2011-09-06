<?php
require_once 'includes/config.inc.php';
$states_arr = array('AL' => "Alabama", 'AK' => "Alaska", 'AZ' => "Arizona", 'AR' => "Arkansas", 'CA' => "California", 'CO' => "Colorado", 'CT' => "Connecticut", 'DE' => "Delaware", 'DC' => "District Of Columbia", 'FL' => "Florida", 'GA' => "Georgia", 'HI' => "Hawaii", 'ID' => "Idaho", 'IL' => "Illinois", 'IN' => "Indiana", 'IA' => "Iowa", 'KS' => "Kansas", 'KY' => "Kentucky", 'LA' => "Louisiana", 'ME' => "Maine", 'MD' => "Maryland", 'MA' => "Massachusetts", 'MI' => "Michigan", 'MN' => "Minnesota", 'MS' => "Mississippi", 'MO' => "Missouri", 'MT' => "Montana", 'NE' => "Nebraska", 'NV' => "Nevada", 'NH' => "New Hampshire", 'NJ' => "New Jersey", 'NM' => "New Mexico", 'NY' => "New York", 'NC' => "North Carolina", 'ND' => "North Dakota", 'OH' => "Ohio", 'OK' => "Oklahoma", 'OR' => "Oregon", 'PA' => "Pennsylvania", 'RI' => "Rhode Island", 'SC' => "South Carolina", 'SD' => "South Dakota", 'TN' => "Tennessee", 'TX' => "Texas", 'UT' => "Utah", 'VT' => "Vermont", 'VA' => "Virginia", 'WA' => "Washington", 'WV' => "West Virginia", 'WI' => "Wisconsin", 'WY' => "Wyoming");

$mysql = new Mysql();
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
    <div id="thirdLine"></div>
    <div id="fourthLine"></div>
    <div id="shortLine"></div>
    <div id="innerContainer" class="cartPage">
        <?php require_once 'includes/header.inc.php'; ?>
        <?php require_once 'includes/leftCol.inc.php'; ?>
        <div id="mainPage">
        <section id="content">
        <h3>Shopping Cart</h3>
        <ul id="flowtabs">
            <li><a id="t1" href="#verify" class="active">Verify Order</a></li>
            <li><a id="t2"  href="#shipping">Shipping and Payment</a></li>
            <li><a id="t3" href="#checkout">Finalize</a></li>
        </ul>

        <div id="flowpanes">
            <div id="verifyOrder">
                <form action="" id="cartForm" data-user-id="<?php echo($userId); ?>">
                    <table>
                        <thead>
                        <tr>
                            <th class="prodImage">Product Image</th>
                            <th class="prodName">Product Name</th>
                            <th class="prodQty">Prod Qty</th>
                            <th class="prodPrice">Prod Price</th>
                            <th class="prodSubtotal">Subtotal</th>

                        </tr>
                        </thead>
                        <tbody>

                            <?php
                                $cartSubTotal = 0;
                                $shippingTotal = 0;
                                if(!is_array($orderArr)){
                                    echo<<<ITEM
                                        <tr id="{$id}" class="orderItem">
                                            <td class="prodImage"></td>
                                            <td class="prodName">There is nothing in your cart.</td>
                                            <td class="prodQty"></td>
                                            <td class="prodPrice"></td>
                                            <td class="prodSubtotal"></td>
                                        </tr>
ITEM;
                                }
                                else {
                                    foreach ($orderArr as $id => $item){
                                        extract($item);
                                        $subTotal = ($qty * $price);
                                        $cartSubTotal = $cartSubTotal + $subTotal;
                                        $subTotal = number_format($subTotal, 2);
                                        echo<<<ITEM
                                            <tr id="{$id}" class="orderItem">
                                                <td class="prodImage"><a href="products.php?category={$cat}"><img src="imgs/categories/{$cat}.jpg" alt="{$name}"></a></td>
                                                <td class="prodName"><a href="products.php?category={$cat}">{$description}</a></td>
                                                <td class="prodQty">
                                                    <input type="number" name="qty[]" class="qtyInput" value="{$qty}">
                                                    <br>
                                                    <button class="updateBtn">update</button>
                                                    <br>
                                                    <a class="deleteBtn" href="delete.php?id={$id}">delete</a>
                                                </td>
                                                <td class="prodPrice">\${$price}</td>
                                                <td class="prodSubtotal">\${$subTotal}</td>
                                            </tr>
ITEM;
                                    }
                                }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="noBorder"></td>
                                    <td id="orderSubtotalLabel" class="alignRight">Subtotal: </td>
                                    <td id="orderSubtotal"><?php echo ('$'.number_format($cartSubTotal,2)); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="noBorder" id="deliveryZipTd"><label for="deliveryZip" style="width:150px">Delivery zip code?</label><input id="deliveryZip" type="text"><input type="submit" id="setDelZipBtn" value="Set Zip Code" name="setDelZipBtn"></td>
                                    <td id="orderTaxLabel" class="alignRight">Tax: </td>
                                    <td id="orderTax">Set Your<br>Zip Code</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="noBorder"></td>
                                    <td id="orderTotalLabel" class="alignRight bold"><span id="cartSymbol"></span> Total: </td>
                                    <td id="orderTotal">Set Your<br>Zip Code</td>
                                </tr>
                            </tfoot>

                        </table>
                    <button id="step1NextBtn" class="continueBtn">Next Step</button>
                    </form>
            </div>
            <div id="customerInfo">
                <form id="shippingForm" action="">
                    <fieldset id="shipping">
                        <legend>Shipping Info</legend>
                        <label for="name">Name: </label>
                        <input type="text" name="name" id="name" required="required" placeholder="John Smith">
                        <br>
                        <label for="address">Address: </label>
                        <input type="text" name="address" id="address" required="required" placeholder="123 Main St.">
                        <br>
                        <label for="city">City: </label>
                        <input type="text" name="city" id="city" required="required" placeholder="Mytown">
                        <br>
                        <label for="state">State: </label>
                        <select name="state" id="state" required="required">
                            <option value="">Choose a State</option>
                            <?php
                            foreach ($states_arr as $abbr => $state) {
                                echo ("<option value='{$abbr}'>{$state}</option>");
                            }
                            ?>

                        </select>
                        <br>
                        <label for="zipcode">Zipcode: </label>
                        <input type="text" name="zipcode" id="zipcode" required="required" placeholder="55555">
                        <br>
                        <label for="email">Email: </label>
                        <input type="email" name="email" id="email" required="required" placeholder="myemail@email.com">
                        <br>
                    </fieldset>
                    <fieldset id="billingInfo">
                        <legend>Billing Info</legend>
                        <input style="width:10px" type="checkbox" name="sameAddress" id="sameAddress" checked="checked" />
                        <label id="sameAddressLabel" for="sameAddress"> same as shipping address</label>
                        <br/>
                        <label class="sameAs" for="nameB">Name: </label>
                        <input class="sameAs" type="text" name="nameB" id="nameB">
                        <br/>
                        <label class="sameAs" for="addressB">Address: </label>
                        <input class="sameAs" type="text" name="addressB" id="addressB">
                        <br/>
                        <label class="sameAs" for="cityB">City: </label>
                        <input class="sameAs" type="text" name="cityB" id="cityB">
                        <br/>
                        <span class="sameAs" id="stateSpanB">
                        <label for="stateB">State: </label>
                            <select  name="stateB" id="stateB">
                                <option value="">Choose a State</option>
<?php
                                foreach ($states_arr as $abbr => $state) {
                                echo ("<option value='{$abbr}'>{$state}</option>");
                            }
                                ?>
                            </select>
                        </span>
                        <br>
                        <span id="zipcodeSpanB">
                            <label class="sameAs" for="zipcodeB">Zipcode: </label>
                            <input class="sameAs" type="text" name="zipcodeB" id="zipcodeB">
                        </span>

                    </fieldset>
                    <fieldset id="ccFieldset">
                        <legend>Credit Card</legend>

                        <div id="left">
                            <label for="ccNum">Credit Card #:</label>
                            <input type="text" name="ccNum" id="ccNum" required="required" placeholder="1111222233334444">
                        </div>
                        <div id="right">
                            <label for="expMonth">Exp. Date:</label>
                            <select class="smallSelect" name="ccMonth" id="expMonth">
                                <option value="01">Jan.</option>
                                <option value="02">Feb.</option>
                                <option value="03">Mar.</option>
                                <option value="04">Apr.</option>
                                <option value="05">May</option>
                                <option value="06">Jun.</option>
                                <option value="07">Jul.</option>
                                <option value="08">Aug.</option>
                                <option value="09">Sep.</option>
                                <option value="10">Oct.</option>
                                <option value="11">Nov.</option>
                                <option value="12">Dec.</option>
                            </select>
                            <select class="smallSelect" name="ccYear" id="expYear">
<?php
                                //get current year and increment forward 10 years.
    $currentYear = date('Y');
    $lastYear = $currentYear + 10;
    for ($year = $currentYear; $year <= $lastYear; $year++) {
        echo ("<option>{$year}</option>");
    }
    ?>
                            </select>
                        </div>
                        <!-- end #right-->
                    </fieldset>
                    <div id="info">
                        Your credit card will not be charged until after this step.
                    </div>
                    <button id="step2NextBtn" class="continueBtn">Next Step</button>

                </form>
                <div id="errors"></div>
                <div id="success"></div>
            </div>
            <div id="checkoutDiv">
                <div id="results"></div>
            </div>
        </div><!-- end div#flowpanes -->

    </section>
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
<script>
    adjustHeight();
    $(window).resize(function(){
        adjustHeight();
    });
</script>

<!--[if lt IE 7 ]>
<script src="js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
<![endif]-->
</body>
</html>