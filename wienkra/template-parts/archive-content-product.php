<?php
	$term_id = get_queried_object_id();
	$get_search_query = get_search_query();
	$is_producent = is_tax('producent');
?>
	<div class="page-wraper">
		<div class="container">
			<div class="grid">
				<div class="col-4_md-12">
					<div class="sidebar-product">
						<?php
							if(!isset($_GET['post_type'])):
						?>
						<div class="search-product-widget widget">
							<p class="widget-title"><?php echo __('Znajdź produkt', 'wienkra'); ?>:</p>
							<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url('/'); ?>">
								<div>
									<input type="hidden" name="post_type" value="produkt">
									<?php if($is_producent): ?>
									<input type="hidden" name="producent" value="<?php echo get_queried_object()->slug; ?>">
									<?php endif; ?>
									<input type="text" value="<?php echo $get_search_query; ?>" name="s" id="s" placeholder="<?php echo __('Znajdź produkt...', 'wienkra'); ?>">
									<input type="submit" id="searchsubmit" value="<?php echo __('Szukaj', 'wienkra'); ?>">
								</div>
							</form>
						</div>
						<?php
							endif;
							if(taxonomy_exists('typ') || taxonomy_exists('funkcja')):
						?>
						<form role="search" method="get" id="filterform" class="filterform" action="<?php echo home_url('/'); ?>">
						<input type="hidden" name="post_type" value="produkt">
						<?php if($is_producent): ?>
						<input type="hidden" name="producent" value="<?php echo get_queried_object()->slug; ?>">
						<?php endif; ?>
						<input type="hidden" value="<?php echo $get_search_query; ?>" name="s" id="s">
						<?php
							$typ = get_terms([
								'taxonomy' => 'typ',
								'hide_empty' => true,
							]);
							$funkcja = get_terms([
								'taxonomy' => 'funkcja',
								'hide_empty' => true,
							]);
							//$rozwiazania = get_terms([
								//'taxonomy' => 'rozwiazania',
								//'hide_empty' => true,
							//]);
							$rozwiazania = null;
							if(isset($rozwiazania[0])):
						?>
						<div class="taxonomy-widget widget">
							<p class="widget-title"><?php echo __('Rozwiązania', 'wienkra'); ?>:</p>
							<ul class="product-tax-checkbox">
								<?php
									foreach($rozwiazania as $single):

									$slug = $single->slug;

									if($is_producent)
									{
										$show = false;

										$args_term = array(
											'post_type' => 'produkt',
											'posts_per_page' => 1,
											'post_status' => 'publish',
											'tax_query' => array(
												'relation' => 'AND',
												array(
													'taxonomy' => 'rozwiazania',
													'field' => 'slug',
													'terms' => array($slug),
												),
												array(
													'taxonomy' => 'producent',
													'field' => 'slug',
													'terms' => array(get_queried_object()->slug),
												)
											)
										);
										$term_post = new WP_Query($args_term);
										if($term_post -> have_posts())
										{
											$show = true;
										}
									}
									else
									{
										$show = true;
									}

									if($show):
										$checked = false;
										if($term_id == $single->term_id && !isset($_GET['post_type']))
										{
											$checked = true;
										}
										elseif(isset($_GET['rozwiazania']))
										{
											if(isset($_GET['rozwiazania'][0]))
											{
												foreach($_GET['rozwiazania'] as $get_item)
												{
													if($get_item == $slug)
													{
														$checked = true;
													}
												}
											}
										}
								?>
								<li>
									<input type="checkbox" id="<?php echo $slug; ?>" name="rozwiazania[]" value="<?php echo $slug; ?>"<?php if($checked): ?> checked<?php endif; ?>>
									<label for="<?php echo $slug; ?>"><?php echo $single->name; ?></label>
								<?php endif; endforeach; ?>
							</ul>
						</div>
						<?php
							endif;
							if(isset($typ[0])):
						?>
						<div class="taxonomy-widget widget">
							<p class="widget-title"><?php echo __('Typ', 'wienkra'); ?>:</p>
							<ul class="product-tax-checkbox">
								<?php
									foreach($typ as $single):

									$slug = $single->slug;

									if($is_producent)
									{
										$show = false;

										$args_term = array(
											'post_type' => 'produkt',
											'posts_per_page' => 1,
											'post_status' => 'publish',
											'tax_query' => array(
												'relation' => 'AND',
												array(
													'taxonomy' => 'typ',
													'field' => 'slug',
													'terms' => array($slug),
												),
												array(
													'taxonomy' => 'producent',
													'field' => 'slug',
													'terms' => array(get_queried_object()->slug),
												)
											)
										);
										$term_post = new WP_Query($args_term);
										if($term_post -> have_posts())
										{
											$show = true;
										}
									}
									else
									{
										$show = true;
									}

									if($show):
										$checked = false;
										if($term_id == $single->term_id && !isset($_GET['post_type']))
										{
											$checked = true;
										}
										elseif(isset($_GET['typ']))
										{
											if(isset($_GET['typ'][0]))
											{
												foreach($_GET['typ'] as $get_item)
												{
													if($get_item == $slug)
													{
														$checked = true;
													}
												}
											}
										}
								?>
								<li>
									<input type="checkbox" id="<?php echo $slug; ?>" name="typ[]" value="<?php echo $slug; ?>"<?php if($checked): ?> checked<?php endif; ?>>
									<label for="<?php echo $slug; ?>"><?php echo $single->name; ?></label>
								<?php endif; endforeach; ?>
							</ul>
						</div>
						<?php
							endif;
							if(isset($funkcja[0])):
						?>
						<div class="taxonomy-widget widget">
							<p class="widget-title"><?php echo __('Funkcje', 'wienkra'); ?>:</p>
							<ul class="product-tax-checkbox">
								<?php
									foreach($funkcja as $single):

									$slug = $single->slug;

									if($is_producent)
									{
										$show = false;

										$args_term = array(
											'post_type' => 'produkt',
											'posts_per_page' => 1,
											'post_status' => 'publish',
											'tax_query' => array(
												'relation' => 'AND',
												array(
													'taxonomy' => 'funkcja',
													'field' => 'slug',
													'terms' => array($slug),
												),
												array(
													'taxonomy' => 'producent',
													'field' => 'slug',
													'terms' => array(get_queried_object()->slug),
												)
											)
										);
										$term_post = new WP_Query($args_term);
										if($term_post -> have_posts())
										{
											$show = true;
										}
									}
									else
									{
										$show = true;
									}

									if($show):
										$checked = false;
										if($term_id == $single->term_id && !isset($_GET['post_type']))
										{
											$checked = true;
										}
										elseif(isset($_GET['funkcja']))
										{
											if(isset($_GET['funkcja'][0]))
											{
												foreach($_GET['funkcja'] as $get_item)
												{
													if($get_item == $slug)
													{
														$checked = true;
													}
												}
											}
										}
								?>
								<li>
									<input type="checkbox" id="<?php echo $slug; ?>" name="typ[]" value="<?php echo $slug; ?>"<?php if($checked): ?> checked<?php endif; ?>>
									<label for="<?php echo $slug; ?>"><?php echo $single->name; ?></label>
								<?php endif; endforeach; ?>
							</ul>
						</div>
						<?php endif; ?>
						<div class="grid-1">
							<div class="col">
								<input type="submit" id="filtersubmit" value="<?php echo __('Filtruj', 'wienkra'); ?>">
								<?php
									if(isset($_GET['post_type'])):
										if(isset($_GET['producent']))
										{
											$archive_link = get_term_link(get_queried_object());
										}
										else
										{
											$archive_link = get_post_type_archive_link('produkt');
										}
								?>
								<a href="<?php echo $archive_link; ?>" style="margin-left:10px;" class="custom-read-more" rel="nofollow"><?php echo __('Resetuj', 'wienkra'); ?></a>
								<?php endif; ?>
							</div>
						</div>
						</form>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-8_md-12">
					<?php
						$term_description = term_description();
						if(!empty($term_description) && !isset($_GET['post_type']))
						{
							$brand_logo = rwmb_meta('brand_logo', ['object_type' => 'term'], $term_id);
							$logo = null;
							if(isset($brand_logo['ID']))
							{
								$logo = wp_get_attachment_image($brand_logo['ID'], "logos_img");
							}
							echo '<div class="content-term-description">'.$logo.$term_description.'</div>';
						}
						if(have_posts()):
					?>
					<div class="content-list-product">
						<?php
							while(have_posts()): the_post();
							echo get_template_part('template-parts/list', 'product');
							endwhile;
						?>
					</div>
					<?php
						the_posts_pagination( array(
							'mid_size'  => 2,
							'prev_text' => __('<span class="wienkra_icon_left"></span> Poprzednia', 'wienkra'),
							'next_text' => __('Następna <span class="wienkra_icon_right"></span>', 'wienkra'),
						));
						else:
					?>
						<p class="text-center"><?php echo __('Brak produktów spełniających kryteria.', 'wienkra'); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
