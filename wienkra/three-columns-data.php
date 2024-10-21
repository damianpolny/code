<?php

/* Template name: Trzy kolumny */

get_header();
if(have_posts()): while (have_posts()): the_post();
$id_page = get_the_ID();
$extra_column_page = rwmb_meta('extra_column_page', '', $id_page);
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<?php the_content(); ?>
			</div>
			<?php
				if(isset($extra_column_page[0])):
				echo '<div class="section-columns-page"><div class="grid-3_lg-2_sm-1">';
				foreach($extra_column_page as $single):
			?>
			<div class="col">
				<div class="section-column-page">
					<?php echo apply_filters("the_content", $single); ?>
				</div>
			</div>
			<?php
				endforeach;
				echo '</div></div>';
				endif;
			?>
		</div>
	</div>
<?php endwhile; endif; get_footer(); ?>