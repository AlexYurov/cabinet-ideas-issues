<!DOCTYPE html>
<html lang="ru-RU">
	<head>
		<?php wp_head(); ?>
		<?php global $options_theme; ?>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<title>
			<?php
				global $page, $paged;
				wp_title('|', true, 'right');
				bloginfo('name');
				$site_description = get_bloginfo('description', 'display');
				if ($site_description && (is_home() || is_front_page())) echo ' | ' . $site_description;
				if ($paged >= 2 || $page >= 2 ) echo ' | ' . sprintf(__('Page %s', 'myTHEME'), max($paged, $page));
			?>
		</title>
        
		<link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,900,700italic,900italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/style.css?ver=2" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/resize2.css" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/metrojs.css" />
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie.css" />
		<![endif]-->
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.bxslider.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/modernizr.custom.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.dlmenu.js"></script>
		<script>
			$(document).ready(function() {
			
				if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
					// mobile & tab
				} else { 
					$('#three li').addClass("animates").attr("data-effect", "flipInY");
					//$('#goals div.title').addClass("animates").attr("data-effect", "fadeInDown");
					//$('#goals .content h3').addClass("animates").attr("data-effect", "fadeInDown");
					//$('#list-principles .item h3').addClass("animates").attr("data-effect", "fadeInLeft");
					//$('#list-principles .item:even h3').addClass("animates").attr("data-effect", "fadeInRight");
					//$('#list-principles .item span img').addClass("animates").attr("data-effect", "bounceIn");
					//$('#client .title').addClass("animates").attr("data-effect", "fadeInDown");
					//$('#mapa .title').addClass("animates").attr("data-effect", "fadeInDown");
					$('#client-list').addClass("animates").attr("data-effect", "bounceIn");
					//$('#client .client-button').addClass("animates").attr("data-effect", "flipInY");
					$('#map-canvas a').addClass("animates").attr("data-effect", "fadeInDown");
                    $('#map-canvas_contacts a').addClass("animates").attr("data-effect", "fadeInDown");
                    $('#list-awards .item span img').addClass("animates").attr("data-effect", "flipInY");
                    
				}
			
				$('head').append('<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/animation.css" />');
				
				$("#three h4").each(function() { 
					$(this).attr("data-number", parseInt($(this).text())).text('1'); 
				});
				
				$(".animates").each(function () {
					var block = $(this);
					var effect = $(this).attr('data-effect');
					$(window).scroll(function() {
						var top = block.offset().top;
						var bottom = block.height() + top;
						top = top - $(window).height();
						var scroll_top = $(this).scrollTop();
						if ((scroll_top > top) && (scroll_top < bottom)) { 
							if (!block.hasClass("animated")) { 
								if (!block.hasClass("count")) { 
									block.addClass('animated ' + effect);
								} else {
									block.addClass('animated ' + effect);
									var inter = 1;
									$("#three").find("h4").each(function() {
										var count = parseInt($(this).attr("data-number")),
										block = $(this),
										timeout = null,
										step = 1;
										timeout = setInterval(function() {
											if (step == 25) {
												block.text(count.toString());
												clearInterval(timeout);
											} else {
												block.text((Math.floor(count*step/25)).toString());
												step++;
											}
										}, 60);
									});		
								}
								
							} 
						}
						else { 
							block.removeClass('animated ' + effect);
						}
					});
				});
			
				$(window).scroll(function() { if ($(this).scrollTop() > 1){ $('#header').addClass("sticky"); } else { $('#header').removeClass("sticky"); } });
				
				$('#dl-menu').find('ul.sub-menu').addClass('dl-submenu');
				$('#dl-menu').dlmenu();
				
				<?php if (is_front_page()) { ?>
			
					var slider = $('#slider-wrap ul').bxSlider({
						mode: 'fade',
						pager: false,
						controls: true,
						//startSlide: 3,
						auto: true,
						pause: 10000,
						onSlideAfter: function(currentSlide){
							// После
							//$(currentSlide).find('h3').animate({
							//	opacity: 1,
							//	left: "-=100"
							//}, 300, function() {});
							
						},
						onSlideBefore: function(currentSlide){
							// Перед
							//$(currentSlide).find('h3').animate({
							//	opacity: 0,
							//	left: "+=100"
							//}, 300, function() {});
						}
					});
					
					$('#client-list ul').bxSlider({
						pager: false,
						controls: true,
						auto: true,
						slideWidth: 160,
						minSlides: 1,
						maxSlides: 5,
						moveSlides: 1,

					});
				
				<?php } ?>
				
				$("#menu li").find("ul.sub-menu").wrap("<div class='subs'></div>");
				$("#menu li li").find("div.subs").removeClass('subs').addClass('subs2');
				
				$("#menu li").hover(function(){
					$(this).addClass("hover");
					if ($(this).find("div").first().hasClass('subs')) { 
						$(this).find("div.subs").slideDown("333");
					}
					if ($(this).find("div").first().hasClass('subs2')) { 
						$(this).find("div.subs2").css('visibility', 'visible');
					}
					
				}, function(){
					$(this).removeClass("hover");
					if ($(this).find("div").first().hasClass('subs')) { 
						$(this).find("div.subs").slideUp("111");
					}
					if ($(this).find("div").first().hasClass('subs2')) { 
						$(this).find("div.subs2").css('visibility', 'hidden');
					}
				});
				
				$("#list-job .header").hover(function(){ $(this).addClass("hover"); }, function(){ $(this).removeClass("hover"); });
				
				$("#list-job .header").click(function(){
					$(this).toggleClass("active");
					$(this).parent().find('.show-hide').slideToggle("slow");
					return false;
				});
				
				$("a.to-forms").click(function(){
					$rel = $(this).attr('href');
					$($rel).fadeIn(400); 
					return false;
				});

              
					
				$('.close').click(function() { 
					$(this).parent().parent().fadeOut(400); 
					return false;
				});
				
				$('.list-portfolio-category .item a').hover(function(){
					$(this).find('div').fadeIn(222); 

				}, function(){
					$(this).find('div').fadeOut(222); 
				});
				
				$('#staff .item').hover(
					function() {
						$(this).find('.text').animate({top: "-=500"}, 500, function() {});
				}, function() {
						$(this).find('.text').animate({top: "+=500"}, 500, function() {});
				});
				
				$("#select-staff li").hover(function(){
					$(this).addClass("hover");
					$('ul:first',this).css('visibility', 'visible');
				}, function(){
					$(this).removeClass("hover");
					$('ul:first',this).css('visibility', 'hidden');
				});
				
				$("#select-staff li a").click(function(){
					$rel = $(this).text();
					$("#select-staff li").find('span').text($rel);
					$("#select-staff li").find("ul").css('visibility', 'hidden');
					$href = $(this).attr('rel');
					$("#load").find('div').fadeIn(222);
					
					$.ajax({
						type: "GET",
						url: "<?php bloginfo('template_directory'); ?>/php/select-staff.php",
						data: "department=" + $href,
					}).done(function( msg ) { 
						//alert(msg);
						$('#list-staff').html(msg);
						$("#load").find('div').fadeOut(222); 
						destination = $("#list-staff").offset().top - 50;
						if ($.browser.safari){
							$('body').animate( { scrollTop: destination }, 1100 );
						} else {
							$('html').animate( { scrollTop: destination }, 1100 );
						}
					});
					return false;
				});
				
				$(".lang li, .social-lang li").hover(function(){
					$(this).addClass("hover");
				}, function(){
					$(this).removeClass("hover");
				});
				
				$("#back-top").hide();
				$(window).scroll(function () { if ($(this).scrollTop() > 100) { $('#back-top').fadeIn(); } else { $('#back-top').fadeOut(); } });
				$('#back-top a').click(function () { $('body,html').animate({ scrollTop: 0 }, 1000); return false; });
				
			});
		</script>
	</head>
	<body <?php body_class(); ?>>
	
		<div id="back-top">
			<a href="#top">Наверх</a>
		</div>
	
		<?php if (!is_404()) { ?>
	
			<div class="block" id="header">
				<div class="center">
					<a class="logo" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
					<div class="social-lang">
						<ul>
							<li class="facebook"><a target="_blank" href="https://www.facebook.com/kabinet.ideas">Facebook</a></li>
							<li class="vk"><a target="_blank" href="https://vk.com/kabinet.ideas">Вконтакте</a></li>
							<li class="twitter"><a target="_blank" href="https://twitter.com/Cabinet_ideas">Twitter</a></li>
							<li class="instagram"><a target="_blank" href="http://instagram.com/cabinet.ideas">Instagram</a></li>
                            <li class="linkedin"><a target="_blank" href="https://www.linkedin.com/company/ра-«кабинет-идей»">LinkedIn</a></li>

						</ul>
						<ul class="lang">
							<li class="ua"><a href="#">Укр</a></li>
							<li class="ru active"><a href="#">Рус</a></li>
						</ul>
					</div>
					<div id="menu">
						<?php if (has_nav_menu('top')) { wp_nav_menu(array('theme_location' => 'top', 'menu_class' => 'top-menu', 'container' => false)); } ?>
                        
						<div class="clear"></div>
					</div>
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Открыть меню</button>
						<?php if (has_nav_menu('top')) { wp_nav_menu(array('theme_location' => 'top', 'menu_class' => 'dl-menu', 'container' => false)); } ?>
					</div>
				</div>
			</div>

        <div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>

		<?php } ?>