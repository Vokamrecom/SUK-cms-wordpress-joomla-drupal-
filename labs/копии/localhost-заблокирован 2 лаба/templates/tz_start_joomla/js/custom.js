/*****************************************************/
/* Amend function makes homepage position beautiful */
/****************************************************/
jQuery(window).load(function () {
    function amend() {
        "use strict";
        var height;
        // height = jQuery(window).height();
        // jQuery('#homepage').css('height', height + 10 + "px");
    }

    amend();
// if user resizes the screen
    jQuery(window).resize(function () {
        amend();
    });
});


/**********************************/
/* Run Loading GIF */
/********************************/
jQuery(window).load(function () {
    jQuery('.back').on('click', function () {
        jQuery('body,html').animate({
            scrollTop: 0
        }, 1000);
    });
    jQuery("#loading").fadeOut("1500", function () {
        jQuery('#loading img').css("display", "none");
        jQuery('#loading').css("display", "none");
        jQuery('.loading').css("display", "none");
    });

    if (jQuery(window).width() > 767) {
        jQuery('.homepage-inner').addClass('animated fadeInUp');

        jQuery('#button-scroll').addClass('animated bounce');

        jQuery('.boxes .box').appear(function () {
            jQuery('.boxes .box').addClass('animated fadeInUp');
        });

        jQuery('.offer-box').appear(function () {
            jQuery('.offer-box').addClass('animated fadeInDown');
        });

        jQuery('.our_team .team_animation').appear(function () {
            jQuery('.our_team .team_animation').addClass('animated fadeInDown');
        });

        jQuery('.customer').appear(function () {
            jQuery('.customer').addClass('animated fadeInDown');
            jQuery('.customer img').addClass('animated bounceIn');
            jQuery('.m1').countTo();
            jQuery('.m2').countTo();
            jQuery('.m3').countTo();
            jQuery('.m4').countTo();
            jQuery('.m5').countTo();
        });

        jQuery('.purchase  img').appear(function () {
            jQuery('.purchase  img').addClass('animated flipInY');
        });

        jQuery('#filter').appear(function () {
            jQuery('#filter').addClass('animated slideInDown');
        });

        jQuery('#portfolio .TzInner').appear(function () {
            jQuery('#portfolio .TzInner').addClass('animated rollIn');
        });

        jQuery('.blogs ').appear(function () {
            jQuery('img.woman').addClass('animated bounceIn');
        });

        jQuery('.milestones ').appear(function () {
            jQuery('img.man').addClass('animated bounceIn')
        });

        jQuery('.blog').appear(function () {
            jQuery('.blog').addClass('animated fadeInUp');
            jQuery('.blog .icon-border span i').addClass('animated bounceIn');
        });

        jQuery('.logos img').appear(function () {
            jQuery('.logos img').addClass('animated fadeInDown');
        });
    }
});

///**********************/
///* Jquery NAV Plugin */
///*********************/
jQuery(document).ready(function () {
    "use strict";
    var $nav;
    var $button_scroll;
    $nav = jQuery('#plazart-mainnav .nav');
    $button_scroll = jQuery('#button-scroll');

    $nav.onePageNav({
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 2200,
        scrollOffset: 30,
        scrollThreshold: 0.5,
        filter: '',
        easing: 'easeOutBack',
        begin: function () {
            //I get fired when the animation is starting
        },
        end: function () {
            //I get fired when the animation is ending
        },
        scrollChange: function ($currentListItem) {
            //I get fired when you enter a section and I pass the list item of the section
        }
    });

    $button_scroll.on('click', 'a', function (e) {
        "use strict";
        var currentPos;
        currentPos = jQuery(this).parent().length;

        $nav.find('li').eq(currentPos).children('a').trigger('click');
        e.preventDefault();
    });

});
//
//
////Add fixed position to NAV

jQuery(window).bind('scroll resize load', function () {
    jQuery('#tz-header-blog-wrapper').next().css('margin-top', jQuery('#tz-header-blog-wrapper').height() + 'px');
    if (jQuery(window).width() >= 767) {
        if (jQuery(document).scrollTop() >= 500) {
            jQuery('#tz-header-wrapper').addClass('fixed-top');
            jQuery('#tz-header-wrapper').addClass('nav-shadow');
        } else {
            jQuery('#tz-header-wrapper').removeClass('fixed-top');
            jQuery('#tz-header-wrapper').removeClass('nav-shadow');
        }
    }
});




