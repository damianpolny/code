<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_post = get_the_ID();
	$flat_file = rwmb_meta('flat_file', '', $id_post);
	$flat_img = rwmb_meta('flat_img', '', $id_post);
	$phone_page = rwmb_meta('phone_page', ['object_type' => 'setting'], 'contigo_settings');
	$flat_shortcode_form = rwmb_meta('flat_shortcode_form', ['object_type' => 'setting'], 'contigo_settings');
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<div class="page-content">
					<?php
						if(isset($flat_img['ID']))
						{
							echo '<div class="flat-content"><a href="'.wp_get_attachment_image_url($flat_img['ID'], 'full').'" data-fslightbox="flat-attachment">';
							echo wp_get_attachment_image($flat_img['ID'], 'large');
							echo '</a></div>';
						}
					?>	
					<div class="flat-group-buttons">
						<div class="grid-3_md-2_sm-1">
							<div class="col">
								<p><a class="custom-button outline display-block big-button" rel="nofollow" href="<?php echo wp_get_referer(); ?>"><?php echo __('powrót do poprzedniej strony', 'tilita'); ?></a></p>
							</div>
							<?php
								if(is_array($flat_file)):
								foreach($flat_file as $single):
								if(isset($single['ID'])):
							?>
							<div class="col">
								<p><a class="custom-button display-block big-button" href="<?php echo wp_get_attachment_url($single['ID']); ?>"><?php echo __('POBIERZ PDF', 'tilita'); ?></a></p>
							</div>
							<?php endif; endforeach; endif; if(!empty($phone_page)): ?>
							<div class="col">
								<p><a class="custom-button display-block big-button" href="tel:<?php echo preg_replace('/\s+/', '', $phone_page); ?>">
									<svg viewBox="0 0 3.6597 3.6601" xmlns="http://www.w3.org/2000/svg"><defs><clipPath><path transform="translate(-419.6 -2859.8)" d="m0 0h595.28v3344.9h-595.28z"/></clipPath></defs><g transform="translate(-103.19 -146.58)"><path transform="matrix(.35278 0 0 -.35278 106.07 150.24)" d="m0 0c-1.989 0-4.045 0.916-5.641 2.512l-0.032 0.034c-1.644 1.642-2.559 3.753-2.51 5.789l3e-3 0.149 0.093 0.117c0.143 0.182 0.284 0.342 0.432 0.49 0.542 0.542 1.179 0.956 1.893 1.233 0.087 0.034 0.185 0.051 0.292 0.051 0.241 0 0.783-0.123 0.92-0.503 0.243-0.674 0.551-1.557 0.775-2.404 0.065-0.245-0.011-0.818-0.33-1.019l-0.79-0.501c7e-3 -5e-3 5e-3 -0.129 0.108-0.27 0.304-0.418 0.659-0.834 1.054-1.235 0.395-0.389 0.809-0.742 1.226-1.045 0.081-0.059 0.173-0.094 0.247-0.094 0.025 0 0.041 5e-3 0.044 7e-3l0.481 0.771c0.217 0.339 0.766 0.349 0.828 0.349 0.064 0 0.121-6e-3 0.173-0.018 1.04-0.232 1.66-0.431 2.454-0.791 0.352-0.16 0.575-0.799 0.418-1.2-0.276-0.713-0.69-1.35-1.231-1.892-0.151-0.15-0.316-0.296-0.493-0.434l-0.116-0.091zm-7.292 8.164c7e-3 -1.725 0.841-3.579 2.251-4.989l0.044-0.044c1.413-1.412 3.23-2.231 4.977-2.238 0.105 0.088 0.204 0.178 0.297 0.269 0.451 0.453 0.798 0.986 1.029 1.583-5e-3 3e-3 -0.023 0.058-0.042 0.102-0.691 0.308-1.259 0.486-2.193 0.695-0.023-3e-3 -0.068-0.012-0.105-0.022l-0.448-0.708c-0.28-0.453-1.021-0.524-1.552-0.135-0.451 0.327-0.899 0.709-1.331 1.134-0.43 0.438-0.814 0.887-1.144 1.34-0.219 0.3-0.308 0.656-0.246 0.977 0.049 0.248 0.186 0.453 0.386 0.577l0.707 0.448c0.01 0.041 0.019 0.096 0.017 0.123-0.196 0.734-0.475 1.54-0.704 2.18-0.038 0.014-0.087 0.026-0.121 0.026-0.567-0.222-1.1-0.57-1.554-1.022-0.09-0.091-0.179-0.188-0.268-0.296" fill="#ffffff"/></g></svg> <?php echo $phone_page; ?>
								</a></p>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<?php if(!empty($flat_shortcode_form)): ?>
					<div class="flat-form">
						<?php echo apply_filters('the_content', $flat_shortcode_form); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>