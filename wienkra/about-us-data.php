<?php

/* Template name: O nas */

get_header();
if(have_posts()): while (have_posts()): the_post();
$id_page = get_the_ID();
$the_content = get_the_content();
$about_us_group_section = rwmb_meta('about_us_group_section', '', $id_page);
$about_us_icons_section = rwmb_meta('about_us_icons_section', '', $id_page);
$about_us_history_line = rwmb_meta('about_us_history_line', '', $id_page);
$about_us_history_text = rwmb_meta('about_us_history_text', '', $id_page);
$about_us_two_column_name = rwmb_meta('about_us_two_column_name', '', $id_page);
$about_us_two_column_left = rwmb_meta('about_us_two_column_left', '', $id_page);
$about_us_two_column_right = rwmb_meta('about_us_two_column_right', '', $id_page);
$about_us_post = rwmb_meta('about_us_post', '', $id_page);
$about_us_post_name = rwmb_meta('about_us_post_name', '', $id_page);
$about_us_post_text = rwmb_meta('about_us_post_text', '', $id_page);
$about_us_two_column_repeat = rwmb_meta('about_us_two_column_repeat', '', $id_page);
$about_us_two_column_repeat_name = rwmb_meta('about_us_two_column_repeat_name', '', $id_page);
$about_us_two_column_repeat_text = rwmb_meta('about_us_two_column_repeat_text', '', $id_page);
$about_us_bottom_columns_title = rwmb_meta('about_us_bottom_columns_title', '', $id_page);
$about_us_bottom_columns_desc_one = rwmb_meta('about_us_bottom_columns_desc_one', '', $id_page);
$about_us_bottom_columns_desc_two = rwmb_meta('about_us_bottom_columns_desc_two', '', $id_page);
$about_us_bottom_columns_repeat = rwmb_meta('about_us_bottom_columns_repeat', '', $id_page);
$about_us_departments_title = rwmb_meta('about_us_departments_title', '', $id_page);
$about_us_departments_subtitle = rwmb_meta('about_us_departments_subtitle', '', $id_page);
$about_us_departments = rwmb_meta('about_us_departments', '', $id_page);
$about_us_bottom_one_title = rwmb_meta('about_us_bottom_one_title', '', $id_page);
$about_us_bottom_one_img = rwmb_meta('about_us_bottom_one_img', '', $id_page);
$about_us_bottom_one_desc = rwmb_meta('about_us_bottom_one_desc', '', $id_page);
$about_us_bottom_two_title = rwmb_meta('about_us_bottom_two_title', '', $id_page);
$about_us_bottom_two_img = rwmb_meta('about_us_bottom_two_img', '', $id_page);
$about_us_bottom_two_desc = rwmb_meta('about_us_bottom_two_desc', '', $id_page);
?>
	<div class="page-wraper">
		<?php if(!empty($the_content)): ?>
		<div class="section-column">
			<div class="grid-2_md-1-noGutter-middle">
				<div class="col">
					<?php if(!empty($the_content)): ?>
					<div class="section-column-text">
						<?php echo apply_filters("the_content", $the_content); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col">
					<?php 
						if(has_post_thumbnail()):
					?>
					<div class="section-column-img">
						<p><?php echo the_post_thumbnail('medium'); ?></p>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(isset($about_us_group_section[0])):
		?>
		<div class="section-group">
			<?php
				foreach($about_us_group_section as $single):
				if(isset($single['about_us_group_section_name'])):
			?>
			<div class="section-title-bar">
				<div class="container">
					<div class="section-title-content color-page">
						<p class="section-title"><?php echo $single['about_us_group_section_name']; ?></p>
					</div>
				</div>
			</div>
			<?php 
				endif;
				if(isset($single['about_us_group_section_left']) || isset($single['about_us_group_section_right'])):
			?>
			<div class="container">
				<div class="grid-2_md-1">
					<div class="col">
					<?php 
						if(isset($single['about_us_group_section_left'])):
					?>
					<div class="section-group-left">
						<?php echo apply_filters("the_content", $single['about_us_group_section_left']); ?>
					</div>
					<?php
						endif;
					?>
					</div>
					<?php
						if(isset($single['about_us_group_section_right'])):
					?>
					<div class="col">
						<div class="section-group-right">
							<?php echo apply_filters("the_content", $single['about_us_group_section_right']); ?>
						</div>
					</div>
					<?php
						endif;
					?>
				</div>
			</div>
			<?php
				endif;
				endforeach;
			?>
		</div>
		<?php 
			endif;
			if(isset($about_us_icons_section[0])):
		?>
		<div class="section-icons">
			<div class="container">
				<div class="grid-4_lg-3_md-2_xs-1">
					<?php 
						foreach($about_us_icons_section as $single):
						if(isset($single['about_us_icons_section_name_two']) && isset($single['about_us_icons_section_img'])):
					?>
					<div class="col">
						<div class="section-icon">
							<div class="section-icon-img">
								<?php echo wp_get_attachment_image($single['about_us_icons_section_img'], "medium"); ?>
							</div>
							<div class="section-icon-text">
								<?php
									if(isset($single['about_us_icons_section_name_one']))
									{
										echo '<p>'.$single['about_us_icons_section_name_one'].'</p>';
									}
								?>
								<p class="section-icon-head"><?php echo $single['about_us_icons_section_name_two']; ?></p>
								<?php
									if(isset($single['about_us_icons_section_name_three']))
									{
										echo '<p>'.$single['about_us_icons_section_name_three'].'</p>';
									}
								?>
							</div>
						</div>
					</div>
					<?php endif; endforeach; ?>
				</div>
			</div>
		</div>
		<?php 
			endif;
			if(isset($about_us_history_line[0]) || !empty($about_us_history_text)):
		?>
		<div class="section-history">
			<div class="grid-2_md-1-noGutter">
				<div class="col">
					<?php if(isset($about_us_history_line[0])): ?>
					<div class="section-history-line">
						<div class="section-history-line-title">
							<?php echo __('Historia firmy Wienkra:', 'wienkra'); ?>
						</div>
						<div class="section-history-line-content">
							<ul class="history-line">
								<?php foreach($about_us_history_line as $single): if(isset($single['about_us_history_line_date']) && isset($single['about_us_history_line_text'])): ?>
								<li data-year="<?php echo $single['about_us_history_line_date']; ?>"><?php echo $single['about_us_history_line_text']; ?></li>
								<?php endif; endforeach; ?>
							</ul>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php if(!empty($about_us_history_text)): ?>
				<div class="col">
					<div class="section-history-right">
						<?php echo apply_filters("the_content", $about_us_history_text); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php 
			endif;
			if(!empty($about_us_two_column_left) || !empty($about_us_two_column_right)):
		?>
		<div class="section-group">
			<?php
				if(!empty($about_us_two_column_name)):
			?>
			<div class="section-title-bar">
				<div class="container">
					<div class="section-title-content color-page">
						<p class="section-title"><?php echo $about_us_two_column_name; ?></p>
					</div>
				</div>
			</div>
			<?php 
				endif;
				if(!empty($about_us_two_column_left) || !empty($about_us_two_column_right)):
			?>
			<div class="container">
				<div class="grid-2_md-1">
					<div class="col">
					<?php 
						if(!empty($about_us_two_column_left)):
					?>
					<div class="section-group-left page-style-list">
						<?php echo apply_filters("the_content", $about_us_two_column_left); ?>
					</div>
					<?php
						endif;
					?>
					</div>
					<?php
						if(!empty($about_us_two_column_right)):
					?>
					<div class="col">
						<div class="section-group-right">
							<?php echo apply_filters("the_content", $about_us_two_column_right); ?>
						</div>
					</div>
					<?php
						endif;
					?>
				</div>
			</div>
			<?php
				endif;
			?>
		</div>
		<?php
			endif;
			if(!empty($about_us_post)):
			if(!empty($about_us_post_name)):
		?>
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo $about_us_post_name; ?></p>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="container">
			<?php
				if(!empty($about_us_post_text)):
			?>
			<div class="medium-text">
				<?php echo apply_filters("the_content", $about_us_post_text); ?>
				<div class="custom-hr-line"></div>
			</div>
			<?php
				endif;
				$args_post = array('post_type' => 'post', 'posts_per_page' => 6, 'post_status' => 'publish', 'post__in' => $about_us_post);
				$about_us_post = new WP_Query($args_post);
				if($about_us_post -> have_posts()):
			?>
			<div class="grid-3_md-2_sm-1">
			<?php
				while ($about_us_post -> have_posts()) : $about_us_post -> the_post();
				echo get_template_part('template-parts/list', 'post');
				endwhile; wp_reset_postdata();
			?>
			</div>
			<?php endif; ?>
		</div>
		<?php
			endif;
			if(isset($about_us_two_column_repeat[0])):
			if(!empty($about_us_two_column_repeat_name)):
		?>
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo $about_us_two_column_repeat_name; ?></p>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="container">
			<?php
				if(!empty($about_us_two_column_repeat_text)):
			?>
			<div class="medium-text">
				<?php echo apply_filters("the_content", $about_us_two_column_repeat_text); ?>
				<div class="custom-hr-line"></div>
			</div>
			<?php
				endif;
			?>
			<div class="grid-2_md-1">
				<?php
					foreach($about_us_two_column_repeat as $single):
				?>
				<div class="col">
					<?php echo apply_filters("the_content", $single); ?>
				</div>
				<?php endforeach; ?>
			</div>
			<div style="display:block;width:100%;height:25px"></div>
		</div>
		<?php
			endif;
			if(!empty($about_us_bottom_columns_title)):
		?>
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo $about_us_bottom_columns_title; ?></p>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(!empty($about_us_bottom_columns_desc_one) || !empty($about_us_bottom_columns_desc_two)):
		?>
		<div class="container">
			<div class="grid-2_md-1">
				<div class="col">
					<?php 
						if(!empty($about_us_bottom_columns_desc_one)):
					?>
					<div class="section-column-text">
						<?php echo apply_filters("the_content", $about_us_bottom_columns_desc_one); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col">
					<?php 
						if(!empty($about_us_bottom_columns_desc_two)):
					?>
					<div class="section-column-text">
						<?php echo apply_filters("the_content", $about_us_bottom_columns_desc_two); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div style="display:block;width:100%;height:25px"></div>
		</div>
		<?php
			endif;
			if(isset($about_us_bottom_columns_repeat[0])):
			foreach($about_us_bottom_columns_repeat as $single):
			if(isset($single['about_us_bottom_columns_repeat_title'])):
		?>
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo $single['about_us_bottom_columns_repeat_title']; ?></p>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(isset($single['about_us_bottom_columns_repeat_left']) || isset($single['about_us_bottom_columns_repeat_right'])):
		?>
		<div class="container">
			<div class="grid-2_md-1">
				<div class="col">
					<?php 
						if(isset($single['about_us_bottom_columns_repeat_left'])):
					?>
					<div class="section-column-text">
						<?php echo apply_filters("the_content", $single['about_us_bottom_columns_repeat_left']); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col">
					<?php 
						if(isset($single['about_us_bottom_columns_repeat_right'])):
					?>
					<div class="section-column-text">
						<?php echo apply_filters("the_content", $single['about_us_bottom_columns_repeat_right']); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div style="display:block;width:100%;height:25px"></div>
		</div>
		<?php
			endif;
			endforeach;
			endif;
			if(isset($about_us_departments[0])):
			if(!empty($about_us_departments_title)):
		?>
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo $about_us_departments_title; ?></p>
					<?php if(!empty($about_us_departments_subtitle)): ?>
					<p class="section-title-text"><?php echo $about_us_departments_subtitle; ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php 
			endif;
		?>
		<div class="section-departments">
			<div class="container">
				<div class="grid-2_md-1">
					<?php foreach($about_us_departments as $single): if(isset($single['about_us_departments_name']) && isset($single['about_us_departments_img'])): ?>
					<div class="col">
						<?php echo wp_get_attachment_image($single['about_us_departments_img'], "medium"); ?>
						<p><?php echo $single['about_us_departments_name']; ?></p>
					</div>
					<?php endif; endforeach; ?>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(!empty($about_us_bottom_one_title)):
		?>
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo $about_us_bottom_one_title; ?></p>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(!empty($about_us_bottom_one_desc) || isset($about_us_bottom_one_img['ID'])):
		?>
		<div class="section-column">
			<div class="grid-2_md-1-noGutter">
				<div class="col">
					<?php 
						if(!empty($about_us_bottom_one_desc)):
					?>
					<div class="section-column-text">
						<?php echo apply_filters("the_content", $about_us_bottom_one_desc); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col">
					<?php 
						if(isset($about_us_bottom_one_img['ID'])):
					?>
					<div class="section-column-img">
						<p><?php echo wp_get_attachment_image($about_us_bottom_one_img['ID'], 'medium'); ?></p>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(!empty($about_us_bottom_two_title)):
		?>
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo $about_us_bottom_two_title; ?></p>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(!empty($about_us_bottom_two_desc) || isset($about_us_bottom_one_img['ID'])):
		?>
		<div class="section-column">
			<div class="grid-2_md-1-noGutter-middle">
				<div class="col">
					<?php 
						if(!empty($about_us_bottom_two_desc)):
					?>
					<div class="section-column-text">
						<?php echo apply_filters("the_content", $about_us_bottom_two_desc); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col">
					<?php 
						if(isset($about_us_bottom_two_img['ID'])):
					?>
					<div class="section-column-img">
						<p><?php echo wp_get_attachment_image($about_us_bottom_two_img['ID'], 'large'); ?></p>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
			endif;
		?>
	</div>
<?php endwhile; endif; get_footer(); ?>