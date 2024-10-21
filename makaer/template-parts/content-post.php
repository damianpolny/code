<div class="col-3_lg-4_md-6_xs-12">
	<div class="content-box-post">
		<a href="<?php the_permalink(); ?>">
			<?php
				if(has_post_thumbnail())
				{
					echo '<p class="content-box-img">';
					the_post_thumbnail('thumbnail');
					echo '</p>';
				}
			?>
			<p class="content-box-post-name"><?php the_title(); ?></p>
		</a>
		<?php the_excerpt(); if(mobile_detect() == 'phone'): ?>
		<p><a class="custom-button fill display-block" href="<?php the_permalink(); ?>"><?php echo __('CZYTAJ WIECEJ', 'makaer'); ?></a></p>
		<?php endif; ?>
	</div>
</div>