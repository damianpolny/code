<?php

/* Template name: Powtarzalne pole */

get_header();
if(have_posts()): while (have_posts()): the_post();
$id_page = get_the_ID();
$repeat_section = rwmb_meta('repeat_section', '', $id_page);
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php if(isset($repeat_section[0])): ?>
	<div class="page-wraper" style="padding-top:0;padding-bottom: 25px;">
		<?php foreach($repeat_section as $single): ?>
		<div class="section-group">
			<?php
				if(isset($single['repeat_section_name'])):
			?>
			<div class="section-title-bar">
				<div class="container">
					<div class="section-title-content color-page">
						<p class="section-title"><?php echo $single['repeat_section_name']; ?></p>
					</div>
				</div>
			</div>
			<?php 
				endif;
				if(isset($single['repeat_section_text'])):
			?>
			<div class="container">
				<?php echo apply_filters("the_content", $single['repeat_section_text']); ?>
			</div>
			<div style="display:block;width:100%;height:25px"></div>
			<?php
				endif;
			?>
		</div>
		<?php endforeach; ?>
	</div>
<?php endif; endwhile; endif; get_footer(); ?>