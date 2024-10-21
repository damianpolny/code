<div class="col col-post">
	<div class="content-box-post">
		<a href="<?php the_permalink(); ?>">
			<?php
				if(has_post_thumbnail())
				{
					the_post_thumbnail();
				}
			?>
		</a>
		<p class="content-box-post-name"><?php the_title(); ?></p>
		<?php the_excerpt(); ?>
		<p class="content-custom-button-next"><a class="custom-button-next" href="<?php the_permalink(); ?>"><span><?php echo __('więcej', 'cn'); ?></span></a></p>
	</div>
</div>