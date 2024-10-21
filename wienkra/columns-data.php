<?php

/* Template name: Kolumny */

get_header();
if(have_posts()): while (have_posts()): the_post();
$id_page = get_the_ID();
$extra_columns_page = rwmb_meta('extra_columns_page', '', $id_page);
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<div class="grid-2_md-1-middle">
					<div class="col">
						<?php
							if (has_post_thumbnail())
							{
								echo '<p>';
								the_post_thumbnail('medium');
								echo '</p>';
							}
						?>
					</div>
					<div class="col">
						<?php 
							the_content();
						?>
					</div>
				</div>
				<?php
					if(isset($extra_columns_page[0])):
					echo '<div class="section-columns-product">';
					foreach($extra_columns_page as $single):
				?>
				<div class="section-column-product">
					<div class="grid-2_md-1-middle">
						<div class="col">
							<?php 
								if(isset($single['extra_columns_page_desc']))
								{
									echo apply_filters("the_content", $single['extra_columns_page_desc']);
								}
							?>
						</div>
						<div class="col">
							<?php 
								if(isset($single['extra_columns_page_img']))
								{
									echo wp_get_attachment_image($single['extra_columns_page_img'], "medium");
								}
							?>
						</div>
					</div>
				</div>
				<?php
					endforeach;
					echo '</div>';
					endif;
				?>
			</div>
		</div>
	</div>
<?php endwhile; endif; get_footer(); ?>
