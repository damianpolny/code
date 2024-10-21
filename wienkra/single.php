<?php

get_header();
if(have_posts()): while (have_posts()): the_post();
$id_post = get_the_ID();
$post_type = get_post_type($id_post);
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<?php if($post_type != 'przedstawiciel' && $post_type != 'produkt'): ?>
				<div class="content-entry-post">
					<div class="grid-2_sm-1-middle">
						<div class="col">
							<?php if(has_category()) { echo __('Kategoria:', 'wienkra').' '.get_the_category_list(','); } ?>
						</div>
						<div class="col text-right">
							<span class="wienkra_icon_calendar_fill"></span><?php echo get_the_date(); ?>
						</div>
					</div>
				</div>
				<?php
					endif;
					if($post_type == 'przedstawiciel')
					{
						$representative_type = rwmb_meta('representative_type', '', $id_post);
						$representative_email = rwmb_meta('representative_email', '', $id_post);
						$representative_phone = rwmb_meta('representative_phone', '', $id_post);
						echo '<div class="grid">';
							echo '<div class="col-4_md-5_sm-12">';
							if (has_post_thumbnail())
							{
								echo '<p class="text-center">';
								the_post_thumbnail('medium');
								echo '</p>';
							}
							echo '</div>';
							echo '<div class="col-8_md-7_sm-12">';
								echo '<p class="h1">'.get_the_title().'</p>';
								if(has_term('', 'dzial'))
								{
									echo '<p class="representative-department"><strong>'.get_the_term_list($id_post, 'dzial', '', ', ').'</strong></p>';
								}
								if(!empty($representative_type))
								{
									echo '<p class="representative-type">'.$representative_type.'</p>';
								}
								if(has_term('', 'wojewodztwo')):
								?>
								<div class="voivodship-content">
									<span class="text-uppercase"><?php echo __('Opiekun województw:', 'wienkra'); ?></span><br/>
									<?php echo get_the_term_list($id_post, 'wojewodztwo', '', ', '); ?>
								</div>
								<?php 
								endif;
								the_content();
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
							echo '</div>';
						echo '</div>';
					}
					else
					{
						the_content();
					}
					if(has_tag()):
				?>
				<div class="content-taq-post">
					<?php echo __('Tagi:', 'wienkra').' '.get_the_tag_list('', ', '); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endwhile; endif; get_footer(); ?>
