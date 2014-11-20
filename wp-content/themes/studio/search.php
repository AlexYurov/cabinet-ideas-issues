<?php include 'header.php'; ?>

	<div class="block" id="header" style="background:url('<?php bloginfo('template_directory'); ?>/images/page/header-bg-1.jpg') no-repeat center 0;">
		<div class="center">
			<span>Мы просто создаем лучшие проекты</span>
		</div>
	</div>

		<div class="block" id="page">
			<div class="center">
				<div class="left page-left">
					<h1 class="title">
						Результаты поиска "<?php echo $s; ?>"
					</h1>
					<div id="list-blog">
						<?php 
							if (have_posts()) : while (have_posts()) : the_post(); 
								setup_postdata($post);
								$m = get_the_date('m');
								switch($m) {
									case '01': $nm = 'январь'; break;
									case '02': $nm = 'феввраль'; break;
									case '03': $nm = 'март'; break;
									case '04': $nm = 'апрель'; break;
									case '05': $nm = 'май'; break;
									case '06': $nm = 'июнь'; break;
									case '07': $nm = 'июль'; break;
									case '08': $nm = 'август'; break;
									case '09': $nm = 'сентябрь'; break;
									case '10': $nm = 'октябрь'; break;
									case '11': $nm = 'ноябрь'; break;
									case '12': $nm = 'декабрь'; break;
								}
								$data_01 = get_post_meta($post->ID, 'cpi_data_01', true);
						?>	
							<div class="item" id="post-<?php the_ID(); ?>">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="left">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('185x152', array('alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
										</a>
									</div>
									<div class="right">
										<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<div class="attr">
											<span class="data"><?php echo get_the_date('d').' '.$nm.' '.get_the_date('Y'); ?></span>|
											<span class="comment-col">Комментариев - 19</span>|
											<span class="view">- <?php echo $data_01; ?></span>
										</div>
										<p class="excerpt"><?php the_excerpt(); ?></p>
										<div class="sharing">
											<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
											<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,moimir,gplus" data-yashareTheme="counter"></div> 
										</div>
									</div>
									<div class="clear"></div>
								<?php } else { ?>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<div class="attr">
										<span class="data"><?php echo get_the_date('d').' '.$nm.' '.get_the_date('Y'); ?></span>|
										<span class="comment-col">Комментариев - 19</span>|
										<span class="view">- <?php echo $data_01; ?></span>
									</div>
									<p class="excerpt"><?php the_excerpt(); ?></p>
									<div class="sharing">
										<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
										<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,moimir,gplus" data-yashareTheme="counter"></div> 
									</div>
								<?php } ?>
							</div>
						<?php endwhile; endif; ?>
					</div>
					<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
				</div>
				<div class="right page-right">
					<?php include 'sidebar.php'; ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>	

<?php include 'footer.php'; ?>