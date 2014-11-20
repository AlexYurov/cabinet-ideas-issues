<?php /* Template Name: О компании */ ?>
<?php include 'header.php'; ?>

	<?php 
		wp_reset_query();
		if (have_posts()) : while (have_posts()) : the_post(); 
			setup_postdata($post);
			$data_91 = get_post_meta($post->ID, 'cpi_data_91', true); // URL изображения
			$data_92 = get_post_meta($post->ID, 'cpi_data_92', true); // Текст
			$data_93 = get_post_meta($post->ID, 'cpi_data_93', true); // Выравнивание
			$data_94 = get_post_meta($post->ID, 'cpi_data_94', true); // Основной цвет
	?>	
		<div class="block" id="slider-static" style="background-image:url('<?php if (strlen($data_91) > 1) { echo $data_91; } else {} ?>');">
			<div class="center">
				<?php if (strlen($data_92) > 1) { ?>
					<div class="cell" style="text-align:<?php echo $data_93; ?>;">
						<h3><?php echo $data_92; ?></h3>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php endwhile; endif; ?>

	<?php if (function_exists('bshepelev_breadcrumbs')) bshepelev_breadcrumbs(); ?>
	
	<div class="block" id="content">
		<div class="center">
			<?php 
				wp_reset_query();
				if (have_posts()) : while (have_posts()) : the_post(); 
					setup_postdata($post);
			?>	
				<div class="content about_us_text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
	
	<div class="block" id="staff">
		<div id="select-staff">
			<ul>
				<li><span>Отдел разработки</span>
					<ul>
						<?php
							$terms = get_terms("department","orderby=count");
							if (count($terms) > 0) { 
								foreach ($terms as $term) { 
						?>
							<li><a href="#<?php echo $term->slug; ?>" rel="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
						<?php 
								}
							}
						?>
					</ul>
				</li>
			</ul>
		</div>
		<div id="list-staff">
			<?php 
				global $post; $i = 0; $j = 0;
				$myposts = query_posts('post_type=staff&showposts=99&department=otdel-razrabotki');
					foreach($myposts as $post) : 
					setup_postdata($post);
					$i++;
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
					$data_21 = get_post_meta($post->ID, 'cpi_data_21', true);
			?>
				<?php 
					if ($i == 1) { 
						echo '<div class="line">'; 
							echo '<div class="center">';
					} 
				?>
					<div class="item">
						<?php the_post_thumbnail('large', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
						<div class="text">
							<h2><?php the_title(); ?></h2>
							<span><?php echo $data_21; ?></span>
							<div class="content">
								<?php the_content(); ?>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				<?php 
					if ($i == 3) {
								echo '<div class="clear"></div>';
							echo '</div>'; 
						echo '</div>';
						$i = 0;
					} 
				?>
			<?php 
				endforeach; wp_reset_query(); 
				if ($i != 0) { 	
								echo '<div class="clear"></div>';
							echo '</div>'; 
						echo '</div>'; 
				}
			?>
		</div>
		<div class="center" id="slogan">
			We strive to create meaningful connections for users through <br />considered strategy and innovation in the digital space. 
		</div>
	</div>

<?php include 'footer.php'; ?>