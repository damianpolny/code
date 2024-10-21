<div class="col">
	<div class="content-box-post">
		<a href="<?php the_permalink(); ?>">
			<?php
				if(has_post_thumbnail())
				{
					the_post_thumbnail('thumbnail');
				}
			?>
			<p class="content-box-post-name"><?php the_title(); ?></p>
		</a>
		<?php the_excerpt(); ?>
		<div>
			<a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Czytaj więcej', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
		</div>
	</div>
</div>