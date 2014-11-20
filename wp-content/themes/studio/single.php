<?php include 'header.php'; ?>
<?php 
	wp_reset_query();
	$queried_post_type = get_query_var('post_type'); 
	$queried_post_term = get_query_var('term');
	$post_standart = true; 
?>

	<?php if ($queried_post_type == 'service') { ?>
		<?php 
			wp_reset_query();
			if (have_posts()) : while (have_posts()) : the_post(); 
				setup_postdata($post);
				$data_91 = get_post_meta($post->ID, 'cpi_data_91', true); // URL изображения
				$data_92 = get_post_meta($post->ID, 'cpi_data_92', true); // Текст
				$data_93 = get_post_meta($post->ID, 'cpi_data_93', true); // Выравнивание
				$data_94 = get_post_meta($post->ID, 'cpi_data_94', true); // Основной цвет
				$post_parent = $post->post_parent;
		?>	
			<?php if (strlen($data_91) > 10) { ?>
			<div class="block" id="slider-static" style="background-image:url('<?php if (strlen($data_91) > 1) { echo $data_91; } else {} ?>');">
				<div class="center">
					<?php if (strlen($data_92) > 1) { ?>
						<div class="cell" style="text-align:<?php echo $data_93; ?>;">
							<h3><?php echo $data_92; ?></h3>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="block" id="slider-static" style="background-image:url('<?php bloginfo('template_directory'); ?>/images/slider-static/single-blog.jpg');">
				<div class="center"></div>
			</div>
			<?php } ?>
		<?php endwhile; endif; ?>
		<div class="block" id="crumbs">
			<div class="center">
				<ul>
					<li><a href="<?php bloginfo('url'); ?>">Главная</a></li>  
					<li><a href="<?php echo get_permalink(160); ?>"><?php echo get_the_title(160); ?></a></li>  
					<?php if ($post_parent != 0) { ?>
						<li><a href="<?php echo get_permalink($post_parent); ?>"><?php echo get_the_title($post_parent); ?></a></li>  
					<?php } ?>
					<li><span class="current"><?php the_title(); ?></span></li>
				</ul>
			</div>
		</div>
		<div class="block" id="content">
			<div class="title">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="center">
				<?php 
					wp_reset_query();
					if (have_posts()) : while (have_posts()) : the_post(); 
						setup_postdata($post);
						$ids = $post->ID;
				?>	
					<div class="content">
						<?php the_content(); ?>
						<div class="clear"></div>
					</div>
					<?php if ($post->post_parent == 0) { ?>
						<div id="post-parent-service">
							<?php 
								global $post;
								$myposts = query_posts('post_type=service&showposts=99&post_parent='.$ids.'&orderby=menu_order&order=ASC');
									foreach($myposts as $post) : 
									setup_postdata($post);
							?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</li>
							<?php endforeach; wp_reset_query(); ?>
						</div>
					<?php } ?>
				<?php endwhile; endif; ?>
				<p class="submit-order"><a class="to-forms" href="#to-message">ЗАМОВИТИ</a></p>
			</div>
		</div>
		<?php $post_standart = false; ?>
	<?php } ?>
	
	<?php if ($queried_post_type == 'reviews') { ?>
		<?php 
			wp_reset_query();
			if (have_posts()) : while (have_posts()) : the_post(); 
				setup_postdata($post);
				$data_91 = get_post_meta($post->ID, 'cpi_data_91', true); // URL изображения
				$data_92 = get_post_meta($post->ID, 'cpi_data_92', true); // Текст
				$data_93 = get_post_meta($post->ID, 'cpi_data_93', true); // Выравнивание
				$data_94 = get_post_meta($post->ID, 'cpi_data_94', true); // Основной цвет
		?>	
			<?php if (strlen($data_91) > 10) { ?>
			<div class="block" id="slider-static" style="background-image:url('<?php if (strlen($data_91) > 1) { echo $data_91; } else {} ?>');">
				<div class="center">
					<?php if (strlen($data_92) > 1) { ?>
						<div class="cell" style="text-align:<?php echo $data_93; ?>;">
							<h3><?php echo $data_92; ?></h3>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="block" id="slider-static" style="background-image:url('<?php bloginfo('template_directory'); ?>/images/slider-static/single-blog.jpg');">
				<div class="center"></div>
			</div>
			<?php } ?>
		<?php endwhile; endif; ?>
		<?php if (function_exists('bshepelev_breadcrumbs')) bshepelev_breadcrumbs(); ?>
		<div class="block" id="content">
			<div class="title">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="center" id="post-<?php the_ID(); ?>">
				<?php 
					wp_reset_query();
					if (have_posts()) : while (have_posts()) : the_post(); 
						setup_postdata($post);
						switch(get_the_date('m')) {
						    case '01': $nm = 'Январь'; break;
							case '02': $nm = 'Феввраль'; break;
							case '03': $nm = 'Март'; break;
							case '04': $nm = 'Апрель'; break;
							case '05': $nm = 'Май'; break;
							case '06': $nm = 'Июнь'; break;
							case '07': $nm = 'Июль'; break;
							case '08': $nm = 'Август'; break;
							case '09': $nm = 'Сентябрь'; break;
							case '10': $nm = 'Октябрь'; break;
							case '11': $nm = 'Ноябрь'; break;
							case '12': $nm = 'Декабрь'; break;
						}
						$data_01 = get_post_meta($post->ID, 'cpi_data_01', true);
						$data_02 = get_post_meta($post->ID, 'cpi_data_02', true);
				?>	
					<div class="data"><?php echo get_the_date('d').' '.$nm.' '.get_the_date('Y'); ?></div>
					<div class="like">
						<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
						<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="facebook,vkontakte,twitter,gplus" data-yashareTitle="<?php the_title(); ?>" data-yashareDescription="<?php the_excerpt(); ?>" data-yashareImage="<?php echo $large_image_url[0]; ?>" data-yashareTheme="counter" data-yashareLink="<?php the_permalink(); ?>"></div> 
					</div>
					<div class="content">
						<?php the_content(); ?>
						<div class="clear"></div>
					</div>
					<div class="tags-list"><?php echo $data_01; ?><?php if (strlen($data_02) > 1) { ?>  ( <?php echo $data_02; ?> )<?php } ?></div>
				<?php endwhile; endif; ?>
			</div>
		</div>
		<?php $post_standart = false; ?>
	<?php } ?>		
	
	<?php if ($queried_post_type == 'work') { ?>
		<?php 
			wp_reset_query();
			if (have_posts()) : while (have_posts()) : the_post(); 
				setup_postdata($post);
				$data_91 = get_post_meta($post->ID, 'cpi_data_91', true); // URL изображения
				$data_92 = get_post_meta($post->ID, 'cpi_data_92', true); // Текст
				$data_93 = get_post_meta($post->ID, 'cpi_data_93', true); // Выравнивание
				$data_94 = get_post_meta($post->ID, 'cpi_data_94', true); // Основной цвет
		?>	
			<?php if (strlen($data_91) > 10) { ?>
			<div class="block" id="slider-static" style="background-image:url('<?php if (strlen($data_91) > 1) { echo $data_91; } else {} ?>');">
				<div class="center">
					<?php if (strlen($data_92) > 1) { ?>
						<div class="cell" style="text-align:<?php echo $data_93; ?>;">
							<h3><?php echo $data_92; ?></h3>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="block" id="slider-static" style="background-image:url('<?php bloginfo('template_directory'); ?>/images/slider-static/single-work.jpg');">
				<div class="center">
					<div class="cell" style="text-align:left;">
						<h3> <br /> <span></span></h3>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php endwhile; endif; ?>
		<div class="block" id="crumbs">
			<div class="center">
				<ul>
					<li><a href="<?php bloginfo('url'); ?>">Главная</a></li>  
					<li><a href="<?php echo get_permalink(154); ?>"><?php echo get_the_title(154); ?></a></li> 
					<li><span class="current"><?php the_title(); ?></span></li>
				</ul>
			</div>
		</div>
		<div class="block" id="content">
			<div class="center" id="post-<?php the_ID(); ?>">
				<?php 
					wp_reset_query();
					if (have_posts()) : while (have_posts()) : the_post(); 
						setup_postdata($post);
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '300x300');
				?>	
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
					<div class="content">
						<?php the_content(); ?>
						<div class="clear"></div>
					</div>
					<div class="tags-list"><?php the_tags('Теги: ', ', ', ''); ?></div>
				<?php endwhile; endif; ?>
			</div>
		</div>
		<?php $post_standart = false; ?>
	<?php } ?>	
	
	<?php if ($post_standart == true) { ?>
		<?php 
			wp_reset_query();
			if (have_posts()) : while (have_posts()) : the_post(); 
				setup_postdata($post);
				$data_91 = get_post_meta($post->ID, 'cpi_data_91', true); // URL изображения
				$data_92 = get_post_meta($post->ID, 'cpi_data_92', true); // Текст
				$data_93 = get_post_meta($post->ID, 'cpi_data_93', true); // Выравнивание
				$data_94 = get_post_meta($post->ID, 'cpi_data_94', true); // Основной цвет
		?>	
			<?php if (strlen($data_91) > 10) { ?>
			<div class="block" id="slider-static" style="background-image:url('<?php if (strlen($data_91) > 1) { echo $data_91; } else {} ?>');">
				<div class="center">
					<?php if (strlen($data_92) > 1) { ?>
						<div class="cell" style="text-align:<?php echo $data_93; ?>;">
							<h3><?php echo $data_92; ?></h3>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="block" id="slider-static" style="background-image:url('<?php bloginfo('template_directory'); ?>/images/slider-static/single-blog.jpg');">
				<div class="center"></div>
			</div>
			<?php } ?>
		<?php endwhile; endif; ?>
		<?php if (function_exists('bshepelev_breadcrumbs')) bshepelev_breadcrumbs(); ?>
		<div class="block" id="content">
			<div class="title">
				<h1><?php the_title(); ?></h1>
			</div>
            <!-- ########################   month name in post ##################################-->
			<div class="center" id="post-<?php the_ID(); ?>">
				<?php 
					wp_reset_query();
					if (have_posts()) : while (have_posts()) : the_post(); 
						setup_postdata($post);
						switch(get_the_date('m')) {
                                    case '01': $nm = 'Января'; break;
									case '02': $nm = 'Феввраля'; break;
									case '03': $nm = 'Марта'; break;
									case '04': $nm = 'Апреля'; break;
									case '05': $nm = 'Мая'; break;
									case '06': $nm = 'Июня'; break;
									case '07': $nm = 'Июля'; break;
									case '08': $nm = 'Августа'; break;
									case '09': $nm = 'Сентября'; break;
									case '10': $nm = 'Октября'; break;
									case '11': $nm = 'Ноября'; break;
									case '12': $nm = 'Декабря'; break;
						}
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '300x300');
				?>	
					<div class="data"><?php echo get_the_date('d').' '.$nm.' '.get_the_date('Y'); ?></div>
                 <div class="author_style_in_post"><span>Автор: <?php the_author_posts_link(); ?></span></div>
					<div class="like">
						<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
						<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="facebook,vkontakte,twitter,gplus" data-yashareTitle="<?php the_title(); ?>" data-yashareDescription="<?php the_excerpt(); ?>" data-yashareImage="<?php echo $large_image_url[0]; ?>" data-yashareTheme="counter" data-yashareLink="<?php the_permalink(); ?>"></div> 
					</div>
                   
					<div class="content ">
						<?php the_content(); ?>
						<div class="clear"></div>
					</div>
					<div class="tags-list"><?php the_tags('Теги: ', ', ', ''); ?></div>
				<?php endwhile; endif; ?>
			</div>
		</div>
	<?php } ?>	

<?php include 'footer.php'; ?>