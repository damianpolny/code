<?php
	$term_list = get_the_terms(get_the_ID(), 'kategoria-produktu');
	$category = array();
	if(!empty($term_list) && is_array($term_list))
	{
		foreach($term_list as $item)
		{
			$category[] = 'cat-id-'.$item->term_id;
		}
	}
?>
<div class="col <?php echo implode(' ', $category); ?>">
	<div class="box-product">
		<a href="<?php the_permalink(); ?>">
			<?php
				if(has_post_thumbnail())
				{
					echo '<div class="box-product-img">';
					the_post_thumbnail('product_size');
					if(mobile_detect() != 'phone')
					{
						echo '<span class="read-more-box">'.__('Zobacz produkt', 'makaer').'</span>';
					}
					echo '</div>';
				}
			?>
			<p class="box-product-name"><?php the_title(); ?></p>
		</a>
		<?php echo apply_filters('the_excerpt', wp_trim_words(get_the_excerpt(), 15)); if(mobile_detect() == 'phone'): ?>
		<p><a class="custom-button display-block" href="<?php the_permalink(); ?>"><?php echo __('ZOBACZ PRODUKT', 'makaer'); ?></a></p>
		<?php endif; ?>
	</div>
</div>