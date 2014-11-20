<?php

	include '../../../../wp-config.php';
	include '../../../../wp-load.php';

	$department = $_GET['department']; 
	
	global $post; $i = 0; $j = 0;
	$myposts = query_posts('post_type=staff&showposts=99&department='.$department);
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
<script>
	$('#staff .item').hover(
		function() {
			$(this).find('.text').animate({top: "-=500"}, 500, function() {});
	}, function() {
			$(this).find('.text').animate({top: "+=500"}, 500, function() {});
	});
</script>

