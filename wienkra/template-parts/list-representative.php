<?php 
	$url = get_the_permalink();
	$id_post = get_the_ID();
	$representative_type = rwmb_meta('representative_type', '', $id_post);
	$representative_email = rwmb_meta('representative_email', '', $id_post);
	$representative_phone = rwmb_meta('representative_phone', '', $id_post);
?>
<div class="col">
	<div class="list-post representative-post">
		<div class="list-post-img">
			<?php
				if (has_post_thumbnail())
				{
					echo '<a href="'.$url.'">'.get_the_post_thumbnail('', 'medium').'</a>';
				}
				if(has_term('', 'dzial'))
				{
					echo '<div class="list-representative-department">'.get_the_term_list($id_post, 'dzial', '', ', ').'</div>';
				}
			?>
		</div>
		<a rel="nofollow" href="<?php echo $url; ?>"><h2 class="list-post-name"><?php the_title(); ?></h2></a>
		<?php 
			if(!empty($representative_type))
			{
				echo '<div class="representative-type">'.$representative_type.'</div>';
			}
			if(has_term('', 'wojewodztwo')):
		?>
		<div class="voivodship-content">
			<span class="text-uppercase"><?php echo __('Opiekun województw:', 'wienkra'); ?></span><br/>
			<?php echo get_the_term_list($id_post, 'wojewodztwo', '', ', '); ?>
		</div>
		<?php 
			endif;
			if(!empty($representative_email)):
		?>
			<p class="email-with-icon"><span class="wienkra_icon_mail"></span><a rel="nofollow" href="mailto:<?php echo antispambot($representative_email); ?>"><?php echo antispambot($representative_email); ?></a></p>
		<?php 
			endif;
			if(!empty($representative_phone)):
		?>
			<p class="phone-with-icon" style="margin-top:-9px"><span class="wienkra_icon_phone"></span><a rel="nofollow" href="tel:<?php echo preg_replace('/\s+/', '', $representative_phone); ?>"><?php echo $representative_phone; ?></a></p>
		<?php 
			endif;
		?>
		<hr>
		<?php the_excerpt(); ?>
	</div>
</div>