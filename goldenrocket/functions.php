<?php

require __DIR__ . '/vendor/autoload.php';

function mobile_detect() {
	$detect = new \Detection\MobileDetect;
	return ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
}

function menus() {
	$locations = array(
		'primary_menu' => 'Menu Główne',
		'footer_menu_one' => 'Menu w stopce 1',
		'footer_menu_two' => 'Menu w stopce 2'
	);
	register_nav_menus($locations);
}
add_action('init', 'menus');

function add_styles() {
	wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.2');
}
add_action('wp_enqueue_scripts', 'add_styles', 55);

function add_scripts() {
	wp_enqueue_script('script-file', get_template_directory_uri().'/js/script.js');
}
add_action('wp_footer', 'add_scripts');

function smartwp_disable_emojis() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'smartwp_disable_emojis');

function disable_emojis_tinymce($plugins) {
	if(is_array($plugins))
	{
		return array_diff($plugins, array('wpemoji'));
	}
	else
	{
		return array();
	}
}

function wp_script_page() {
	echo "<script>
	
		gsap.registerPlugin(ScrollTrigger, TextPlugin);
		
		var lazyLoadInstance = new LazyLoad();
					
		let scrollpos = window.scrollY;
		const header = document.querySelector('header .header');
		const header_height = header.offsetHeight;

		const add_class_on_scroll = () => header.classList.add('header-scroll');
		const remove_class_on_scroll = () => header.classList.remove('header-scroll');

		window.addEventListener('scroll', function() {
			scrollpos = window.scrollY;
			if(scrollpos >= header_height)
			{
				add_class_on_scroll();
			}
			else
			{
				remove_class_on_scroll();
			}
		})
	
		if(document.getElementById('showreel_player'))
		{
			const showreel_player = new Plyr('#showreel_player', {
				controls: ['play-large'],
				resetOnEnd: true,
			});
			
		}
		
		if(document.getElementById('showreel_player_loop'))
		{
			const showreel_player_loop = new Plyr('#showreel_player_loop', {
				controls: false
			});
			
			if(document.getElementById('volume_up'))
			{
				var icon_volume = document.getElementById('volume_up_icon');
				document.getElementById('volume_up').addEventListener('click', function(event) {
					if(showreel_player_loop.volume == 1)
					{
						showreel_player_loop.volume = 0;
					}
					else
					{
						showreel_player_loop.volume = 1;
					}
					icon_volume.classList.toggle('fa-volume-off');
					icon_volume.classList.toggle('fa-volume-high');
				});
			}
		}
		
		if(document.querySelectorAll('.player-hover').length > 0)
		{
			const player_hover = Array.from(document.querySelectorAll('.player-hover')).map((p) => new Plyr(p, {
				controls: false,
				fullscreen: false
			}));
			if(player_hover.length > 0)
			{
				Array.from(player_hover).map((p) => video_autoload(p));
				Array.from(document.querySelectorAll('.video-hover')).map((p) => hover_start(p));
				
				function hover_start(p) {
					p.addEventListener('mouseover', function () {
						var count_number = p.dataset.number;
						if(player_hover[count_number])
						{
							player_hover[count_number].play();
						}
					});
					p.addEventListener('mouseout', function () {
						var count_number = p.dataset.number;
						if(player_hover[count_number])
						{
							setTimeout(function () {
								player_hover[count_number].stop();
							}, 1500);
						}
					});
				}
				
				function video_autoload(p) {
					var playPromise = p.play();
					if (playPromise !== undefined) {
						playPromise.then(_ => {
							p.pause();
						}).catch(error => {
							
						});
					}
				}
			}
		}
		
		if(document.getElementById('swiper_case_study'))
		{
			var swiper_case_study = new Swiper('#swiper_case_study', {
				slidesPerView: 1,
				spaceBetween: 0,
				rewind: true,
				navigation: {
					nextEl: '.swiper-content-case-study .swiper-button-next',
					prevEl: '.swiper-content-case-study .swiper-button-prev',
				},
				breakpoints: {
					1024: {
						slidesPerView: 2
					}
				}
			});
		}
		
		if(document.getElementById('swiper_logos'))
		{
			var swiper_logos = new Swiper('#swiper_logos', {
				slidesPerView: 1,
				spaceBetween: 0,
				rewind: true,
				navigation: {
					nextEl: '.swiper-content-logo .swiper-button-next',
					prevEl: '.swiper-content-logo .swiper-button-prev',
				},
				breakpoints: {
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					},
					1024: {
						slidesPerView: 4
					}
				}
			});
		}
		
		if(document.getElementById('swiper_text'))
		{
			var swiper_text = new Swiper('#swiper_text', {
				slidesPerView: 1,
				spaceBetween: 0,
				rewind: true,
				navigation: {
					nextEl: '.swiper-content-text .swiper-button-next',
					prevEl: '.swiper-content-text .swiper-button-prev',
				},
				breakpoints: {
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					},
					1024: {
						slidesPerView: 3
					}
				}
			});
		}
		
		if(document.querySelectorAll('.purecounter').length > 0)
		{
			const purecounter = document.querySelectorAll('.purecounter');
			gsap.from(purecounter, {
				textContent: 0,
				duration: 3,
				ease: Power1.easeIn,
				snap: { 
					textContent: 1
				},
				scrollTrigger: {
					trigger: '#counter_start',
					start: 'top 90%'
				}
			});
		}
		
		if(document.getElementById('contact_title_type') && document.getElementById('contact_title_type_cursor'))
		{
			gsap.to('#contact_title_type', {
				text: {
					value: 'Napisz do nas'
				},
				duration: 1.5,
				delay: 0.5,
				ease: 'none',
				scrollTrigger: {
					trigger: '#contact',
					start: 'top 100%'
				}
			});
			gsap.fromTo('#contact_title_type_cursor', {autoAlpha: 0, x: -20}, {autoAlpha: 1, duration: 1, repeat: -1, ease: SteppedEase.config(1)});
		}
		
		if(document.getElementsByClassName('fade-up').length > 0)
		{
			gsap.utils.toArray('.fade-up').forEach((elem) => {
				let f = gsap.timeline({
				scrollTrigger: {
					trigger: elem,
					start: 'top 85%',
					end: 'top 50%',
				},
				}).from(elem, {y:70, duration:1, opacity: 0, ease:'none'})
			});
		}
		
		if(document.getElementsByClassName('fade-left').length > 0)
		{
			gsap.utils.toArray('.fade-left').forEach((elem) => {
				let g = gsap.timeline({
					scrollTrigger: {
						trigger: elem,
						start: 'top 85%',
						end: 'top 50%'
					},
				}).from(elem, {x:70, duration:1, opacity: 0, ease:'none'})
			});
		}
		
		if(document.getElementsByClassName('fade-right').length > 0)
		{
			gsap.utils.toArray('.fade-right').forEach((elem) => {
				let h = gsap.timeline({
					scrollTrigger: {
						trigger: elem,
						start: 'top 85%',
						end: 'top 50%',
					},
				}).from(elem, {x:-70, duration:1, opacity: 0, ease:'none'})
			});
		}
		
		function getSamePageAnchor (link) {
			if (link.protocol !== window.location.protocol || link.host !== window.location.host || link.pathname !== window.location.pathname || link.search !== window.location.search)
			{
				return false;
			}
			return link.hash;
		}

		function scrollToHash(hash, e) {
			var outerheight = document.getElementById('header_top').offsetHeight + 40;
			const elem = hash ? document.querySelector(hash) : false;
			if(elem)
			{
				if(e) e.preventDefault();
					gsap.to(window,{scrollTo:{y:elem,offsetY:outerheight}});
			}
		}

		document.querySelectorAll('a[href^=\"#\"]').forEach(a => {
			a.addEventListener('click', e => {
				scrollToHash(getSamePageAnchor(a), e);
			});
		});
		
		window.addEventListener('load', function () {			
			if(window.location.hash)
			{
				scrollToHash(window.location.hash);
			}
			
			if(document.getElementById('menu_bar') && document.getElementById('menu_top'))
			{
				var x = document.getElementById('menu_top');
				if (window.innerWidth <= 1024)
				{
					x.style.display = 'none';
					
					var elms = document.querySelectorAll('#menu_top ul li a[href^=\"#\"]');
					for(var i = 0; i < elms.length; i++)
					{
						elms[i].addEventListener('click', function(event) {
							document.getElementById('menu_bar').classList.toggle('active-bar');
							if (x.style.display === 'none')
							{
								x.style.display = 'block';
							}
							else
							{
								x.style.display = 'none';
							}
						});
					}
					
				}

				document.getElementById('menu_bar').addEventListener('click', function() {
					document.getElementById('menu_bar').classList.toggle('active-bar');
					if (x.style.display === 'none')
					{
						x.style.display = 'block';
					}
					else
					{
						x.style.display = 'none';
					}
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
add_image_size('medium_size', 700, 380, true);
add_image_size('logo_size', 300, 300, false);

function custom_title($atts) {
	$default = array(
		'paragraph' => 'p',
		'title' => null,
		'extra_class' => null
	);
	$a = shortcode_atts($default, $atts);
	return '<div class="section-title-content '.$a['extra_class'].'"><'.$a['paragraph'].' class="section-title">'.$a['title'].'</'.$a['paragraph'].'></div>';
}
add_shortcode('custom_title', 'custom_title');

function portfolio_post_type() {
	$args = [
		'label'  => 'Portfolio',
		'labels' => [
			'menu_name' => 'Portfolio',
			'name_admin_bar' => 'Portfolio',
			'add_new' => 'Dodaj portfolio',
			'add_new_item' => 'Dodaj nowe portfolio',
			'new_item' => 'Nowe portfolio',
			'edit_item' => 'Edytuj portfolio',
			'view_item' => 'Zobacz portfolio',
			'update_item' => 'Zaktualizuj portfolio'
		],
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_rest' => true,
		'capability_type' => 'post',
		'has_archive' => 'portfolio',
		'hierarchical' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite_no_front' => false,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-nametag',
		'supports' => [
			'title', 'editor', 'thumbnail'
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('portfolio', $args);
}
add_action('init', 'portfolio_post_type');

function case_study_post_type() {
	$args = [
		'label'  => 'Case Study',
		'labels' => [
			'menu_name' => 'Case Study',
			'name_admin_bar' => 'Case Study',
			'add_new' => 'Dodaj case study',
			'add_new_item' => 'Dodaj nowe case study',
			'new_item' => 'Nowe case study',
			'edit_item' => 'Edytuj case study',
			'view_item' => 'Zobacz case study',
			'update_item' => 'Zaktualizuj case study'
		],
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_rest' => true,
		'capability_type' => 'post',
		'has_archive' => 'case-study',
		'hierarchical' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite_no_front' => false,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-media-interactive',
		'supports' => [
			'title', 'editor', 'thumbnail'
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('case-study', $args);
}
add_action('init', 'case_study_post_type');

function category_case_study_taxonomy() {
	$args = [
		'label'  => 'Kategoria',
		'labels' => [
			'menu_name' => 'Kategoria',
			'add_new_item' => 'Dodaj nową kategorie',
			'edit_item' => 'Edytuj kategorie',
			'update_item' => 'Zaktualizuj kategorie',
			'not_found' => 'Nie znaleziono żadnych kategorii.'
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
	register_taxonomy('kategoria-case-study', [ 'case-study' ], $args);
}
add_action('init', 'category_case_study_taxonomy');

function category_portfolio_taxonomy() {
	$args = [
		'label'  => 'Kategoria',
		'labels' => [
			'menu_name' => 'Kategoria',
			'add_new_item' => 'Dodaj nową kategorie',
			'edit_item' => 'Edytuj kategorie',
			'update_item' => 'Zaktualizuj kategorie',
			'not_found' => 'Nie znaleziono żadnych kategorii.'
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
	register_taxonomy('kategoria-portfolio', ['portfolio'], $args);
}
add_action('init', 'category_portfolio_taxonomy');

add_filter('mb_settings_pages', function ($settings_pages) {
	$settings_pages[] = [
		'id' => 'goldenrocket-settings',
		'option_name' => 'goldenrocket_settings',
		'menu_title' => 'Opcje strony',
		'submit_button' => 'Zapisz ustawienia'
	];
	return $settings_pages;
});

function register_meta_boxes_goldenrocket_settings($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Ustawienia',
		'id' => null,
		'settings_pages' => 'goldenrocket-settings',
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'Formularz kontaktowy'
			],
			[
				'name' => 'Dodaj shortcode',
				'id' => 'form_shortcode',
				'type' => 'text'
			],
			[
				'type' => 'heading',
				'name' => 'ADRES'
			],
			[
				'name' => 'Dodaj',
				'id' => 'footer_adress',
				'type' => 'textarea'
			],
			[
				'type' => 'heading',
				'name' => 'SOCIAL'
			],
			[
				'name' => 'Facebook',
				'id' => 'facebook_url',
				'type' => 'url'
			],
			[
				'name' => 'Instagram',
				'id' => 'instagram_url',
				'type' => 'url'
			],
			[
				'name' => 'Linkedin',
				'id' => 'linkedin_url',
				'type' => 'url'
			],
			[
				'name' => 'TikTok',
				'id' => 'tiktok_url',
				'type' => 'url'
			],
			[
				'type' => 'heading',
				'name' => 'Współrzędne geograficzne'
			],
			[
				'name' => 'Dodaj',
				'id' => 'page_coordinates',
				'type' => 'text',
				'sanitize_callback' => 'none'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_goldenrocket_settings');

function register_meta_boxes_custom_frontpage($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include' => [
			'relation' => 'OR',
			'ID' => get_option('page_on_front', true)
		],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'OBRAZKI TŁA'
			],
			[
				'name' => 'Obrazek 1',
				'id' => 'bg_img_one_front_page',
				'type' => 'single_image',
			],
			[
				'name' => 'Obrazek 2',
				'id' => 'bg_img_two_front_page',
				'type' => 'single_image',
			],
			[
				'type' => 'heading',
				'name' => 'SHOWREEL'
			],
			[
				'name' => 'Dodaj',
				'id' => 'showreel_front_page',
				'type' => 'video',
				'max_file_uploads' => 1
			],
			[
				'type' => 'heading',
				'name' => 'VIDEO'
			],
			[
				'name' => 'Dodaj',
				'id' => 'video_front_page',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Nazwa',
						'id' => 'video_name',
						'type' => 'text'
					],
					[
						'name' => 'Plik MP4',
						'id' => 'video_file',
						'type' => 'video',
						'max_file_uploads' => 1
					],
					[
						'name' => 'Obrazek',
						'id' => 'video_img',
						'type' => 'single_image'
					],
					[
						'name' => 'URL',
						'id' => 'video_url',
						'type' => 'url'
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'OFERTA'
			],
			[
				'name' => 'Dodaj',
				'id' => 'offer_front_page',
				'type' => 'wysiwyg',
			],
			[
				'name' => 'Boxy',
				'id' => 'offer_box_front_page',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Nazwa',
						'id' => 'box_name',
						'type' => 'text'
					],
					[
						'name' => 'Ikonka',
						'id' => 'box_icon',
						'type' => 'single_image'
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'LICZBY'
			],
			[
				'name' => 'Dodaj',
				'id' => 'counter_front_page',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Liczba',
						'id' => 'counter_number',
						'type' => 'number'
					],
					[
						'name' => 'Nazwa',
						'id' => 'counter_name',
						'type' => 'text'
					],
					[
						'name' => 'Opis',
						'id' => 'counter_txt',
						'type' => 'text'
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'LOGA'
			],
			[
				'name' => 'Dodaj',
				'id' => 'logos_front_page',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Logo',
						'id' => 'logo_img',
						'type' => 'single_image'
					],
					[
						'name' => 'URL',
						'id' => 'logo_url',
						'type' => 'url'
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'KONTAKT'
			],
			[
				'name' => 'Dodaj boxy',
				'id' => 'contact_box',
				'clone' => true,
				'sort_clone' => true,
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			],
			[
				'type' => 'heading',
				'name' => 'STOPKA'
			],
			[
				'name' => 'Slogan',
				'id' => 'footer_slogan',
				'type' => 'text',
				'sanitize_callback' => 'none'
			],
			[
				'type' => 'heading',
				'name' => 'STRONA CASE STUDY'
			],
			[
				'name' => 'Tytuł',
				'id' => 'page_case_study_title',
				'type' => 'text',
			],
			[
				'name' => 'Opis',
				'id' => 'page_case_study_txt',
				'type' => 'wysiwyg',
			],
			[
				'type' => 'heading',
				'name' => 'STRONA PORTFOLIO'
			],
			[
				'name' => 'Tytuł',
				'id' => 'page_offer_title',
				'type' => 'text',
			],
			[
				'name' => 'Opis',
				'id' => 'page_offer_txt',
				'type' => 'wysiwyg',
			],
			[
				'name' => 'Showreel',
				'id' => 'page_offer_showreel',
				'type' => 'video',
				'max_file_uploads' => 1
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_frontpage');

function register_meta_boxes_case_study($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'case-study',
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'LICZBY'
			],
			[
				'name' => 'Dodaj',
				'id' => 'count_case_study',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Numer',
						'id' => 'count_number',
						'type' => 'number'
					],
					[
						'name' => 'Opis',
						'id' => 'count_txt',
						'type' => 'textarea'
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'GALERIA'
			],
			[
				'name' => 'Dodaj',
				'id' => 'gallery_case_study',
				'type' => 'image_advanced',
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_case_study');

function register_meta_boxes_offer($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'portfolio',
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'VIDEO'
			],
			[
				'name' => 'Dodaj',
				'id' => 'offer_video',
				'type' => 'video',
				'max_file_uploads' => 1
			],
			[
				'type' => 'heading',
				'name' => 'SHORTCODE PDF'
			],
			[
				'name' => 'Dodaj',
				'id' => 'offer_shortcode_pdf',
				'type' => 'text'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_offer');

function register_meta_boxes_about_us($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['about-us.php']
        ],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'TYTUŁ'
			],
			[
				'name' => 'Dodaj',
				'id' => 'about_us_title',
				'type' => 'text',
			],
			[
				'type' => 'heading',
				'name' => 'CO NAS WYRÓŻNIA'
			],
			[
				'name' => 'Dodaj',
				'id' => 'distinction_about_us',
				'type' => 'textarea',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'sanitize_callback' => 'none'
			],
			[
				'type' => 'heading',
				'name' => 'DOŚWIADCZENIE'
			],
			[
				'name' => 'Opis',
				'id' => 'about_us_experience',
				'type' => 'wysiwyg',
			],
			[
				'type' => 'heading',
				'name' => 'NAGRODY'
			],
			[
				'name' => 'Dodaj',
				'id' => 'awards_about_us',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields' => [
					[
						'name' => 'Nazwa',
						'id' => 'award_name_about_us',
						'type' => 'text'
					],
					[
						'name' => 'Kategoria',
						'id' => 'award_cat_about_us',
						'type' => 'text'
					],
					[
						'name' => 'URL',
						'id' => 'award_url_about_us',
						'type' => 'url'
					]
				]
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_about_us');

function register_meta_boxes_portfolio_taxonomy($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'taxonomies' => 'kategoria-portfolio',
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'VIDEO'
			],
			[
				'name' => 'Dodaj',
				'id' => 'portfolio_taxonomy_video',
				'type' => 'video',
				'max_file_uploads' => 1
			],
			[
				'type' => 'heading',
				'name' => 'OBRAZEK'
			],
			[
				'name' => 'Dodaj',
				'id' => 'portfolio_taxonomy_img',
				'type' => 'single_image',
			],
			[
				'type' => 'heading',
				'name' => 'Kod PDF'
			],
			[
				'name' => 'Dodaj',
				'id' => 'portfolio_taxonomy_pdf',
				'type' => 'text',
			],
			[
				'type' => 'heading',
				'name' => 'Kod GALERI'
			],
			[
				'name' => 'Dodaj',
				'id' => 'gallery_taxonomy_pdf',
				'type' => 'text',
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_portfolio_taxonomy');