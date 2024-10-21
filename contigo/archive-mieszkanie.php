<?php

get_header(); 
$map_building_img = rwmb_meta('map_building_img', ['object_type' => 'setting'], 'contigo_settings');
?>
		<div class="page-wraper">
			<div class="container">
				<?php if(have_posts()): ?>
				<div class="page-title-content">
					<p class="page-title"><?php echo __('Wybierz budynek', 'contigo'); ?></p>
				</div>
				<?php if(isset($map_building_img['ID'])): ?>
				<div class="section-map-img" style="margin-bottom:30px;">
					<img width="1120" height="631" src="<?php echo wp_get_attachment_image_url($map_building_img['ID'], 'full'); ?>" alt="contigo" usemap="#buildingsmap" id="buildings_map" />
					<map name="buildingsmap">
						<?php
							$flat_array_legend = array();
							while(have_posts()): the_post();
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
							endwhile;
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
				<?php endif; echo get_template_part('template-parts/flat', 'table'); endif; ?>
			</div>
		</div>
<?php get_footer(); ?>
