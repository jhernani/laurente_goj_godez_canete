$(function() {
    $(document).ready(function(){  
        /* Fix menu
        ---------------------------------------------------------- */   
		var elm = $("#md-navbar"),
            nav = $("#nav"),
			sections = {};
        function getPositions() {
			sections[""] = 0;
            $("#nav li a").each(function() {
                var linkHref = $(this).attr('href');
                if(linkHref != "" && linkHref != "#") {
                    var divPos = $(linkHref).offset(),
                        topPos = divPos.top;
                    sections[linkHref.substr(1)] = Math.round(topPos - 62);
                }
            });
        }
        function getSection(windowPos) {
		  var returnValue = '';
		  for(var section in sections) {
			if(sections[section] < windowPos) {
			  returnValue = section;
			}
		  }
		  return returnValue;
		};
        $(window).scroll(function() {
            var scrollt = window.pageYOffset || $(document).scrollTop();
			var oritop = $("header").height() - 60;
            if(scrollt >= oritop) {
				if(!elm.hasClass("md-fix")) {
					elm.addClass("md-fix").addClass("nav-fix").css({top: "-60px", opacity: 0}).animate({top: "0", opacity: 1});
				}	
            }
            else {
				if(elm.hasClass("md-fix")) {
					elm.removeClass("md-fix").animate({top: "-60px", opacity: 0}, function() {$(this).css({opacity: 1}).removeClass("nav-fix")});
				}	
            }
            getPositions();
            var position = getSection(scrollt);
            if(position !== '') {
                var $menu = nav.find('a[href=#'+position+']').parent();
                if(!$menu.is(".current")) {
					$("#nav li.current").removeClass("current");
						$menu.addClass("current");
                    nav.find("li.back").stop().animate({
                        width: $menu[0].offsetWidth,
                        left: $menu[0].offsetLeft
                    }, 500);
                }
            } else {
                var $menu = nav.find('li').first();
                if(!$menu.is(".current")) {
					$("#nav li.current").removeClass("current");
					$menu.addClass("current");
                    nav.find("li.back").stop().animate({
                        width: $menu[0].offsetWidth,
                        left: $menu[0].offsetLeft
                    }, 500);
                }
            }
        });
		
        /* Responsive menu & slide
        ---------------------------------------------------------- */   
		$(window).resize(function() {
			var wWidth = $(window).width();
			if(wWidth < 1500) {
				var slideHeight = wWidth / 2;
				$("#md-spotlight").height(slideHeight);
				if(wWidth < 760) {
					var margintop = (slideHeight - $("#md-spotlight .md-intro").height()) / 2;
					$("#md-spotlight .md-intro").css("margin-top", margintop);
				} else {
					$("#md-spotlight .md-intro").css("margin-top", slideHeight * 0.12);
				}
			}
		});
        $(window).resize();
        var resNav = responsiveNav("#nav", { // Selector: The ID of the wrapper
            animate: true, // Boolean: Use CSS3 transitions, true or false
            transition: 400, // Integer: Speed of the transition, in milliseconds
            label: "<span></span><span></span><span></span>", // String: Label for the navigation toggle
            insert: "after", // String: Insert the toggle before or after the navigation
            customToggle: "", // Selector: Specify the ID of a custom toggle
            openPos: "relative", // String: Position of the opened nav, relative or static
            jsClass: "js", // String: 'JS enabled' class which is added to <html> el
            init: function(){}, // Function: Init callback
            open: function(){ $("#md-navbar .arrow").show(); }, // Function: Open callback
            close: function(){$("#md-navbar .arrow").hide();}, // Function: Close callback
			onshow: function(){ 
				$menu = $("li.current", nav);
				nav.find("li.back").stop().css({
					width: $menu[0].offsetWidth,
					left: $menu[0].offsetLeft
				});
			}
        });
        $("#nav li a").click(function() {
            var href = $(this).attr("href");
            if(href != "" && href != "#") {
                var scrollTo = $(href);
                $('html,body').animate({scrollTop: scrollTo.offset().top - 60});
            } else {
                $('html,body').animate({scrollTop: 0});
            }
			if(nav.attr("aria-hidden") == "false") {
				resNav.toggle();
			}
            return false;
        });

        /* Tabs
        ---------------------------------------------------------- */
        $(".tabs-wrap").tabs();
        $( "#accordion,#toogle,#accordion-rwd" ).accordion({
            collapsible: true,
            heightStyle: "content"
        });
        $(".md-icon-dialog").hover(function() {
            $(".md-dialog", this).stop(true, true).fadeIn();
        }, function() {
            $(".md-dialog", this).stop(true, true).fadeOut();
        });
        /* Cycle Slide
        ---------------------------------------------------------- */
        $('#md-slider-1').cycle({
            fx:    'scrollHorz',
            speed:  1000,
            next: "#md-slider-1-ctrl .slide-next",
            prev: "#md-slider-1-ctrl .slide-pre",
            pager: "#md-slider-1-switch",
            fit: 1,
			log: false
        });
        $('#md-slider-2').cycle({
            fx:    'fade',
			slides: "> div",
            speed:  500,
			timeout: 3000,
            pager: "#md-slider-2-switch",
			log: false
        });
        $('#md-slider-3').cycle({
            fx:    'scrollHorz',
            speed:  1000,
            slides: "> div",
            next: "#md-slider-3-ctrl .slide-next",
            prev: "#md-slider-3-ctrl .slide-prev",
			log: false
        });

        /* Features effect
        ---------------------------------------------------------- */
        $(".origami").origami({});
        $("#origami-accordion .accordion-toggle").click(function() {
            $(this).parent().parent().toggleClass("active");
            $(this).parent().next().slideToggle();
            return false;
        });
        var titleActive = 0;
        var titleInt = setInterval(function() {
            titleActive = (titleActive < $("#landing-title span.option").size() - 1) ? titleActive + 1 : 0;
			$("#landing-title span.option-next").html();
            var newTitle = $("#landing-title span.option:eq("+titleActive+")").html();
            $("#landing-title span.active").html(newTitle);
        }, 2000); 

        

        /* Lavalamp menu
        ---------------------------------------------------------- */
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
         // some code..
        } else {
            $(function() { $(".lavaLamp").lavaLamp({ fx: "backout", speed: 600 })});
        }
		
    });
});