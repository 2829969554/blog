$('.toTop').click(function(){$('html,body').animate({scrollTop: '0px'}, 800);});
    $(window).scroll(function(){
        $(window).scrollTop()>10?$('.toTop').css('display','block'):$('.toTop').css('display','none');
    });