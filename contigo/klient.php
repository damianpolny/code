<?php
	/* Template name: Klient */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$the_content = get_the_content('', '', $id_page);
	$client_page_img_one = rwmb_meta('client_page_img_one', '', $id_page);
	$client_page_text = rwmb_meta('client_page_text', '', $id_page);
	$client_page_text_one = rwmb_meta('client_page_text_one', '', $id_page);
	$client_page_img_two = rwmb_meta('client_page_img_two', '', $id_page);
	$client_page_group = rwmb_meta('client_page_group', '', $id_page);
	$client_page_text_two = rwmb_meta('client_page_text_two', '', $id_page);
?>
		<div class="page-wraper" style="padding-bottom:0">
			<?php
				if(!empty($the_content)):
			?>
			<div class="section-column position-relative">
				<div class="container">
					<div class="grid-middle">
						<div class="col-5_lg-6_md-12">
							<div class="section-column-text">
								<?php echo apply_filters('the_content', $the_content); ?>
							</div>
						</div>
						<div class="col-7_lg-6_md-12">
							<?php
								if(isset($client_page_img_one['ID']))
								{
									echo '<p class="text-right">';
									echo wp_get_attachment_image($client_page_img_one['ID'], 'large');
									echo '</p>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
				endif;
				if(!empty($client_page_text)):
			?>
			<div class="section-text">
				<div class="container">
					<?php echo apply_filters('the_content', $client_page_text); ?>
				</div>
			</div>
			<?php
				endif;
				if(!empty($client_page_text_two) || !empty($client_page_text_one) || isset($client_page_group[0])):
			?>
			<div class="section-color" style="margin-bottom:0">
			<?php
				if(!empty($client_page_text_one)):
			?>
			<div class="section-column section-column-reverse section-column-no-ornament position-relative">
				<div class="container">
					<div class="grid-middle">
						<div class="col-5_lg-6_md-12">
							<div class="section-column-text">
								<?php echo apply_filters('the_content', $client_page_text_one); ?>
							</div>
						</div>
						<div class="col-7_lg-6_md-12">
							<?php
								if(isset($client_page_img_two['ID']))
								{
									echo '<p class="text-right">';
									echo wp_get_attachment_image($client_page_img_two['ID'], 'large');
									echo '</p>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
				endif;
				if(isset($client_page_group[0])):
				foreach($client_page_group as $single):
			?>
			<div class="section-column section-column-no-ornament position-relative">
				<div class="container">
					<div class="grid-middle">
						<div class="col-5_lg-6_md-12">
							<?php if(isset($single['client_page_group_text'])): ?>
							<div class="section-column-text">
								<?php echo apply_filters('the_content', $single['client_page_group_text']); ?>
							</div>
							<?php endif; ?>
						</div>
						<div class="col-7_lg-6_md-12">
							<?php
								if(isset($single['client_page_group_img']))
								{
									echo '<p class="text-right">';
									if(isset($single['client_page_group_file']))
									{
										echo '<a href="'.wp_get_attachment_url($single['client_page_group_file'][0]).'">';
									}
									echo wp_get_attachment_image($single['client_page_group_img'], 'large');
									if(isset($single['client_page_group_file']))
									{
											echo '</a>';
									}
									echo '</p>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
				endforeach;
				endif;
				if(!empty($client_page_text_two)):
			?>
			<div class="section-text">
				<div class="container">
					<div class="grid-center">
						<div class="col-8_lg-10_md-12">
							<?php echo apply_filters('the_content', $client_page_text_two); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
				endif;
			?>
			</div>
			<?php
				endif;
			?>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>