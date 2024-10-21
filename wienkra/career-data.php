<?php

/* Template name: Kariera */

get_header();
if(have_posts()): while (have_posts()): the_post();
	$id_page = get_the_ID();
	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => -1,
		'post_parent'    => $id_page,
		'order'          => 'ASC',
		'orderby'        => 'menu_order'
	);
	$parent = new WP_Query($args);
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<?php the_content(); ?>
			</div>
			<?php
				if($parent->have_posts())
				{
					while($parent -> have_posts()): $parent -> the_post();
						echo '<p class="page-list-career"><span class="wienkra_icon_right"></span> <a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
					endwhile; wp_reset_postdata();
				}
			?>
		</div>
	</div>
<?php endwhile; endif; get_footer(); ?>