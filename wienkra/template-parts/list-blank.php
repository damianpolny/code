<?php $url = get_the_permalink(); ?>
<div class="col">
	<div class="list-post">
		<a href="<?php echo $url; ?>" rel="nofollow">
			<?php
				if (has_post_thumbnail())
				{
					the_post_thumbnail('thumbnail');
				}
			?>
			<h2 class="list-post-name"><?php the_title(); ?></h2>
		</a>
		<?php the_excerpt(); ?>
		<p><a class="custom-read-more" href="<?php echo $url; ?>"><?php echo __("Dalej", "wienkra"); ?></a></p>
	</div>
</div>