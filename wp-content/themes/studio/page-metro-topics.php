<?php /* Template Name: Метро - тематики */ ?>
<?php include 'header.php'; ?>

	<?php if (function_exists('bshepelev_breadcrumbs')) bshepelev_breadcrumbs(); ?>
	
	<div class="block" id="content">
		<div class="center">
			<?php 
				wp_reset_query();
				if (have_posts()) : while (have_posts()) : the_post(); 
					setup_postdata($post);
			?>	
				<div class="content">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			<?php endwhile; endif; ?>
			<div id="list-topics">
				<div class="tiles tile-group">
					<?php
						$i = 0;
						$terms = get_terms("subjects","orderby=id&order=DESC");
						if (count($terms) > 0) { 
							foreach ($terms as $term) { 
								$i++;
								if (strlen($term->description) > 1) {
									$output = wptexturize($term->description);
								} else {
									$output = $term->name;
								}
								$term_link = get_term_link($term);
								switch($i) {
									case 1: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="flip" data-direction="vertical" data-delay="9000" rel="<?php echo $term_link; ?>">
											<div class="green" data-delay="4500">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 2: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="carousel" data-direction="vertical" data-delay="11000" rel="<?php echo $term_link; ?>">
											<div class="white-purple">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 3: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile start-stop" data-mode="slide" data-swap="image" data-direction="vertical" data-stops="100%,0,100%" data-delay="12000" rel="<?php echo $term_link; ?>">
											<div class="gray">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 4: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="fade" data-delay="13000" rel="<?php echo $term_link; ?>">
											<div class="white-green">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 5: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="fade" data-delay="9000" rel="<?php echo $term_link; ?>">
											<div class="white-green">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 6: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="flip" data-direction="horizontal" data-delay="11000" rel="<?php echo $term_link; ?>">
											<div class="green">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 7: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="carousel" data-direction="horizontal" data-delay="12000" rel="<?php echo $term_link; ?>">
											<div class="white-green">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 8: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="flip" data-direction="vertical" data-delay="13000" rel="<?php echo $term_link; ?>">
											<div class="gray">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 9: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile start-stop" data-mode="slide" data-swap="image" data-direction="vertical" data-stops="100%,0,100%" data-delay="8000" rel="<?php echo $term_link; ?>">
											<div class="green">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 10: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="fade" data-delay="12000" rel="<?php echo $term_link; ?>">
											<div class="white-green">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 11: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="flip" data-direction="vertical" data-delay="11000" rel="<?php echo $term_link; ?>">
											<div class="gray">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
										break;
									case 12: 
					?>
										<div id="brick-<?php echo $term->term_id; ?>" class="live-tile" data-mode="flip" data-direction="vertical" data-delay="9000" rel="<?php echo $term_link; ?>">
											<div class="green">
												<h2><?php echo $output; ?></h2>
											</div>
											<div>
												<img class="thumb" src="<?php bloginfo('template_directory'); ?>/images/work/topics/<?php echo $term->term_id; ?>_images.jpg" />
											</div>
										</div>
					<?php
									}
							} 
						}
					?>
				</div>
			</div>
			<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/metrojs.js"></script>
			<script type="text/javascript">
				$(document).ready(function () {
				
					$(".live-tile").liveTile({
						pauseOnHover: true,
						onHoverOutDelay: 300
					});
					
					$(".live-tile").hover(function(){
						$(this).addClass("hover");
						$first = $(this).find('div').first().html();
						$(this).append('<div class="purple new">' + $first + '</div>');

					}, function(){
						$(this).removeClass("hover");
						$(this).find('div.new').fadeOut('slow');
						setTimeout(function() {
							$(this).find('div.new').remove();
						}, 555);
					});
					
					$(".live-tile").click(function(){
						$rel = $(this).attr('rel');
						location.href = $rel;
						return false;
					});
					
				});
			</script>
		</div>
	</div>

<?php include 'footer.php'; ?>