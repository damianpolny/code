<?php

require __DIR__ . '/vendor/autoload.php';

function mobile_detect() {
	$detect = new \Detection\MobileDetect;
	return ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
}

function menus() {
	$locations = array(
		'primary_menu' => 'Menu Główne',
		'footer_menu' => 'Menu w stopce'
	);
	register_nav_menus($locations);
}
add_action('init', 'menus');

function add_styles_script() {
	wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.4');
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'add_styles_script', 55);

function add_scripts() {
	$get_template_directory_uri = get_template_directory_uri();
	wp_enqueue_script('script-file', $get_template_directory_uri.'/js/script.js', array(), '1.3');
	if(is_page_template('cart-page-info.php'))
	{
		wp_enqueue_script('ajax-cart', $get_template_directory_uri.'/js/cart.js', array(), '1.4');
		wp_localize_script('ajax-cart', 'ajaxcart', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
		wp_enqueue_script('ajax-send-cart', $get_template_directory_uri.'/js/cart-send.js', array(), '1.3');
		wp_localize_script('ajax-send-cart', 'ajaxsendcart', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}
	if(is_page_template('comments.php'))
	{
		wp_enqueue_script('ajax-comments', $get_template_directory_uri.'/js/comments.js', array(), '1.2');
		wp_localize_script('ajax-comments', 'ajaxcomments', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}
	wp_enqueue_script('ajax-filter', $get_template_directory_uri.'/js/filter.js', array(), '1.3');
	wp_localize_script('ajax-filter', 'ajaxfilter', array(
		'ajaxurl' => admin_url('admin-ajax.php')
	));
}
add_action('wp_footer', 'add_scripts');

add_filter('paginate_links', function($link) {
    $pos = strpos($link, 'page/1/');
    if($pos !== false) {
      $link = substr($link, 0, $pos);
    }
    return $link;
});

function remove_wp_block_library_css(){
	if(class_exists('Classic_Editor'))
	{
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('global-styles');
		wp_dequeue_style('classic-theme-styles');
	}
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

function sitemap_exclude_taxonomy($excluded, $taxonomy) {
    return $taxonomy == 'kurs';
}
add_filter('wpseo_sitemap_exclude_taxonomy', 'sitemap_exclude_taxonomy', 10, 2);

function wp_script_page() {
	echo "<script>

		if(document.getElementById('slider_front_page'))
		{
			var slider_front_page = new Swiper('#slider_front_page', {
				effect: 'fade',
				rewind: true,
				allowTouchMove: false,
				slidesPerView: 1,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				pagination: {
					el: '.custom-swiper-pagination .swiper-pagination',
					clickable: true
				}
			});

			if(document.getElementsByClassName('slider-front-page-video').length > 0)
			{
				const videos_array = document.getElementsByClassName('slider-front-page-video');

				var length_array = videos_array.length;

				videos_array[0].play();

				function onended_video(p, index)
				{
					p.onended = function() {
						slider_front_page.slideNext();
					}
				}

				function play_video(p, index, realIndex)
				{
					if(realIndex == index)
					{
						p.play();
					}
					else
					{
						p.pause();
						p.currentTime = 0;
					}
				}

				Array.from(videos_array).map((p, index) => onended_video(p, index));

				slider_front_page.on('slideChange', function (e) {
					Array.from(videos_array).map((p, index) => play_video(p, index, this.realIndex));
				});

			}

		}

		if(document.getElementById('slider_subject'))
		{
			var slider_subject = new Swiper('#slider_subject', {
				rewind: true,
				slidesPerView: 1,
				spaceBetween: 0,
				navigation: {
					nextEl: '.slider_subject .swiper-button-next',
					prevEl: '.slider_subject .swiper-button-prev',
				},
				breakpoints: {
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					},
					1024: {
						slidesPerView: 3,
						spaceBetween: 30
					},
					1360: {
						slidesPerView: 4,
						spaceBetween: 30
					},
					1790: {
						slidesPerView: 5,
						spaceBetween: 40
					},
				}
			});
		}

		if(document.getElementById('slider_lecturer'))
		{
			var slider_lecturer = new Swiper('#slider_lecturer', {
				rewind: true,
				slidesPerView: 1,
				navigation: {
					nextEl: '.slider_lecturer .swiper-button-next',
					prevEl: '.slider_lecturer .swiper-button-prev',
				},
				breakpoints: {
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					},
					1024: {
						slidesPerView: 3,
						spaceBetween: 30
					},
					1360: {
						slidesPerView: 4,
						spaceBetween: 30
					},
					1790: {
						slidesPerView: 5,
						spaceBetween: 30
					},
				}
			});
		}
		
		if(document.getElementById('slider_discounts'))
		{
			var slider_discounts = new Swiper('#slider_discounts', {
				loop: true,
				slidesPerView: 1,
				centeredSlides: true,
				autoplay: true,
				spaceBetween: 0,
				navigation: {
					nextEl: '.slider_discounts .swiper-button-next',
					prevEl: '.slider_discounts .swiper-button-prev',
				},
				breakpoints: {
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					},
					1024: {
						slidesPerView: 3,
						spaceBetween: 30
					},
					1360: {
						spaceBetween: 30
					},
					1790: {
						slidesPerView: 4.8,
						spaceBetween: 40
					},
				}
			});
		}

		if(document.getElementsByClassName('slider_subject_list').length > 0)
		{
			var slider_subject_list = new Swiper('.slider_subject_list', {
				rewind: true,
				slidesPerView: 1,
				spaceBetween: 0,
				navigation: {
					nextEl: '.slider-subject-list .swiper-button-next',
					prevEl: '.slider-subject-list .swiper-button-prev',
				},
				breakpoints: {
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					},
					1024: {
						slidesPerView: 3,
						spaceBetween: 30
					},
					1360: {
						slidesPerView: 4,
						spaceBetween: 30
					},
					1790: {
						slidesPerView: 4,
						spaceBetween: 60
					},
				}
			});
		}
		
		if(document.getElementById('slider_post'))
		{
			var slider_post = new Swiper('#slider_post', {
				rewind: true,
				slidesPerView: 1,
				spaceBetween: 0,
				navigation: {
					nextEl: '.slider_post .swiper-button-next',
					prevEl: '.slider_post .swiper-button-prev',
				},
				breakpoints: {
					1024: {
						slidesPerView: 2,
						spaceBetween: 40,
					},
					1360: {
						slidesPerView: 2,
						spaceBetween: 80,
					},
					1790: {
						slidesPerView: 2,
						spaceBetween: 160,
					}
				}
			});
		}

		jQuery(document).ready(function(){
			
			if(document.getElementById('phone'))
			{
				jQuery('#phone').mask('000-000-000');
			}
			
			jQuery(document.body).on('click', '.menu-bar, .menu-top .close-menu-top', function() {
				jQuery('.menu-top').toggleClass('active-menu');
				jQuery('.menu-bar').toggleClass('active-bar');
			});
			
			jQuery(document.body).on('click', 'header .header .header-content .menu-top > div > ul > li.menu-item-has-children .open-sub-menu', function() {
				jQuery(this).parent().find('ul.sub-menu').slideToggle();
			});
			
			if(jQuery(window).width() <= 1360)
			{
				jQuery('header .header .header-content .menu-top > div > ul > li.menu-item-has-children').append('<span class=\"open-sub-menu\"></span>');
				jQuery('header .header .header-content .menu-top').append('<span class=\"close-menu-top\">&#215;</span>');
			}

			jQuery('.subject-slider-item').not(':has(.subject-slider-item-content)').click(function(){
				jQuery(this).toggleClass('active');
			});

			jQuery('.cn-popup .cn-popup-close').click(function(){
				jQuery('.cn-popup').remove();
			});

			jQuery('.subject-filter-content .subject-filter .subject-filter-list-name').click(function(){
				jQuery(this).toggleClass('active');
			});

			jQuery('.subject-filter-content .subject-filter ul.subject-filter-list li input').click(function(){
				jQuery(this).parent().parent().prev().addClass('active');
			});

			jQuery('#subject_filter .filter-reset').click(function(){
				jQuery('#form_filter input').prop('checked',false);
			});
			
			jQuery('#comments_filters .filter-reset').click(function(){
				jQuery('#form_comments_filters input').prop('checked',false);
				jQuery('#comments_the_content').empty();
			});

			jQuery('.acccordion-container .acccordion-item .acccordion-head').click(function(){
				jQuery(this).toggleClass('active');
				jQuery(this).find('.acccordion-open').toggleClass('active');
				jQuery(this).next().toggleClass('active');
			});

			jQuery('.subject-slider-item .subject-slider-item-content .subject-slider-item-list-url a.simplefavorite-button').click(function(){
				jQuery(this).parent().parent().parent().parent().addClass('loading');
			});

			jQuery(document.body).on('click', 'ul.list-level-select-slide li, .subject-page-top .subject-page-top-blob ul.list-blob li', function(){
				var url_subject = jQuery(this).data('url');
				
				if(url_subject != '')
				{
					window.location.href = url_subject;
				}
				
			});
			
			jQuery(document.body).on('click', '.subject-slider-item .subject-slider-item-content .subject-slider-item-name', function(){
				
				if(jQuery(window).width() >= 1024)
				{
					var url_subject = jQuery(this).data('url');
					
					if(url_subject != '')
					{
						window.location.href = url_subject;
					}
				}
				
			});

			jQuery(document).on('favorites-updated-single', function(event, favorites, post_id, site_id, status){

				if(typeof favorites != 'undefined')
				{
					jQuery('header .header-navbar a.cart-top .cart-top-count').html(Object.keys(favorites[0].posts).length);

					if(status == 'active')
					{
						jQuery('#subject-id-' + post_id).addClass('active');
						gtag('event', 'conversion_event_add_to_cart', {});
					}
					else if(status == 'inactive')
					{
						jQuery('#subject-id-' + post_id).removeClass('active');
					}

					jQuery('#subject-id-' + post_id + ' .subject-slider-item-content').removeClass('loading');

				}

			});
			
			if(document.getElementById('opinion_filters'))
			{
				jQuery(document.body).on('change', '#opinion_filters .subject-filter ul.subject-filter-list li input', function() {
							
					var year = jQuery(this).val();
										
					if(year != '')
					{
						jQuery('.opinion-content-img').hide();
						jQuery('#year_img_' + year).show();
					}
						
				});
				
				jQuery('#opinion_filters .filter-reset').click(function(){
					jQuery('.opinion-content-img').show();
					jQuery('#opinion_filters input').prop('checked',false);
				});
				
			}

		});

	</script>";
}
add_action('wp_footer', 'wp_script_page', 55);

function remove_version_generator() {
	return '';
}
add_filter('the_generator', 'remove_version_generator');

function remove_version_from_style_js($src) {
    if(strpos($src, 'ver=' . get_bloginfo('version')))
        $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'remove_version_from_style_js');
add_filter('script_loader_src', 'remove_version_from_style_js');

add_theme_support('post-thumbnails');
add_theme_support('custom-logo');

function big_image_size_threshold($threshold) {
	return 9999;
}
add_filter('big_image_size_threshold', 'big_image_size_threshold', 100, 1);

function get_url_for_slug($slug) {
	if(class_exists("pll_get_post"))
	{
		return get_permalink(pll_get_post(get_page_by_path($slug)->ID, pll_current_language()));
	}
	else
	{
		return get_permalink(get_page_by_path($slug));
	}
}

add_filter('manage_kurs_posts_columns', function ($defaults) {
	$defaults['start_end_hour'] = 'Godziny';
	$defaults['total_price_subject'] = 'Cena';
	return $defaults;
}, 10);

add_action('manage_kurs_posts_custom_column', function ($column_name, $post_id) {
	if($column_name == 'start_end_hour')
	{
		$time_from_subject = get_post_meta($post_id, 'time_from_subject');
		$time_to_subject = get_post_meta($post_id, 'time_to_subject');
		if(isset($time_from_subject[0]))
		{
			echo $time_from_subject[0];
		}
		echo ' - ';
		if(isset($time_to_subject[0]))
		{
			echo $time_to_subject[0];
		}
	}
	if($column_name == 'total_price_subject')
	{
		$total_price_subject = get_post_meta($post_id, 'total_price_subject');
		if(isset($total_price_subject[0]))
		{
			echo $total_price_subject[0].' zł';
		}
	}
}, 10, 2);

function my_manage_columns($columns) {
	unset($columns['date']);
	return $columns;
}

