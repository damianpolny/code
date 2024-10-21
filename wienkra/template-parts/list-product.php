<?php $url = get_the_permalink(); ?>
<div class="list-product">
	<div class="grid-middle">
		<div class="col-4_lg-5_sm-12">
			<a href="<?php echo $url; ?>" rel="nofollow">
				<?php
					if (has_post_thumbnail())
					{
						the_post_thumbnail('logos_img');
					}
				?>
			</a>
		</div>
		<div class="col-8_lg-7_sm-12">
			<h2 class="list-product-name"><?php the_title(); ?></h2>
			<?php the_excerpt(); ?>
			<div><a class="custom-read-more" href="<?php echo $url; ?>"><?php echo __("Czytaj więcej", "wienkra"); ?></a></div>
		</div>
	</div>
</div>