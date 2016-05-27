$(function(){
    $.supersized({
        slide_interval     : 4000,
        transition         : 1,
        transition_speed   : 1000,
        performance        : 1,
        min_width          : 0,
        min_height         : 0,
        vertical_center    : 1,
        horizontal_center  : 1,
        fit_always         : 0,
        fit_portrait       : 1,
        fit_landscape      : 0,
        slide_links        : 'blank',
        slides             : [
                                 {image : '/Public/img/login/1.jpg'},
                                 {image : '/Public/img/login/2.jpg'},
                                 {image : '/Public/img/login/2.jpg'}
                             ]
    });
    $('.page-container form').submit(function(){
        var username = $(this).find('.username').val();
        var password = $(this).find('.password').val();
        var verification = $(this).find('.verification').val();
        if(username == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '27px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.username').focus();
            });
            return false;
        }
        if(password == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '96px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.password').focus();
            });
            return false;
        }
        if(verification == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '165px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.verification').focus();
            });
            return false;
        }
    });
    $('.page-container form .username, .page-container form .password, .page-container form .verification').keyup(function(){
        $(this).parent().find('.error').fadeOut('fast');
    });
    var captcha_img = $(".verify_img");
    var verify_img = captcha_img.attr("src");
    $(".verify_img").click(function(){
        if(verify_img.indexOf('?')>0){  
            $(this).attr("src", verify_img + '&random=' + Math.random());  
        }else{  
            $(this).attr("src", verify_img.replace(/\?.*$/,'') +'?'+Math.random());  
        } 
    })
});