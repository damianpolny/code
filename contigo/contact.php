<?php
	/*Template name: Kontakt */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$contact_page_text = rwmb_meta('contact_page_text', '', $id_page);
	$contact_page_form = rwmb_meta('contact_page_form', '', $id_page);
	if(!empty($contact_page_text)):
?>
		<div class="page-wraper page-wraper-light">
			<div class="container">
				<?php echo apply_filters('the_content', $contact_page_text); ?>
			</div>
		</div>
<?php endif; ?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-content">
					<div class="grid">
						<div class="col-5_lg-6_md-12">
							<?php the_content(); ?>
						</div>
						<div class="col-7_lg-6_md-12">
							<?php if(!empty($contact_page_form)): ?>
							<div class="contact-form">
								<?php echo do_shortcode($contact_page_form); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="map_content"></div>
<?php 
	endwhile; endif;
	get_footer();
?>