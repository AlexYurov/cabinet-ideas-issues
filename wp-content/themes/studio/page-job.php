<?php /* Template Name: Вакансии */ ?>
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
	
	<div class="block" id="content">
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
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			<?php endwhile; endif; ?>
			<div id="list-job">
				<?php 
					global $post;
					$myposts = query_posts('post_type=jobs&showposts=99');
						foreach($myposts as $post) : 
						setup_postdata($post);
						$data_01 = get_post_meta($post->ID, 'cpi_data_01', true);
				?>
					<div class="item">
						<div class="header">
							<h2><?php the_title(); ?></h2>
							<i class="<?php echo $data_01; ?>"></i>
							<span></span>
						</div>
						<div class="show-hide">
							<div class="content">
								<?php the_content(); ?>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				<?php endforeach; wp_reset_query(); ?>
			</div>
		</div>
	</div>

<?php include 'footer.php'; ?>