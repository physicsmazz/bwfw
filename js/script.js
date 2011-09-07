if($('html').hasClass('js')){
    $('#noJs').remove();
}

$(function() {

    if($('html').hasClass('no-borderradius')){
        $('html').prepend('<div id="ie">Your browser doesn\'t support some of the new CSS styles.' +
                '<br>Consider upgrading to <a target="_blank" href="http://www.mozilla.com/en-US/firefox/">Firefox</a>, <a target="_blank" href="http://www.google.com/chrome">Chrome</a>, <a target="_blank" href="http://www.apple.com/safari/download/">Safari</a>, or <a target="_blank" href="http://windows.microsoft.com/ie9">IE9</a> for a better viewing experience. <span id="closeIE">X</span></span></div>');
        $('html').delegate('#closeIE','click',function(){
            $('#ie').slideUp(400, function(){
                $(this).remove();
            })
        });
    }

    $('#comingSoon').find('form').submit(function(){
        var btn = $('#signUpBtn');
        btn.text('Sending...');
        var formData = $(this).serialize();
        $.ajax({
            url: 'sendMail.php',
            dataType: 'json',
            data: formData,
            type: 'post',
            success:function(json){
                if(!json.error){
                    btn.text('Thank You!');
                }else{
                    btn.text('Sign Up');
                    alert('There was a problem signing you up.');
                }
            }
        });

        return false;
    });


    contact();
    Cart.init();
    Account.init();




});

var adjustHeight = function(){
    var wHeight = $('#flowpanes').height();
//        $('#leftCol').height(wHeight + 15);
    $('#mainPage').height(wHeight + 70);
    return false;
};

var Account = {
init: function(){
    $('#loginBtn').add('.commercialLogin').click(this.login);
    $('#newAccountBtn').click(this.create);
},
login: function(){
    $('#container').append('<div id="loginModal"></div>');
    $('#loginModal').dialog({
        title: "Please Log In",
        modal: true
    });
    return false;
},
create: function(){
    $('#container').append('<div id="newAccountModal"></div>');
    $('#newAccountModal').dialog({
        title: 'Please Enter Your Information',
        modal: true
    });
    return false;
}
};
var contact = function(){
var form = $('#contactForm');
form.submit(function(){
    $('#bottomInput').append('<p id="sendingMsg">Sending...</p>');
    //send mail...if ok, remove form and insert image
    $.ajax({
        url: 'sendMail.php',
        dataType: 'json',
        data: form.serialize(),
        type: 'post',
        success:function(json){
            if(json.result == 'OK'){
                window.location = 'thankyou.php';
            }else{
                $('#sendingMsg').remove();
                alert('ERROR: ' + json.errorArr[0]);
            }
        }
    });

    return false;
});
return false;
};


