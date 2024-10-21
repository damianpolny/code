<?php

get_header();
?>
		<?php
			if(have_posts()):
			$args_featureds_post = null;
			if(is_home() && !is_paged())
			{
				$post_id_page_archive = get_option('page_for_posts', true);
				if(is_numeric($post_id_page_archive))
				{
					$featureds_post = rwmb_meta('featureds_post', '', $post_id_page_archive);
					if(isset($featureds_post[0]))
					{
						$args_featureds_post = array('post_type' => 'post', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date', 'post_status' => 'publish', 'post__in' => $featureds_post);
					}
				}
			}
			$featureds_post = new WP_Query($args_featureds_post);
			if($featureds_post -> have_posts()):
		?>
		<div class="page-wraper" style="background-color: var(--light_grey)">
			<div class="container">
				<div class="grid-3_md-2_sm-1">
					<?php
						while ($featureds_post -> have_posts()) : $featureds_post -> the_post();
						echo get_template_part('template-parts/list', 'post', array('flag' => 'featured'));
						endwhile; wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<div class="page-wraper">
		<div class="container">
			<?php if($featureds_post -> have_posts()): ?>

			<?php endif; ?>
			<div class="grid-3_md-2_sm-1">
				<?php
					while(have_posts()): the_post();
					$post_type = get_post_type();
					if($post_type == 'post')
					{
						echo get_template_part('template-parts/list', 'post');
					}
					elseif($post_type == 'przedstawiciel')
					{
						echo get_template_part('template-parts/list', 'representative');
					}
					else
					{
						echo get_template_part('template-parts/list', 'blank');
					}
					endwhile;
				?>
			</div>
		<?php
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => __('<span class="wienkra_icon_left"></span> Poprzednia', 'wienkra'),
				'next_text' => __('Następna <span class="wienkra_icon_right"></span>', 'wienkra'),
			));
			else:
		?>
	<div class="page-wraper">
		<div class="container">
			<p><?php echo __('Brak postów spełniających kryteria.', 'wienkra'); ?></p>
		<?php endif; ?>
		</div>
	</div>
<?php get_footer(); ?>
