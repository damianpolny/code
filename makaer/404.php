<?php

get_header(); ?>
	<div class="page-wraper">
		<div class="page-content">
			<div class="grid-2_md-1-middle-noGutter">
				<div class="col">
					<div class="content-img-404">
						<p><img width="" height="" src="<?php echo get_template_directory_uri(); ?>/img/404.webp" alt="404"></p>
					</div>
				</div>
				<div class="col">
					<div class="content-text-404">
						<p class="section-heading">
							<span><?php echo __('Nie znaleziono strony', 'makaer'); ?></span><span class="section-heading-line"></span>
						</p>
						<h1><?php echo __('STRONA KTÓREJ SZUKASZ NIE ISTNIEJE', 'makaer'); ?></h1>
						<p><?php echo __('Wygląda na to, że strona której szukasz została usunięta lub przeniesiona przez administratora. Upewnij się, że adres nie zawiera błędów lub spróbuj ponownie później. W razie dalszych problemów skontaktuj się z administratorem strony.', 'makaer'); ?></p>
						<p><a class="custom-button" href="<?php echo get_home_url(); ?>"><?php echo __('STRONA GŁÓWNA', 'makaer'); ?></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
