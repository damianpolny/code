<?php

get_header();
$id_front_page = get_option('page_on_front');
$slider_front_page = rwmb_meta('slider_front_page', '', $id_front_page);
$the_content = get_the_content('', '', $id_front_page);
$section_one_text_front_page = rwmb_meta('section_one_text_front_page', '', $id_front_page);
$section_one_img_front_page = rwmb_meta('section_one_img_front_page', '', $id_front_page);
$section_icons_one = rwmb_meta('section_icons_one', '', $id_front_page);
$section_two_text_front_page = rwmb_meta('section_two_text_front_page', '', $id_front_page);
$section_two_img_front_page = rwmb_meta('section_two_img_front_page', '', $id_front_page);
$section_icons_two = rwmb_meta('section_icons_two', '', $id_front_page);
$section_slogan_front_page = rwmb_meta('section_slogan_front_page', '', $id_front_page);
$section_slogan_location_front_page = rwmb_meta('section_slogan_location_front_page', '', $id_front_page);
$gallery_front_page = rwmb_meta('gallery_front_page', '', $id_front_page);
$bottom_img_front_page = rwmb_meta('bottom_img_front_page', '', $id_front_page);
$map_building_img = rwmb_meta('map_building_img', ['object_type' => 'setting'], 'contigo_settings');
$args_flat = array('post_type' => 'mieszkanie', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date', 'post_status' => 'publish');
$front_page_flat = new WP_Query($args_flat);
if(is_array($slider_front_page) && !empty($slider_front_page)):
?>
<div class="section-slider-front-page">
	<div class="splide" id="slider_front_page" role="group" aria-label="Slider">
		<div class="splide__track">
			<ul class="splide__list">
				<?php
					foreach($slider_front_page as $single):
					if(isset($single['ID'])):
				?>
				<li class="splide__slide" data-title="<?php echo get_the_title($single['ID']); ?>">
					<?php echo wp_get_attachment_image($single['ID'], 'full'); ?>
				</li>
				<?php 
					endif;
					endforeach;
				?>
			</ul>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($the_content)):
?>
<div class="section-column position-relative" id="about">
	<div class="container">
		<div class="grid-middle">
			<div class="col-5_lg-6_md-12">
				<div class="section-column-text">
					<?php echo apply_filters('the_content', $the_content); ?>
				</div>
			</div>
			<div class="col-7_lg-6_md-12">
				<?php
					if(has_post_thumbnail())
					{
						$id_thumbnail = get_post_thumbnail_id($id_front_page);
						echo '<p class="text-right">';
						the_post_thumbnail('large');
						if(is_numeric($id_thumbnail))
						{
							$title_thumbnail = get_the_title($id_thumbnail);
							if(!empty($title_thumbnail))
							{
								echo '<span class="thumbnail-title">'.$title_thumbnail.'</span>';
							}
						}
						echo '</p>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(is_array($section_icons_one) && !empty($section_icons_one)):
?>
<div class="section-icon">
	<div class="container">
		<div class="grid-5_md-2">
			<?php
				foreach($section_icons_one as $single):
				if(isset($single['ID'])):
			?>
			<div class="col">
				<div class="section-icon-single">
					<?php 
						echo wp_get_attachment_image($single['ID'], 'medium');
						$title = get_the_title($single['ID']);
						if(!empty($title))
						{
							echo apply_filters('the_content', $title);
						}
					?>
				</div>
			</div>
			<?php 
				endif;
				endforeach;
			?>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($section_one_text_front_page)):
?>
<div class="section-column section-column-reverse position-relative">
	<div class="container">
		<div class="grid-middle">
			<div class="col-5_lg-6_md-12">
				<div class="section-column-text">
					<?php echo apply_filters('the_content', $section_one_text_front_page); ?>
				</div>
			</div>
			<div class="col-7_lg-6_md-12">
				<?php
					if(isset($section_one_img_front_page['ID']))
					{
						echo '<p class="text-right">';
						echo wp_get_attachment_image($section_one_img_front_page['ID'], 'large');
						echo '</p>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($section_slogan_front_page)):
?>
<div class="section-slogan">
	<div class="container">
		<div class="grid-center">
			<div class="col-8_lg-10_md-12">
				<?php echo apply_filters('the_content', $section_slogan_front_page); ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($section_slogan_location_front_page) || !empty($section_two_text_front_page) || (is_array($section_icons_two) && !empty($section_icons_two))):
?>
<div class="section-color" id="location">
	<div class="container">
		<div class="page-title-content">
			<p class="page-top-title"><?php echo __('LOKALIZACJA', 'contigo'); ?></p>
			<p class="page-title"><?php echo __('WROCŁAW - ZAKRZÓW', 'contigo'); ?></p>
			<p class="page-bottom-title"><?php echo __('UL. Danuty Siedzikówny', 'contigo'); ?></p>
		</div>
	</div>
