<?php

get_header(); ?>
	<div class="page-wraper">
		<div class="container">
			<div style="max-width:836px;width:100%;margin:0 auto">
				<div class="page-content text-center">
					<h1><?php echo __('Przepraszamy, podana strona nie istnieje.', 'cn'); ?></h1>
					<p><?php echo __('Wygląda na to, że strona, której szukasz została przeniesiona lub usunięta przez administratora. Upewnij się czy we wpisanym adresie nie ma błędów lub spróbuj ponownie później.', 'cn'); ?></p>
					<div class="grid-2_sm-1">	
						<div class="col">
							<p><a class="custom-button" href="<?php echo get_home_url(); ?>"><?php echo __('Strona główna', 'cn'); ?></a></p>
						</div>
						<div class="col">
							<p><a class="custom-button" href="<?php echo get_post_type_archive_link('kurs'); ?>"><?php echo __('Zobacz kursy', 'cn'); ?></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
