<div class="col">
	<div class="content-box-post fade-up">
		<div class="content-box-post-img">
			<?php
				if(has_post_thumbnail())
				{
					echo '<a href="'.get_permalink().'">';
					the_post_thumbnail('thumbnail');
					echo '</a>';
				}
			?>
			<div class="content-box-post-date">
				<div>
					<span class="number-day"><?php echo get_the_date('d'); ?></span>
					<span><?php echo get_the_date('F'); ?></span>
				</div>
			</div>
		</div>
		<div class="content-box-post-entry">
			<p class="content-box-post-author"><?php echo __('By', 'goldenrocket'); ?> / <?php echo get_the_author_meta('nicename'); ?></p>
			<p class="content-box-post-name"><?php the_title(); ?></p>
			<p><a class="read-more" href="<?php the_permalink(); ?>"><span><?php echo __('Czytaj', 'goldenrocket'); ?></span></a></p>
		</div>
	</div>
</div>