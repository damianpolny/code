<?php

get_header(); 
$term_id = get_queried_object_id();
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content">
					<p class="page-title"><?php echo __('Wybierz mieszkanie', 'contigo'); ?></p>
				</div>
				<?php echo get_template_part('template-parts/flat', 'table'); ?>
			</div>
		</div>
<?php get_footer(); ?>