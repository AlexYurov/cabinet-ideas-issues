
		<?php if (!is_404()) { ?>
	
			<div class="block" id="footer">
				<div class="center">
					<div class="bulge-level"></div>
					<div class="left form">
						<?php echo do_shortcode('[contact-form-7 id="159" title="Форма - футер"]'); ?>
					</div>
					<div class="left logo-social">
						<a class="logo-bottom" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
						<ul>
							<li class="facebook"><a target="_blank" href="https://www.facebook.com/kabinet.ideas">Facebook</a></li>
							<li class="vk"><a target="_blank" href="https://vk.com/kabinet.ideas">Вконтакте</a></li>
							<li class="twitter"><a target="_blank" href="https://twitter.com/Cabinet_ideas">Twitter</a></li>
							<li class="instagram"><a target="_blank" href="http://instagram.com/cabinet.ideas">Instagram</a></li>
                            <li class="linkedin"><a target="_blank" href="https://www.linkedin.com/company/ра-«кабинет-идей»">LinkedIn</a></li>
						</ul>
					</div>
					<div class="right adress-phone">
						<ul>
							<li class="adress"><?php echo $options_theme['data_01']; ?></li>
							<li class="phone"><a href="tel:<?php echo $options_theme['data_02']; ?>"><?php echo $options_theme['data_02']; ?></a></li>
							<li class="email"><a href="mailto:<?php echo $options_theme['data_03']; ?>"><?php echo $options_theme['data_03']; ?></a></li>
							<li class="skype"><a href=" skype:<?php echo $options_theme['data_04']; ?>?add"><?php echo $options_theme['data_04']; ?></a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		
		<?php } ?>

		<?php wp_footer(); ?>
		
		<!-- FORMS --->
		
		<div id="to-message">
			<div class="formss">
				<h3>Заполните форму</h3>
				<?php echo do_shortcode('[contact-form-7 id="64" title="Форма обратной связи"]'); ?>
				<a class="close">Закрыть</a>
			</div>
		</div>
		
		<div id="send-reviews">
			<div class="formss">
				<h3>Додати вiдгук</h3>
				<?php echo do_shortcode('[contact-form-7 id="130" title="Добавить отзыв"]'); ?>
				<a class="close">Закрыть</a>
			</div>
		</div>

		<div id="send-cv">
			<div class="formss">
				<h3>Отправить резюме</h3>
				<?php echo do_shortcode('[contact-form-7 id="482" title="Отправить резюме"]'); ?>
				<a class="close">Закрыть</a>
			</div>
		</div>
		



        

		<div id="load">
			<div class="loads"></div>
		</div>
		
	</body>
</html>



