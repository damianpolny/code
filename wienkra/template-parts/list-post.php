<?php $url = get_the_permalink(); ?>
<div class="col">
	<div class="list-post post-type">
		<?php if(isset($args['flag'])): if($args['flag'] == 'featured'): ?>
		<div class="list-post-flag"><?php echo __("POLECANE", "wienkra"); ?></div>
		<?php endif; endif; ?>
		<a href="<?php echo $url; ?>" rel="nofollow">
			<?php
				if (has_post_thumbnail())
				{
					the_post_thumbnail('thumbnail');
				}
			?>
			<h2 class="list-post-name"><?php the_title(); ?></h2>
		</a>
		<div class="list-post-date"><span class="wienkra_icon_calendar_fill"></span><?php echo get_the_date(); ?></div>
		<?php echo apply_filters('the_excerpt' ,wp_trim_words(get_the_excerpt(), 15)); ?>
		<p><a class="custom-read-more" href="<?php echo $url; ?>"><?php echo __("Dalej", "wienkra"); ?></a></p>
	</div>
</div>