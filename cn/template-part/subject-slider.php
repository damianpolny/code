<?php
	$id_post = get_the_ID();
	$subject = get_the_terms($id_post, 'kurs');
	$status = get_the_terms($id_post, 'status');
	$level = get_the_terms($id_post, 'poziom');
	$day = get_the_terms($id_post, 'dzien');
	$year = get_the_terms($id_post, 'rok');
	$time_from_subject = rwmb_meta('time_from_subject', '', $id_post);
	$time_to_subject = rwmb_meta('time_to_subject', '', $id_post);
	$date_start_subject = rwmb_meta('date_start_subject', '', $id_post);
	$subject_term_id = null;
	$color_subject = null;
	$color_subject_limit = null;
	$get_user_favorites = null;
	$page_info_subject = null;
	$status_color_r = null;
	$active_limit = false;
	$limit = false;
	$status_color = '#000000';
	$disable = has_term('brak-miejsc', 'status', $id_post);
	$global_start_subject = rwmb_meta('global_start_subject', ['object_type' => 'setting'], 'cn_settings');
	if(class_exists("Favorites"))
	{
		$get_user_favorites = get_user_favorites();
	}
	if(isset($subject[0]->term_id))
	{
		$color_subject = rwmb_meta('color_subject', ['object_type' => 'term'], $subject[0]->term_id);
		$color_subject_limit = rwmb_meta('color_subject_limit', ['object_type' => 'term'], $subject[0]->term_id);
		if(isset($status[0]->term_id))
		{
			$status_color_r = rwmb_meta('color_status', ['object_type' => 'term'], $status[0]->term_id);
			$active_limit = rwmb_meta('active_limit', ['object_type' => 'term'], $status[0]->term_id);
		}
		if(has_term('ostatnie-wolne-miejsca', 'status', $id_post))
		{
			$color_subject = $color_subject_limit;
		}
		if($active_limit)
		{
			$limit = true;
		}
		if(!empty($status_color_r))
		{
			$status_color = $status_color_r;
		}
		
		if(isset($level[0]->term_id) && isset($year[0]->term_id))
		{
			$page_info_subject = get_posts(array(
				'post_type' => 'page',
				'hierarchical' => 0,
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'page_subject_term',
						'value' => $subject[0]->term_id,
						'compare' => '='
					),
					array(
						'key' => 'page_subject_level_term',
						'value' => $level[0]->term_id,
						'compare' => '='
					),
					array(
						'key' => 'page_subject_year_term',
						'value' => $year[0]->term_id,
						'compare' => '='
					)
				)
			));
		}		
	}
	
	if(!empty($color_subject)):
?>
<style>
	:root .subject-slider-item-<?php echo $id_post; ?> {
		--color-subject-slider: <?php echo $color_subject; ?>
	};
</style>
<?php
	endif;
?>
<div class="subject-slider-item subject-slider-item-<?php echo $id_post; ?><?php if(in_array($id_post, $get_user_favorites)): ?> active<?php endif; if($limit): ?> active-limit<?php endif; if($disable): ?> disable<?php endif; ?>" id="subject-id-<?php echo $id_post; ?>">
	<div class="subject-slider-item-content">
		<p class="subject-slider-item-name" data-url="<?php if(isset($page_info_subject[0]->ID)) { echo get_permalink($page_info_subject[0]->ID); } ?>"><?php echo the_title(); ?></p>
		<?php if((!empty($time_from_subject) && !empty($time_to_subject)) || isset($day[0]->name)): ?>
		<div class="subject-slider-item-date">
			<?php if(!empty($time_from_subject) && !empty($time_to_subject)): ?>
			<p class="subject-slider-item-date-hour"><?php echo $time_from_subject; ?>-<?php echo $time_to_subject; ?></p>
			<?php
				endif;
				if(isset($day[0]->name)):
			?>
			<p class="subject-slider-item-date-day"><?php echo $day[0]->name; ?></p>
			<?php endif; ?>
		</div>
		<?php
			endif;
			if(isset($level[0]->term_id)):
			$letter_level = rwmb_meta('letter_level', ['object_type' => 'term'], $level[0]->term_id);
			if(!empty($letter_level)):
		?>
		<div class="subject-slider-item-letter">
			<p><?php echo $letter_level; ?></p>
		</div>
		<?php
			endif;
			endif;
			if(class_exists("Favorites") && !$disable):
		?>
		<div class="subject-slider-item-list-url">
			<div>
				<p style="text-align:left">
					<?php echo get_favorites_button($id_post); ?>
				</p>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<div class="subject-slider-item-info">
		<?php if(!empty($date_start_subject) && $date_start_subject != '-'): ?>
		<p class="subject-start-date"><svg viewBox="0 0 29.5 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs /> <path d="m17.609 17.559 6-6.002h-8.771c-.72 3.39-3.736 5.943-7.338 5.943C3.364 17.5 0 14.135 0 10c0-4.136 3.364-7.5 7.5-7.5 3.46 0 6.38 2.355 7.242 5.546h8.867l-6-5.548L19.499 0c3.66 3.66 6.497 6.495 10 10l-10 10-1.89-2.441Zm-13.11-7.56c0 1.655 1.346 3.001 3 3.001 1.655 0 3-1.346 3-3 0-1.655-1.345-3.001-3-3.001-1.654 0-3 1.346-3 3Z" /> </svg> <span><?php echo __('start', 'cn'); ?> </span><?php echo date("d.m.Y", strtotime($date_start_subject)); ?></p>
		<?php
			elseif(!empty($global_start_subject)):
		?>
		<p class="subject-start-date"><svg viewBox="0 0 29.5 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs /> <path d="m17.609 17.559 6-6.002h-8.771c-.72 3.39-3.736 5.943-7.338 5.943C3.364 17.5 0 14.135 0 10c0-4.136 3.364-7.5 7.5-7.5 3.46 0 6.38 2.355 7.242 5.546h8.867l-6-5.548L19.499 0c3.66 3.66 6.497 6.495 10 10l-10 10-1.89-2.441Zm-13.11-7.56c0 1.655 1.346 3.001 3 3.001 1.655 0 3-1.346 3-3 0-1.655-1.345-3.001-3-3.001-1.654 0-3 1.346-3 3Z" /> </svg> <span><?php echo __('start', 'cn'); ?>: </span><?php echo $global_start_subject; ?></p>
		<?php
			endif;
			if(has_term('ilosc-miejsc-ograniczona', 'status', $id_post)):
		?>
		<p class="subject-start-date" style="color:<?php echo $status_color; ?>;"><?php echo __('ilość miejsc ograniczona', 'cn'); ?></p>
		<?php
			elseif(has_term('ostatnie-wolne-miejsca', 'status', $id_post)):
		?>
		<p class="subject-start-date" style="color:<?php echo $status_color; ?>;"><?php echo __('ostatnie wolne miejsca!', 'cn'); ?></p>
		<?php
			elseif($disable):
		?>
		<p class="subject-start-date" style="color:<?php echo $status_color; ?>;"><?php echo __('brak miejsc', 'cn'); ?></p>
		<?php
			elseif(has_term('', 'status', $id_post)):
		?>
		<p class="subject-start-date" style="color:<?php echo $status_color; ?>;"><?php echo strip_tags(get_the_term_list($id_post, 'status', '', ', ')); ?></p>
		<?php
			endif;
		?>
	</div>
</div>