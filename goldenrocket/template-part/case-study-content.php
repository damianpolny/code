<?php
	$id_post = get_the_ID();
?>
<div class="col fade-up">
	<div class="content-box-casy-study">
		<?php
			if(has_post_thumbnail())
			{
				echo '<a href="'.get_permalink().'">';
				the_post_thumbnail('medium_size');
				echo '</a>';
			}
		?>
		<div class="content-box-case-study-entry">
			<?php if(has_term('', 'kategoria-case-study', $id_post)): ?>
			<p class="content-box-case-study-category"><?php echo strip_tags(get_the_term_list($id_post, 'kategoria-case-study', '', ', ')); ?></p>
			<?php endif; ?>
			<p class="content-box-case-study-name"><?php the_title(); ?></p>
		</div>
	</div>
</div>