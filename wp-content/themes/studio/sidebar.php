<div id="sidebar">

	<div class="brick ask-a-question">
		<h3>Задать вопрос</h3>
		<b>Есть вопрос? Мы с радостью ответим</b>
		<div class="list">
			<p class="mail">email: <span><a href="mailto:<?php echo $options_theme['data_05']; ?>"><?php echo $options_theme['data_05']; ?></a></span></p>
			<p class="phone">тел: <span><?php echo $options_theme['data_04']; ?></span></p>
		</div>
	</div>
	
	<div class="brick banner">
		<h3>Наши услуги</h3>
		<div class="list">
			<ul>
				<?php 
					global $post;
					$myposts = query_posts('post_type=banner&showposts=99&orderby=rand');
						foreach($myposts as $post) : 
						setup_postdata($post);
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
						$data_01 = get_post_meta($post->ID, 'cpi_data_01', true);
				?>
					<li style="background:url('<?php echo $large_image_url[0]; ?>') no-repeat 0 0;">
						<?php if (strlen($data_01) > 1) { ?>
							<h4><a href="<?php echo $data_01; ?>"><?php the_title(); ?></a></h4>
						<?php } else { ?>
							<h4><?php the_title(); ?></h4>
						<?php } ?>
					</li>
				<?php endforeach; wp_reset_query(); ?>
			</ul>
		</div>
	</div>
	
	<div class="brick service animates" data-effect="fadeInDown">
		<div class="list">
			<ul>
				<?php 
					global $post;
					$myposts = query_posts('post_type=service&showposts=99');
						foreach($myposts as $post) : 
						setup_postdata($post);
				?>
					<?php 
						//if ('/stroy/service/' + $post->post_name == $_SERVER['REQUEST_URI']) {
					?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; wp_reset_query(); ?>
			</ul>
		</div>
	</div>
	
	<div class="brick news">
		<h3>Новости и события</h3>
		<div class="list">
			<?php 
				global $post;
				$myposts = query_posts('post_type=news&showposts=2');
					foreach($myposts as $post) : 
					setup_postdata($post);
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
					$data_01 = get_post_meta($post->ID, 'cpi_data_01', true);
					switch($data_01) {
						case 'news': $bshepelev = 'Новости'; break;
						case 'events': $bshepelev = 'Событие'; break;
					}
			?>
				<div class="item animates" data-effect="fadeInDown">
					<?php if (has_post_thumbnail()) { ?>
						<div class="left">
							<a class="image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('102x102', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>
							<span class="view <?php echo $data_01; ?>"><?php echo $bshepelev; ?></span>
							<span class="data"><?php echo get_the_date('d.m.Y'); ?></span>
							<p class="more"><a href="<?php the_permalink(); ?>">Узнать больше</a></p>
						</div>
						<div class="right">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<p><?php the_excerpt(); ?></p>
						</div>
						<div class="clear"></div>
					<?php } else { ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<span class="view <?php echo $data_01; ?>"><?php echo $bshepelev; ?></span><span class="data"><?php echo get_the_date('d.m.Y'); ?></span>
						<p style="padding:5px 0 0 0;"><?php the_excerpt(); ?></p>
						<p class="more"><a href="<?php the_permalink(); ?>">Узнать больше</a></p>
					<?php } ?>
				</div>
			<?php endforeach; wp_reset_query(); ?>
			<div class="clear"></div>
		</div>
	</div>
	
</div>