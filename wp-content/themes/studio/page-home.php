<?php /* Template Name: Главная страница */ ?>
<?php include 'header.php'; ?>

	<div class="block" id="slider-wrap">
		<ul>
			<li class="one" style="background:url('<?php bloginfo('template_directory'); ?>/images/slider-home/slider-1.jpg') no-repeat center center;">
				<div class="c">
					<div class="l">
						<h3>Вселенная полнится <span>идеями!</span><br>
						У нас живут <br />
						<span>лучшие</span> из них!</h3>
					</div>
					<div class="r">
						<?php echo do_shortcode('[contact-form-7 id="373" title="Slider-one"]'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</li>
			<li class="two" style="background:url('<?php bloginfo('template_directory'); ?>/images/slider-home/slider-2.jpg') no-repeat center center;">
				<div class="c">
					<h3>Откройте миру ваши <span>яркие преимущества</span></h3>
					<?php echo do_shortcode('[contact-form-7 id="374" title="Slider-two"]'); ?>
				</div>
			</li>
			<li class="three" style="background:url('<?php bloginfo('template_directory'); ?>/images/slider-home/slider-3.jpg') no-repeat center center;">
				<div class="c">
					<div class="l">
						<h3>Творческий <span>выход</span> <br />
						из <span>лабиринта задач</span></h3>
					</div>
					<div class="r">
						<?php echo do_shortcode('[contact-form-7 id="375" title="Slider-three"]'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</li>
			<li class="four" style="background:url('<?php bloginfo('template_directory'); ?>/images/slider-home/slider-4.jpg') no-repeat center center;">
				<div class="c">
					<div class="l">
						<h3>Правильная капля <br />
						<span>креатива</span><br />
						всколыхнет волны <br />
						<span>клиентов</span></h3>
					</div>
					<div class="r">
						<?php echo do_shortcode('[contact-form-7 id="377" title="Slider-four"]'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</li>
			<li class="five" style="background:url('<?php bloginfo('template_directory'); ?>/images/slider-home/slider-5.jpg') no-repeat center center;">
				<div class="c">
					<h3>Накормим<span> креативом </span>отборного качества</h3>
					<?php echo do_shortcode('[contact-form-7 id="378" title="Slider-five"]'); ?>
				</div>
			</li>
			<li class="six" style="background:url('<?php bloginfo('template_directory'); ?>/images/slider-home/slider-6.jpg') no-repeat center center;">
				<div class="c">
					<div class="l">
						<h3>Зажгите свою звезду <br />
						на <span>бизнес-небосклоне!</span></h3>
					</div>
					<div class="r">
						<?php echo do_shortcode('[contact-form-7 id="379" title="Slider-six"]'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</li>
			<li class="seven" style="background:url('<?php bloginfo('template_directory'); ?>/images/slider-home/slider-7.jpg') no-repeat center center;">
				<div class="c">
					<h3>Трудности не преграда, <br />
					<span>а стимул!</span><br />
					Почувствуйте <br />
					всю мощь рекламы!</h3>
					<?php echo do_shortcode('[contact-form-7 id="380" title="Slider-seven"]'); ?>
				</div>			
			</li>
		</ul>
	</div>
	
	<div class="block" id="three">
		<div class="center">
			<ul>
				<li class="count"><i></i><h4 class="count"><?php echo $options_theme['data_05']; ?></h4><span>Проектов</span></li>
				<li class="count"><i></i><h4 class="count"><?php echo $options_theme['data_06']; ?></h4><span>Текстов</span></li>
				<li class="count"><i></i><h4 class="count"><?php echo $options_theme['data_07']; ?></h4><span>Клиентов</span></li>
			</ul>
		</div>
	</div>
	
	<div class="block" id="about">
		<?php wp_reset_query(); ?>
		<div class="center">
			<?php 
				if (have_posts()) : while (have_posts()) : the_post(); 
					setup_postdata($post);
			?>	
				<div class="content">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			<?php endwhile; endif; ?>
		</div>
		<div class="bulge-level-top"></div>
		<div class="bulge-level-bottom"></div>
	</div>
	
	<div class="block" id="awards">
		<div class="title">
			<h2>Наши награды</h2>
		</div>
		<div class="center">
			<div id="list-awards">
				<?php 
					global $post; $i = 0;
					$myposts = query_posts('post_type=awards&showposts=4');
						foreach($myposts as $post) : 
						setup_postdata($post);
						$i++;
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
				?>
					<div class="item">
						<span><img src="<?php echo $large_image_url[0]; ?>" /></span>
						<h3><?php the_title(); ?></h3>
					</div>
				<?php endforeach; wp_reset_query(); ?>
			</div>
		</div>
	</div>
	
	<div class="block" id="rank">
		<div class="title">
			<h2>Наши звания</h2>
		</div>
		<div class="center">
			<div id="list-rank">
				<?php 
					global $post; $i = 0;
					$myposts = query_posts('post_type=rank&showposts=4');
						foreach($myposts as $post) : 
						setup_postdata($post);
						$i++;
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
				?>
					<div class="item">
						<span><img src="<?php echo $large_image_url[0]; ?>" /></span>
						<h3><?php the_title(); ?></h3>
					</div>
				<?php endforeach; wp_reset_query(); ?>
			</div>
		</div>
	</div>
	
	<div class="block" id="client">
		<div class="title">
			<h2>Наши клиенты</h2>
		</div>
		<div class="center">
			<div id="client-list">
				<ul>
					<?php 
						global $post;
						$myposts = query_posts('post_type=client&showposts=99&post_parent=0');
							foreach($myposts as $post) : 
							setup_postdata($post);
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
							$data_01 = get_post_meta($post->ID, 'cpi_data_01', true);
					?>
						<?php if (strlen($data_01) > 2) { ?>
							<li><a target="_blank" href="<?php echo $data_01; ?>"><img src="<?php echo $large_image_url[0]; ?>" /></a></li>
						<?php } else { ?>
							<li><img src="<?php echo $large_image_url[0]; ?>" /></li>
						<?php } ?>
					<?php endforeach; wp_reset_query(); ?>
				</ul>
			</div>
			<div class="client-button">
				<a href="#to-message" class="to-forms">Стать клиентом</a>
			</div>
		</div>
	</div>
	
	<div class="block" id="mapa">
		<div class="title">
			<h2>Мы тут</h2>
		</div>
		            <script> zindex = 103 </script>
		    <div id="map-canvas_contacts" onclick="style.zIndex = zindex--">
                <a></a> 
            </div>
             <div id="map-canvas_contacts_google" onclick="style.zIndex = zindex++">
                     <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1287.065061806292!2d23.916868027508563!3d49.82121949127114!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473ae0cc671ceb95%3A0x8b2a3ef96a3bf94b!2z0LLRg9C7LiDQk9C-0YDQvtC00L7RhtGM0LrQsCwgMzY3LCDQm9GM0LLRltCyLCDQm9GM0LLRltCy0YHRjNC60LAg0L7QsdC70LDRgdGC0Yw!5e0!3m2!1suk!2sua!4v1415955802317" width="100%" height="400" frameborder="0" style="border:0"></iframe>
                 </div>
	</div>

<?php include 'footer.php'; ?>