<?php
	if(is_array($section_icons_two) && !empty($section_icons_two)):
?>
<div class="section-icon">
	<div class="container">
		<div class="grid-4_md-2">
			<?php
				foreach($section_icons_two as $single):
				if(isset($single['ID'])):
			?>
			<div class="col">
				<div class="section-icon-single">
					<?php 
						echo wp_get_attachment_image($single['ID'], 'medium');
						$title = get_the_title($single['ID']);
						if(!empty($title))
						{
							echo apply_filters('the_content', $title);
						}
					?>
				</div>
			</div>
			<?php 
				endif;
				endforeach;
			?>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($section_two_text_front_page)):
?>
<div class="section-column section-column-no-ornament position-relative">
	<div class="container">
		<div class="grid-middle">
			<div class="col-5_lg-6_md-12">
				<div class="section-column-text">
					<?php echo apply_filters('the_content', $section_two_text_front_page); ?>
				</div>
			</div>
			<div class="col-7_lg-6_md-12">
				<?php
					if(isset($section_two_img_front_page['ID']))
					{
						echo '<p class="text-right">';
						echo wp_get_attachment_image($section_two_img_front_page['ID'], 'large');
						echo '</p>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($section_slogan_location_front_page)):
?>
<div class="section-slogan">
	<div class="container">
		<div class="grid-center">
			<div class="col-8_lg-10_md-12">
				<?php echo apply_filters('the_content', $section_slogan_location_front_page); ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
?>
<div id="map_content"></div>
</div>
<?php
	endif;
	if(($front_page_flat -> have_posts() || isset($map_building_img['ID']))):
?>
<div class="section-table-map" id="apartment">
	<div class="container">
		<?php
			if(isset($map_building_img['ID'])):
		?>
		<div class="section-map">
			<div class="page-title-content">
				<p class="page-title"><?php echo __('Wybierz mieszkanie', 'contigo'); ?></p>
			</div>
			<div class="section-map-img">
				<img width="1120" height="631" src="<?php echo wp_get_attachment_image_url($map_building_img['ID'], 'full'); ?>" alt="contigo" usemap="#buildingsmap" id="buildings_map" />
				<map name="buildingsmap">
					<?php
						$flat_array_legend = array();
						while($front_page_flat -> have_posts()): $front_page_flat -> the_post();
						$id_post = get_the_ID();
						$flat_coords = rwmb_meta('flat_coords', '', $id_post);
						$flat_status = rwmb_meta('flat_status', '', $id_post);
						if(!empty($flat_coords)):
						$title = get_the_title($id_post);
						
						$sanitize_title = sanitize_title($title);
						
						if($flat_status == 0)
						{
							$status = __('SPRZEDANE', 'contigo');
							$fillColor = 'e9550b';
						}
						elseif($flat_status == 1)
						{
							$status = __('WOLNE', 'contigo');
							$fillColor = '167a0c';
						}
						else
						{
							$status = __('REZERWACJA', 'contigo');
							$fillColor = 'fff660';
						}
						
						$flat_array_legend[] = array(
							'key' => $sanitize_title,
							'fillColor' => $fillColor
						);
						
					?>
					<area data-key="<?php echo $sanitize_title; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" href="<?php the_permalink($id_post); ?>" coords="<?php echo $flat_coords; ?>" shape="poly">
					<?php
						endif;
						endwhile; wp_reset_postdata();
					?>
				</map>
			</div>
			<script type="text/javascript">
			<?php
				if(!empty($flat_array_legend))
				{
					$js_array = json_encode($flat_array_legend);
					echo "let flat_array_legend = ". $js_array.";";
				}
			?>
			</script>
		</div>
		<?php
			endif;
			if($front_page_flat -> have_posts()):
		?>
		<div class="section-table">
			<div class="flat-table-head">
				<div class="grid">
					<div class="col-5_md-12">
						<div class="flat-table-head-range">
							<?php echo __('Metraż', 'contigo'); ?>:
							<div class="flat-table-head-range-input">
								<div class="multi-range">
									<input type="range" min="70" max="135" value="0" id="range_from">
									<input type="range" min="70" max="135" value="135" id="range_to">
								</div>
								<div class="multi-range-output">
									<div id="range_from_output">70 m<sup>2</sup></div>
									<div id="range_to_output">135 m<sup>2</sup></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-7_md-12">
						<div class="grid">
							<div class="col-6_sm-12">
								<p><?php echo __('Liczba pokoi', 'contigo'); ?>: <span class="filter-flat-table" data-number="4" data-column="3">4</span> <span class="filter-flat-table" data-number="5" data-column="3">5</span></p>
							</div>
							<div class="col-6_sm-12">
								<p><?php echo __('Piętro', 'contigo'); ?>: <span class="filter-flat-table" data-number="parter" data-column="4">0</span> <span class="filter-flat-table" data-number="1" data-column="4">1</span> <span class="filter-flat-table" data-number="2" data-column="4">2</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<table id="flat_table" class="display">
				<thead>
					<tr>
						<th><?php echo __('Typ', 'contigo'); ?></th>
						<th><?php echo __('Numer', 'contigo'); ?></th>
						<th><?php echo __('Metraż', 'contigo'); ?></th>
						<th><?php echo __('Pokoje', 'contigo'); ?></th>
						<th><?php echo __('Piętro', 'contigo'); ?></th>
						<th><?php echo __('Status', 'contigo'); ?></th>
						<th><?php echo __('Rzut', 'contigo'); ?></th>
						<th><?php echo __('Szczegóły', 'contigo'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						while($front_page_flat -> have_posts()): $front_page_flat -> the_post();
						$id_post = get_the_ID();
					?>
					<tr>
						<td><?php echo strip_tags(get_the_term_list($id_post, 'typ', '', ', ')); ?></td>
						<td><?php echo rwmb_meta('flat_number', '', $id_post); ?></td>
						<td><?php echo rwmb_meta('flat_size', '', $id_post); ?></td>
						<td><?php echo rwmb_meta('flat_rooms', '', $id_post); ?></td>
						<td><?php echo strip_tags(get_the_term_list($id_post, 'pietro', '', ', ')); ?></td>
						<td><?php 
							$flat_status = rwmb_meta('flat_status', '', $id_post);
							if($flat_status == 0)
							{
								echo __('SPRZEDANE', 'contigo');
							}
							elseif($flat_status == 1)
							{
								echo __('WOLNE', 'contigo');
							}
							else
							{
								echo __('REZERWACJA', 'contigo');
							}
						?></td>
						<td>
							<?php
								$flat_file = rwmb_meta('flat_file', '', $id_post);
								if(is_array($flat_file)):
								foreach($flat_file as $single):
								if(isset($single['ID'])):
							?>
							<a class="custom-button" style="text-wrap:nowrap" href="<?php echo wp_get_attachment_url($single['ID']); ?>"><?php echo __('pobierz pdf', 'contigo'); ?></a>
							<?php endif; endforeach; endif; ?>
						</td>
						<td><a class="custom-button outline" href="<?php the_permalink(); ?>"><?php echo __('SZCZEGÓŁY', 'contigo'); ?></a></td>
					</tr>
					<?php endwhile; wp_reset_postdata(); ?>
				</tbody>
			</table>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
	endif;
	if(isset($gallery_front_page[0])):
?>
<div class="section-color" id="gallery" style="margin-bottom:0">
	<div class="container">
		<div class="page-title-content">
			<p class="page-title"><?php echo __('GALERIA', 'contigo'); ?></p>
		</div>
		<div class="gallery-content">
			<div class="grid-2_md-1">
				<?php
					foreach($gallery_front_page as $single):
					if(isset($single['gallery_front_page_img']) && isset($single['gallery_front_page_name']) && isset($single['gallery_front_page_item'][0])):
					$sanitize_title = sanitize_title($single['gallery_front_page_name']);
				?>
				<div class="col">
					<div class="gallery-content-item">
						<a href="<?php echo wp_get_attachment_image_url($single['gallery_front_page_img'], 'full'); ?>" data-fslightbox="gallery-<?php echo $sanitize_title; ?>" data-caption="<?php echo $single['gallery_front_page_name']; ?>">
						<div class="gallery-content-item-name"><?php echo $single['gallery_front_page_name']; ?></div>
						<?php echo wp_get_attachment_image($single['gallery_front_page_img'], 'large'); ?>
						</a>
						<?php foreach($single['gallery_front_page_item'] as $item): ?>
						<a href="<?php echo wp_get_attachment_image_url($item, 'full'); ?>" data-fslightbox="gallery-<?php echo $sanitize_title; ?>" data-caption="<?php echo $single['gallery_front_page_name']; ?>"></a>
						<?php endforeach; ?>
					</div>
				</div>
				<?php
					endif;
					endforeach;
				?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($bottom_img_front_page['ID'])):
?>
<div class="section-image-full-width" style="background-image:url(<?php echo wp_get_attachment_image_url($bottom_img_front_page['ID'], 'full'); ?>);background-size:cover;background-position:center;background-attachment:fixed;background-repeat:no-repeat;">
	<?php echo wp_get_attachment_image($bottom_img_front_page['ID'], 'full'); ?>
</div>
<?php endif; get_footer(); ?>
