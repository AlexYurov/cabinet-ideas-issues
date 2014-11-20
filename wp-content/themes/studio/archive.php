<?php include 'header.php'; ?>
<?php 
	wp_reset_query();
	$queried_post_type = get_query_var('post_type'); 
	$queried_post_term = get_query_var('term');
	$tax = $wp_query->get_queried_object();
	if (strlen($tax->taxonomy) > 1) {
		$queried_post_type = $tax->taxonomy;
	}
	$post_standart = true; 
?>

	<?php if ($queried_post_type == 'reviews') { ?>

		<div class="block" id="slider-static" style="background-image:url('<?php bloginfo('template_directory'); ?>/images/slider-static/archive-reviews.jpg');">
			<div class="center">
				<div class="cell" style="text-align:left;">
					
				</div>
			</div>
		</div>
		<?php if (function_exists('bshepelev_breadcrumbs')) bshepelev_breadcrumbs(); ?>
		<div class="block" id="content">
			<div class="center">
				<div class="reviews-button">
					<a href="#send-reviews" class="to-forms">Добавить отзыв</a>
				</div>
				<div id="list-reviews">
					<?php 
						wp_reset_query();
						$days_difference_message = '';
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
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '300x300');
							$data_01 = get_post_meta($post->ID, 'cpi_data_01', true);
							$data_02 = get_post_meta($post->ID, 'cpi_data_02', true);
							$days_difference = floor((strtotime("now")-strtotime(get_the_date("Y-m-d")))/86400);
							switch($days_difference) {
								case 1: $days_difference_message = '1 день назад'; break;
								case 2: $days_difference_message = '2 дні тому'; break;
								case 3: $days_difference_message = '3 дні тому'; break;
								case 4: $days_difference_message = '4 дні тому'; break;
								case 5: $days_difference_message = '5 днів тому'; break;
								case 6: $days_difference_message = '6 днів тому'; break;
								case 7: $days_difference_message = 'тиждень тому'; break;
								case 8: $days_difference_message = '8 днів тому'; break;
								case 9: $days_difference_message = '9 днів тому'; break;
								case 10: $days_difference_message = '10 днів тому'; break;
							}
					?>	
						<div class="post" id="post-<?php the_ID(); ?>">
							<h2><?php the_title(); ?></h2>
							<div class="content">
								<?php the_content(); ?>
								<div class="clear"></div>
							</div>
							<div class="footer">
								<span class="data"><?php if (strlen($days_difference_message) > 2) { echo $days_difference_message; } else { echo get_the_date('d').' '.$nm.' '.get_the_date('Y'); } ?></span>
								<b>&nbsp;&nbsp;&mdash;&nbsp;&nbsp;<?php echo $data_01; ?></b><?php if (strlen($data_02) > 1) { ?><i>( <?php echo $data_02; ?> )</i><?php } ?></div>
							<div class="share">
								<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
								<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="facebook,vkontakte,twitter,gplus" data-yashareTitle="<?php the_title(); ?>" data-yashareDescription="<?php the_excerpt(); ?>" data-yashareImage="none" data-yashareTheme="counter" data-yashareLink="<?php the_permalink(); ?>"></div> 
							</div>
						</div>
					<?php endwhile; endif; ?>
					<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
				</div>
			</div>
		</div>
		<?php $post_standart = false; ?>
	<?php } ?>
	
	<?php if ($queried_post_type == 'subjects') { ?>
		<div class="block" id="crumbs">
			<div class="center">
				<ul>
					<li><a href="<?php bloginfo('url'); ?>">Главная</a></li>  
					<li><a href="<?php echo get_permalink(154); ?>"><?php echo get_the_title(154); ?></a></li>  
					<li><span class="current"><?php echo $tax->name; ?></span></li>
				</ul>
			</div>
		</div>
		<div class="block" id="content">
			<div class="center">
				<div class="list-portfolio-category">
					<?php 
						$importance = array();
						$importance['key'] = 'cpi_data_81';
						$importance['value'] = 'importance';
						$importance['compare'] = 'IN';
						$exclude_ = array();
						global $post;
						$args = array(
							'post_type' => 'work',
							'showposts' => 4,
							'subjects' => $tax->slug,
							'meta_query' => array(
								$importance
							)
						);
						$i = 0;
						$myposts = query_posts($args);
							foreach($myposts as $post) : 
							setup_postdata($post);
							$i++;
							$exclude_[] = $post->ID;
					?>
						<div class="item<?php if ($i == 1) { echo ' first'; } if ($i == 4) { echo ' last'; } ?>">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('300x300', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
								<div><h2><?php the_title(); ?></h2></div>
							</a>
						</div>
					<?php endforeach; wp_reset_query(); ?>
					<div class="clear"></div>
				</div>
				<div class="list-portfolio-category" style="border-top:1px solid #83be16; padding:30px 0 0 0; margin:30px 0 0 0;">
					<?php 
						wp_reset_query(); $i = 0;
						global $query_string;
						$args = array_merge( $wp_query->query, array( 'post__not_in' => $exclude_) );
						query_posts($args);
						if (have_posts()) : while (have_posts()) : the_post(); 
							setup_postdata($post);
							$i++;
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '300x300');
					?>	
						<div class="item<?php if ($i == 1) { echo ' first'; } if ($i == 4) { echo ' last'; } ?>">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('300x300', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
								<div><h2><?php the_title(); ?></h2></div>
							</a>
						</div>
					<?php 
							if ($i == 4) { $i = 0; echo '<div class="clear"></div>'; }
						endwhile; endif; 
						if ($i != 0) { echo '<div class="clear"></div>'; }
					?>
				</div>
				<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
			</div>
		</div>
		<?php $post_standart = false; ?>
	<?php } ?>
	
	<?php if ($queried_post_type == 'categories') { ?>
		<div class="block" id="crumbs">
			<div class="center">
				<ul>
					<li><a href="<?php bloginfo('url'); ?>">Главная</a></li>  
					<li><a href="<?php echo get_permalink(154); ?>"><?php echo get_the_title(154); ?></a></li>  
					<li><span class="current"><?php echo $tax->name; ?></span></li>
				</ul>
			</div>
		</div>
		<div class="block" id="content">
			<div class="center">
				<div class="list-portfolio-category">
					<?php 
						$importance = array();
						$importance['key'] = 'cpi_data_81';
						$importance['value'] = 'importance';
						$importance['compare'] = 'IN';
						$exclude_ = array();
						global $post;
						$args = array(
							'post_type' => 'work',
							'showposts' => 4,
							'categories' => $tax->slug,
							'meta_query' => array(
								$importance
							)
						);
						$i = 0;
						$myposts = query_posts($args);
							foreach($myposts as $post) : 
							setup_postdata($post);
							$i++;
							$exclude_[] = $post->ID;
					?>
						<div class="item<?php if ($i == 1) { echo ' first'; } if ($i == 4) { echo ' last'; } ?>">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('300x300', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
								<div><h2><?php the_title(); ?></h2></div>
							</a>
						</div>
					<?php endforeach; wp_reset_query(); ?>
					<div class="clear"></div>
				</div>
				<div class="list-portfolio-category" style="border-top:1px solid #83be16; padding:30px 0 0 0; margin:30px 0 0 0;">
					<?php 
						wp_reset_query(); $i = 0;
						global $query_string;
						$args = array_merge( $wp_query->query, array( 'post__not_in' => $exclude_) );
						query_posts($args);
						if (have_posts()) : while (have_posts()) : the_post(); 
							setup_postdata($post);
							$i++;
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '300x300');
					?>	
						<div class="item<?php if ($i == 1) { echo ' first'; } if ($i == 4) { echo ' last'; } ?>">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('300x300', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
								<div><h2><?php the_title(); ?></h2></div>
							</a>
						</div>
					<?php 
							if ($i == 4) { $i = 0; echo '<div class="clear"></div>'; }
						endwhile; endif; 
						if ($i != 0) { echo '<div class="clear"></div>'; }
					?>
				</div>
				<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
			</div>
		</div>
		<?php $post_standart = false; ?>
	<?php } ?>

	<?php if ($post_standart == true) { ?>
		<div class="block" id="slider-static" style="background-image:url('<?php bloginfo('template_directory'); ?>/images/slider-static/archive-blog.jpg');">
			<div class="center"></div>
		</div>
		<?php if (function_exists('bshepelev_breadcrumbs')) bshepelev_breadcrumbs(); ?>
		<div class="block" id="content">
			<div class="center">
				<div class="left" id="page-left">
					<div id="list-blog">
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
							<div class="post" id="post-<?php the_ID(); ?>">
								<div class="left post-left">
									<?php if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('300x300', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>
									<?php } ?>
								</div>
								<div class="right post-right">
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<?php the_excerpt(); ?>
									<div class="post-footer">
										<div class="left"><?php echo get_the_date('d').' '.$nm.' '.get_the_date('Y'); ?><div class="author_style"><span>Автор: <?php the_author_posts_link(); ?></span></div></div>
										<div class="right"><a href="<?php the_permalink(); ?>">Читати далі</a></div>
										<div class="clear"></div>
									</div>
								</div>
								<div class="clear"></div>
								<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
								<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="facebook,vkontakte,twitter,gplus" data-yashareTitle="<?php the_title(); ?>" data-yashareDescription="<?php the_excerpt(); ?>" data-yashareImage="<?php echo $large_image_url[0]; ?>" data-yashareTheme="counter" data-yashareLink="<?php the_permalink(); ?>"></div> 
							</div>
						<?php endwhile; endif; ?>
					</div>
					<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
				</div>
				<div class="right" id="page-right">
					<div id="widget-area">
						<?php 
							if (is_active_sidebar('widget-area-blog')) : 
								echo '<ul>';
									dynamic_sidebar('widget-area-blog');
								echo '</ul>';
							endif;
						?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	<?php } ?>

<?php include 'footer.php'; ?>