<?php /* Template Name: Контакты */ ?>
<?php include 'header.php'; ?>

	<?php 
		wp_reset_query();
		if (have_posts()) : while (have_posts()) : the_post(); 
			setup_postdata($post);
			$data_91 = get_post_meta($post->ID, 'cpi_data_91', true);
			$data_92 = get_post_meta($post->ID, 'cpi_data_92', true);
	?>	
		<div class="block" id="slider-static" style="background-image:url('<?php if (strlen($data_91) > 1) { echo $data_91; } else {} ?>');">
			<div class="center">
				<?php if (strlen($data_92) > 1) { ?>
					<div class="cell">
						<h3><?php echo $data_92; ?></h3>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php endwhile; endif; ?>

	<?php if (function_exists('bshepelev_breadcrumbs')) bshepelev_breadcrumbs(); ?>
	
	<div class="block fix_footer_contacts" id="content">
		<div class="title">
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="center">
			<?php 
				wp_reset_query();
				if (have_posts()) : while (have_posts()) : the_post(); 
					setup_postdata($post);
			?>	
				<div class="content">
					<div class="contact_form_contacts"><?php echo do_shortcode('[contact-form-7 id="64" title="Форма обратной связи"]'); ?></div>
					<div class="clear"></div>
					<div id="contact">
						<p><div class="cont_street"><img src="<?php bloginfo('template_directory'); ?>/images/cont_mark.png"><?php echo $options_theme['data_01']; ?></div></p>
						<p><div class="cont_phone"><img src="<?php bloginfo('template_directory'); ?>/images/cont_phon.png">тел.: <a href="tel:<?php echo $options_theme['data_02']; ?>"><?php echo $options_theme['data_02']; ?></a></div></p>
						<p><div class="cont_mail"><img src="<?php bloginfo('template_directory'); ?>/images/cont_arr.png">E-mail: <a href="mailto:<?php echo $options_theme['data_03']; ?>"><?php echo $options_theme['data_03']; ?></a></div></p>
						<p><div class="cont_skype"><img src="<?php bloginfo('template_directory'); ?>/images/cont_skype.png">Skype: <a href=" skype:<?php echo $options_theme['data_04']; ?>?add"><?php echo $options_theme['data_04']; ?></a></div></p>
					</div>
                    
                    
				</div>
                    
			<?php endwhile; endif; ?>
		</div>
        <div class="block" id="mapa">


            

<!-- <script> zindex = 102 </script>
<h1 style="position:relative;background:#eef;  z-index: 103;" onclick="style.zIndex = zindex++">1</h1>
<h1 style="position:relative;background:#fee;top:-20px;  z-index: 103;" onclick="style.zIndex = zindex--">2</h1> -->
            <script> zindex = 103 </script>
		    <div id="map-canvas_contacts" onclick="style.zIndex = zindex--">
                <a></a> 
            </div>
             <div id="map-canvas_contacts_google" onclick="style.zIndex = zindex++">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1287.065061806292!2d23.916868027508563!3d49.82121949127114!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473ae0cc671ceb95%3A0x8b2a3ef96a3bf94b!2z0LLRg9C7LiDQk9C-0YDQvtC00L7RhtGM0LrQsCwgMzY3LCDQm9GM0LLRltCyLCDQm9GM0LLRltCy0YHRjNC60LAg0L7QsdC70LDRgdGC0Yw!5e0!3m2!1suk!2sua!4v1415955802317" width="100%" height="400" frameborder="0" style="border:0"></iframe>
                 </div>
	    </div>
	</div>

<?php include 'footer.php'; ?>