var Cart = {
init: function(){
//        Cart.adjustHeight();
    Cart.tab1();
    Cart.sameAsShipping();
    $('#t1').click(Cart.tab1);
    $('#t2').click(Cart.tab2);
    $('#t3').click(Cart.tab3);
    $('.deleteBtn').click(Cart.deleteItem);
    $('.updateBtn').click(Cart.updateQty);
    $('#step1NextBtn').click(Cart.tab2);
    $('#step2NextBtn').click(Cart.tab3);
    $('#step2PrevBtn').click(Cart.tab1);
    $('#addToCartBtn').click(Cart.addToCart);
    $('#setDelZipBtn').click(Cart.getTax);
},
tab1position: '-10px',
tab2position: '-802px',
tab3position: '-1583px',
cartDiv: $('#verifyOrder'),
tab1: function(){
    $('#flowpanes').animate({
        left: Cart.tab1position
    }, 500);
    $('#t1').removeClass().addClass('active');
    $('#t2, #t3').removeClass();
    return false;
},
tab2: function(){
    if($('#deliveryZip').val().length == 5){
        //if there is a zipcode, get the shipping and tax.
        Cart.getTax();
    }

    $('#flowpanes').animate({
        left: Cart.tab2position
    }, 500);
    $('#t1').removeClass().addClass('complete');
    $('#t2').removeClass().addClass('active');
    $('#t3').removeClass();
    return false;
},
tab3: function(){
    $('#results').html('');
    $('#deliveryZipTd').html('');
    if (Cart.addressValidate()) {
        //slide the panes
        $('#flowpanes').animate({
            left: Cart.tab3position
        }, 500);
        $('#t1, #t2').removeClass().addClass('complete');
        $('#t3').removeClass().addClass('active');

        Cart.createConfirmForm();

        //if it's in mass, do the tax
        var subTotal = parseFloat($finalTable.find('#orderSubtotal').text().replace(/\$|,/g, ''));
        if ($('#state').val() == 'MA') {
            var taxAmount = (.0625 * subTotal);
        } else {
            taxAmount = 0;
        }
        $finalTable.find('#orderTax').text(formatCurrency(taxAmount));
        $('#checkoutBtn').remove();

        var total = subTotal + taxAmount;
        $finalTable.find('#orderTotal').text(formatCurrency(total));

        //append a checkout button
        $('#checkoutDiv').append('<button class="continueBtn" id="checkoutBtn" type="submit" value="checkout">Finalize Order</button>');

        //look for the checkout button to be pressed to finalize the whole thing
        $('#checkoutBtn').click(Cart.processCC);
    }
    return false;
},
getTax:function(){
    var zipcode = $('#deliveryZip').val();
    $.ajax({
        url: 'cart_getTax.php',
        dataType: 'json',
        data: {zipcode: zipcode},
        type: 'post',
        success:function(json){
            if(json.taxable){
                var subTotal = parseFloat($('#orderSubtotal').text().replace(/\$|,/g, '')),
                    taxRaw = subTotal * 0.0625,
                    total = formatCurrency(subTotal + taxRaw);

                $('#orderTax').text(formatCurrency(taxRaw));
                $('#orderTotal').text(total);
            }
        }
    });
    return false;
},
addToCart: function(){
    var $this = $(this),
        parentEl = $this.closest('#prodDiv'),
        data = parentEl.find('#prodForm').serialize(),
        sizeEl = parentEl.find('#size'),
        depthEl = parentEl.find('#depth');

    if(sizeEl.val() == ''){
        sizeEl.css('border','1px solid red');
        return false
    }else if(depthEl.val() == ''){
        depthEl.css('border','1px solid red');
        return false
    }
    $.ajax({
        url: 'cart_addToCart.php',
        dataType: 'json',
        data: data,
        type: 'post',
        success:function(json){
            if(json.prodId){
                if(json.itemExists){
                    //increment the qty
                }else{
                    if(!$('#cartIcon').hasClass('items')){
                        $('#cartIcon').addClass('items');
                    }
                }
            }else{
                alert('There was a problem adding the item.');
            }
        }
    });
    return false;
},
processCC: function(){
    var $this = $(this),
        ccResult = false;

    var orderDetails = {
        shipName: $('#name').val(),
        shipAddress: $('#address').val(),
        shipCity: $('#city').val(),
        shipState: $('#state').val(),
        shipZipcode: $('#zipcode').val(),
        ccNum: $('#ccNum').val(),
        ccMonth: $('#expMonth').val(),
        ccYear: $('#expYear').val(),
        subtotal: $finalTable.find('#orderSubtotal').text().replace(/\$|,/g, ''),
        taxTotal: $finalTable.find('#orderTax').text().replace(/\$|,/g, ''),
        orderTotal: $finalTable.find('#orderTotal').text().replace(/\$|,/g, ''),
        hash: location.hash,
        orderId: $('#cartForm').data('user-id')
    };

    var sameAddress = $('#sameAddress').attr('checked');
    if (sameAddress) {
            orderDetails.billName = orderDetails.shipName;
            orderDetails.billAddress = orderDetails.shipAddress;
            orderDetails.billCity = orderDetails.shipCity;
            orderDetails.billState = orderDetails.shipState;
            orderDetails.billZipcode = orderDetails.shipZipcode;
    } else {
            orderDetails.billName = $('#nameB').val();
            orderDetails.billAddress = $('#addressB').val();
            orderDetails.billCity = $('#cityB').val();
            orderDetails.billState = $('#stateB').val();
            orderDetails.billZipcode = $('#zipcodeB').val();
    }
    //change button text
    $('#results').html('Processing your credit card...');

    $.ajax({
        url: 'cart_processCC.php',
        dataType: 'json',
        data: orderDetails,
        type: 'post',
        success:function(json) {
            if(json.result == 'true'){
                $('#results').html('Your credit card was charged.<br>');
                Cart.orderFinalize();
            }else{
                $('#results').html('There was a problem processing your credit card. <br>' + json.errorMessage + '<br>');
            }
        }  //end ajax
    });
    return ccResult;
},
orderFinalize: function(){
    var $this = $(this);
    var orderDetails = {
        shipName: $('#name').val(),
        shipAddress: $('#address').val(),
        shipCity: $('#city').val(),
        shipState: $('#state').val(),
        shipZipcode: $('#zipcode').val(),
        ccNum: $('#ccNum').val(),
        ccMonth: $('#expMonth').val(),
        ccYear: $('#expYear').val(),
        email: $('#email').val(),
        subtotal: $finalTable.find('#orderSubtotal').text().replace(/\$|,/g, ''),
        taxTotal: $finalTable.find('#orderTax').text().replace(/\$|,/g, ''),
        orderTotal: $finalTable.find('#orderTotal').text().replace(/\$|,/g, ''),
        orderId: $('#cartForm').data('user-id')
    };

    var sameAddress = $('#sameAddress').attr('checked');
    if (sameAddress) {
            orderDetails.billName = orderDetails.shipName;
            orderDetails.billAddress = orderDetails.shipAddress;
            orderDetails.billCity = orderDetails.shipCity;
            orderDetails.billState = orderDetails.shipState;
            orderDetails.billZipcode = orderDetails.shipZipcode;
    } else {
            orderDetails.billName = $('#nameB').val();
            orderDetails.billAddress = $('#addressB').val();
            orderDetails.billCity = $('#cityB').val();
            orderDetails.billState = $('#stateB').val();
            orderDetails.billZipcode = $('#zipcodeB').val();
    }
//                //change button text

    $('#results').append('Finalizing Order<br>');

    $.ajax({
        url: 'cart_checkout.php',
        dataType: 'json',
        data: orderDetails,
        type: 'post',
        success:function(json){
            if(json.setOrder != 0){
                if(json.emailSend){
                    $('#results').html('An email confirmation has been sent.<br>Please allow up to an hour to receive the email confirmation.<br>');
                }else{
                    $('#results').html('There was a problem sending the email confirmation.<br>Someone will contact you by phone to confirm your order.<br>');
                }
                $('#cartLink').html('Shopping Cart - <span></span>').css('backgroundPosition', '100% -60px');
            }else{
                $('#results').append('There was a problem processing your order.<br>');
            }
        }
    });  //end ajax
////                        $('#cartPage').find('.ccError').removeClass('ccError');
////    //                                alert(json[3]);
////                        switch (json[2]) {
////                            case '8':
////                                $('#t2').trigger('click');
////                                $('#expMonth, #expYear').addClass('ccError');
////                                break;
////                            case '7':
////                                $('#t2').trigger('click');
////                                $('#expMonth, #expYear').addClass('ccError');
////                                break;
////                            case '6':
////                                $('#t2').trigger('click');
////                                $('#ccNum').addClass('ccError');
////                                break;
////                            case '17':
////                                $('#t2').trigger('click');
////                                $('#ccNum').addClass('ccError');
////                                break;
////                            case '27':
////                                $('#t2').trigger('click');
////                                if ($('#sameAddress').attr('checked')) {
////                                    //if same as shipping is checked
////                                    //highlight shipping zipcode
////                                    $('#zipcode').addClass('ccError');
////                                } else {
////                                    $('#zipcodeB').addClass('ccError');
////                                }
////                                break;
////                        }


},
addressValidate: function(){
    var formok = true,
        errors = [],
        formElements = $('#shippingForm').find('input[type!="submit"], textarea, select'),
        errorNotice = $('#errors'),
        successNotice = $('#success'),
        loading = $('#loading'),
        errorMessages = {
            required: ' is a required field',
            email: 'You have not entered a valid email address for the field: ',
            minlength: ' must be greater than '
        } ;


    formElements.each(function(){
        var name = this.name,
            nameUC = name.ucfirst(),
            value = this.value,
            placeholderText = this.getAttribute('placeholder'),
            type = this.getAttribute('type'), //get type old school way
            isRequired = this.getAttribute('required'),
            minLength = this.getAttribute('data-minlength');

        //if HTML5 formfields are supported
        if( (this.validity) && !this.validity.valid ){
            formok = false;

            //if there is a value missing
            if(this.validity.valueMissing){
                errors.push(nameUC + errorMessages.required);
            }
            //if this is an email input and it is not valid
            else if(this.validity.typeMismatch && type == 'email'){
                errors.push(errorMessages.email + nameUC);
            }
//
            this.focus(); //safari does not focus element an invalid element
            return false;
        }

        //if this is a required element
        if(isRequired){
            //if HTML5 input required attribute is not supported
            if(!Modernizr.input.required){
                if(value == placeholderText){
                    this.focus();
                    formok = false;
                    errors.push(nameUC + errorMessages.required);
                    return false;
                }
            }
        }

        //if HTML5 input email input is not supported
        if(type == 'email'){
            if(!Modernizr.inputtypes.email){
                var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                 if( !emailRegEx.test(value) ){
                    this.focus();
                    formok = false;
                    errors.push(errorMessages.email + nameUC);
                    return false;
                }
            }
        }

        //check minimum lengths
        if(minLength){
            if( value.length < parseInt(minLength) ){
                this.focus();
                formok = false;
                errors.push(nameUC + errorMessages.minlength + minLength + ' characters');
                return false;
            }
        }
    });
    return formok;

    function showNotice(type, data){
        if(type == 'error'){
            successNotice.hide();
            errorNotice.find("li[id!='info']").remove();
            for(x in data){
                errorNotice.append('<li>'+data[x]+'</li>');
            }
            errorNotice.show();
        }
        else {
            errorNotice.hide();
            successNotice.show();
        }
    }

},
adjustHeight: function(){
    var shoppingCartHeight = $('#cartForm').height();
    shoppingCartHeight = (shoppingCartHeight < 310) ? 310 : shoppingCartHeight;
    $('.cartPage, .cartPage #content').height(shoppingCartHeight + 170);
},
deleteItem: function(){
    var $row = $(this).closest('tr');
    $.ajax({
        url: 'cart_deleteItem.php',
        dataType: 'text',
        data: {id: $row.attr('id')},
        type: 'get',
        success:function(text){
            if(text){
                $row.fadeOut(500, function(){
                    $row.remove();
                    Cart.calcOrder();
                    return false;
                })
            }else{
                alert('there was a problem deleting the item.');
            }
        }
    });

    return false;
},
sameAsShipping: function(){
    //when same as shipping is active, grey out and disable the billingInfo fieldset..
    var $same = $('#sameAddress'),
        $inputs = $('#billingInfo').find('input, label, select').not('#sameAddress, #sameAddressLabel'),
        disabledOpacity = 0.4;

    $inputs.animate({'opacity': disabledOpacity}, 400);

    $same.click(function(){
          if($same.is(':checked')){
              $inputs.animate({'opacity': disabledOpacity}, 400);
          }else{
              $inputs.animate({'opacity': 1}, 400);
          }
//            return false;
    });


    return false;
},
calcOrder: function(){
    var orderTotal = 0,
        subTotal = 0,
        tax = $('#orderTax').text();
    //loop through each item
    Cart.cartDiv.find('.orderItem').each(function(idx,el){
        var qty = $(el).find('.qtyInput').val(),
            price = $(el).find('.prodPrice').text();

        if(qty == '0'){
            $(el).fadeOut(400, function(){
                $(el).remove();
            });
        }
        price = price.replace(/\$|,/g,'');
        prodSubtotal = qty * parseFloat(price);
        $(el).find('.prodSubtotal').text('$' + prodSubtotal.toFixed(2));
        subTotal = subTotal + prodSubtotal;
        return subTotal;
    });
    //end .each

    tax = tax.replace(/\$|,/g,'');
//        orderTotal = subTotal + parseFloat(tax);

    $('#orderSubtotal').text('$' + subTotal.toFixed(2));
//        $('#orderTotal').text('$' + orderTotal.toFixed(2));
    return false;
},
updateQty: function(){
    var cart = $('#cartForm'),
        itemArr = [];

    $.each($('#cartForm').find('.orderItem'), function(idx, el){
        var $this = $(el),
            item = {};
        item.id = $this.attr('id');
        item.qty = $this.find('.qtyInput').val();
        item.price = $this.find('.prodPrice').text().replace(/\$|,/,'');
        itemArr.push(item);
    } );

    //do ajax to change the session
    $.ajax({
        url: 'cart_updateQty.php',
        dataType: 'json',
        data: {
            items: itemArr
        },
        type: 'post',
        success:function(json){
            Cart.calcOrder();
        }
    });

    return false;
},
createConfirmForm: function(){
        //remove any pre-existing tables
        $('#finalTable').remove();
        //clone the products table and append it
        $('#verifyOrder').find('table').clone(true).prependTo('#checkoutDiv').attr('id', 'finalTable');
        //remove the update and delete buttons
        $finalTable = $('#finalTable');
        $finalTable.find('.deleteBtn').remove();
        //convert the qty input into text
        $.each($finalTable.find('.qtyInput, .updateBtn'), function() {
            $this = $(this);
            var tempVal = $this.val();
            $this.after('<span class="prodQty">' + tempVal + '</span>');
            $this.remove();
        });
        //append some feedback

    return false;
}

};


var formatCurrency = function(num) {
num = num.toString().replace(/\$|,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+','+
num.substring(num.length-(4*i+3));
return (((sign)?'':'-') + '$' + num + '.' + cents);
};

String.prototype.ucfirst = function() {
return this.charAt(0).toUpperCase() + this.slice(1);
};
