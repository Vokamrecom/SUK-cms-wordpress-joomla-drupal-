/**
 * @version    $Id$
 * @package    SUN Framework
 * @subpackage Layout Builder
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */
 var SunBlank = {

 	_templateParams:		{},

 	initOnDomReady: function()
 	{
		// Setup event to update submenu position
		(function($) {

			var RtlMenu = false;
			if($("body").hasClass("sunfw-direction-rtl"))
				RtlMenu = true;
			else {
				RtlMenu = false;
			}

			SunFwUtils.setSubmenuPosition(RtlMenu,$);

		})(jQuery);

		// Check megamenu is caret
		(function($) {
			
			if($('.sunfw-megamenu-sub-menu ul.nav li.parent').length) {

				$('.sunfw-megamenu-sub-menu ul.nav:not(.sub-menu) li.parent > a, .sunfw-megamenu-sub-menu ul.nav:not(.sub-menu) li.parent > span.nav-header').append('<span class="caret"></span>');

			}

		})(jQuery);
		// Fixed Menu Open Bootstrap
		(function($) {
			$('.sunfw-menu li.parent .caret').on("click", function(e){
				$(this).toggleClass('open');
				$(this).parent().next('ul').toggleClass('menuShow');
				e.stopPropagation();
				e.preventDefault();

			});

		})(jQuery);

		// Animation Menu when hover
		(function($) {
			var timer_out;
			timer_out = setTimeout(function() {
				$('.sunfwMenuSlide .dropdown-submenu, .sunfwMenuSlide .megamenu').hover(
					function() {
						$('> .sunfw-megamenu-sub-menu, > .dropdown-menu', this).stop( true, true ).slideDown('fast');
					},
					function() {
						$('> .sunfw-megamenu-sub-menu, > .dropdown-menu', this).stop( true, true ).slideUp('fast');
					}
					);

				$('.sunfwMenuFading .dropdown-submenu, .sunfwMenuFading .megamenu').hover(
					function() {
						$('> .sunfw-megamenu-sub-menu, > .dropdown-menu', this).stop( true, true ).fadeIn('fast');
					},
					function() {
						$('> .sunfw-megamenu-sub-menu, > .dropdown-menu', this).stop( true, true ).fadeOut('fast');
					}
					);
			}, 100);

		})(jQuery);

		//Scroll Top
		(function($) {
			if($('.sunfw-scrollup').length) {
				$(window).scroll(function() {
					if ($(this).scrollTop() > 30) {
						$('.sunfw-scrollup').fadeIn();
					} else {
						$('.sunfw-scrollup').fadeOut();
					}
				});

				$('.sunfw-scrollup').click(function(e) {
					e.preventDefault();
					$("html, body").animate({
						scrollTop: 0
					}, 600);
					return false;
				});
			};
			//Accirdidon SideMenu at mobile device
			if (jQuery('.menu-sidemenu li.parent').length > 0) { 
				jQuery('.menu-sidemenu li.parent > :first-child').append('<span class="caret"></span>');
			};
			if ( jQuery(window).width() <= 767){
				jQuery('.menu-sidemenu li.parent span.caret').on('click', function(e){
					jQuery(this).closest('li').toggleClass('active');
					e.preventDefault();
				});	            
			}
		})(jQuery);
				
		//CounterUp
		(function($) {
        	// CounterUp
			if($('.counterUp > span').length) {
				$('.counterUp > span').counterUp({
				  delay: 8,
				  time: 2000
				});
				$('.counterUp > span').addClass('animated fadeInDownBig');
			}    
		})(jQuery);
		
		//Search box when click search button
		(function($) {
			/*====== Show search ======*/
			var show_search = jQuery('.custom-search .active').length;
			jQuery('.custom-search  label').click(function(){
				jQuery('.custom-search.search').toggleClass('active');
				if(show_search){
					jQuery('.custom-search .inputbox').removeClass('active');
				} else{
					jQuery('.custom-search .inputbox').toggleClass('active');
				}
			})
			//click outside hide input search;
			var $win = jQuery(window); // or $box parent container
			var $box = jQuery(".custom-search.search");
			// if(show_search){
				$win.on("click", function(event){		
					if ($box.has(event.target).length == 0 && !$box.is(event.target)){
						jQuery('.custom-search .inputbox').removeClass('active');
						jQuery('.custom-search.search').removeClass('active');
					} 
				});	
			// }
		})(jQuery);
		
	},

	initOnLoad: function()
	{
		//console.log('initOnLoad');
	},
	setDropdownModuleEvents: function ()
	{
		var userSelection = document.getElementsByClassName('.login-topbar h3.box-title');
		for(var i = 0; i < userSelection.length; i++) {
			(function(index) {
				var elm = userSelection[index];

				while (!elm.hasClass('module-style'))
					elm = elm.getParent();
				elm.toggleClass('active');
			})(i);
		}
		jQuery('.login-topbar h3.box-title').click(function() {
			jQuery('.login-topbar').toggleClass('active');
		});

		var $win = jQuery(window); // or $box parent container
		var $box = jQuery(".login-topbar");
		$win.on("click", function(event){		
			if ($box.has(event.target).length == 0 && !$box.is(event.target)){
				jQuery('.login-topbar').removeClass('active');
			} 
		});	
	},
	
	stickyMenu: function (element) {
		var header       = '.sunfw-sticky';
		var stickyNavTop = jQuery(header).offset().top;
		var stickyNav = function () {
          var scrollTop    = jQuery(document).scrollTop();
          var placeholder = jQuery('.sunfw-sticky-placeholder')
          if (scrollTop > stickyNavTop) {
            jQuery(header).addClass('sunfw-sticky-open');
            placeholder.show();
          } else {
            jQuery(header).removeClass('sunfw-sticky-open');
            placeholder.hide();
          }
		};

		stickyNav();

		jQuery(window).scroll(function() {
          console.log('scrolling')
			stickyNav();
		});
	},

	setWidtSectionMenu: function () {
		var widthBoxLayout = jQuery('.sunfw-content.boxLayout').width();
		jQuery('.sunfw-sticky.sunfw-section').width(widthBoxLayout);
	},

	initTemplate: function(templateParams)
	{
		// Store template parameters
		_templateParams = templateParams;

		jQuery(document).ready(function ()
		{
			SunBlank.initOnDomReady();
			if (jQuery('div.login-topbar h3.box-title').length > 0) {
				SunBlank.setDropdownModuleEvents();
			}
			// Check width box layout
			if(jQuery('.sunfw-content.boxLayout').length > 0 && jQuery('.sunfw-sticky.sunfw-section')) {
				SunBlank.setWidtSectionMenu();
				jQuery( window ).resize(function() {
					SunBlank.setWidtSectionMenu();
				});
			}
		});

		jQuery(window).load(function ()
		{
			SunBlank.initOnLoad();

			// Check sticky
			if( jQuery('.sunfw-section').hasClass('sunfw-sticky')) {
				var stickyHeight = jQuery('.sunfw-sticky').outerHeight();
				jQuery('.sunfw-sticky').after('<div class="sunfw-sticky-placeholder" style="height:' + stickyHeight +  'px"></div>');	
				SunBlank.stickyMenu();
			}

		});
	}
}