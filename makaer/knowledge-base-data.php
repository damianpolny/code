<?php
	/* Template name: Baza wiedzy */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$title = get_the_title();
	$the_content = get_the_content('', '', $id_page);
	$section_knowledge = rwmb_meta('section_knowledge', '', $id_page);
	$knowledge_args = array (
		'post_type' => 'page',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'post_parent' => $id_page
	);
	$knowledge_args = new WP_Query($knowledge_args);
	if($knowledge_args -> have_posts())
	{
		while($knowledge_args -> have_posts()): $knowledge_args -> the_post();
			$sub_section_knowledge = rwmb_meta('section_knowledge', '', get_the_ID());
			if(isset($sub_section_knowledge[0]))
			{	
				$section_knowledge = array_merge($section_knowledge, $sub_section_knowledge);
			}
		endwhile; wp_reset_postdata();
	}
?>
	<div class="hero-top position-relative" data-name="<?php echo $title; ?>">
		<div class="container">
			<div class="hero-top-content">
				<div class="page-title-content">
					<h1 class="page-title"><?php echo $title; ?></h1>
				</div>
			</div>
		</div>
	</div>
	<?php if(!empty($the_content)): ?>
	<div class="page-wraper" style="padding-bottom:0">
		<div class="container">
			<div class="page-content">
				<?php echo apply_filters('the_content', $the_content); ?>
			</div>
		</div>
	</div>
	<?php
		endif;
	?>
	<div class="page-wraper">
		<div class="container">
			<div class="grid">
				<div class="col-3_lg-4_md-5_sm-12">
					<div class="sidebar-left">
						<?php echo list_child_pages(); ?>
					</div>
				</div>
				<?php if(isset($section_knowledge[0])): ?>
				<div class="col-9_lg-8_md-7_sm-12">
					<?php
						foreach($section_knowledge as $item):
						if(isset($item['section_knowledge_name']) && isset($item['section_knowledge_txt'])):
					?>
					<div class="accordion-item">
						<div class="accordion-head">
							<?php echo $item['section_knowledge_name']; ?>
							<svg viewBox="0 0 12.62 16.113526" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs /> <g transform="translate(-1581.599,-28.871)"> <path d="M 0,0 H 14.666" transform="rotate(90,779.2195,808.6905)" fill="none" stroke="#AF865B" stroke-linecap="round" stroke-width="1.2" /> <path d="M 0,0 5.71,5.71 0,11.42" transform="rotate(90,777.5965,816.0225)" fill="none" stroke="#AF865B" stroke-linecap="round" stroke-width="1.2" /> </g> </svg>
						</div>
						<div class="accordion-content">
							<?php echo apply_filters('the_content', $item['section_knowledge_txt']); ?>
						</div>
					</div>
					<?php endif; endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php
	echo get_template_part('template-parts/content', 'catalog');
	endwhile; endif;
	get_footer();
?>