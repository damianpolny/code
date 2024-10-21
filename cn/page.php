<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	if(is_page(21))
	{
		echo '<iframe style="filter:grayscale(100%);" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2443.560954918759!2d21.02144131574058!3d52.23319397976087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471eccf7b8e922ef%3A0xa9b18f0bcb7ad043!2sCollegium+Novum+Kursy+Maturalne!5e0!3m2!1spl!2spl!4v1468934151093" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen=""></iframe>';
	}
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content text-center">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<div style="max-width:836px;width:100%;margin:0 auto">
					<div class="page-content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>