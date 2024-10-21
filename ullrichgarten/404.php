<?php

get_header(); ?>
	<div class="page-hero-top">
		<div class="page-hero-top-content">
			<div class="container text-center">
				<div class="page-title-content">
					<h1 class="page-title"><?php echo __('Die von Ihnen angegebene Seite existiert leider nicht.', 'ullrichgarten'); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content text-center">
				<p><?php echo __('Es scheint, dass die Seite, die Sie suchen, von einem Administrator verschoben oder gelöscht wurde. Bitte vergewissern Sie sich, dass die von Ihnen eingegebene Adresse keine Fehler enthält, oder versuchen Sie es später noch einmal.', 'ullrichgarten'); ?></p>
				<p><a class="custom-button" href="<?php echo get_home_url(); ?>"><?php echo __('Zur Hauptseite gehen', 'ullrichgarten'); ?></a></p>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
