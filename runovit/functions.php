<?php

function menus() {
	$locations = array(
		'primary_menu' => 'Menu Główne',
		'footer_menu_1' => 'Menu w stopce 1',
		'footer_menu_2' => 'Menu w stopce 2',
		'footer_menu_3' => 'Menu w stopce 3'
	);
	register_nav_menus($locations);
}
add_action('init', 'menus');

function add_styles() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.3');
}
add_action('wp_enqueue_scripts', 'add_styles', 55);

function add_scripts() {
	wp_enqueue_script('script-file', get_template_directory_uri().'/js/script.js');
}
add_action('wp_footer', 'add_scripts');

function wp_script_page() {
	echo "<script>
		if(document.getElementById('slider_homepage'))
		{
			var slider_homepage = new Swiper('#slider_homepage', {
				rewind: true,
				spaceBetween: 0,
				effect: 'fade',
				slidesPerView: 1,
				navigation: {
					enabled: false,
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				breakpoints: {
					768: {
						navigation: {
							enabled: true,
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						}
					}
				}
			});
		}
		if(document.getElementById('menu_bar') && document.getElementById('menu_top'))
		{
			document.getElementById('menu_bar').addEventListener('click', function() {
				document.getElementById('menu_bar').classList.toggle('active-bar');
				document.getElementById('menu_top').classList.toggle('active-menu');
			});
		}
		jQuery(document).ready(function(){
			jQuery('body').on('woosw_change_count', function(event, count) {
				jQuery('.icon-woo li .wishlist-count').html(count);
			});
		});
	</script>";
	
	if(class_exists('WooCommerce'))
	{
		if(is_account_page())
		{
			echo "<script>	
				jQuery(document).ready(function(){
					jQuery('.woocommerce.woocommerce-account .button').addClass('button-fill');
				});
			</script>";
		}
	}
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

function disable_emojis() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

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

function shop_category() {
	$args = array(
		'name' => 'Kategorie produktów',
		'id' => 'shop_category',
		'description' => 'Dodaj widgety.',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widgettitle">',
		'after_title' => '</p>'
	);
	register_sidebar($args);
}
add_action('widgets_init', 'shop_category');

function shop_filter() {
	$args = array(
		'name' => 'Filtry produktów',
		'id' => 'shop_filter',
		'description' => 'Dodaj widgety.',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widgettitle">',
		'after_title' => '</p>'
	);
	register_sidebar($args);
}
add_action('widgets_init', 'shop_filter');

function newsletter_widget() {
	$args = array(
		'name' => 'Newsletter',
		'id' => 'newsletter_widget',
		'description' => 'Dodaj widgety.',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widgettitle">',
		'after_title' => '</p>'
	);
	register_sidebar($args);
}
add_action('widgets_init', 'newsletter_widget');

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

function custom_button($atts) {
    $default = array(
		'url' => '#',
		'text' => null,
		'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
    return '<p class="'.$a['extra_class'].'"><a class="button button-fill" href="'.esc_url($a['url']).'">'.$a['text'].'</a></p>';
}
add_shortcode('custom_button', 'custom_button');

function read_more($atts) {
    $default = array(
		'url' => '#',
		'text' => null,
		'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
    return '<p class="'.$a['extra_class'].'"><a class="read-more" href="'.esc_url($a['url']).'">'.$a['text'].' <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/> </svg> </a></p>';
}
add_shortcode('read_more', 'read_more');

function custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

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

function register_meta_boxes_custom_frontpage($meta_boxes) {
	$meta_boxes[] = [
		'title'  => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include' => [
			'relation' => 'OR',
			'ID' => get_option('page_on_front')
		],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'BOXY POLECANYCH PRODUKTÓW'
			],
			[
				'name' => 'Dodaj',
				'id' => 'home_box_featured',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'fields' => [
					[
						'name' => 'Nazwa',
						'id'=> 'home_box_featured_name',
						'type' => 'text',
					],
					[
						'name' => 'Ikonka',
						'id' => 'home_box_featured_icon',
						'type' => 'text',
					],
					[
						'name' => 'Wybierz kategorie',
						'id' => 'home_box_featured_category',
						'type' => 'taxonomy_advanced',
						'taxonomy' => 'product_cat',
						'field_type' => 'checkbox_tree',
						'query_args' => [
							'parent' => 0
						]
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'SEKCJA INFORMACYJNA 1'
			],
			[
				'name' => 'Opis',
				'id' => 'home_section_one',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			],
			[
				'name' => 'Obrazek',
				'id' => 'home_section_img_one',
				'type' => 'single_image'
			],
			[
				'type' => 'heading',
				'name' => 'BOXY'
			],
			[
				'name' => 'Opis',
				'id' => 'home_section_box',
				'clone' => true,
				'sort_clone' => true,
				'type' => 'wysiwyg'
			],
			[
				'type' => 'heading',
				'name' => 'BOXY Z OFERTĄ'
			],
			[
				'name' => 'Dodaj',
				'id' => 'home_box_offer',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'fields' => [
					[
						'name' => 'Nazwa',
						'id'=> 'home_box_offer_name',
						'type' => 'text',
					],
					[
						'name' => 'Linki',
						'id' => 'home_box_offer_url',
						'type' => 'group',
						'clone' => true,
						'sort_clone' => true,
						'fields' => [
							[
								'name' => 'Nazwa',
								'id'=> 'home_box_offer_url_name',
								'type' => 'text',
							],
							[
								'name' => 'URL',
								'id'=> 'home_box_offer_url_url',
								'type' => 'url',
							]
						]
					],
					[
						'name' => 'Boxy',
						'id' => 'home_box_offer_item',
						'clone' => true,
						'sort_clone' => true,
						'type' => 'wysiwyg'
					]
				]
			],
			[
				'type' => 'heading',
				'name' => 'SEKCJA INFORMACYJNA 2'
			],
			[
				'name' => 'Opis',
				'id' => 'home_section_two',
				'type' => 'wysiwyg',
				'options' => [
					'media_buttons' => false
				]
			],
			[
				'name' => 'Obrazek',
				'id' => 'home_section_img_two',
				'type' => 'single_image'
			],
			[
				'type' => 'heading',
				'name' => 'STOPKA'
			],
			[
				'name' => 'Adres',
				'id' => 'adress_page',
				'type' => 'textarea'
			],
			[
				'name' => 'NIP',
				'id' => 'nip_page',
				'type' => 'text'
			],
			[
				'name' => 'E-mail',
				'id' => 'email_page',
				'type' => 'email'
			],
			[
				'name' => 'Telefon 1',
				'id' => 'email_page_one',
				'type' => 'text'
			],
			[
				'name' => 'Telefon 2',
				'id' => 'email_page_two',
				'type' => 'text'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_frontpage');

function register_meta_boxes_custom_page_about_us($meta_boxes) {
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
				'name' => 'IKONKA'
			],
			[
				'name' => 'Dodaj',
				'id' => 'about_us_icon',
				'type' => 'single_image'
			],
			[
				'type' => 'heading',
				'name' => 'BOXY LEWE'
			],
			[
				'name' => 'Nazwa',
				'id'=> 'about_us_left_offer_name',
				'type' => 'text',
			],
			[
				'name' => 'Obrazek',
				'id'=> 'about_us_left_offer_img',
				'type' => 'single_image',
			],
			[
				'name' => 'Tytuł linków',
				'id'=> 'about_us_left_offer_name_url',
				'type' => 'text',
			],
			[
				'name' => 'Linki',
				'id' => 'about_us_left_offer_url',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'fields' => [
					[
						'name' => 'Nazwa',
						'id'=> 'about_us_left_offer_url_name',
						'type' => 'text',
					],
					[
						'name' => 'URL',
						'id'=> 'about_us_left_offer_url_url',
						'type' => 'url',
					]
				]
			],
			[
				'name' => 'Boxy',
				'id' => 'about_us_left_offer_item',
				'clone' => true,
				'sort_clone' => true,
				'type' => 'wysiwyg'
			],
			[
				'type' => 'heading',
				'name' => 'BOXY PRAWE'
			],
			[
				'name' => 'Nazwa',
				'id'=> 'about_us_right_offer_name',
				'type' => 'text',
			],
			[
				'name' => 'Obrazek',
				'id'=> 'about_us_right_offer_img',
				'type' => 'single_image',
			],
			[
				'name' => 'Tytuł linków',
				'id'=> 'about_us_right_offer_name_url',
				'type' => 'text',
			],
			[
				'name' => 'Linki',
				'id' => 'about_us_right_offer_url',
				'type' => 'group',
				'clone' => true,
				'sort_clone' => true,
				'fields' => [
					[
						'name' => 'Nazwa',
						'id'=> 'about_us_right_offer_url_name',
						'type' => 'text',
					],
					[
						'name' => 'URL',
						'id'=> 'about_us_right_offer_url_url',
						'type' => 'url',
					]
				]
			],
			[
				'name' => 'Boxy',
				'id' => 'about_us_right_offer_item',
				'clone' => true,
				'sort_clone' => true,
				'type' => 'wysiwyg'
			]
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_about_us');

function register_meta_boxes_custom_page_offer($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['offer.php']
        ],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'Tytuł sekcji'
			],
			[
				'name' => 'Dodaj',
				'id'=> 'offer_section_title',
				'type' => 'text',
			],
			[
				'type' => 'heading',
				'name' => 'Typ danych'
			],
			[
				'name' => 'Wybierz',
				'id' => 'page_offer_type',
				'placeholder' => 'Zaznacz',
				'type' => 'select',
				'options' => [
					'grzyby' => 'Grzyby',
					'owoce' => 'Owoce'
				]
			],
			[
				'type' => 'heading',
				'name' => 'Tytuł danych kontakotwych'
			],
			[
				'name' => 'Dodaj',
				'id'=> 'offer_data_title',
				'type' => 'text',
			],
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_offer');

function register_meta_boxes_custom_page_wholesale($meta_boxes) {
	$meta_boxes[] = [
		'title' => 'Opcje',
		'id' => null,
		'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['wholesale.php']
        ],
		'fields' => [
			[
				'type' => 'heading',
				'name' => 'SEKCJA TEKSTOWA'
			],
			[
				'name' => 'Tytuł sekcji',
				'id'=> 'offer_section_title',
				'type' => 'text',
			],
			[
				'name' => 'Boxy',
				'id' => 'offer_section_box',
				'clone' => true,
				'sort_clone' => true,
				'type' => 'wysiwyg'
			],
			[
				'type' => 'heading',
				'name' => 'Tytuł danych kontakotwych'
			],
			[
				'name' => 'Dodaj',
				'id'=> 'offer_data_title',
				'type' => 'text',
			],
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_wholesale');

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
				'id' => 'url_map',
				'type' => 'url'
			],
		]
	];
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_page_contact');

if(class_exists('WooCommerce'))
{

	function add_woocommerce_support()
	{
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');
	}
	add_action('after_setup_theme', 'add_woocommerce_support');

	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	
	add_filter('woocommerce_product_tabs', '__return_empty_array');
	
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 29);
	
	function change_breadcrumb_delimiter($defaults)
	{
		$defaults['delimiter'] = '<span class="woocommerce-breadcrumb-delimiter">&#8250;</span>';
		return $defaults;
	}
	add_filter('woocommerce_breadcrumb_defaults', 'change_breadcrumb_delimiter');
	
	function add_to_cart_fragment($fragments)
	{
		$fragments['.icon-woo li a .cart-top'] = '<span class="count cart-top">'.WC()->cart->get_cart_contents_count().'</span>';
		return $fragments;
	}
	add_filter('woocommerce_add_to_cart_fragments', 'add_to_cart_fragment');
	
	function add_grammage_list_product()
	{
		global $product;
		if(has_term('', 'pa_gramatura', $product->get_id()))
		{
			echo '<div class="product-grammage">'.strip_tags(get_the_term_list($product->get_id(), 'pa_gramatura', '', ', ')).'</div>';
		}
	}
	add_filter('woocommerce_before_shop_loop_item_title', 'add_grammage_list_product', 5);
	
	function add_form_list_product()
	{
		global $product;
		global $woocommerce_loop;
		if(has_term('', 'pa_forma-grzybow', $product->get_id()))
		{
			if(is_product() && $woocommerce_loop['name'] != 'related' && $woocommerce_loop['name'] != 'upsells')
			{
				echo '<div style="font-size:16px;font-weight:700;margin-bottom:25px;">';
			}
			echo '<div class="product-form">';
			if(has_term('krajanka', 'pa_forma-grzybow', $product->get_id()))
			{
				echo '<span class="runovit_ico_tasak" style="margin-right:4px;"></span> ';
			}
			if(has_term('kapelusz', 'pa_forma-grzybow', $product->get_id()))
			{
				echo '<span class="runovit_ico_cleaver" style="margin-right:4px;"></span> ';
			}
			echo strip_tags(get_the_term_list($product->get_id(), 'pa_forma-grzybow', '', ', '));
			if(is_product() && $woocommerce_loop['name'] != 'related' && $woocommerce_loop['name'] != 'up-sells')
			{
				if(has_term('', 'pa_gramatura', $product->get_id()))
				{
					echo '<span style="padding:0 15px;"></span>';
					echo '<span class="runovit_ico_jar" style="margin-right:4px;"></span> ';
					echo strip_tags(get_the_term_list($product->get_id(), 'pa_gramatura', '', ', '));
				}
				echo '</div>';
			}
			echo '</div>';
		}
	}
	add_filter('woocommerce_shop_loop_item_title', 'add_form_list_product', 11);
	add_filter('woocommerce_single_product_summary', 'add_form_list_product', 21);
	
	function add_info_shipping()
	{
		echo '<div class="product-shipping-info"><span class="runovit_ico_gift"></span>'.__('Darmowa dostawa od 200.00 zł', 'runovit').'</div>';
	}
	add_filter('woocommerce_single_product_summary', 'add_info_shipping', 49);
	
	function terms_and_conditions_to_registration()
	{
		if(wc_get_page_id( 'terms' ) > 0 && is_account_page())
		{
	?>
		<p class="form-row terms wc-terms-and-conditions">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
				<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset($_POST['terms'])), true); ?> id="terms"/> <span><?php wc_terms_and_conditions_checkbox_text(); ?></span> <span class="required">*</span>
			</label>
			<input type="hidden" name="terms-field" value="1" />
		</p>
	<?php
		}
	}
	add_action('woocommerce_register_form', 'terms_and_conditions_to_registration', 1);

	function terms_and_conditions_validation($username, $email, $validation_errors)
	{
		if(!isset($_POST['terms']))
		{
			$validation_errors->add('terms_error', __( 'Proszę zaakceptować regulamin', 'runovit'));
		}
		return $validation_errors;
	}
	add_action('woocommerce_register_post', 'terms_and_conditions_validation', 20, 3);
	
	function hover_img_product_archive() {
		$image_id = wc_get_product()->get_gallery_image_ids();
		if(isset($image_id[0]))
		{
			echo '<div class="woocommerce-loop-product__hover">';
			echo wp_get_attachment_image($image_id[0]);
			echo '</div>';
		}
	}
	add_action('woocommerce_before_shop_loop_item_title', 'hover_img_product_archive', 11);
	
	function woo_pagination($args) {
		$args['prev_text'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>';
		$args['next_text'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>';
		return $args;
	}
	add_filter('woocommerce_pagination_args', 'woo_pagination');
}
