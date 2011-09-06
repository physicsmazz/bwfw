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



});

