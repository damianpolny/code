<?php

require __DIR__ . '/vendor/autoload.php';

function mobile_detect() {
	$detect = new \Detection\MobileDetect;
	return ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
}

function menus() {
	$locations = array(
		'lang_menu' => 'Menu językowe',
		'primary_menu' => 'Menu Główne',
		'footer_menu_1' => 'Menu w stopce 1',
		'footer_menu_2' => 'Menu w stopce 2',
		'footer_menu_3' => 'Menu w stopce 3'
	);
	register_nav_menus($locations);
}
add_action('init', 'menus');

function add_styles_and_script() {
	wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.2');
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'add_styles_and_script', 55);

function add_scripts() {
	wp_enqueue_script('script-file', get_template_directory_uri().'/js/script.js');
}
add_action('wp_footer', 'add_scripts');

function wp_script_page() {
	echo "<script>
	
		if(document.getElementById('slider_offer'))
		{
			var slider_offer = new Swiper('#slider_offer', {
				rewind: true,
				spaceBetween: 30,
				slidesPerView: 1,
				breakpoints: {
					576: {
						slidesPerView: 2,
					},
					768: {
						slidesPerView: 3,
					},
					1180: {
						slidesPerView: 5,
					}
				}
			});
		}
		
		if(document.getElementById('slider_post'))
		{
			var slider_post = new Swiper('#slider_post', {
				rewind: true,
				spaceBetween: 0,
				slidesPerView: 1,
				navigation: {
					nextEl: '.custom-swiper-navigation .swiper-button-next',
					prevEl: '.custom-swiper-navigation .swiper-button-prev',
				}
			});
		}
	
		if(document.getElementById('header_home'))
		{
			let scrollpos = window.scrollY;
			const header = document.querySelector('header');
			const header_height = header.offsetHeight;
			const add_class_on_scroll = () => header.classList.add('header-home');
			const remove_class_on_scroll = () => header.classList.remove('header-home');
			window.addEventListener('scroll', function()
			{
				scrollpos = window.scrollY;
				if (scrollpos >= header_height)
				{
					remove_class_on_scroll()
				}
				else
				{
					add_class_on_scroll()
				}
			});
		}
		
		if(document.getElementById('home_section_products'))
		{
			jQuery(document).ready(function(){
				
				jQuery('#home_section_products_grid .col, #home_section_products_grid .col-12').hide();
				var first_class_cat = jQuery('.section-products ul.list-category li').attr('class');
				var first_class_cat_id = first_class_cat.replace(/\D/g,'');
				jQuery('.cat-id-' + first_class_cat_id).show();
				
				jQuery('.section-products ul.list-category li a').click(function(event){
					event.preventDefault();
					
					jQuery('.section-products ul.list-category li').removeClass('current-cat');
					jQuery(this).parent().addClass('current-cat');
					
					var class_cat = jQuery(this).parent().attr('class');
					
					var cat_id = class_cat.replace(/\D/g,'');
					
					jQuery('#home_section_products_grid .col, #home_section_products_grid .col-12').hide();
					
					jQuery('.cat-id-' + cat_id).show();
					
				});
			});
		}	
	
		if(document.getElementById('gallery_mansory'))
		{
			FlexMasonry.init('#gallery_mansory', {
				responsive: false,
				responsive: true,
				breakpointCols: {
					'min-width: 769px': 3,
					'max-width: 768px': 2,
					'max-width: 576px': 1
				}
			});
		}

		jQuery(document).ready(function(){
			
			jQuery('.accordion-item .accordion-head svg').on('click', function() {
				jQuery(this).parent().parent().toggleClass('active');
				jQuery(this).parent().next().slideToggle();
			});
			
			if(jQuery(window).width() <= 768)
			{
				jQuery('header .header .header-content .header-content-right a.button-file').clone().prependTo('header .header .header-content .menu-top');
				jQuery('header .header .header-content .header-content-left').clone().appendTo('header .header .header-content .menu-top');
				jQuery('header .header .header-content .header-content-right').clone().appendTo('header .header .header-content .menu-top');
				jQuery('<div style=\"clear:both;\"></div>').appendTo('header .header .header-content .menu-top');
				
				jQuery('header .header .header-content .logo-top .menu-bar').on('click', function() {
					jQuery('header .header .header-content .logo-top .menu-bar').toggleClass('active-bar');
					jQuery('header .header .header-content .menu-top').slideToggle();
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

add_theme_support('post-thumbnails');
add_theme_support('custom-logo');
add_image_size('product_size', 300, 300, false);
add_image_size('thumbnail_wide', 800, 260, true);

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

function posts_link_next_class($format){
	$format = str_replace('href=', 'class="read-more" href=', $format);
	return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
	$format = str_replace('href=', 'class="read-more read-more-left" href=', $format);
	return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');

function custom_title($atts) {
	$default = array(
		'paragraph' => 'p',
		'subparagraph' => 'p',
		'title' => null,
		'subtitle' => null,
		'above' => null,
		'extra_class' => null
	);
	$a = shortcode_atts($default, $atts);
	if(!empty($a['subtitle']) && !empty($a['title']))
	{
		return '<div class="section-title-content '.$a['extra_class'].'"><'.$a['paragraph'].' class="section-title">'.$a['title'].'</'.$a['paragraph'].'><'.$a['subparagraph'].' class="section-subtitle">'.$a['subtitle'].'</'.$a['subparagraph'].'></div>';
	}
	elseif(!empty($a['subtitle']) && !empty($a['above']))
	{
		return '<div class="section-title-content '.$a['extra_class'].'"><p class="section-abovetitle">'.$a['above'].'</p><'.$a['subparagraph'].' class="section-subtitle">'.$a['subtitle'].'</'.$a['subparagraph'].'></div>';
	}
	elseif(!empty($a['subtitle']))
	{
		return '<div class="section-title-content '.$a['extra_class'].'"><'.$a['subparagraph'].' class="section-subtitle">'.$a['subtitle'].'</'.$a['subparagraph'].'></div>';
	}
	else
	{
		return '<div class="section-title-content '.$a['extra_class'].'"><'.$a['paragraph'].' class="section-title">'.$a['title'].'</'.$a['paragraph'].'></div>';
	}
}
add_shortcode('custom_title', 'custom_title');

function custom_button($atts) {
    $default = array(
		'url' => '#',
		'text' => null,
		'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
    return '<p class="'.$a['extra_class'].'"><a class="custom-button" href="'.esc_url($a['url']).'">'.$a['text'].'</a></p>';
}
add_shortcode('custom_button', 'custom_button');

function stroke_text($atts) {
    $default = array(
		'text' => null
    );
    $a = shortcode_atts($default, $atts);
	if(!empty($a['text']))
	{
		return '<p class="stroke-text">'.$a['text'].'</p>';
	}
	else
	{
		return null;
	}
}
add_shortcode('stroke_text', 'stroke_text');

function page_waves($a) {
	return '<p class="page-waves"></p>';
}
add_shortcode('page_waves', 'page_waves');

function list_child_pages() {
	global $post;
	$string = null;
	if(is_page() && $post->post_parent)
	{
		$childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of='.$post->post_parent.'&echo=0');
	}
	else
	{
		$childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of='.$post->ID.'&echo=0');
	}
	if($childpages)
	{
		$string = '<ul class="child-pages">'.$childpages.'</ul>';
	}
	return $string;
}

function products_post_type() {
	$args = [
		'label'  => __('Produkty', 'makaer'),
		'labels' => [
			'menu_name' => __('Produkty', 'makaer'),
			'name_admin_bar' => __('Produkt', 'makaer'),
			'add_new' => 'Dodaj produkt',
			'add_new_item' => 'Dodaj nowy produkt',
			'new_item' => 'Nowy produkt',
			'edit_item' => 'Edytuj produkt',
			'view_item' => 'Zobacz produkt',
			'update_item' => 'Zaktualizuj produkt',
			'not_found' => 'Nie znaleziono.'
		],
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_rest' => true,
		'capability_type' => 'post',
		'has_archive' => 'produkty',
		'hierarchical' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite_no_front' => false,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-products',
		'supports' => [
			'title', 'editor', 'excerpt', 'thumbnail'
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('produkt', $args);
}
add_action('init', 'products_post_type');

function category_products_taxonomy() {
	$args = [
		'label'  => 'Kategoria',
		'labels' => [
			'menu_name' => 'Kategoria',
			'add_new_item' => 'Dodaj nowy kategorie',
			'edit_item' => 'Edytuj kategorie',
			'update_item' => 'Zaktualizuj kategorie',
			'not_found' => 'Nie znaleziono żadnych kategorii.'
		],
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'show_in_quick_edit' => true,
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
	register_taxonomy('kategoria-produktu', ['produkt'], $args);
}
add_action('init', 'category_products_taxonomy');

add_filter('mb_settings_pages', function ($settings_pages) {
    $settings_pages[] = [
        'id'          => 'makaer-settings',
        'option_name' => 'makaer_settings',
        'menu_title'  => 'Opcje strony',
        'submit_button' => 'Zapisz ustawienia'
    ];
    return $settings_pages;
});

function register_meta_boxes_makaer_settings($meta_boxes) {

	$meta_boxes[] = [
		'title'  => 'Ustawienia strony',
		'id' => null,
		'settings_pages' => 'makaer-settings',
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'SOCIAL'
			],
			[
				'name' => 'Facebook URL',
				'id' => 'facebook_page',
				'type' => 'url'
			],
			[
				'name' => 'Instagram URL',
				'id' => 'instagram_page',
				'type' => 'url'
			],
			[
				'name' => 'TikTok URL',
				'id' => 'tiktok_page',
				'type' => 'url'
			],
			[
				'name' => 'Pinterest URL',
				'id' => 'pinterest_page',
				'type' => 'url'
			],
			[
				'type' => 'heading',
				'name' => 'DANE KONTAKTOWE'
			],
			[
				'name' => 'E-mail',
				'id' => 'email_page',
				'type' => 'email'
			],
			[
				'name' => 'Telefon',
				'id' => 'phone_page',
				'type' => 'text'
			],
			[
				'name' => 'Adres',
				'id' => 'adres_page',
				'type' => 'textarea'
			],
			[
				'name' => 'Dane rejestracyjne',
				'id' => 'legal_data_page',
				'type' => 'textarea'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_makaer_settings');

function register_meta_boxes_custom_frontpage($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include' => [
			'relation' => 'OR',
			'ID' => get_option('page_on_front'),
		],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'TOP'
			],
			[
				'name' => 'Plik video',
				'id' => 'home_top_video',
				'type' => 'video',
				'max_file_uploads' => 1
			],
			[
				'name' => 'Opis',
				'id' => 'home_top_video_text',
				'type' => 'wysiwyg'
			],
			[
				'type' => 'heading',
				'name' => 'PRODUKTY'
			],
			[
				'name' => 'Wybierz kategorie produktów',
				'id' => 'home_category_products',
				'type' => 'taxonomy_advanced',
				'taxonomy' => 'kategoria-produktu',
				'field_type' => 'checkbox_list'
			],
			[
				'type' => 'heading',
				'name' => 'WPISY'
			],
			[
				'name' => 'Obrazek',
				'id' => 'home_post_img_section',
				'type' => 'single_image'
			],
			[
				'type' => 'heading',
				'name' => 'DYSTRYBUCJA'
			],
			[
				'name' => 'Opis',
				'id' => 'home_top_text_section',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			],
			[
				'type' => 'heading',
				'name' => 'SEKCJA INFORMACYJNA'
			],
			[
				'name' => 'Obrazek',
				'id' => 'home_middle_img_section',
				'type' => 'single_image'
			],
			[
				'name' => 'Opis',
				'id' => 'home_middle_text_section',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			],
			[
				'type' => 'heading',
				'name' => 'NEWSLETTER'
			],
			[
				'name' => 'Opis',
				'id' => 'newsletter_content',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			],
			[
				'type' => 'heading',
				'name' => 'DOLNA SEKCJA'
			],
			[
				'name' => 'Obrazek',
				'id' => 'home_bottom_img',
				'type' => 'single_image'
			],
			[
				'name' => 'Opis',
				'id' => 'home_bottom_text',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_frontpage');

function register_meta_boxes_custom_page_products($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'produkt',
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'Top obrazek'
			],
			[
				'name' => 'Dodaj',
				'id' => 'top_img',
				'type' => 'single_image'
			],
			[
				'type' => 'heading',
				'name' => 'Cechy i parametry'
			],
			[
				'name' => 'Obrazek',
				'id' => 'features_img',
				'type' => 'single_image'
			],
			[
				'name'       => 'Cechy',
				'id'         => 'features_product',
				'type'       => 'group',
				'clone'      => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields'     => [
					[
						'name' => 'Tytuł',
						'id'   => 'features_product_name',
						'type' => 'text',
					],
					[
						'name' => 'Opis',
						'id'   => 'features_product_subname',
						'type' => 'text',
						'callback' => null
					],
					[
						'name' => 'Klasa ikonki',
						'id'   => 'features_product_icon',
						'type' => 'text',
					],
					[
						'name' => 'Skala',
						'id'   => 'features_product_count',
						'type' => 'number',
					]
				]
			],
			[
				'name'       => 'Parametry',
				'id'         => 'parameters_product',
				'type'       => 'group',
				'clone'      => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields'     => [
					[
						'name' => 'Tytuł',
						'id'   => 'parameters_product_name',
						'type' => 'text',
					],
					[
						'name' => 'Opis',
						'id'   => 'parameters_product_subname',
						'type' => 'text',
						'callback' => null
					],
					[
						'name' => 'Klasa ikonki',
						'id'   => 'parameters_product_icon',
						'type' => 'text',
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'Sposób użycia'
			],
			[
				'name' => 'Obrazek',
				'id' => 'img_method_of_use_product',
				'type' => 'single_image'
			],
			[
				'name' => 'Plik video',
				'id' => 'video_method_of_use_product',
				'type' => 'video',
				'max_file_uploads' => 1
			],
			[
				'name' => 'Opis',
				'id' => 'method_of_use_product',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			],
			[
				'type' => 'heading',
				'name' => 'Dostepne kolory'
			],
			[
				'name'       => 'Dodaj',
				'id'         => 'section_colors',
				'type'       => 'group',
				'clone'      => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields'     => [
					[
						'name' => 'Tytuł',
						'id'   => 'section_colors_name',
						'type' => 'text',
					],
					[
						'name' => 'ID',
						'id'   => 'section_colors_id',
						'type' => 'number',
					],
					[
						'name' => 'Galeria',
						'id'   => 'section_colors_gallery',
						'type' => 'image_advanced',
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'Galeria'
			],
			[
				'name' => 'Dodaj',
				'id' => 'gallery_img',
				'type' => 'image_advanced'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_products');

function register_meta_boxes_custom_page_catalog($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['catalog-page-data.php']
        ],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'Plik katalogu'
			],
			[
				'name' => 'Dodaj plik PDF',
				'id' => 'page_catalog_file',
				'type' => 'file_advanced',
				'max_file_uploads' => 1
			],
			[
				'type' => 'heading',
				'name' => 'Kod przeglądarki pdf'
			],
			[
				'name' => 'Dodaj',
				'id' => 'viever_pdf',
				'type' => 'text'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_catalog');

function register_meta_boxes_custom_page_about_us($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['about-page-data.php']
        ],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'Dodatkowy tytuł'
			],
			[
				'name' => 'Dodaj',
				'id' => 'about_us_extra_title',
				'type' => 'text'
			],
			[
				'type' => 'heading',
				'name' => 'Nasze wartości'
			],
			[
				'name' => 'Dodaj',
				'id' => 'our_values',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Tytuł',
						'id' => 'our_values_name',
						'type' => 'text',
					],
					[
						'name' => 'Ikonka',
						'id' => 'our_values_icon',
						'type' => 'single_image',
					],
				]
			],
			[
				'type' => 'heading',
				'name' => 'Sekcja środkowa'
			],
			[
				'name' => 'Obrazek',
				'id' => 'about_us_img',
				'type' => 'single_image'
			],
			[
				'name' => 'Opis',
				'id' => 'about_us_text',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			],
			[
				'type' => 'heading',
				'name' => 'Sekcja tekstowa'
			],
			[
				'name' => 'Opis',
				'id' => 'about_us_section_text',
				'type' => 'wysiwyg'
			],
			[
				'type' => 'heading',
				'name' => 'Galeria'
			],
			[
				'name' => 'Dodaj',
				'id' => 'gallery_img',
				'type' => 'image_advanced'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_about_us');

function register_meta_boxes_custom_page_brand($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['brand-page-data.php']
        ],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'Dodatkowy tytuł'
			],
			[
				'name' => 'Dodaj',
				'id' => 'brand_extra_title',
				'type' => 'text'
			],
			[
				'type' => 'heading',
				'name' => 'Sekcja tekstowa'
			],
			[
				'name' => 'Dodaj',
				'id' => 'brand_section',
				'type' => 'wysiwyg'
			],
			[
				'type' => 'heading',
				'name' => 'Produkty'
			],
			[
				'name' => 'Dodaj',
				'id' => 'brand_slider',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Tytuł',
						'id' => 'brand_slider_name',
						'type' => 'text',
					],
					[
						'name' => 'Obrazek',
						'id' => 'brand_slider_img',
						'type' => 'single_image',
					],
					[
						'name' => 'Opis',
						'id' => 'brand_slider_text',
						'type' => 'textarea',
					],
				]
			],
			[
				'type' => 'heading',
				'name' => 'Dolna sekcja'
			],
			[
				'name' => 'Dodaj',
				'id' => 'brand_bottom_section',
				'type' => 'wysiwyg'
			],
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_brand');

function register_meta_boxes_custom_page_distribution($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['distribution-page-data.php']
        ],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'Dodatkowy tytuł'
			],
			[
				'name' => 'Dodaj',
				'id' => 'distribution_extra_title',
				'type' => 'text'
			],
			[
				'type' => 'heading',
				'name' => 'Dlaczego wybrać Makear?'
			],
			[
				'name' => 'Dodaj',
				'id' => 'distribution_box',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'type' => 'textarea'
			],
			[
				'type' => 'heading',
				'name' => 'CO DOSTAJESZ W ZAMIAN'
			],
			[
				'name' => 'Dodaj',
				'id' => 'distribution_info',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'type' => 'wysiwyg'
			],
			[
				'type' => 'heading',
				'name' => 'Kod formularza kontaktowego'
			],
			[
				'name' => 'Dodaj',
				'id' => 'distribution_form',
				'type' => 'text'
			],
			[
				'type' => 'heading',
				'name' => 'Opis formularza kontaktowego'
			],
			[
				'name' => 'Dodaj',
				'id' => 'distribution_form_txt',
				'type' => 'textarea'
			],
			[
				'type' => 'heading',
				'name' => 'DOLNA SEKCJA'
			],
			[
				'name' => 'Obrazek',
				'id' => 'distribution_bottom_img',
				'type' => 'single_image'
			],
			[
				'name' => 'Opis',
				'id' => 'distribution_bottom_text',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_distribution');

function register_meta_boxes_custom_page_contact($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['contact-page-data.php']
        ],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'Kod formularza kontaktowego'
			],
			[
				'name' => 'Dodaj',
				'id' => 'contact_form',
				'type' => 'text'
			],
			[
				'type' => 'heading',
				'name' => 'URL mapy'
			],
			[
				'name' => 'Dodaj',
				'id' => 'contact_map_url',
				'type' => 'url'
			],
			[
				'type' => 'heading',
				'name' => 'Opis formularza kontaktowego'
			],
			[
				'name' => 'Dodaj',
				'id' => 'contact_form_txt',
				'type' => 'textarea'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_contact');

function register_meta_boxes_custom_page_knowledge($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['knowledge-base-data.php']
        ],
		'fields' => [
			[
				'name'       => 'Dodaj pytania i odpowiedzi',
				'id'         => 'section_knowledge',
				'type'       => 'group',
				'clone'      => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields'     => [
					[
						'name' => 'Tytuł',
						'id'   => 'section_knowledge_name',
						'type' => 'text',
					],
					[
						'name' => 'Opis',
						'id'   => 'section_knowledge_txt',
						'type' => 'wysiwyg',
					]
				]
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_knowledge');

function custom_excerpt_length($length) {
	if(!is_singular('produkt'))
	{
		return 15;
	}
	else
	{
		return $length;
	}
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);