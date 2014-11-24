<?php /* Template Name: Портфолио */ ?>
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
            
				<div class="content text_in_all_content_standart">
					<?php the_content(); ?>
                    
					<div class="clear"></div>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>

<?php include 'footer.php'; ?>