function my_column_init() {
	add_filter('manage_posts_columns' , 'my_manage_columns');
}
add_action('admin_init' , 'my_column_init');

function separator_content($atts) {
    $default = array(
      'height' => '5'
    );
    $a = shortcode_atts($default, $atts);
    return '<div style="display:block;width:100%;height:'.$a['height'].'px"></div>';
}
add_shortcode('separator_content', 'separator_content');

function subject_post_type() {
	$args = [
		'label'  => 'Kursy',
		'labels' => [
			'menu_name' => 'Kursy',
			'name_admin_bar' => 'Kurs',
			'add_new' => 'Dodaj kurs',
			'add_new_item' => 'Dodaj nowy kurs',
			'new_item' => 'Nowy kurs',
			'edit_item' => 'Edytuj kurs',
			'view_item' => 'Zobacz kurs',
			'update_item' => 'Zaktualizuj kurs'
		],
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_rest' => true,
		'capability_type' => 'post',
		'has_archive' => 'kursy',
		'hierarchical' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite_no_front' => false,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-welcome-learn-more',
		'supports' => [
			'title',
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('kurs', $args);
}
add_action('init', 'subject_post_type');

function comments_post_type() {
	$args = [
		'label'  => 'Komentarze',
		'labels' => [
			'menu_name' => 'Komentarze',
			'name_admin_bar' => 'Komentarz',
			'add_new' => 'Dodaj komentarz',
			'add_new_item' => 'Dodaj nowy komentarz',
			'new_item' => 'Nowy komentarz',
			'edit_item' => 'Edytuj komentarz',
			'update_item' => 'Zaktualizuj komentarz'
		],
		'public' => false,
		'exclude_from_search' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_rest' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite_no_front' => false,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-format-status',
		'supports' => [
			'title', 'editor'
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('komentarz', $args);
}
add_action('init', 'comments_post_type');

function lecturer_post_type() {
	$args = [
		'label'  => 'Wykładowcy',
		'labels' => [
			'menu_name' => 'Wykładowcy',
			'name_admin_bar' => 'Wykładowca',
			'add_new' => 'Dodaj wykładowce',
			'add_new_item' => 'Dodaj nowego wykładowce',
			'new_item' => 'Nowy wykładowca',
			'edit_item' => 'Edytuj wykładowce',
			'view_item' => 'Zobacz wykładowce',
			'update_item' => 'Zaktualizuj wykładowce'
		],
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_rest' => true,
		'capability_type' => 'post',
		'has_archive' => 'wykladowcy',
		'hierarchical' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite_no_front' => false,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-admin-users',
		'supports' => [
			'title', 'thumbnail', 'editor', 'excerpt'
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('wykladowca', $args);
}
add_action('init', 'lecturer_post_type');

function lecturer_subject_taxonomy() {
	$args = [
		'label'  => 'Przedmiot',
		'labels' => [
			'menu_name' => 'Przedmiot',
			'add_new_item' => 'Dodaj nowy przedmiot',
			'edit_item' => 'Edytuj przedmiot',
			'update_item' => 'Zaktualizuj przedmiot',
			'not_found' => 'Nie znaleziono żadnych przedmiotów.'
		],
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => false,
		'show_admin_column' => false,
		'show_in_rest' => false,
		'hierarchical' => true,
		'query_var' => false,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('przedmiot-wykladowcy', [ 'wykladowca' ], $args);
}
add_action('init', 'lecturer_subject_taxonomy');

function subject_taxonomy() {
	$args = [
		'label'  => 'Przedmiot',
		'labels' => [
			'menu_name' => 'Przedmiot',
			'add_new_item' => 'Dodaj nowy przedmiot',
			'edit_item' => 'Edytuj przedmiot',
			'update_item' => 'Zaktualizuj przedmiot',
			'not_found' => 'Nie znaleziono żadnych przedmiotów.'
		],
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => false,
		'show_admin_column' => false,
		'show_in_rest' => false,
		'hierarchical' => true,
		'query_var' => false,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('kurs', [ 'kurs', 'komentarz' ], $args);
}
add_action('init', 'subject_taxonomy');

function subject_level_taxonomy() {
	$args = [
		'label'  => 'Poziom',
		'labels' => [
			'menu_name' => 'Poziom',
			'add_new_item' => 'Dodaj nowy poziom',
			'edit_item' => 'Edytuj poziom',
			'update_item' => 'Zaktualizuj poziom',
			'not_found' => 'Nie znaleziono żadnych poziomów.'
		],
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => false,
		'show_admin_column' => true,
		'show_in_rest' => false,
		'hierarchical' => true,
		'query_var' => false,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('poziom', [ 'kurs', 'komentarz' ], $args);
}
add_action('init', 'subject_level_taxonomy');

function subject_day_taxonomy() {
	$args = [
		'label'  => 'Dzień',
		'labels' => [
			'menu_name' => 'Dzień',
			'add_new_item' => 'Dodaj nowy dzień',
			'edit_item' => 'Edytuj dzień',
			'update_item' => 'Zaktualizuj dzień',
			'not_found' => 'Nie znaleziono żadnych dni.'
		],
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => false,
		'show_admin_column' => true,
		'show_in_rest' => false,
		'hierarchical' => true,
		'query_var' => false,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('dzien', [ 'kurs' ], $args);
}
add_action('init', 'subject_day_taxonomy');

function subject_year_taxonomy() {
	$args = [
		'label'  => 'Rok',
		'labels' => [
			'menu_name' => 'Rok',
			'add_new_item' => 'Dodaj nowy rok',
			'edit_item' => 'Edytuj rok',
			'update_item' => 'Zaktualizuj rok',
			'not_found' => 'Nie znaleziono żadnych lat.'
		],
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => false,
		'show_admin_column' => true,
		'show_in_rest' => false,
		'hierarchical' => true,
		'query_var' => false,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('rok', [ 'kurs', 'komentarz' ], $args);
}
add_action('init', 'subject_year_taxonomy');

function subject_status_taxonomy() {
	$args = [
		'label'  => 'Status',
		'labels' => [
			'menu_name' => 'Status',
			'add_new_item' => 'Dodaj nowy status',
			'edit_item' => 'Edytuj status',
			'update_item' => 'Zaktualizuj status',
			'not_found' => 'Nie znaleziono żadnych statusów.'
		],
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => false,
		'show_admin_column' => false,
		'show_in_rest' => false,
		'hierarchical' => true,
		'query_var' => false,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('status', [ 'kurs' ], $args);
}
add_action('init', 'subject_status_taxonomy');

function subject_type_taxonomy() {
	$args = [
		'label'  => 'Typ',
		'labels' => [
			'menu_name' => 'Typ',
			'add_new_item' => 'Dodaj nowy typ',
			'edit_item' => 'Edytuj typ',
			'update_item' => 'Zaktualizuj typ',
			'not_found' => 'Nie znaleziono żadnych typów.'
		],
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => false,
		'show_admin_column' => false,
		'show_in_rest' => false,
		'hierarchical' => true,
		'query_var' => false,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('typ', [ 'kurs' ], $args);
}
add_action('init', 'subject_type_taxonomy');


add_filter('mb_settings_pages', function ($settings_pages) {
    $settings_pages[] = [
        'id' => 'cn-settings',
        'option_name' => 'cn_settings',
        'menu_title' => 'Opcje strony',
        'submit_button' => 'Zapisz ustawienia'
    ];
    return $settings_pages;
});

function register_meta_boxes_cn_settings($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje strony',
		'id' => null,
		'settings_pages' => 'cn-settings',
		'tabs' => [
			'contact_page_tab' => 'Dane kontaktowe',
			'discounts_page_tab' => 'Zniżki',
			'extra_page_tab' => 'Dodatki do kursów',
			'start_subject_tab' => 'Początek kursu',
			'extra_subject_tab' => 'Warsztaty praktycznych umiejętności',
			'cart_tab' => 'Koszyk'
		],
		'fields' => [
			[
				'name' => 'Numer telefonu',
				'id' => 'phone_page',
				'type' => 'text',
				'tab' => 'contact_page_tab'
			],
			[
				'name' => 'E-mail',
				'id' => 'email_page',
				'type' => 'email',
				'tab' => 'contact_page_tab'
			],
			[
				'name' => 'Facebook',
				'id' => 'facebook_url_page',
				'type' => 'url',
				'tab' => 'contact_page_tab'
			],
			[
				'name' => 'Instagram',
				'id' => 'instagram_url_page',
				'type' => 'url',
				'tab' => 'contact_page_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Zniżka za zapis do daty',
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Tytuł',
				'id' => 'discounts_date_title',
				'type' => 'text',
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Wielkość zniżki (%)',
				'id' => 'discounts_number',
				'type' => 'number',
				'min' => 1,
				'max' => 99,
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Data obowiązywania',
				'id' => 'discounts_date',
				'type' => 'date',
				'tab' => 'discounts_page_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Zniżka za płatność w całości',
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Wielkość zniżki (%)',
				'id' => 'discounts_all_number',
				'type' => 'number',
				'min' => 1,
				'max' => 99,
				'tab' => 'discounts_page_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Zniżka na 2 kurs',
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Wielkość zniżki (%)',
				'id' => 'discounts_two_number',
				'type' => 'number',
				'min' => 1,
				'max' => 99,
				'tab' => 'discounts_page_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Zniżka na 3 i kolejny kurs',
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Wielkość zniżki (%)',
				'id' => 'discounts_many_number',
				'type' => 'number',
				'min' => 1,
				'max' => 99,
				'tab' => 'discounts_page_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Zniżka za kontynuacje',
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Wielkość zniżki (%)',
				'id' => 'discounts_year_number',
				'type' => 'number',
				'min' => 1,
				'max' => 99,
				'tab' => 'discounts_page_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Zniżka dla znajomych',
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Wielkość zniżki (%)',
				'id' => 'discounts_group_number',
				'type' => 'number',
				'min' => 1,
				'max' => 99,
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Wielkość grupy',
				'id' => 'discounts_group_count_number',
				'type' => 'number',
				'min' => 1,
				'max' => 20,
				'tab' => 'discounts_page_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Zniżka za rodzeństwo',
				'tab' => 'discounts_page_tab'
			],
			[
				'name' => 'Wielkość zniżki (%)',
				'id' => 'discounts_sibling_number',
				'type' => 'number',
				'min' => 1,
				'max' => 99,
				'tab' => 'discounts_page_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Cena za komplet nagrań',
				'tab' => 'extra_page_tab'
			],
			[
				'name' => 'Dodaj cene',
				'id' => 'extra_video_subject',
				'type' => 'number',
				'min' => 1,
				'tab' => 'extra_page_tab'
			],
			[
				'name' => 'Dodaj',
				'id' => 'extra_subject',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'tab' => 'extra_subject_tab',
				'fields' => [
					[
						'name' => 'Tytuł',
						'id' => 'extra_subject_title',
						'type' => 'text',
					],
					[
						'name' => 'Opis',
						'id' => 'extra_subject_text',
						'type' => 'text',
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'E-mail wiadomości z formularza',
				'tab' => 'cart_tab'
			],
			[
				'name' => 'Dodaj email',
				'id' => 'cart_email_page',
				'type' => 'email',
				'tab' => 'cart_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Treść wiadomości',
				'tab' => 'cart_tab'
			],
			[
				'name' => 'Dodaj treść',
				'id' => 'cart_email_content',
				'type' => 'wysiwyg',
				'tab' => 'cart_tab'
			],
			[
				'type' => 'heading',
				'name' => 'Dodaj informacje kiedy zaczyna się kurs',
				'tab' => 'start_subject_tab'
			],
			[
				'name' => 'Dodaj',
				'id' => 'global_start_subject',
				'type' => 'text',
				'tab' => 'start_subject_tab'
			],
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_cn_settings');

function register_meta_boxes_custom_frontpage($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include' => [
			'relation' => 'OR',
			'ID' => get_option('page_on_front')
		],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'POPUP',
			],
			[
				'name' => 'Aktywny',
				'id' => 'popup_cn_enable',
				'type' => 'switch',
				'on_label'  => 'Tak',
				'off_label' => 'Nie',
			],
			[
				'name' => 'Obrazek',
				'id' => 'popup_cn_image',
				'type' => 'single_image',
			],
			[
				'name' => 'Tytuł',
				'id' => 'popup_cn_title',
				'type' => 'textarea',
			],
			[
				'name' => 'Numer',
				'id' => 'popup_cn_number',
				'type' => 'text',
				'sanitize_callback' => 'none'
			],
			[
				'name' => 'Opis',
				'id' => 'popup_cn_text',
				'type' => 'text',
				'sanitize_callback' => 'none'
			],
			[
				'name' => 'Link',
				'id' => 'popup_cn_url',
				'type' => 'url',
			],
			[
				'type' => 'heading',
				'name' => 'SLIDER',
			],
			[
				'name' => 'Dodaj',
				'id' => 'slider_front_page',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'VIDEO',
						'id' => 'slider_front_page_video',
						'type' => 'video',
						'max_file_uploads' => 1,
					],
					[
						'name' => 'Napis',
						'id' => 'slider_front_page_words_image',
						'type' => 'single_image',
					],
					[
						'name' => 'Pozycja napisu',
						'id' => 'slider_front_page_words_image_position',
						'type' => 'select',
						'select_all_none' => true,
						'options' => [
							'left' => 'Lewa',
							'right' => 'Prawa',
							'center' => 'Środek'
						]
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'SEKCJA KURSÓW',
			],
			[
				'name' => 'Tytuł sekcji',
				'id' => 'section_subject_name',
				'type' => 'text',
			],
			[
				'name' => 'Opis sekcji',
				'id' => 'section_subject_text',
				'type' => 'textarea',
			],
			[
				'name' => 'Wybierz stronę z kursami',
				'id' => 'section_subject_slider',
				'type' => 'post',
				'post_type' => 'page',
				'field_type' => 'select_advanced',
				'placeholder' => 'Wybierz stronę',
				'ajax' => true,
				'js_options' => [
					'minimumInputLength' => 2,
				],
				'query_args'  => [
					'post_status'    => 'publish',
					'posts_per_page' => -1,
				]
			],
			[
				'name' => 'BOXY 1',
				'id' => 'box_one_front_page',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Tytuł',
						'id' => 'box_one_front_page_name',
						'type' => 'text',
					],
					[
						'name' => 'Opis',
						'id' => 'box_one_front_page_text',
						'type' => 'textarea',
					],
					[
						'name' => 'URL',
						'id' => 'box_one_front_page_url',
						'type' => 'url',
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'SEKCJA INFORMACYJNA',
			],
			[
				'name' => 'VIDEO',
				'id' => 'section_info_video',
				'type' => 'video',
				'max_file_uploads' => 1,
			],
			[
				'name' => 'Procent',
				'id' => 'section_info_procent',
				'type' => 'text'
			],
			[
				'name' => 'Tytuł',
				'id' => 'section_info_title',
				'type' => 'text',
			],
			[
				'name' => 'Nazwa przycisku',
				'id' => 'section_info_button',
				'type' => 'text',
			],
			[
				'name' => 'URL',
				'id' => 'section_info_url',
				'type' => 'url',
			],
			[
				'type' => 'heading',
				'name' => 'BOXY 2',
			],
			[
				'name' => 'Dodaj',
				'id' => 'box_two_front_page',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Ikonka',
						'id' => 'box_two_front_page_icon',
						'type' => 'single_image',
					],
					[
						'name' => 'Tytuł',
						'id' => 'box_two_front_page_name',
						'type' => 'text',
					],
					[
						'name' => 'Opis',
						'id' => 'box_two_front_page_text',
						'type' => 'textarea',
					],
					[
						'name' => 'URL',
						'id' => 'box_two_front_page_url',
						'type' => 'url',
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'SEKCJA INFORMACYJNA',
			],
			[
				'name' => 'Obrazek',
				'id' => 'section_list_img',
				'type' => 'single_image',
			],
			[
				'name' => 'Tytuł sekcji',
				'id' => 'section_slogan_name',
				'type' => 'text',
			],
			[
				'name' => 'Tytuł grupy 1',
				'id' => 'section_slogan_group_one_name',
				'type' => 'text',
			],
			[
				'name' => 'Grupa 1',
				'id' => 'section_slogan_group_one',
				'type' => 'text',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
			],
			[
				'name' => 'Tytuł grupy 2',
				'id' => 'section_slogan_group_two_name',
				'type' => 'text',
			],
			[
				'name' => 'Grupa 2',
				'id' => 'section_slogan_group_two',
				'type' => 'text',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
			],
			[
				'type' => 'heading',
				'name' => 'PLAN JAZDY',
			],
			[
				'name' => 'Obrazek',
				'id' => 'section_images',
				'type' => 'single_image',
			],
			[
				'type' => 'heading',
				'name' => 'SEKCJA INFORMACYJNA',
			],
			[
				'name' => 'VIDEO',
				'id' => 'section_comments_video',
				'type' => 'video',
				'max_file_uploads' => 1,
			],
			[
				'name' => 'Tytuł',
				'id' => 'section_comment_title',
				'type' => 'text',
			],
			[
				'name' => 'Opis',
				'id' => 'section_comment_text',
				'type' => 'textarea',
			],
			[
				'name' => 'URL',
				'id' => 'section_comment_url',
				'type' => 'url',
			],
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_frontpage');

function register_meta_boxes_custom_page_subject($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['subject-page-info.php']
        ],
		'fields' => [
			[
				'name' => 'Wybierz kurs przypisany do tej strony',
				'id' => 'page_subject_term',
				'type' => 'taxonomy_advanced',
				'taxonomy' => 'kurs'
			],
			[
				'name' => 'Wybierz poziom przypisany do tej strony',
				'id' => 'page_subject_level_term',
				'type' => 'taxonomy_advanced',
				'taxonomy' => 'poziom'
			],
			[
				'name' => 'Wybierz rok przypisany do tej strony',
				'id' => 'page_subject_year_term',
				'type' => 'taxonomy_advanced',
				'taxonomy' => 'rok'
			],
			[
				'name' => 'Slogan',
				'id' => 'page_subject_slogan',
				'type' => 'textarea',
			],
			[
				'type' => 'heading',
				'name' => 'BOXY INFORMACYJNE',
			],
			[
				'name' => 'Dodaj',
				'id' => 'box_subject_item',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Tytuł',
						'id' => 'page_subject_item_name',
						'type' => 'text',
					],
					[
						'name' => 'Opis',
						'id' => 'page_subject_item_text',
						'type' => 'textarea',
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'FAQ',
			],
			[
				'name' => 'Dodaj',
				'id' => 'page_subject_faq',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Tytuł',
						'id' => 'page_subject_faq_name',
						'type' => 'text',
					],
					[
						'name' => 'Opis',
						'id' => 'page_subject_faq_text',
						'type' => 'wysiwyg',
					]
				]
			],
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_subject');

function register_meta_boxes_custom_page_discounts($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['discounts-page.php']
        ],
		'fields' => [
			[
				'name' => 'Tytuł top',
				'id' => 'section_discount_name',
				'type' => 'text',
			],
			[
				'name' => 'Procent',
				'id' => 'section_discount_percent',
				'type' => 'text',
				'sanitize_callback' => 'none'
			],
			[
				'name' => 'Opis top',
				'id' => 'section_discount_txt',
				'type' => 'text',
				'sanitize_callback' => 'none'
			],
			[
				'name' => 'Tytuł sekcji',
				'id' => 'section_slider_name',
				'type' => 'text',
			],
			[
				'name' => 'Opis sekcji',
				'id' => 'section_slider_txt',
				'type' => 'text',
			],
			[
				'name' => 'Dodatkowa sekcja tekstowa (full width)',
				'id' => 'extra_the_content',
				'type' => 'wysiwyg',
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_discounts');

function register_meta_boxes_custom_page_about_courses($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['about_courses.php']
        ],
		'fields' => [
			[
				'name' => 'Obrazek',
				'id' => 'about_courses_video_img',
				'type' => 'single_image'
			],
			[
				'name' => 'VIDEO',
				'id' => 'about_courses_video',
				'type' => 'video',
				'max_file_uploads' => 1
			],
			[
				'name' => 'Dodatkowy opis',
				'id' => 'about_courses_extra_txt',
				'type' => 'wysiwyg'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_about_courses');

function register_meta_boxes_custom_page_opinions($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['opinions.php']
        ],
		'fields' => [
			[
				'name' => 'Dodaj opinie',
				'id' => 'opinions_content',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Rok',
						'id' => 'opinions_content_year',
						'type' => 'number',
					],
					[
						'name' => 'Obrazek',
						'id' => 'opinions_content_img',
						'type' => 'single_image',
					],
					[
						'name' => 'Dodatkowe obrazki',
						'id' => 'opinions_content_imgs',
						'type' => 'image_advanced',
					]
				]
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_opinions');

function register_meta_boxes_custom_post_subject($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'kurs',
		'fields' => [
			[
				'name' => 'Cena za cały kurs',
				'id' => 'total_price_subject',
				'type' => 'number'
			],
			[
				'name' => 'Start kursu',
				'id' => 'date_start_subject',
				'type' => 'date'
			],
			[
				'name' => 'Godzina rozpoczęcia',
				'id' => 'time_from_subject',
				'type' => 'time'
			],
			[
				'name' => 'Godzina zakończenia',
				'id' => 'time_to_subject',
				'type' => 'time'
			],
			[
				'name' => 'Czy wyłączyć dodatek video do kursu?',
				'id' => 'extra_course_video',
				'type' => 'switch',
				'style' => 'rounded',
				'on_label' => 'Tak',
				'off_label' => 'Nie'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_post_subject');

function register_meta_boxes_custom_subject($meta_boxes) {
	$meta_boxes[] = [
		'title' => null,
		'id' => null,
		'taxonomies' => 'kurs',
		'fields' => [
			[
				'name' => 'Kolor przedmiotu',
				'id' => 'color_subject',
				'type' => 'color',
			],
			[
				'name' => 'Kolor ostatnie wolne miejsca',
				'id' => 'color_subject_limit',
				'type' => 'color',
			],
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_subject');

function register_meta_boxes_custom_level($meta_boxes) {
	$meta_boxes[] = [
		'title' => null,
		'id' => null,
		'taxonomies' => 'poziom',
		'fields' => [
			[
				'name' => 'Literka poziomu',
				'id' => 'letter_level',
				'type' => 'text',
				'limit' => 1
			],
			[
				'name' => 'Skrócona nazwa poziomu',
				'id' => 'short_name_level',
				'type' => 'text',
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_level');

function register_meta_boxes_custom_status($meta_boxes) {
	$meta_boxes[] = [
		'title' => null,
		'id' => null,
		'taxonomies' => 'status',
		'fields' => [
			[
				'name' => 'Kolor tekstu',
				'id' => 'color_status',
				'type' => 'color',
			],
			[
				'name' => 'Czy wypełnić kolorem kafelek',
				'id' => 'active_limit',
				'type' => 'switch',
				'on_label' => 'Tak',
				'off_label' => 'Nie',
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_status');

function footer_one_widget() {
	$args = array(
		'name' => 'Stopka 1',
		'id' => 'footer_one_widget',
		'description' => 'Dodaj widgety.',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widgettitle">',
		'after_title' => '</p>'
	);
	register_sidebar($args);
}
add_action('widgets_init', 'footer_one_widget');

function footer_two_widget() {
  	$args = array(
		'name' => 'Stopka 2',
		'id' => 'footer_two_widget',
		'description' => 'Dodaj widgety.',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widgettitle">',
		'after_title' => '</p>'
	);
	register_sidebar($args);
}
add_action('widgets_init', 'footer_two_widget');

function footer_three_widget() {
  	$args = array(
		'name' => 'Stopka 3',
		'id' => 'footer_three_widget',
		'description' => 'Dodaj widgety.',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widgettitle">',
		'after_title' => '</p>'
	);
	register_sidebar($args);
}
add_action('widgets_init', 'footer_three_widget');

function footer_four_widget() {
  	$args = array(
		'name' => 'Stopka 4',
		'id' => 'footer_four_widget',
		'description' => 'Dodaj widgety.',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widgettitle">',
		'after_title' => '</p>'
	);
	register_sidebar($args);
}
add_action('widgets_init', 'footer_four_widget');

function footer_five_widget() {
  	$args = array(
		'name' => 'Stopka 5',
		'id' => 'footer_five_widget',
		'description' => 'Dodaj widgety.',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widgettitle">',
		'after_title' => '</p>'
	);
	register_sidebar($args);
}
add_action('widgets_init', 'footer_five_widget');

function subject_year($query) {
    if((is_tax('kurs') || is_post_type_archive('kurs')) && isset($_GET['year_check']) && $query->is_main_query() && !isset($_REQUEST['data']))
	{
		if(is_numeric($_GET['year_check']))
		{
			$tax_query = array(
				array (
					'taxonomy' => 'rok',
					'field' => 'slug',
					'terms' => $_GET['year_check']
				)
			);
			$query->set('tax_query', $tax_query);
		}
    }
}
add_action('pre_get_posts', 'subject_year');

function subject_tax($query) {
    if(is_tax('kurs') && $query->is_main_query())
	{
		$query->set('post_type', 'kurs');
    }
}
add_action('pre_get_posts', 'subject_tax');


function ajax_comments() {
	$tax_query = array();
	$comments_arg = null;

	if(isset($_REQUEST['data']))
	{

		$kurs = array();
		$poziom = array();
		$rok = array();

		foreach($_REQUEST['data'] as $item)
		{
			if(trim($item['name'],'[]') == 'kurs')
			{
				$kurs[] = $item['value'];
			}
			if(trim($item['name'],'[]') == 'poziom')
			{
				$poziom[] = $item['value'];
			}
			if(trim($item['name'],'[]') == 'rok')
			{
				$rok[] = $item['value'];
			}
		}

		if(!empty($kurs))
		{
			$tax_query[] = array(
				'taxonomy' => 'kurs',
				'field' => 'slug',
				'terms' => $kurs
			);
		}
		if(!empty($poziom))
		{
			$tax_query[] = array(
				'taxonomy' => 'poziom',
				'field' => 'slug',
				'terms' => $poziom
			);
		}
		if(!empty($rok))
		{
			$tax_query[] = array(
				'taxonomy' => 'rok',
				'field' => 'slug',
				'terms' => $rok
			);
		}
	}

	if(!empty($tax_query))
	{
		$comments_arg = array (
			'post_type' => 'komentarz',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'tax_query' => [
				'relation' => 'AND',
				$tax_query
			]
		);
	}

	$comments_arg = new WP_Query($comments_arg);
	if($comments_arg -> have_posts())
	{
		while($comments_arg -> have_posts()): $comments_arg -> the_post();
		echo '<div style="padding-bottom:35px;"><p style="font-size:22px;text-transform:uppercase;" class="text-center"><strong>'.get_the_title().'</strong></p>';
		$value = apply_filters('orphan_replace', get_the_content());
		echo apply_filters('the_content', $value);
		echo '</div>';
		endwhile; wp_reset_postdata();
	}
	else
	{
		echo __('Brak komentarzy spełniających podane kryteria.', 'cn');
	}
	die();
}
add_action('wp_ajax_nopriv_ajax_comments', 'ajax_comments');
add_action('wp_ajax_ajax_comments', 'ajax_comments');

function ajax_filter() {
	$tax_query = array();
	$meta_query = array();

	if(isset($_REQUEST['data']))
	{

		$kurs = array();
		$hours = array();
		$poziom = array();
		$dzien = array();
		$rok = array();
		$typ = array();

		foreach($_REQUEST['data'] as $item)
		{
			if(trim($item['name'],'[]') == 'kurs')
			{
				$kurs[] = $item['value'];
			}
			if(trim($item['name'],'[]') == 'poziom')
			{
				$poziom[] = $item['value'];
			}
			if(trim($item['name'],'[]') == 'dzien')
			{
				$dzien[] = $item['value'];
			}
			if(trim($item['name'],'[]') == 'hours')
			{
				$hours[] = $item['value'];
			}
			if(trim($item['name'],'[]') == 'rok')
			{
				$rok[] = $item['value'];
			}
			if(trim($item['name'],'[]') == 'typ')
			{
				$typ[] = $item['value'];
			}
		}

		if(!empty($kurs))
		{
			$tax_query[] = array(
				'taxonomy' => 'kurs',
				'field' => 'slug',
				'terms' => $kurs
			);
		}
		if(!empty($poziom))
		{
			$tax_query[] = array(
				'taxonomy' => 'poziom',
				'field' => 'slug',
				'terms' => $poziom
			);
		}
		if(!empty($dzien))
		{
			$tax_query[] = array(
				'taxonomy' => 'dzien',
				'field' => 'slug',
				'terms' => $dzien
			);
		}
		if(!empty($typ))
		{
			$tax_query[] = array(
				'taxonomy' => 'typ',
				'field' => 'slug',
				'terms' => $typ
			);
		}
		if(!empty($hours))
		{

			$a = false;
			$b = false;
			$c = false;

			foreach($hours as $hour)
			{
				if($hour == '1630_1930')
				{
					$c = true;
				}
				elseif($hour == '9_12')
				{
					$a = true;
				}
				elseif($hour == '1215_1515')
				{
					$b = true;
				}
			}

			if($a && !$b && !$c)
			{
				$meta_query[] = array(
					'type' => 'TIME',
					'key' => 'time_from_subject',
					'compare' => 'BETWEEN',
					'value' => array('9:00', '12:00')
				);
			}
			elseif(!$a && $b && !$c)
			{
				$meta_query[] = array(
					'type' => 'TIME',
					'key' => 'time_from_subject',
					'compare' => 'BETWEEN',
					'value' => array('12:15', '15:15')
				);
			}
			elseif(!$a && !$b && $c)
			{
				$meta_query[] = array(
					'type' => 'TIME',
					'key' => 'time_from_subject',
					'compare' => 'BETWEEN',
					'value' => array('16:30', '19:30')
				);
			}
			elseif($a && $b && !$c)
			{
				$meta_query[] = array(
					'type' => 'TIME',
					'key' => 'time_from_subject',
					'compare' => 'BETWEEN',
					'value' => array('9:00', '15:15')
				);
			}
			elseif(!$a && $b && $c)
			{
				$meta_query[] = array(
					'type' => 'TIME',
					'key' => 'time_from_subject',
					'compare' => 'BETWEEN',
					'value' => array('12:15', '19:30')
				);
			}
			elseif($a && !$b && $c)
			{
				$meta_query[] = array(
					'type' => 'TIME',
					'key' => 'time_from_subject',
					'compare' => 'NOT BETWEEN',
					'value' => array('12:15', '15:15')
				);
			}
			else {
				$meta_query[] = array(
					'type' => 'TIME',
					'compare' => 'NOT BETWEEN',
					'value' => array('9:00', '19:30')
				);
			}

		}
		if(!empty($rok))
		{
			$tax_query[] = array(
				'taxonomy' => 'rok',
				'field' => 'slug',
				'terms' => $rok
			);
		}
	}

	if(!empty($tax_query))
	{
		$subject_filter = array (
			'post_type' => 'kurs',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'tax_query' => [
				'relation' => 'AND',
				$tax_query
			],
			'meta_query' => [
				$meta_query
			]
		);
	}
	else
	{
		$subject_filter = array (
			'post_type' => 'kurs',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'meta_query' => [
				$meta_query
			]
		);
	}

	$subject_filter = new WP_Query($subject_filter);
	if($subject_filter -> have_posts())
	{
		while($subject_filter -> have_posts()): $subject_filter -> the_post();
		?>
		<div class="col">
			<?php echo get_template_part('template-part/subject', 'slider'); ?>
		</div>
		<?php
		endwhile; wp_reset_postdata();
	}
	else
	{
		echo __('Brak kursów spełniających podane kryteria.', 'cn');
	}
	die();
}
add_action('wp_ajax_nopriv_ajax_filter', 'ajax_filter');
add_action('wp_ajax_ajax_filter', 'ajax_filter');

function ajax_cart() {
	cart_content();
	die();
}
add_action('wp_ajax_nopriv_ajax_cart', 'ajax_cart');
add_action('wp_ajax_ajax_cart', 'ajax_cart');

function ajax_send_cart() {
	send_cart();
	die();
}
add_action('wp_ajax_nopriv_ajax_send_cart', 'ajax_send_cart');
add_action('wp_ajax_ajax_send_cart', 'ajax_send_cart');

function cart_content()
{
	$get_user_favorites = null;
	$subject_cart = array();
	$payment_option = null;
	$extra_subject_check = array();
	$extra_video_checked = array();

	$request = $_REQUEST;

	$check_group = false;
	$check_sibling = false;
	$count_year = 0;

	$name = null;
	$street = null;
	$email = null;
	$repeat_email = null;
	$school = null;
	$city = null;
	$zipcode = null;
	$street_number = null;
	$flat_number = null;
	$phone = null;
	$baccalaureate = null;
	$comments_notification = null;
	$name_participants_group = null;
	$name_participants_group_2 = null;
	$name_participants_group_3 = null;
	$name_participants_group_4 = null;
	$name_participants_group_5 = null;
	$name_sibling = null;

	if(isset($request['data'][0]))
	{
		foreach($request['data'] as $item_r)
		{
			if(isset($item_r['name']) && isset($item_r['value']))
			{
				if($item_r['name'] == 'payment_option')
				{
					$payment_option = $item_r['value'];
				}

				if($item_r['name'] == 'extra-subject[]')
				{
					if($item_r['value'] != __('Nie wybieram żadnego warsztatu', 'cn'))
					{
						$extra_subject_check[] = $item_r['value'];
					}
				}

				if($item_r['name'] == 'check_group')
				{
					$check_group = true;
				}
				
				if($item_r['name'] == 'name_participants_group')
				{
					$name_participants_group = $item_r['value'];
				}
				
				if($item_r['name'] == 'name_participants_group_2')
				{
					$name_participants_group_2 = $item_r['value'];
				}
				
				if($item_r['name'] == 'name_participants_group_3')
				{
					$name_participants_group_3 = $item_r['value'];
				}
				
				if($item_r['name'] == 'name_participants_group_4')
				{
					$name_participants_group_4 = $item_r['value'];
				}
				
				if($item_r['name'] == 'name_participants_group_5')
				{
					$name_participants_group_5 = $item_r['value'];
				}

				if($item_r['name'] == 'check_sibling')
				{
					$check_sibling = true;
				}
				
				if($item_r['name'] == 'name_sibling')
				{
					$name_sibling = $item_r['value'];
				}

				if($item_r['name'] == 'count_year')
				{
					$count_year = $item_r['value'];
				}

				$words = preg_replace('/[0-9]+/', '', $item_r['name']);
				if($words == 'extra_video_')
				{
					$extra_video_checked[] = $item_r['value'];
				}

				if($item_r['name'] == 'name')
				{
					$name = $item_r['value'];
				}

				if($item_r['name'] == 'street')
				{
					$street = $item_r['value'];
				}

				if($item_r['name'] == 'city')
				{
					$city = $item_r['value'];
				}

				if($item_r['name'] == 'flat_number')
				{
					$flat_number = $item_r['value'];
				}

				if($item_r['name'] == 'street_number')
				{
					$street_number = $item_r['value'];
				}

				if($item_r['name'] == 'zipcode')
				{
					$zipcode = $item_r['value'];
				}

				if($item_r['name'] == 'email')
				{
					$email = $item_r['value'];
				}
				
				if($item_r['name'] == 'repeat_email')
				{
					$repeat_email = $item_r['value'];
				}

				if($item_r['name'] == 'phone')
				{
					$phone = $item_r['value'];
				}

				if($item_r['name'] == 'school')
				{
					$school = $item_r['value'];
				}

				if($item_r['name'] == 'baccalaureate')
				{
					$baccalaureate = $item_r['value'];
				}
				
				if($item_r['name'] == 'comments_notification')
				{
					$comments_notification = $item_r['value'];
				}

			}
		}
	}

	if(class_exists("Favorites"))
	{
		$get_user_favorites = get_user_favorites();
	}
	if(is_array($get_user_favorites) && !empty($get_user_favorites))
	{
		$subject_cart = array (
			'post_type' => 'kurs',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post__in' => $get_user_favorites,
			'tax_query' => [
				'relation' => 'AND',
				[
					'taxonomy' => 'status',
					'operator' => 'EXISTS',
				],
				[
					'taxonomy' => 'status',
					'field' => 'slug',
					'terms' => 'brak-miejsc',
					'operator' => 'NOT IN',
				]
			],
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => 'total_price_subject',
					'compare' => 'EXIST'
				]
			]
		);
	}
	$subject_cart = new WP_Query($subject_cart);
	if($subject_cart -> have_posts()):
	$subject_price_cart_array = array();
	$count_cart = $subject_cart->found_posts;
	$discounts_date = rwmb_meta('discounts_date', ['object_type' => 'setting'], 'cn_settings');
	$discounts_date_title = rwmb_meta('discounts_date_title', ['object_type' => 'setting'], 'cn_settings');
	$discounts_number = rwmb_meta('discounts_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_all_number = rwmb_meta('discounts_all_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_two_number = rwmb_meta('discounts_two_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_many_number = rwmb_meta('discounts_many_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_group_number = rwmb_meta('discounts_group_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_group_count_number = rwmb_meta('discounts_group_count_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_sibling_number = rwmb_meta('discounts_sibling_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_year_number = rwmb_meta('discounts_year_number', ['object_type' => 'setting'], 'cn_settings');
	$extra_video_subject = rwmb_meta('extra_video_subject', ['object_type' => 'setting'], 'cn_settings');
	$extra_subject = rwmb_meta('extra_subject', ['object_type' => 'setting'], 'cn_settings');
	?>
	<form id="cart-form">
		<div class="cart-bar-top">
			<div class="container">
				<div class="cart-icon">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100"> <g> <path d="M38.25,92.54c-4.44,0-8.05-3.61-8.05-8.05s3.61-8.05,8.05-8.05h0c2.15,0,4.16.84,5.69,2.35,1.52,1.52,2.36,3.54,2.36,5.69h0c0,4.45-3.61,8.06-8.05,8.06ZM38.26,82.81h0c-.93,0-1.68.76-1.68,1.68s.75,1.68,1.68,1.68,1.68-.75,1.68-1.68c0-.45-.18-.88-.5-1.19s-.74-.49-1.18-.49Z"/> <path d="M74.54,92.54c-4.44,0-8.05-3.61-8.05-8.05s3.61-8.05,8.04-8.05h0c2.15,0,4.16.84,5.69,2.35,1.52,1.52,2.36,3.54,2.36,5.69h0c0,4.45-3.61,8.06-8.05,8.06ZM74.54,82.81h0c-.93,0-1.68.76-1.68,1.68s.75,1.68,1.68,1.68,1.68-.75,1.68-1.68c0-.45-.18-.88-.5-1.19s-.74-.49-1.18-.49Z"/> <path d="M40.27,72.51c-5.15,0-9.65-3.68-10.66-8.83l-5.48-27.36c-.02-.08-.03-.16-.05-.24l-2.55-12.74h-9.5c-2.43,0-4.4-1.97-4.4-4.4s1.97-4.4,4.4-4.4h13.11c2.1,0,3.9,1.48,4.31,3.53l2.57,12.85h52.11c1.31,0,2.56.58,3.39,1.6.83,1.01,1.18,2.34.93,3.63l-5.24,27.5c-1.04,5.25-5.69,8.89-10.96,8.86h-31.77c-.07,0-.14,0-.21,0ZM33.79,39.73l4.45,22.23c.21,1.04,1.14,1.77,2.16,1.75h31.94c1.06.01,2.04-.71,2.24-1.74l4.24-22.24h-45.03Z"/> </g> </svg>
				</div>
			</div>
		</div>
		<div class="cart-content">
			<div class="container">
				<div class="step-cart">
					<p class="step-cart-name text-center"><?php echo __('WYBRANE KURSY', 'cn'); ?></p>
					<div class="step-cart-box">
						<div class="grid-3_lg-2_sm-1-center">
							<?php
								while($subject_cart -> have_posts()): $subject_cart -> the_post();
								$id_subject = get_the_ID();
								$total_price_subject = rwmb_meta('total_price_subject', '', $id_subject);
								$extra_course_video = rwmb_meta('extra_course_video', '', $id_subject);
								$subject_price_cart_array[] = $total_price_subject;
							?>
							<div class="col col-cart-subject">
								<div class="step-cart-box-item">
									<?php echo get_template_part('template-part/subject', 'slider'); ?>
								</div>
								<?php if(!empty($extra_video_subject) && !$extra_course_video): ?>
								<div class="step-cart-box-item step-cart-box-item-extra">
									<label for="extra_video_<?php echo $id_subject; ?>">
										<input type="radio" id="extra_video_<?php echo $id_subject; ?>" class="extra-video-input<?php if(in_array($id_subject, $extra_video_checked)): ?> active-radio<?php endif; ?>" name="extra_video_<?php echo $id_subject; ?>" value="<?php echo $id_subject; ?>"<?php if(in_array($id_subject, $extra_video_checked)): ?> checked<?php endif; ?>>
										<p class="step-cart-box-item-extra-name"><?php echo __('KOMPLET NAGRAŃ <br/>40 GODZIN WYKŁADÓW', 'cn'); ?></p>
										<p><?php echo __('Materiały dodatkowe', 'cn'); ?><br/><strong><?php echo sprintf(__('cena %s złotych', 'cn'), $extra_video_subject); ?></strong></p>
									</label>
								</div>
								<?php endif; ?>
							</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="cart-content">
			<div class="step-cart-name-content">
				<div class="container">
					<p class="step-cart-name text-center"><?php echo __('FORMA PŁATNOŚCI', 'cn'); ?></p>
				</div>
			</div>
			<div class="container">
				<div class="step-cart">
					<div class="cart-payment-options">
						<div class="grid-3_md-2_xs-1-middle">
							<div class="col-bottom text-center">
								<label for="payment_all">
									<span><?php echo __('zapłacę w całości', 'cn'); ?></span>
									<input type="radio" id="payment_all" name="payment_option" value="all"<?php if($payment_option == 'all' || $payment_option == null): ?> checked<?php endif; ?>>
								</label>
							</div>
							<div class="col text-center">
								<label style="color:var(--default)">
									<?php echo __('zapłacę w ratach', 'cn'); ?>
									<span style="font-size:12px;line-height:17px;min-height:auto;"><?php echo __('wybierz ilość rat', 'cn'); ?></span>
								</label>
								<ul class="cart-payment-options-list">
									<li>
										<label for="payment_installment_2">
											<span><?php echo __('2', 'cn'); ?></span>
											<input type="radio" id="payment_installment_2" name="payment_option" value="2"<?php if($payment_option == 2): ?> checked<?php endif; ?>>
										</label>
									</li>
									<li>
										<label for="payment_installment_3">
											<span><?php echo __('3', 'cn'); ?></span>
											<input type="radio" id="payment_installment_3" name="payment_option" value="3"<?php if($payment_option == 3): ?> checked<?php endif; ?>>
										</label>
									</li>
									<?php if($count_cart > 1): ?>
									<li>
										<label for="payment_installment_4">
											<span><?php echo __('4', 'cn'); ?></span>
											<input type="radio" id="payment_installment_4" name="payment_option" value="4"<?php if($payment_option == 4): ?> checked<?php endif; ?>>
										</label>
									</li>
									<?php
										endif;
										if($count_cart > 2):
									?>
									<li>
										<label for="payment_installment_5">
											<span><?php echo __('5', 'cn'); ?></span>
											<input type="radio" id="payment_installment_5" name="payment_option" value="5"<?php if($payment_option == 5): ?> checked<?php endif; ?>>
										</label>
									</li>
									<?php endif; ?>
								</ul>
							</div>
							<div class="col-bottom text-center">
								<label for="payment_other">
									<span><?php echo __('inna płatność<br/>uzgodniona z biurem', 'cn'); ?></span>
									<input type="radio" id="payment_other" name="payment_option" value="other"<?php if($payment_option == 'other'): ?> checked<?php endif; ?>>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="cart-content">
			<div class="step-cart-name-content">
				<div class="container">
					<p class="step-cart-name text-center"><?php echo __('INFORMACJE DODATKOWE', 'cn'); ?></p>
				</div>
			</div>
			<div class="container">
				<div class="step-cart">
					<div class="cart-payment-options">
						<div class="grid-3_md-2_xs-1-center">
							<?php if(is_numeric($discounts_group_number) && is_numeric($discounts_group_count_number)): ?>
							<div class="col text-center">
								<label for="count_participants">
									<span><?php echo __('Czy zapisujesz się<br/>ze znajomymi<br/> (min. 4 os.)?', 'cn'); ?></span>
									<input type="radio" id="check_group" name="check_group" value="1"<?php if($check_group): ?> class="active-radio" checked<?php endif; ?>>
								</label>
							</div>
							<?php
								endif;
								if(is_numeric($discounts_sibling_number)):
							?>
							<div class="col text-center">
								<label for="count_participants">
									<span><?php echo __('Czy Twoje rodzeństwo uczęszcza/uczęszczało na zajęcia w Collegium Novum? Zniżkę naliczamy też za poprzednie lata.', 'cn'); ?></span>
									<input type="radio" id="check_sibling" name="check_sibling" value="1"<?php if($check_sibling): ?> class="active-radio" checked<?php endif; ?>>
								</label>
							</div>
							<?php
								endif;
							?>
							<div class="col text-center">
								<label for="count_year">
									<span><?php echo __('Liczba przedmiotów na które<br/>uczęszczałeś/aś w roku ubiegłym', 'cn'); ?></span>
									<select name="count_year" id="count_year" style="width:90px;margin:17px auto 0 auto;" required>
										<option value="0"<?php if($count_year == 0): ?> selected<?php endif; ?>>0</option>
										<option value="1"<?php if($count_year == 1): ?> selected<?php endif; ?>>1</option>
										<option value="2"<?php if($count_year == 2): ?> selected<?php endif; ?>>2</option>
										<option value="3"<?php if($count_year == 3): ?> selected<?php endif; ?>>3</option>
										<option value="4"<?php if($count_year == 4): ?> selected<?php endif; ?>>4</option>
										<option value="5"<?php if($count_year == 5): ?> selected<?php endif; ?>>5</option>
									</select>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if($check_group): ?>
		<div class="cart-content">
			<div class="step-cart-name-content">
				<div class="container">
					<p class="step-cart-name text-center"><?php echo __('WPISZ IMIONA I NAZWISKA OSÓB KTÓRE BĘDĄ <br/>UCZĘSZCZAĆ Z TOBĄ NA ZAJĘCIA W GRUPIE', 'cn'); ?></p>
				</div>
			</div>
			<div class="container">
				<div class="step-cart">
					<div class="cart-discounts" style="padding-top:30px">
						<div class="grid-2_md-1-center">
							<div class="col">
								<p><input type="text" id="name_participants_group" value="<?php echo $name_participants_group; ?>" name="name_participants_group" style="text-align:left;" placeholder="<?php echo __('Imię i nazwisko', 'cn'); ?>" minlength="6" required></p>
								<p><input type="text" id="name_participants_group_2" value="<?php echo $name_participants_group_2; ?>" name="name_participants_group_2" style="text-align:left;" placeholder="<?php echo __('Imię i nazwisko', 'cn'); ?>" minlength="6" required></p>
								<p><input type="text" id="name_participants_group_3" value="<?php echo $name_participants_group_3; ?>" name="name_participants_group_3" style="text-align:left;" placeholder="<?php echo __('Imię i nazwisko', 'cn'); ?>" minlength="6" required></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			endif;
			if($check_sibling):
		?>
		<div class="cart-content">
			<div class="step-cart-name-content">
				<div class="container">
					<p class="step-cart-name text-center"><?php echo __('WPISZ IMIONA I NAZWISKA SWOJEGO RODZEŃSTWA', 'cn'); ?></p>
				</div>
			</div>
			<div class="container">
				<div class="step-cart">
					<div class="cart-discounts" style="padding-top:30px">
						<div class="grid-2_md-1-center">
							<div class="col">
								<textarea id="name_sibling" name="name_sibling" style="text-align:left;height:130px" required><?php echo $name_sibling; ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			endif;
		?>
		<div class="cart-content">
			<div class="step-cart-name-content">
				<div class="container">
					<p class="step-cart-name text-center"><?php echo __('ZNIŻKI', 'cn'); ?></p>
				</div>
			</div>
			<div class="container">
				<div class="step-cart">
					<div class="cart-discounts">
						<?php
							if(!empty($discounts_date) && is_numeric($discounts_number)):
							$discounts_date_strtotime = strtotime($discounts_date);
							$today_date = strtotime(date('Y-m-d'));
						?>
						<div class="cart-discounts-step<?php if($discounts_date_strtotime >= $today_date): ?> active<?php endif; ?>">
							<div class="cart-discounts-step-number">
								-<?php echo $discounts_number; ?>%
							</div>
							<div class="cart-discounts-step-radio">
								<input type="radio" id="discounts_date" name="discounts_date" value="1"<?php if($discounts_date_strtotime >= $today_date): ?> checked<?php endif; ?>>
							</div>
							<div class="cart-discounts-step-text">
								<?php if(!empty($discounts_date_title)): ?>
								<p class="cart-discounts-step-name"><?php echo $discounts_date_title; ?></p>
								<?php endif; ?>
								<p><?php echo sprintf(__('OFERTA WAŻNA TYLKO DO %s LUB WYCZERPANIA MIEJSC W GRUPACH', 'cn'),wp_date("d F Y", strtotime($discounts_date))); ?></p>
							</div>
						</div>
						<?php
							endif;
							if(is_numeric($discounts_all_number)):
						?>
						<div class="cart-discounts-step<?php if($payment_option == 'all' || $payment_option == null): ?> active<?php endif; ?>">
							<div class="cart-discounts-step-number">
								-<?php echo $discounts_all_number; ?>%
							</div>
							<div class="cart-discounts-step-radio">
								<input type="radio" id="discounts_all_payment" name="discounts_all_payment" value="1" <?php if($payment_option == 'all' || $payment_option == null): ?> checked<?php endif; ?>>
							</div>
							<div class="cart-discounts-step-text">
								<p class="cart-discounts-step-name"><?php echo __('ZA PŁATNOŚĆ JEDNORAZOWĄ W CAŁOŚCI', 'cn'); ?></p>
							</div>
						</div>
						<?php endif; if(is_numeric($discounts_two_number)): ?>
						<div class="cart-discounts-step<?php if($count_cart > 1): ?> active<?php endif; ?>">
							<div class="cart-discounts-step-number">
								-<?php echo $discounts_two_number; ?>%
							</div>
							<div class="cart-discounts-step-radio">
								<input type="radio" id="discounts_two_payment" name="discounts_two_payment" value="1"<?php if($count_cart > 1): ?> checked<?php endif; ?>>
							</div>
							<div class="cart-discounts-step-text">
								<p class="cart-discounts-step-name"><?php echo __('DRUGI PRZEDMIOT KURSU', 'cn'); ?></p>
							</div>
						</div>
						<?php endif; if(is_numeric($discounts_many_number)): ?>
						<div class="cart-discounts-step<?php if($count_cart > 2): ?> active<?php endif; ?>">
							<div class="cart-discounts-step-number">
								-<?php echo $discounts_many_number; ?>%
							</div>
							<div class="cart-discounts-step-radio">
								<input type="radio" id="discounts_many_payment" name="discounts_many_payment" value="1"<?php if($count_cart > 2): ?> checked<?php endif; ?>>
							</div>
							<div class="cart-discounts-step-text">
								<p class="cart-discounts-step-name"><?php echo __('TRZECI I KAŻDY NASTĘPNY PRZEDMIOT KURSU', 'cn'); ?></p>
							</div>
						</div>
						<?php endif; if(is_numeric($discounts_year_number)): ?>
						<div class="cart-discounts-step<?php if($count_year > 0): ?> active<?php endif; ?>">
							<div class="cart-discounts-step-number">
								-<?php echo $discounts_year_number; ?>%
							</div>
							<div class="cart-discounts-step-radio">
								<input type="radio" id="discounts_year_number" name="discounts_year_number" value="1"<?php if($count_year > 0): ?> checked<?php endif; ?>>
							</div>
							<div class="cart-discounts-step-text">
								<p class="cart-discounts-step-name"><?php echo __('KONTYNUACJA NAUKI W CN <br/>(TYLE PRZEDMIOTÓW ILE BYŁO W ROKU UBIEGŁYM)', 'cn'); ?></p>
							</div>
						</div>
						<?php endif; if(is_numeric($discounts_group_number) && is_numeric($discounts_group_count_number)): ?>
						<div class="cart-discounts-step<?php if($check_group): ?> active<?php endif; ?>">
							<div class="cart-discounts-step-number">
								-<?php echo $discounts_group_number; ?>%
							</div>
							<div class="cart-discounts-step-radio">
								<input type="radio" id="discounts_group_number" name="discounts_group_number" value="1"<?php if($check_group): ?> checked<?php endif; ?>>
							</div>
							<div class="cart-discounts-step-text">
								<p class="cart-discounts-step-name"><?php echo sprintf(__('ZNIŻKA DLA ZNAJOMYCH <br/>(PRZY ZAPISIE POWYŻEJ %s OSÓB)', 'cn'), $discounts_group_count_number); ?></p>
							</div>
						</div>
						<?php endif; if(is_numeric($discounts_sibling_number)): ?>
						<div class="cart-discounts-step<?php if($check_sibling): ?> active<?php endif; ?>">
							<div class="cart-discounts-step-number">
								-<?php echo $discounts_sibling_number; ?>%
							</div>
							<div class="cart-discounts-step-radio">
								<input type="radio" id="discounts_sibling_number" name="discounts_sibling_number" value="1"<?php if($check_sibling): ?> checked<?php endif; ?>>
							</div>
							<div class="cart-discounts-step-text">
								<p class="cart-discounts-step-name"><?php echo __('RODZEŃSTWO BIORĄCE UDZIAŁ W KURSACH <BR>(ROK BIEŻĄCY LUB POPRZEDNIE LATA)', 'cn'); ?></p>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="cart-content">
			<div class="step-cart-name-content">
				<div class="container">
					<p class="step-cart-name text-center"><?php echo __('CENA', 'cn'); ?></p>
				</div>
			</div>
			<div class="container">
				<div class="step-cart">
					<?php $total_price = get_total_price($subject_price_cart_array, $extra_video_checked, $payment_option, $check_group, $check_sibling, $count_year); ?>
					<div class="step-cart-price">
						<?php
							$count_installment = 1;
							if($payment_option == 2)
							{
								$count_installment = 2;
							}
							elseif($payment_option == 3)
							{
								$count_installment = 3;
							}
							elseif($payment_option == 4)
							{
								$count_installment = 4;
							}
							elseif($payment_option == 5)
							{
								$count_installment = 5;
							}
							$get_installment = get_installment($total_price, $count_installment);
							if(!empty($get_installment)):
							foreach($get_installment as $item):
						?>
						<div class="cart-installment">
							<div class="grid-2_xs-1-middle">
								<div class="col text-right">
									<?php echo $item['name']; ?>
								</div>
								<div class="col">
									<span><?php echo $item['price']; ?></span>
									<small><?php echo __('termin do zapłaty', 'cn'); ?>: <?php echo $item['date']; ?></small>
								</div>
							</div>
						</div>
						<?php
							endforeach;
							endif;
						?>
						<div class="cart-total-price">
							<div class="text-center">
								<?php echo __('KWOTA DO ZAPŁATY', 'cn'); ?> <span><?php echo $total_price; ?> zł</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			if(isset($extra_subject[0])):
		?>
		<div class="cart-content">
			<div class="step-cart-name-content">
				<div class="container">
					<p class="step-cart-name text-center"><?php echo __('WARSZTATY PRAKTYCZNYCH UMIEJĘTNOŚCI', 'cn'); ?></p>
				</div>
			</div>
			<div class="container">
				<div class="step-cart">
					<div class="step-cart-extra-subject" style="text-align:center;font-weight:700;">
						<p><?php echo __('Do jednego przedmiotu kursu całorocznego przysługuje Ci jeden bezpłatny warsztat, który wliczony jest w cenę kursu. Zajęcia nie są obowiązkowe. <br/>Jeżeli jesteś zainteresowany wybierz warsztat.', 'cn'); ?></p>
					</div>
					<?php
						$a = 1;
						foreach($extra_subject as $extra):
						if(isset($extra['extra_subject_title']) && isset($extra['extra_subject_text'])):
					?>
					<div class="cart-installment cart-extra-video">
						<label for="extra-subject_<?php echo $a; ?>" style="cursor:pointer;">
							<div class="grid-middle-center-noGutter">
								<div class="col-3_xs-2">
									<input type="checkbox" class="extra-subject-check" id="extra-subject_<?php echo $a; ?>" name="extra-subject[]" style="display:block;margin-left:auto;" value="<?php echo $extra['extra_subject_title']; ?>"<?php if(in_array($extra['extra_subject_title'], $extra_subject_check)): ?> checked<?php endif; ?>>
								</div>
								<div class="col-6_md-9_xs-10">
									<p style="margin-bottom:0"><?php echo $extra['extra_subject_title']; ?><br/><?php echo $extra['extra_subject_text']; ?></p>
								</div>
							</div>
						</label>
					</div>
					<?php
						$a++;
						endif;
						endforeach;
					?>
					<div class="cart-installment cart-extra-video">
						<label for="extra-subject_<?php echo $a; ?>" style="cursor:pointer;">
							<div class="grid-middle-center-noGutter">
								<div class="col-3_xs-2">
									<input type="checkbox" class="extra-subject-none" id="extra-subject_<?php echo $a; ?>" name="extra-subject[]" style="display:block;margin-left:auto;" value="<?php echo __('Nie wybieram żadnego warsztatu', 'cn'); ?>"<?php if(in_array(__('Nie wybieram żadnego warsztatu', 'cn'), $extra_subject_check) || empty($extra_subject_check)): ?> checked<?php endif; ?>>
								</div>
								<div class="col-6_md-9_xs-10">
									<p style="margin-bottom:0"><?php echo __('Nie wybieram żadnego warsztatu', 'cn'); ?></p>
								</div>
							</div>
						</label>
					</div>
				</div>
			</div>
		</div>
		<?php
			endif;
		?>
		<div class="cart-content">
			<div class="step-cart-name-content">
				<div class="container">
					<p class="step-cart-name text-center"><?php echo __('DANE OSOBOWE', 'cn'); ?></p>
				</div>
			</div>
			<div class="container">
				<div class="step-cart">
					<div class="step-cart-input">
						<div class="grid-2_sm-1 grid-medium">
							<div class="col">
								<p>
									<input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="<?php echo __('imię i nazwisko', 'cn'); ?>" required>
								</p>
								<p>
									<input type="text" id="street" name="street" value="<?php echo $street; ?>" placeholder="<?php echo __('ulica', 'cn'); ?>" required>
								</p>
								<p>
									<input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo __('e-mail', 'cn'); ?>" required>
								</p>
								<p>
									<input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="<?php echo __('telefon', 'cn'); ?>" required>
								</p>
							</div>
							<div class="col">
								<div class="grid grid-small">
									<div class="col-8">
										<p>
											<input type="text" id="city" name="city" value="<?php echo $city; ?>" placeholder="<?php echo __('miejscowość', 'cn'); ?>" required>
										</p>
									</div>
									<div class="col-4">
										<p>
											<input type="text" id="zipcode" name="zipcode" value="<?php echo $zipcode; ?>" placeholder="<?php echo __('kod pocztowy', 'cn'); ?>" required>
										</p>
									</div>
								</div>
								<div class="grid-2 grid-small">
									<div class="col">
										<p>
											<input type="text" id="street_number" name="street_number" value="<?php echo $street_number; ?>" placeholder="<?php echo __('numer domu', 'cn'); ?>" required>
										</p>
									</div>
									<div class="col">
										<p>
											<input type="text" id="flat_number" name="flat_number" value="<?php echo $flat_number; ?>" placeholder="<?php echo __('numer mieszkania', 'cn'); ?>">
										</p>
									</div>
								</div>
								<p>
									<input type="email" id="repeat_email" name="repeat_email" value="<?php echo $repeat_email; ?>" placeholder="<?php echo __('powtórz e-mail', 'cn'); ?>" required>
								</p>
								<p>
									<input type="number" id="baccalaureate" value="<?php echo $baccalaureate; ?>" name="baccalaureate" min="<?php echo date('Y'); ?>" max="<?php echo date('Y', strtotime('+800 days')); ?>" placeholder="<?php echo __('rok matury', 'cn'); ?>" required>
								</p>
							</div>
						</div>
						<p>
							<input type="text" id="school" name="school" value="<?php echo $school; ?>" placeholder="<?php echo __('Twoja szkoła', 'cn'); ?>" required>
						</p>
						<p>
							<textarea style="height:110px;" type="text" id="comments_notification" name="comments_notification" placeholder="<?php echo __('Uwagi', 'cn'); ?>"><?php echo $comments_notification; ?></textarea>
						</p>
						<p class="term">
							<label for="term_all">
								<input type="checkbox" id="term_all" name="term_all" required>
								<span><?php echo __('Zaznacz wszystkie', 'cn'); ?></span>
							</label>
						</p>
						<p class="term">
							<label for="term_1">
								<input type="checkbox" id="term_1" name="term_1" required>
								<span><?php echo __('* Akceptuję regulamin kursu (regulamin dostępny także w naszym biurze).', 'cn'); ?> <a target="_blank" href="<?php echo get_url_for_slug('regulamin'); ?>"><?php echo __('Przeczytaj regulamin.'); ?></a></span>
							</label>
						</p>
						<p class="term">
							<label for="term_2">
								<input type="checkbox" id="term_2" name="term_2" required>
								<span><?php echo __('* Wyrażam zgodę na przetwarzanie podanych przeze mnie w formularzu danych osobowych w celu realizacji zajęć przez Collegium Novum Sp. z o.o.', 'cn'); ?></span>
							</label>
						</p>
						<p class="term">
							<label for="term_3">
								<input type="checkbox" id="term_3" name="term_3" required>
								<span><?php echo __('* Wyrażam zgodę na używanie wykorzystywanej przeze mnie poczty elektronicznej przez Collegium Novum Sp. z o.o. dla celów realizacji zajęć za pomocą podanego w formularzu adresu mailowego.', 'cn'); ?></span>
							</label>
						</p>
						<p class="term">
							<label for="term_4">
								<input type="checkbox" id="term_4" name="term_4" required>
								<span><?php echo __('* Wyrażam zgodę na używanie wykorzystywanych przeze mnie telekomunikacyjnych urządzeń końcowych przez Collegium Novum Sp. z o.o. dla celów realizacji zajęć za pomocą podanego w formularzu numeru telefonu.<br/><br/>Administratorem danych osobowych zawartych w formularzu jest Collegium Novum Sp. z o.o. z siedzibą pod adresem: ul. Solec 81 B/a-51, 00-382 Warszawa, tel.: 505 777 200, e-mail: info@collegiumnovum.pl. Dane będą przetwarzane do podjęcia działań na żądanie osoby, której dane dotyczą, przed zawarciem umowy oraz do celów wynikających z prawnie uzasadnionego interesu realizowanego przez administratora danych, a mianowicie marketingu bezpośredniego. Dane będą przetwarzane do czasu zrealizowania lub zaprzestania realizowania ww. celów. Osobie, której dane dotyczą przysługuje prawo do żądania dostępu do danych, które jej dotyczą, jak również do ich sprostowania, usunięcia lub ograniczenia przetwarzania, a w zakresie przetwarzania do celów marketingu bezpośredniego również prawo do sprzeciwu wobec przetwarzania. Osoba, której dane dotyczą może wnieść skargę do Prezesa Urzędu Ochrony Danych Osobowych. Podanie powyższych danych jest dobrowolne, lecz niepodanie ich będzie skutkowało niemożnością realizacji celów, o których mowa powyżej.', 'cn'); ?></span>
							</label>
						</p>
						<button type="submit" class="button-send-cart" name="send_cart"><span><?php echo __('Wyślij zgłoszenie', 'cn'); ?></span></button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<?php else: ?>
	<div class="cart-bar-top">
		<div class="container">
			<div class="cart-icon">
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100"> <g> <path d="M38.25,92.54c-4.44,0-8.05-3.61-8.05-8.05s3.61-8.05,8.05-8.05h0c2.15,0,4.16.84,5.69,2.35,1.52,1.52,2.36,3.54,2.36,5.69h0c0,4.45-3.61,8.06-8.05,8.06ZM38.26,82.81h0c-.93,0-1.68.76-1.68,1.68s.75,1.68,1.68,1.68,1.68-.75,1.68-1.68c0-.45-.18-.88-.5-1.19s-.74-.49-1.18-.49Z"/> <path d="M74.54,92.54c-4.44,0-8.05-3.61-8.05-8.05s3.61-8.05,8.04-8.05h0c2.15,0,4.16.84,5.69,2.35,1.52,1.52,2.36,3.54,2.36,5.69h0c0,4.45-3.61,8.06-8.05,8.06ZM74.54,82.81h0c-.93,0-1.68.76-1.68,1.68s.75,1.68,1.68,1.68,1.68-.75,1.68-1.68c0-.45-.18-.88-.5-1.19s-.74-.49-1.18-.49Z"/> <path d="M40.27,72.51c-5.15,0-9.65-3.68-10.66-8.83l-5.48-27.36c-.02-.08-.03-.16-.05-.24l-2.55-12.74h-9.5c-2.43,0-4.4-1.97-4.4-4.4s1.97-4.4,4.4-4.4h13.11c2.1,0,3.9,1.48,4.31,3.53l2.57,12.85h52.11c1.31,0,2.56.58,3.39,1.6.83,1.01,1.18,2.34.93,3.63l-5.24,27.5c-1.04,5.25-5.69,8.89-10.96,8.86h-31.77c-.07,0-.14,0-.21,0ZM33.79,39.73l4.45,22.23c.21,1.04,1.14,1.77,2.16,1.75h31.94c1.06.01,2.04-.71,2.24-1.74l4.24-22.24h-45.03Z"/> </g> </svg>
			</div>
		</div>
	</div>
	<div class="cart-content">
		<div class="container">
			<div class="step-cart">
				<p class="step-cart-name text-center"><?php echo __('Brak dodanych kursów', 'cn'); ?></p>
			</div>
		</div>
	</div>
	<?php
		endif;
}

function send_cart() {

	$request = $_REQUEST;

	if(isset($request['data']))
	{
		$extra_video_checked = array();
		$payment_option = null;
		$extra_subject = array();
		$check_group = false;
		$name_participants_group = null;
		$name_participants_group_2 = null;
		$name_participants_group_3 = null;
		$name_participants_group_4 = null;
		$name_participants_group_5 = null;
		$text_group = 'NIE';
		$check_sibling = false;
		$name_sibling = null;
		$text_sibling = 'NIE';
		$count_year = 0;
		$name = null;
		$street = null;
		$email = null;
		$school = null;
		$city = null;
		$zipcode = null;
		$street_number = null;
		$flat_number = null;
		$phone = null;
		$baccalaureate = null;
		$term = array();
		$content_email = null;
		$comments_notification = 'Brak';

		foreach($request['data'] as $item)
		{
			if(isset($item['name']) && isset($item['value']))
			{
				if($item['name'] == 'payment_option')
				{
					$payment_option = $item['value'];
				}
				if($item['name'] == 'extra-subject[]')
				{
					if($item['value'] != __('Nie wybieram żadnego warsztatu', 'cn'))
					{
						$extra_subject[] = $item['value'];
					}
					else
					{
						$extra_subject[] = __('Nie wybieram żadnego warsztatu', 'cn');
					}
				}
				if($item['name'] == 'check_group')
				{
					$check_group = true;
					$text_group = 'TAK';
				}
				if($item['name'] == 'name_participants_group')
				{
					$name_participants_group = $item['value'];
				}
				if($item['name'] == 'name_participants_group_2')
				{
					$name_participants_group_2 = $item['value'];
				}
				if($item['name'] == 'name_participants_group_3')
				{
					$name_participants_group_3 = $item['value'];
				}
				if($item['name'] == 'name_participants_group_4')
				{
					$name_participants_group_4 = $item['value'];
				}
				if($item['name'] == 'name_participants_group_5')
				{
					$name_participants_group_5 = $item['value'];
				}
				if($item['name'] == 'check_sibling')
				{
					$check_sibling = true;
					$text_sibling = 'TAK';
				}
				if($item['name'] == 'name_sibling')
				{
					$name_sibling = $item['value'];
				}
				if($item['name'] == 'count_year')
				{
					if(is_numeric($item['value']))
					{
						$count_year = $item['value'];
					}
				}
				if($item['name'] == 'name')
				{
					$name = $item['value'];
				}
				if($item['name'] == 'street')
				{
					$street = $item['value'];
				}
				if($item['name'] == 'street_number')
				{
					$street_number = $item['value'];
				}
				if($item['name'] == 'flat_number')
				{
					$flat_number = $item['value'];
				}
				if($item['name'] == 'city')
				{
					$city = $item['value'];
				}
				if($item['name'] == 'zipcode')
				{
					$zipcode = $item['value'];
				}
				if($item['name'] == 'email')
				{
					if(filter_var($item['value'], FILTER_VALIDATE_EMAIL))
					{
						$email = $item['value'];
					}
				}
				if($item['name'] == 'phone')
				{
					$phone = $item['value'];
				}
				if($item['name'] == 'school')
				{
					$school = $item['value'];
				}
				if($item['name'] == 'baccalaureate')
				{
					if(is_numeric($item['value']))
					{
						$baccalaureate = $item['value'];
					}
				}
				if($item['name'] == 'comments_notification')
				{
					$comments_notification = $item['value'];
				}
				if($item['name'] == 'term_1' || $item['name'] == 'term_2' || $item['name'] == 'term_3' || $item['name'] == 'term_4')
				{
					$term[] = $item['value'];
				}
				$words = preg_replace('/[0-9]+/', '', $item['name']);
				if($words == 'extra_video_')
				{
					$extra_video_checked[] = $item['value'];
				}

			}
		}

		if(!empty($name) && !empty($email) && !empty($street) && !empty($street_number) && !empty($phone) && !empty($city) && !empty($zipcode) && !empty($extra_subject) && !empty($school) && !empty($baccalaureate) && $count_year >= 0 && count($term) == 4 && ($payment_option == 'all' || $payment_option == 'other' || $payment_option == 2 || $payment_option == 3 || $payment_option == 4 || $payment_option == 5))
		{
			$subject_price_cart_array = array();
			$get_user_favorites = null;
			$subject_cart = null;

			if(class_exists("Favorites"))
			{
				$get_user_favorites = get_user_favorites();
			}

			if(is_array($get_user_favorites) && !empty($get_user_favorites))
			{
				$subject_cart = array (
					'post_type' => 'kurs',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'ignore_sticky_posts' => true,
					'post__in' => $get_user_favorites,
					'tax_query' => [
						'relation' => 'AND',
						[
							'taxonomy' => 'status',
							'operator' => 'EXISTS',
						],
						[
							'taxonomy' => 'status',
							'field' => 'slug',
							'terms' => 'brak-miejsc',
							'operator' => 'NOT IN',
						]			
					],
					'meta_query' => [
						'relation' => 'AND',
						[
							'key' => 'total_price_subject',
							'compare' => 'EXIST'
						]
					]
				);
			}

			$subject_cart = new WP_Query($subject_cart);
			if($subject_cart -> have_posts())
			{
				$content_email = '<strong style="font-size:16px;padding-bottom:5px;">'.__('WYBRANE KURSY', 'cn').':</strong>';
				while($subject_cart -> have_posts()): $subject_cart -> the_post();

					$content_subject = array();

					$id_subject = get_the_ID();
					$total_price_subject = rwmb_meta('total_price_subject', '', $id_subject);
					$time_from_subject = rwmb_meta('time_from_subject', '', $id_subject);
					$time_to_subject = rwmb_meta('time_to_subject', '', $id_subject);
					$date_start_subject = rwmb_meta('date_start_subject', '', $id_subject);
					$level = get_the_terms($id_subject, 'poziom');
					$day = get_the_terms($id_subject, 'dzien');

					$subject_price_cart_array[] = $total_price_subject;

					$content_subject[] = strtoupper(get_the_title());

					if(isset($level[0]->name))
					{
						$content_subject[] = $level[0]->name;
					}
					if(!empty($date_start_subject) && $date_start_subject != '-')
					{
						$content_subject[] = date("d.m.Y", strtotime($date_start_subject));
					}
					if(isset($day[0]->name))
					{
						$content_subject[] = $day[0]->name;
					}
					if(!empty($time_from_subject) && !empty($time_to_subject))
					{
						$content_subject[] = $time_from_subject.' - '.$time_to_subject;
					}

					$content_email = $content_email.'<br/>- '.implode(', ', $content_subject);

					if(in_array($id_subject, $extra_video_checked))
					{
						$content_email = $content_email.' + komplet 40 godzin nagrań wykładów';
					}

				endwhile; wp_reset_postdata();
				
				if(!empty($name_participants_group) && !empty($name_participants_group_2) && !empty($name_participants_group_3))
				{
					$name_participants_group = __('Osoby z którymi będę uczęszczać na zajęcia w grupie', 'cn').': '.$name_participants_group.' '.$name_participants_group_2.' '.$name_participants_group_3.' '.$name_participants_group_4.' '.$name_participants_group_5.'<br/>';
				}
				
				if(!empty($name_sibling))
				{
					$name_sibling = __('Moje rodzeństwo którę uczęszczało na zajęcia w latach ubiegłych', 'cn').': '.$name_sibling.'<br/>';
				}

				$content_email = $content_email.'
					<br/><br/><strong style="font-size:16px;padding-bottom:5px;">'.__('DANE UCZESTNIKA', 'cn').':</strong><br/>
					Imię i nazwisko: '.$name.'<br/>
					Adres: '.$street.' '.$street_number.' '.$flat_number.'<br/>
					Kod pocztowy: '.$zipcode.'<br/>
					Miasto: '.$city.'<br/>
					Adres e-mail: '.$email.'<br/>
					Telefon: '.$phone.'<br/><br/>
					Szkoła: '.$school.'<br/>
					Rok matury: '.$baccalaureate.'<br/><br/>
					Zapisuję się na kurs w grupie powyżej 3 osób: '.$text_group.'<br/>
					'.$name_participants_group.'
					Rodzeństwo uczęszcza na zajęcia w Collegium Novum: '.$text_sibling.'<br/>
					'.$name_sibling.'
					Liczba przedmiotów na które uczęszczałem w roku ubiegłym: '.$count_year.'<br/>
					Warsztaty praktycznych umiejętności: '.implode(', ', $extra_subject).'<br/>
					UWAGI:<br/>'.$comments_notification;

				if($payment_option == 'other')
				{
					$content_email = $content_email.'<br/><br/>'.__('SPOSÓB PŁATNOŚCI USTALIŁEM Z BIUREM INDYWIDUALNIE', 'cn');
				}

				$price = get_total_price($subject_price_cart_array, $extra_video_checked, $payment_option, $check_group, $check_sibling, $count_year);
				$get_installment = get_installment($price, $payment_option);

				$content_email = $content_email.'<br/><br/>'.__('KWOTA DO ZAPŁATY', 'cn').': <strong>'.$price.' zł</strong><br/>';

				if(isset($get_installment[0]))
				{
					foreach($get_installment as $item)
					{
						$content_email = $content_email.$item['name'].' - '.$item['price'].' - '.__('płatne do', 'cn').' '.$item['date'].'<br/>';
					}
				}
				
				$cart_email_content = rwmb_meta('cart_email_content', ['object_type' => 'setting'], 'cn_settings');
				$cart_email_page = rwmb_meta('cart_email_page', ['object_type' => 'setting'], 'cn_settings');

				$to = $email;
				$subject = 'ZGŁOSZENIE '.date('d.m.Y').' | COLLEGIUM NOVUM';
				$body = '<center><strong>'.__('DZIĘKUJEMY ZA ZGŁOSZENIE NA KURS', 'cn').'</strong></center><br/>'.$content_email.'<br/></br/>'.$cart_email_content;
				$headers = array('Content-Type: text/html; charset=UTF-8','From: Kursy maturalne COLLEGIUM NOVUM <zgloszenia@collegiumnovum.pl>');

				wp_mail($to, $subject, $body, $headers);
				
				if(!empty($cart_email_page))
				{
					if(filter_var($cart_email_page, FILTER_VALIDATE_EMAIL))
					{
						$to = $cart_email_page;
						$subject = 'ZGŁOSZENIE - '.$name.' '.$email.' | COLLEGIUM NOVUM';
						$body = $content_email;
						$headers = array('Content-Type: text/html; charset=UTF-8','From: Kursy maturalne COLLEGIUM NOVUM <zgloszenia@collegiumnovum.pl>', 'Reply-To: '.$name.' <'.$email.'>');
						wp_mail($to, $subject, $body, $headers);
					}
				}

				echo '<div class="cart-bar-top"><div class="container"><div class="cart-icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100"> <g> <path d="M38.25,92.54c-4.44,0-8.05-3.61-8.05-8.05s3.61-8.05,8.05-8.05h0c2.15,0,4.16.84,5.69,2.35,1.52,1.52,2.36,3.54,2.36,5.69h0c0,4.45-3.61,8.06-8.05,8.06ZM38.26,82.81h0c-.93,0-1.68.76-1.68,1.68s.75,1.68,1.68,1.68,1.68-.75,1.68-1.68c0-.45-.18-.88-.5-1.19s-.74-.49-1.18-.49Z"/> <path d="M74.54,92.54c-4.44,0-8.05-3.61-8.05-8.05s3.61-8.05,8.04-8.05h0c2.15,0,4.16.84,5.69,2.35,1.52,1.52,2.36,3.54,2.36,5.69h0c0,4.45-3.61,8.06-8.05,8.06ZM74.54,82.81h0c-.93,0-1.68.76-1.68,1.68s.75,1.68,1.68,1.68,1.68-.75,1.68-1.68c0-.45-.18-.88-.5-1.19s-.74-.49-1.18-.49Z"/> <path d="M40.27,72.51c-5.15,0-9.65-3.68-10.66-8.83l-5.48-27.36c-.02-.08-.03-.16-.05-.24l-2.55-12.74h-9.5c-2.43,0-4.4-1.97-4.4-4.4s1.97-4.4,4.4-4.4h13.11c2.1,0,3.9,1.48,4.31,3.53l2.57,12.85h52.11c1.31,0,2.56.58,3.39,1.6.83,1.01,1.18,2.34.93,3.63l-5.24,27.5c-1.04,5.25-5.69,8.89-10.96,8.86h-31.77c-.07,0-.14,0-.21,0ZM33.79,39.73l4.45,22.23c.21,1.04,1.14,1.77,2.16,1.75h31.94c1.06.01,2.04-.71,2.24-1.74l4.24-22.24h-45.03Z"/> </g> </svg></div></div></div><div class="cart-content"><div class="container"><div class="step-cart"><p class="step-cart-name text-center">'.__('DZIĘKUJEMY. FORMULARZ ZOSTAŁ WYSŁANY.', 'cn').'</p></div></div></div>';
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 0;
		}
	}
	else
	{
		echo 0;
	}
}

function get_total_price($subject_price_cart_array = array(), $extra_video = array(), $payment_option = null, $check_group = false, $check_sibling = false, $count_year = 0) {

	$total_price = 0;
	$array_calc = array();

	if(!empty($subject_price_cart_array) && is_array($subject_price_cart_array))
	{
		$size = count($subject_price_cart_array);

		$discounts_date_strtotime = null;
		$today_date = null;

		$discounts_date = rwmb_meta('discounts_date', ['object_type' => 'setting'], 'cn_settings');
		$discounts_number = rwmb_meta('discounts_number', ['object_type' => 'setting'], 'cn_settings');
		$discounts_all_number = rwmb_meta('discounts_all_number', ['object_type' => 'setting'], 'cn_settings');
		$discounts_two_number = rwmb_meta('discounts_two_number', ['object_type' => 'setting'], 'cn_settings');
		$discounts_many_number = rwmb_meta('discounts_many_number', ['object_type' => 'setting'], 'cn_settings');
		$discounts_group_number = rwmb_meta('discounts_group_number', ['object_type' => 'setting'], 'cn_settings');
		$discounts_group_count_number = rwmb_meta('discounts_group_count_number', ['object_type' => 'setting'], 'cn_settings');
		$discounts_sibling_number = rwmb_meta('discounts_sibling_number', ['object_type' => 'setting'], 'cn_settings');
		$discounts_year_number = rwmb_meta('discounts_year_number', ['object_type' => 'setting'], 'cn_settings');
		$extra_video_subject = rwmb_meta('extra_video_subject', ['object_type' => 'setting'], 'cn_settings');

		if(!empty($discounts_date) && is_numeric($discounts_number))
		{
			$discounts_date_strtotime = strtotime($discounts_date);
			$today_date = strtotime(date('Y-m-d'));
		}

		$count = 1;

		foreach($subject_price_cart_array as $item)
		{
			$calc = $item;

			if($discounts_date_strtotime >= $today_date)
			{
				$percent_one = round($discounts_number / 100, 2);
				$calc = $calc - ($percent_one * $calc);
			}
			if(is_numeric($discounts_all_number) && ($payment_option == 'all' || $payment_option == null))
			{
				$percent_two = round($discounts_all_number / 100, 2);
				$calc = $calc - ($percent_two * $calc);
			}
			if(is_numeric($discounts_two_number) && $size > 1 && $count == 2)
			{
				$percent_three = round($discounts_two_number / 100, 2);
				$calc = $calc - ($percent_three * $calc);
			}
			if(is_numeric($discounts_many_number) && $size > 2 && $count > 2)
			{
				$percent_four = round($discounts_many_number / 100, 2);
				$calc = $calc - ($percent_four * $calc);
			}
			if(is_numeric($discounts_group_number) && is_numeric($discounts_group_count_number))
			{
				if($check_group)
				{
					$percent_five = round($discounts_group_number / 100, 2);
					$calc = $calc - ($percent_five * $calc);
				}
			}
			if(is_numeric($discounts_sibling_number))
			{
				if($check_sibling)
				{
					$percent_six = round($discounts_sibling_number / 100, 2);
					$calc = $calc - ($percent_six * $calc);
				}
			}
			if(is_numeric($count_year) && is_numeric($discounts_year_number))
			{
				if($count_year > 0)
				{
					if($count_year >= $count)
					{
						$percent_seven = round($discounts_year_number / 100, 2);
						$calc = $calc - ($percent_seven * $calc);
					}

				}
			}

			$array_calc[] = $calc;

			$count++;

		}

		if(!empty($array_calc))
		{
			foreach($array_calc as $price)
			{
				$total_price = $total_price + $price;
			}

			$total_price = round($total_price, 0);
		}

	}

	if(!empty($extra_video) && is_array($extra_video) && is_numeric($extra_video_subject))
	{
		$size = count($extra_video);

		$total_price = $total_price + ($extra_video_subject * $size);
		$total_price = round($total_price, 0);
	}

	return $total_price;
}

function get_installment($price = null, $count = 1) {

	$installment = array();

	if($price > 0)
	{
		if($count == 2)
		{

			$installment[] = array(
				'name' => '1 rata',
				'price' => round(0.6 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('+3 days')).' r.'
			);

			$installment[] = array(
				'name' => '2 rata',
				'price' => round(0.4 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+31 days')).' r.'
			);
		}
		elseif($count == 3)
		{

			$installment[] = array(
				'name' => '1 rata',
				'price' => round(0.4 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('+3 days')).' r.'
			);

			$installment[] = array(
				'name' => '2 rata',
				'price' => round(0.35 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+31 days')).' r.'
			);

			$installment[] = array(
				'name' => '3 rata',
				'price' => round(0.25 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+62 days')).' r.'
			);

		}
		elseif($count == 4)
		{

			$installment[] = array(
				'name' => '1 rata',
				'price' => round(0.3 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('+3 days')).' r.'
			);

			$installment[] = array(
				'name' => '2 rata',
				'price' => round(0.25 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+31 days')).' r.'
			);

			$installment[] = array(
				'name' => '3 rata',
				'price' => round(0.25 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+62 days')).' r.'
			);

			$installment[] = array(
				'name' => '4 rata',
				'price' => round(0.2 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+93 days')).' r.'
			);

		}
		elseif($count == 5)
		{

			$installment[] = array(
				'name' => '1 rata',
				'price' => round(0.25 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('+3 days')).' r.'
			);

			$installment[] = array(
				'name' => '2 rata',
				'price' => round(0.2 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+31 days')).' r.'
			);

			$installment[] = array(
				'name' => '3 rata',
				'price' => round(0.2 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+62 days')).' r.'
			);

			$installment[] = array(
				'name' => '4 rata',
				'price' => round(0.2 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+93 days')).' r.'
			);

			$installment[] = array(
				'name' => '5 rata',
				'price' => round(0.15 * $price, 0).' zł',
				'date' => date('d.m.Y', strtotime('now'.'+124 days')).' r.'
			);

		}
		else
		{
			$installment[] = array(
				'name' => 'Jednorazowa wpłata w całości',
				'price' => $price.' zł',
				'date' => date('d.m.Y', strtotime('+3 days')).' r.'
			);
		}
	}

	return $installment;

}
