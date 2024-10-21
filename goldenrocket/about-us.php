<?php
	/*Template name: O nas */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$distinction_about_us = rwmb_meta('distinction_about_us', '', $id_page);
	$about_us_experience = rwmb_meta('about_us_experience', '', $id_page);
	$awards_about_us = rwmb_meta('awards_about_us', '', $id_page);
	$about_us_title = rwmb_meta('about_us_title', '', $id_page);
	if(mobile_detect() != 'phone'):
?>
<img width="800" height="885" class="rocket-about-us xs-hidden" src="<?php echo get_template_directory_uri(); ?>/img/rocket.webp" alt="GoldenRocket">
<?php endif; ?>
<div class="page-wraper page-wraper-case-study position-relative">
	<?php if(mobile_detect() != 'phone'): ?>
	<div class="about-us-page-post-anim fade-up md-hidden">
		<img width="900" height="662" class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/anim_2.gif" alt="GoldenRocket">
	</div>
	<?php endif; ?>
	<div class="section-title-content text-left small-margin">
		<div class="section-title-line line-top fade-up">
			<span class="line"></span><?php echo __('Co robimy', 'goldenrocket'); ?>
		</div>
		<div class="container-small">
			<h1 class="section-title fade-up"><?php if(!empty($about_us_title)) { echo $about_us_title; } else { echo __('Kompleksowo zarządzamy marketingiem!', 'goldenrocket'); } ?></h1>
		</div>
	</div>
	<div class="section-text-content">
		<div class="container-small fade-up">
			<div class="grid-noGutter">
				<div class="col-7_lg-10_md-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php if(isset($distinction_about_us[0])): ?>
	<div class="section-list-step">
		<div class="container">
			<div class="section-title-content circle-left text-left fade-right small-margin">
				<p class="section-title"><?php echo __('Co nas wyróżnia?', 'goldenrocket'); ?></p>
			</div>
			<ul>
				<?php
					$count = 1;
					foreach($distinction_about_us as $item):
				?>
				<li class="fade-right" data-number="<?php echo $count; ?>">
					<?php echo apply_filters('the_content', $item); ?>
				</li>
				<?php
					$count++;
					endforeach;
				?>
			</ul>
		</div>
	</div>
	<?php
		endif;
		if(!empty($about_us_experience)):
	?>
	<div class="about-us-counter">
		<div class="container-medium">
			<div class="about-us-experience">
				<div class="about-us-experience-content">
					<div class="about-us-experience-content-bg fade-left"></div>
					<?php echo apply_filters('the_content', $about_us_experience); ?>
				</div>
				<?php if(mobile_detect() != 'phone'): ?>
				<img class="about-us-experience-img fade-right md-hidden" width="580" height="869" src="<?php echo get_template_directory_uri(); ?>/img/dawid_prymas.webp" alt="Dawid Prymas" title="Dawid Prymas">
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset($awards_about_us[0])):
	?>
	<div style="overflow:hidden">
		<div class="container">
			<div class="section-title-content subtitle-line fade-up">
				<p class="section-subtitle"><?php echo __('CO ZDOBYLIŚMY', 'goldenrocket'); ?></p>
				<p class="section-title"><?php echo __('Nagrody', 'goldenrocket'); ?></p>
			</div>
			<div class="swiper-content-text fade-up">
				<div class="swiper" id="swiper_text">
					<div class="swiper-wrapper">
						<?php
							foreach($awards_about_us as $item):
							if(isset($item['award_name_about_us']) && isset($item['award_cat_about_us'])):
						?>
						<div class="swiper-slide">
							<div class="swiper-box">
								<span class="swiper-box-cat"><?php echo $item['award_cat_about_us']; ?></span>
								<span class="swiper-box-name"><?php echo $item['award_name_about_us']; ?></span>
							</div>
						</div>
						<?php
							endif;
							endforeach;
						?>
					</div>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
			<p class="text-center fade-up" style="font-size:15px;line-height: 22px;opacity:0.8;width:100%;max-width:500px;font-weight:500;margin:0 auto 20px auto;">
				<?php echo __('Skontaktuj się z nami już dziś, aby dowiedzieć się więcej o naszych usługach i jak możemy wesprzeć rozwój Twojej marki.', 'goldenrocket'); ?><br/></br/>
				<a rel="nofollow noopener" href="#contact"><svg xmlns="http://www.w3.org/2000/svg" width="27.568" height="15.761" viewBox="0 0 27.568 15.761"><path d="M16,19.974,26.433,9.551a1.97,1.97,0,0,0-2.79-2.782L11.824,18.579a1.966,1.966,0,0,0-.057,2.717L23.634,33.187a1.97,1.97,0,1,0,2.79-2.782Z" transform="translate(-6.194 27.011) rotate(-90)" fill="#fff" opacity="0.678"/></svg></a>
			</p>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php 
	endwhile; endif;
	get_footer();
?>