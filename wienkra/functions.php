<?php

function get_api_course_url() {
	return 'https://szkolenia.wienkra.pl';
}

function menus() {
  $locations = array(
  'primary_menu' => 'Menu Główne',
  'footer_menu' => 'Menu w stopce');
  register_nav_menus( $locations );
}
add_action( 'init', 'menus' );

function add_script_styles() {
  $get_template_directory_uri = get_template_directory_uri();
  wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.5');
  wp_enqueue_style('style-map', $get_template_directory_uri.'/css/cssmap-poland.css');
  wp_enqueue_script('script-calendar', $get_template_directory_uri.'/js/calendar.js');
}
add_action('wp_enqueue_scripts', 'add_script_styles', 55);

function add_scripts() {
	$get_template_directory_uri = get_template_directory_uri();
	wp_enqueue_script('jquery');
	wp_enqueue_script('script-file', $get_template_directory_uri.'/js/script.js');
	wp_enqueue_script('script-map', $get_template_directory_uri.'/js/jquery.cssmap.min.js');
	wp_enqueue_script('ajax-representative',  $get_template_directory_uri.'/js/ajax-representative.js', array(), '1.1');
    wp_localize_script('ajax-representative', 'ajaxrepresentative', array(
	     'ajaxurl' => admin_url('admin-ajax.php')
    ));
	wp_enqueue_script('ajax-course-form',  $get_template_directory_uri.'/js/ajax-course-form.js');
    wp_localize_script('ajax-course-form', 'ajaxrcourseform', array(
	     'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_footer', 'add_scripts');

function remove_wp_block_library_css(){
  if(class_exists('Classic_Editor'))
  {
	wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );
  }
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );

function wp_script_page() {
echo
  "<script>

  const lightbox = GLightbox();

  if(document.getElementById('slider_front_page'))
  {
    var slider_front_page = new Swiper(\"#slider_front_page\", {
		rewind: true,
		slidesPerView: 1
    });

	slider_front_page.on('slideChange', function (e) {
		jQuery(\".slider-front-page-content .slider-front-page-pagination ul li\").removeClass(\"active\");
		jQuery(\".slider-front-page-content .slider-front-page-pagination ul li[data-number='\" + e.activeIndex +\"']\").addClass(\"active\");
	});

	jQuery(document).ready(function(){
		jQuery(\".slider-front-page-content .slider-front-page-pagination ul li\").click(function(){
			if(typeof jQuery(this).data(\"number\") != \"undefined\")
			{
				slider_front_page.slideTo(jQuery(this).data(\"number\"));
				jQuery(\".slider-front-page-content .slider-front-page-pagination ul li\").removeClass(\"active\");
				jQuery(this).addClass(\"active\");
			}
		});
	});

  }
  
  if(document.getElementById('map_provinces_sales_representative'))
  {
	jQuery(document).ready(function(){
		jQuery(\"#map_provinces_sales_representative\").CSSMap({
		  \"size\": 650,
		  \"mapStyle\": \"vintage\",
		  \"cities\": true,
		  \"tapOnce\": true,
		  \"tooltips\": \"floating-top-center\",
		  \"responsive\": \"auto\",
		  onClick: function(e) {
			  jQuery('.terms-inline-button ul li a').removeClass('active');
			  var code = e.children(\"A\").eq(0).attr(\"href\");
			  jQuery.ajax({
					url: ajaxrepresentative.ajaxurl,
					type: 'post',
					data: {
					  action: 'ajax_representative',
					  term_id: code
					},
					beforeSend: function() {
						jQuery('.map-provinces-sales-representative').addClass('active');
					},
					success: function(data) {
						jQuery('.representative-contact-page').html(data);
						jQuery([document.documentElement, document.body]).animate({
							scrollTop: jQuery('.list-post.representative-post').offset().top
						}, 1000);
						jQuery('.map-provinces-sales-representative').removeClass('active');
					},
					error: function() {
					  alert('Error');
					  jQuery('.map-provinces-sales-representative').removeClass('active');
					}
			  })
		  }
		});
	});
  }

  if(document.getElementById('slider_logos'))
	{
		var slider_logos = new Swiper(\"#slider_logos\", {
			rewind: true,
			slidesPerView: 2,
			spaceBetween: 35,
			navigation: {
				nextEl: \".swiper-button-next.swiper-button-logos-next\",
				prevEl: \".swiper-button-prev.swiper-button-logos-prev\",
			},
			breakpoints: {
				578: {
				  slidesPerView: 3
				},
				 768: {
				  slidesPerView: 5
				}
			}
		});
	}

  jQuery(document).ready(function(){

		if(document.getElementById('f_gas_input'))
		{
			jQuery('#f_gas_input').mask('FGAZ-P/00/0000/00', {translation: {'A': {pattern: /[\/]/, fallback: 'A'}}, placeholder: 'FGAZ-P/__/_____/__'});
		}
		
		if(document.getElementById('zipcode'))
		{
			jQuery('#zipcode').mask('00-000');
		}
		
		if(document.getElementById('col2_company_address_4'))
		{
			jQuery('#col2_company_address_4').mask('00-000');
		}
		
		if(document.getElementById('col1_address_4'))
		{
			jQuery('#col1_address_4').mask('00-000');
		}

	  jQuery(\"form#searchform div input[type=text]\").attr(\"placeholder\", \"".__('Szukaj...', 'wienkra')."\");

	  if(jQuery(window).width() < 768)
	  {
		  jQuery(\"header .menu-top\").append(\"<div class='close-menu-top'>&#10005;</div>\");
		  jQuery(\"header .header .header-content .data-top\").clone().appendTo(\"header .menu-top\");
		  jQuery(\"header .header .header-content .search-top\").css(\"margin-bottom\", \"0\");
		  jQuery(\"header .header .header-content .data-top\").remove();
	  }

	  jQuery(\"header .header .menu-bar, header .menu-top .close-menu-top\").click(function(){
		jQuery(\"header .menu-top\").toggleClass(\"active-menu\");
		jQuery(\"header .header .menu-bar\").toggleClass(\"active-bar\");
	  });
	  
	  jQuery('.wpcf7 .wpcf7-submit').click(function(event) {
			jQuery(this).css({'visibility':'hidden','pointer-events':'none'});
	  });

  });

	document.addEventListener('wpcf7submit', function(event) {
		jQuery('.wpcf7 .wpcf7-submit').css({'visibility':'visible','pointer-events':'auto'});
	}, false);

	document.addEventListener('wpcf7invalid', function(event) {
		jQuery('.wpcf7 .wpcf7-submit').css({'visibility':'visible','pointer-events':'auto'});		
	}, false);

	document.addEventListener('wpcf7mailsent', function(event) {
		jQuery('.wpcf7 .wpcf7-submit').css({'visibility':'visible','pointer-events':'auto'});		
	}, false);

  </script>";
}
add_action('wp_footer', 'wp_script_page', 55);

function remove_version_generator() {
return '';
}
add_filter('the_generator', 'remove_version_generator');

function remove_version_from_style_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_version_from_style_js');
add_filter( 'script_loader_src', 'remove_version_from_style_js');

add_image_size( 'logos_img', 300 );

add_theme_support( 'post-thumbnails' );
add_theme_support('custom-logo');

function ajax_representative() {
    $term_id = $_POST['term_id'];
    if(is_numeric($term_id) || $term_id == 'all' || $term_id == '#dolnoslaskie' || $term_id == '#kujawsko-pomorskie' || $term_id == '#lubelskie' || $term_id == '#lubuskie' || $term_id == '#lodzkie' || $term_id == '#malopolskie' || $term_id == '#mazowieckie' || $term_id == '#opolskie' || $term_id == '#podkarpackie' || $term_id == '#podlaskie' || $term_id == '#pomorskie' || $term_id == '#slaskie' || $term_id == '#swietokrzyskie' || $term_id == '#warminsko-mazurskie' || $term_id == '#wielkopolskie' || $term_id == '#zachodniopomorskie')
    {
		if($term_id == 0 || $term_id == 'all')
		{
			if($term_id == 'all')
			{
				$args_representative = array('post_type' => 'przedstawiciel', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date', 'post_status' => 'publish');
			}
			else
			{
				$args_representative = array('post_type' => 'przedstawiciel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date', 'post_status' => 'publish');
			}

		}
		elseif($term_id == '#dolnoslaskie' || $term_id == '#kujawsko-pomorskie' || $term_id == '#lubelskie' || $term_id == '#lubuskie' || $term_id == '#lodzkie' || $term_id == '#malopolskie' || $term_id == '#mazowieckie' || $term_id == '#opolskie' || $term_id == '#podkarpackie' || $term_id == '#podlaskie' || $term_id == '#pomorskie' || $term_id == '#slaskie' || $term_id == '#swietokrzyskie' || $term_id == '#warminsko-mazurskie' || $term_id == '#wielkopolskie' || $term_id == '#zachodniopomorskie')
		{
			$term_id = str_replace('#', '', $term_id);
			$args_representative = array('post_type' => 'przedstawiciel', 'order' => 'DESC', 'orderby' => 'date', 'post_status' => 'publish', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'wojewodztwo', 'field' => 'slug', 'terms' => $term_id)));
		}
		else
		{
			$args_representative = array('post_type' => 'przedstawiciel', 'order' => 'DESC', 'orderby' => 'date', 'post_status' => 'publish', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'dzial', 'field' => 'term_id', 'terms' => $term_id)));
		}
		$representative_post = new WP_Query($args_representative);
		if($term_id == 'dolnoslaskie' || $term_id == 'kujawsko-pomorskie' || $term_id == 'lubelskie' || $term_id == 'lubuskie' || $term_id == 'lodzkie' || $term_id == 'malopolskie' || $term_id == 'mazowieckie' || $term_id == 'opolskie' || $term_id == 'podkarpackie' || $term_id == 'podlaskie' || $term_id == 'pomorskie' || $term_id == 'slaskie' || $term_id == 'swietokrzyskie' || $term_id == 'warminsko-mazurskie' || $term_id == 'wielkopolskie' || $term_id == 'zachodniopomorskie')
		{
			echo '<div class="section-title-content"><p class="section-title">'.get_term_by('slug', $term_id, 'wojewodztwo')->name.'</p></div>';
		}
		elseif($term_id != 0 && $term_id != 'all')
		{
			echo '<div class="section-title-content"><p class="section-title">'.get_term($term_id, 'dzial')->name.'</p></div>';
		}
		if($representative_post -> have_posts())
		{
			echo '<div class="grid-5_lg-3_md-2_sm-1">';
				while ($representative_post -> have_posts()) : $representative_post -> the_post();
				echo get_template_part('template-parts/list', 'representative');
				endwhile; wp_reset_postdata();
			echo '</div>';
			if($term_id == 0)
			{
				//echo '<p class="text-center"><a class="custom-button js-load-all" href="'.get_post_type_archive_link('przedstawiciel').'">'.__('Zobacz wszystkich', 'wienkra').'</a></p>';
			}
		}
		else
		{
			echo '<p>'.__('Brak przedstawicieli.', 'wienkra').'</p>';
		}
    }
	else
	{
		return 0;
	}
    die();
}
add_action( 'wp_ajax_nopriv_ajax_representative', 'ajax_representative' );
add_action( 'wp_ajax_ajax_representative', 'ajax_representative' );

function ajax_course_from() {

	if(isset($_POST['data_form'][0]))
	{
		$id_course = null;
		$code_course = null;
		$name = null;
		$nip = null;
		$street = null;
		$street_number = null;
		$flat_number = null;
		$city = null;
		$zipcode = null;
		$voivodeship = null;
		$manager = null;
		$person = null;
		$email = null;
		$phone = null;
		$count = null;
		$agree_1 = null;
		$message = null;

		foreach($_POST['data_form'] as $single)
		{
			if($single['name'] == 'id_course')
			{
				if(is_numeric($single['value']))
				{
					$id_course = $single['value'];
				}
			}
			if($single['name'] == 'code_course')
			{
				if(!empty($single['value']))
				{
					$code_course = $single['value'];
				}
			}
			if($single['name'] == 'name')
			{
				if(!empty($single['value']))
				{			
					$name = str_replace('&', '%26', $single['value']);
				}
			}
			if($single['name'] == 'nip')
			{
				if(!empty($single['value']))
				{
					$nip = $single['value'];
				}
			}
			if($single['name'] == 'street')
			{
				if(!empty($single['value']))
				{
					$street = $single['value'];
				}
			}
			if($single['name'] == 'street_number')
			{
				if(!empty($single['value']))
				{
					$street_number = $single['value'];
				}
			}
			if($single['name'] == 'flat_number')
			{
				$flat_number = $single['value'];
			}
			if($single['name'] == 'zipcode')
			{
				if(!empty($single['value']))
				{
					$zipcode = $single['value'];
				}
			}
			if($single['name'] == 'city')
			{
				if(!empty($single['value']))
				{
					$city = $single['value'];
				}
			}
			if($single['name'] == 'person')
			{
				if(!empty($single['value']))
				{
					$person = $single['value'];
				}
			}
			if($single['name'] == 'email')
			{
				if(filter_var($single['value'], FILTER_VALIDATE_EMAIL))
				{
					$email = $single['value'];
				}
			}
			if($single['name'] == 'phone')
			{
				if(!empty($single['value']))
				{
					$phone = $single['value'];
				}
			}
			if($single['name'] == 'count')
			{
				if(is_numeric($single['value']))
				{
					$count = $single['value'];
				}
			}
			if($single['name'] == 'manager')
			{
				if(!empty($single['value']))
				{
					$manager = $single['value'];
				}
			}
			if($single['name'] == 'voivodeship')
			{
				if(!empty($single['value']))
				{
					$voivodeship = $single['value'];
				}
			}
			if($single['name'] == 'agree_1')
			{
				if(!empty($single['value']))
				{
					$agree_1 = $single['value'];
				}
			}
			if($single['name'] == 'message')
			{
				if(!empty($single['value']))
				{
					$message = $single['value'];
				}
			}
		}
		if(!empty($id_course) && !empty($code_course) && !empty($name) && !empty($nip) && !empty($street) && !empty($street_number) && !empty($city) && !empty($person) && !empty($email) && !empty($phone) && !empty($count) && !empty($manager) && !empty($voivodeship) && !empty($agree_1))
		{
			$url = get_api_course_url().'/include_course';
			$post = 'id_course=' . $id_course . '&code_course=' . $code_course . '&name=' . $name . '&nip=' . $nip . '&street=' . $street . '&street_number=' . $street_number . '&flat_number=' . $flat_number . '&city=' . $city . '&zipcode=' . $zipcode . '&voivodeship=' . $voivodeship . '&person=' . $person . '&email=' . $email . '&phone=' . $phone . '&manager=' . $manager . '&count=' . $count . '&message=' . $message;

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$response = curl_exec($ch);

			echo $response;
		}
		else
		{
			echo __('Błąd danych w formularzu', 'wienkra');
		}
	}
	else
	{
		echo __('Błąd zapytania', 'wienkra');
	}

    die();
}
add_action('wp_ajax_nopriv_ajax_course_form', 'ajax_course_from');
add_action('wp_ajax_ajax_course_form', 'ajax_course_from');


function custom_title($atts) {
    $default = array(
      'paragraph' => 'p',
      'title' => null,
      'text_title' => null,
      'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
    if(!empty($a['text_title']))
    {
      return '<div class="section-title-content '.$a['extra_class'].'"><'.$a['paragraph'].' class="section-title">'.$a['title'].'</'.$a['paragraph'].'><p class="section-title-text">'.$a['text_title'].'</p></div>';
    }
    else
    {
      return '<div class="section-title-content '.$a['extra_class'].'"><'.$a['paragraph'].' class="section-title">'.$a['title'].'</'.$a['paragraph'].'></div>';
    }
}
add_shortcode('custom_title', 'custom_title');

function custom_title_section($atts) {
    $default = array (
      'paragraph' => 'p',
      'text' => null,
      'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
    return '<'.$a['paragraph'].' class="custom-title-section '.$a['extra_class'].'">'.$a['text'].'</'.$a['paragraph'].'>';
}
add_shortcode('custom_title_section', 'custom_title_section');

function custom_hr($atts) {

    return '<div class="custom-hr-line"></div>';
}
add_shortcode('custom_hr', 'custom_hr');

function custom_button($atts) {
    $default = array(
      'url' => '#',
      'text' => '',
      'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
    return '<p class="'.$a['extra_class'].'"><a class="custom-button" href="'.esc_url($a['url']).'">'.$a['text'].'</a></p>';
}
add_shortcode('custom_button', 'custom_button');

function custom_button_with_icon($atts) {
    $default = array(
      'url' => '#',
      'text' => '',
	  'class_icon' => null,
      'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
	if(!empty($a['class_icon']))
	{
		return '<a class="custom-button-icon '.$a['extra_class'].'" href="'.esc_url($a['url']).'"><span class="'.$a['class_icon'].'"></span>'.$a['text'].'</a>';
	}
	else
	{
		return null;
	}
}
add_shortcode('custom_button_with_icon', 'custom_button_with_icon');

function return_separator($atts) {
    $default = array(
      'height' => '10'
    );
    $a = shortcode_atts($default, $atts);
    return '<div style="display:block;width:100%;height:'.$a['height'].'px"></div>';
}
add_shortcode('return_separator', 'return_separator');

function email_content($atts) {
    $default = array(
      'email' => null,
	  'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
	if(filter_var($a['email'], FILTER_VALIDATE_EMAIL))
	{
		return '<p class="email-with-icon '.$a['extra_class'].'"><span class="wienkra_icon_mail"></span><a rel="nofollow" href="mailto:'.antispambot($a['email']).'">'.__('E-mail:', 'wienkra').' '.antispambot($a['email']).'</a></p>';
	}
	else
	{
		return null;
	}
}
add_shortcode('email_content', 'email_content');

function phone_content($atts) {
    $default = array(
      'phone' => null,
	  'fax' => null,
	  'extra_class' => null
    );
    $a = shortcode_atts($default, $atts);
	$b = '<p class="phone-with-icon '.$a['extra_class'].'"><span class="wienkra_icon_phone"></span>';
	if(!empty($a['phone']))
	{
		$b = $b.'<a rel="nofollow" href="tel:'.preg_replace('/\s+/', '', $a['phone']).'">'.__('Tel.:', 'wienkra').' '.$a['phone'].'</a>';
	}
	if(!empty($a['fax']))
	{
		if(!empty($a['phone']))
		{
		 $b = $b.', ';
		}
		$b = $b.'<a rel="nofollow" href="tel:'.preg_replace('/\s+/', '', $a['fax']).'">'.__('Fax:', 'wienkra').' '.$a['fax'].'</a>';
	}
	$b = $b.'</p>';
	return $b;
}
add_shortcode('phone_content', 'phone_content');

function return_div($atts) {
    $default = array(
      'class' => null
    );
    $a = shortcode_atts($default, $atts);
    return '<div class="'.$a['class'].'">';
}
add_shortcode('return_div', 'return_div');

function close_div($atts) {
    return '</div>';
}
add_shortcode('close_div', 'close_div');

function file_list($atts) {

	$content = null;

    $default = array(
      'taxonomy' => null,
	  'slug' => null
    );
    $a = shortcode_atts($default, $atts);

	if(!empty($a['taxonomy']) && !empty($a['slug']))
	{
		$args_file = array('post_type' => 'pliki', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date', 'post_status' => 'publish', 'tax_query' => array(array('taxonomy' => $a['taxonomy'], 'field' => 'slug', 'terms' => $a['slug'])));
		$file_post = new WP_Query($args_file);

		if($file_post -> have_posts())
		{
			$content = '<ul class="list-file">';

			while($file_post -> have_posts()): $file_post -> the_post();
				$id_page = get_the_ID();
				$file_attachment = rwmb_meta('file_attachment', '', $id_page);
				if(is_array($file_attachment))
				{
					foreach($file_attachment as $file)
					{
						$content = $content.'<li>
							<a href="'.wp_get_attachment_url($file['ID']).'">'.get_the_title().'</a><br/>
							<small>'.get_the_date('F j Y').'</small>
						</li>';
					}
				}
			endwhile; wp_reset_postdata();

			$content = $content.'</ul>';

			return $content;
		}
		else
		{
			return $content;
		}

	}
	else
	{
		return $content;
	}
}
add_shortcode('file_list', 'file_list');

function representative_post_type() {
	$args = [
		'label'  => 'Przedstawiciele',
		'labels' => [
			'menu_name'          => 'Przedstawiciele',
			'name_admin_bar'     => 'Przedstawiciel',
			'add_new'            => 'Dodaj nowy',
			'add_new_item'       => 'Dodaj nowego przedstawiciela',
			'new_item'           => 'Nowy przedstawiciel',
			'edit_item'          => 'Edytuj przedstawiciela',
			'view_item'          => 'Zobacz przedstawiciela',
			'update_item'        => 'Zaktualizuj przedstawiciela'
		],
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'has_archive'         => 'przedstawiciele',
		'query_var'           => true,
		'can_export'          => true,
		'rewrite_no_front'    => false,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-admin-users',
		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('przedstawiciel', $args);
}
add_action('init', 'representative_post_type');

function product_post_type() {
	$args = [
		'label'  => 'Produkty',
		'labels' => [
			'menu_name'          => 'Produkty',
			'name_admin_bar'     => 'Produkt',
			'add_new'            => 'Dodaj nowy',
			'add_new_item'       => 'Dodaj nowy produkt',
			'new_item'           => 'Nowy produkt',
			'edit_item'          => 'Edytuj produkt',
			'view_item'          => 'Zobacz produkt',
			'update_item'        => 'Zaktualizuj produkt'
		],
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'has_archive'         => 'produkty',
		'query_var'           => true,
		'can_export'          => true,
		'rewrite_no_front'    => false,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-cart',
		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('produkt', $args);
}
add_action('init', 'product_post_type');

function file_post_type() {
	$args = [
		'label'  => 'Pliki',
		'labels' => [
			'menu_name'          => 'Pliki',
			'name_admin_bar'     => 'Pliki',
			'add_new'            => 'Dodaj pliki',
			'add_new_item'       => 'Dodaj nowy plik',
			'new_item'           => 'Nowy plik',
			'edit_item'          => 'Edytuj plik',
			'view_item'          => 'Zobacz plik',
			'update_item'        => 'Zaktualizuj plik'
		],
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'has_archive'         => 'pliki',
		'query_var'           => true,
		'can_export'          => true,
		'rewrite_no_front'    => false,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-media-document',
		'supports' => [
			'title'
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('pliki', $args);
}
add_action('init', 'file_post_type');

function department_taxonomy() {
	$args = [
		'label'  => 'Działy',
		'labels' => [
			'menu_name' => 'Działy',
			'add_new_item' => 'Dodaj nowy dział',
			'edit_item' => 'Edytuj dział',
			'update_item' => 'Zaktualizuj dział',
			'not_found' => 'Nie znaleziono żadnych działów.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('dzial', [ 'przedstawiciel' ], $args);
}
add_action('init', 'department_taxonomy');

function voivodship_taxonomy() {
	$args = [
		'label'  => 'Województwo',
		'labels' => [
			'menu_name' => 'Województwa',
			'add_new_item' => 'Dodaj nowe województwo',
			'edit_item' => 'Edytuj województwo',
			'update_item' => 'Zaktualizuj województwo',
			'not_found' => 'Nie znaleziono żadnych województw.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('wojewodztwo', [ 'przedstawiciel' ], $args);
}
add_action('init', 'voivodship_taxonomy');

function brand_taxonomy() {
	$args = [
		'label'  => 'Producent',
		'labels' => [
			'menu_name' => 'Producent',
			'add_new_item' => 'Dodaj nowego producenta',
			'edit_item' => 'Edytuj producenta',
			'update_item' => 'Zaktualizuj producenta',
			'not_found' => 'Nie znaleziono żadnych producentów.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('producent', [ 'produkt' ], $args);
}
add_action('init', 'brand_taxonomy');

function type_taxonomy() {
	$args = [
		'label'  => 'Typ',
		'labels' => [
			'menu_name' => 'Typ',
			'add_new_item' => 'Dodaj nowy typ',
			'edit_item' => 'Edytuj typ',
			'update_item' => 'Zaktualizuj typ',
			'not_found' => 'Nie znaleziono żadnych typów.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('typ', [ 'produkt' ], $args);
}
add_action('init', 'type_taxonomy');

function function_taxonomy() {
	$args = [
		'label'  => 'Funkcja',
		'labels' => [
			'menu_name' => 'Funkcja',
			'add_new_item' => 'Dodaj nową funkcję',
			'edit_item' => 'Edytuj funkcję',
			'update_item' => 'Zaktualizuj funkcję',
			'not_found' => 'Nie znaleziono żadnych funkcji.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('funkcja', [ 'produkt' ], $args);
}
add_action('init', 'function_taxonomy');

function solutions_taxonomy() {
	$args = [
		'label'  => 'Rozwiązania',
		'labels' => [
			'menu_name' => 'Rozwiązania',
			'add_new_item' => 'Dodaj nowe rozwiązanie',
			'edit_item' => 'Edytuj rozwiązanie',
			'update_item' => 'Zaktualizuj rozwiązanie',
			'not_found' => 'Nie znaleziono żadnych rozwiązań.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
			'slug' => 'rozwiazanie'
		]
	];
	register_taxonomy('rozwiazania', [ 'produkt' ], $args);
}
add_action('init', 'solutions_taxonomy');

function file_type_taxonomy() {
	$args = [
		'label'  => 'Typ pliku',
		'labels' => [
			'menu_name' => 'Typ pliku',
			'add_new_item' => 'Dodaj nowy typ pliku',
			'edit_item' => 'Edytuj typ pliku',
			'update_item' => 'Zaktualizuj typ pliku',
			'not_found' => 'Nie znaleziono żadnych typów pliku.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('typ-pliku', [ 'pliki' ], $args);
}
add_action('init', 'file_type_taxonomy');

function file_manufacturer_taxonomy() {
	$args = [
		'label'  => 'Producent',
		'labels' => [
			'menu_name' => 'Producent',
			'add_new_item' => 'Dodaj nowego producenta',
			'edit_item' => 'Edytuj producenta',
			'update_item' => 'Zaktualizuj producenta',
			'not_found' => 'Nie znaleziono żadnych producentów'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => true,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('producent-pliku', [ 'pliki' ], $args);
}
add_action('init', 'file_manufacturer_taxonomy');

add_filter('mb_settings_pages', function ($settings_pages) {
    $settings_pages[] = [
        'id'          => 'wienkra-settings',
        'option_name' => 'wienkra_settings',
        'menu_title'  => 'Opcje strony',
        'submit_button' => 'Zapisz ustawienia'
    ];
    return $settings_pages;
});

function register_meta_boxes_wienkra_settings( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Ustawienia WIENKRA',
        'id'     => null,
        'settings_pages' => 'wienkra-settings',
        'fields' => [
          [
              'type' => 'heading',
              'name' => 'DANE KONTAKTOWE',
          ],
          [
              'name' => 'E-mail',
              'id'   => $prefix . 'email_page',
              'type' => 'email',
          ],
          [
              'name' => 'Telefon',
              'id'   => $prefix . 'phone_page',
              'type' => 'text',
          ],
          [
              'name' => 'Facebook URL',
              'id'   => $prefix . 'facebook_page',
              'type' => 'url',
          ],
          [
              'name' => 'Linkedin URL',
              'id'   => $prefix . 'linkedin_page',
              'type' => 'url',
          ],
          [
              'name' => 'YouTube URL',
              'id'   => $prefix . 'youtube_page',
              'type' => 'url',
          ],
          [
              'type' => 'heading',
              'name' => 'PRZYCISK HEADER',
          ],
          [
              'name' => 'Nazwa',
              'id'   => $prefix . 'button_head_name',
              'type' => 'text',
          ],
          [
              'name' => 'URL',
              'id'   => $prefix . 'button_head_url',
              'type' => 'url',
          ],
		  [
              'type' => 'heading',
              'name' => 'LOGO W STOPCE',
          ],
		  [
              'name' => 'Dodaj',
              'id'   => $prefix . 'logo_footer',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'MAPA GOOGLE',
          ],
          [
              'name' => 'API Google Maps',
              'id'   => $prefix . 'api_google_maps',
              'type' => 'text',
          ],
		  [
            'name'       => 'Dodaj',
            'id'         => $prefix . 'group_marker_google_maps',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
			  [
				  'name' => 'Nazwa',
				  'id'   => $prefix . 'map_marker_name',
				  'type' => 'text',
			  ],
              [
				  'name' => 'Szerokość geograficzna',
				  'id'   => $prefix . 'map_lat',
				  'type' => 'text',
			  ],
			  [
				  'name' => 'Długość geograficzna',
				  'id'   => $prefix . 'map_lng',
				  'type' => 'text',
			  ],
			]
		  ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_wienkra_settings' );

function register_meta_boxes_custom_frontpage( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Opcje',
        'id'     => null,
        'post_types' => 'page',
        'include'    => [
            'relation' => 'OR',
            'ID'       => get_option('page_on_front', true),
        ],
        'fields' => [
		  [
              'type' => 'heading',
              'name' => 'SLIDER',
          ],
          [
            'name'       => 'Dodaj',
            'id'         => $prefix . 'slider_front_page',
            'type'       => 'group',
            'clone'      => true,
            'max_clone'  => 4,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
              [
                  'name' => 'Obrazek',
                  'id'   => $prefix . 'slider_front_page_img',
                  'type' => 'single_image',
              ],
			  [
                  'name' => 'Tytuł',
                  'id'   => $prefix . 'slider_front_page_name',
                  'type' => 'text',
              ],
              [
                  'name' => 'Opis',
                  'id'   => $prefix . 'slider_front_page_text',
                  'type' => 'wysiwyg',
              ],
			  [
                  'name' => 'Logo',
                  'id'   => $prefix . 'slider_front_page_logo',
                  'type' => 'single_image',
              ],
			  [
                  'name' => 'Przycisk - nazwa',
                  'id'   => $prefix . 'slider_front_page_button',
                  'type' => 'text',
              ],
			  [
                  'name' => 'Przycisk - URL',
                  'id'   => $prefix . 'slider_front_page_url',
                  'type' => 'url',
              ]
            ]
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 1',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_one',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'front_page_img_one',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 2',
          ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'front_page_section_title_two',
              'type' => 'text',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_two',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'front_page_img_two',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 3',
          ],
		  		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_three',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'front_page_img_three',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 4',
          ],
		  		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_four',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'front_page_img_four',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 5',
          ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'front_page_section_title_three',
              'type' => 'text',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_five',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'front_page_img_five',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 6',
          ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'front_page_section_title_four',
              'type' => 'text',
          ],
		  		  [
            'name'       => 'Dodaj loga',
            'id'         => $prefix . 'logos_slider_w',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
              [
                  'name' => 'Obrazek',
                  'id'   => $prefix . 'logos_slider_w_img',
                  'type' => 'single_image',
              ],
			  [
                  'name' => 'URL',
                  'id'   => $prefix . 'logos_slider_w_url',
                  'type' => 'url',
              ]
            ]
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_six',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'front_page_img_six',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 7',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_seven',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_eight',
              'type' => 'wysiwyg',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 8',
          ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'front_page_section_title_five',
              'type' => 'text',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_nine',
              'type' => 'textarea',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 9',
          ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'front_page_section_title_six',
              'type' => 'text',
          ],
		  [
            'name'       => 'Dodaj boxy',
            'id'         => $prefix . 'front_page_section_ten',
            'type'       => 'group',
            'clone'      => true,
            'max_clone'  => 12,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
              [
                  'name' => 'Obrazek',
                  'id'   => $prefix . 'front_page_section_ten_img',
                  'type' => 'single_image',
              ],
              [
                  'name' => 'Tytuł',
                  'id'   => $prefix . 'front_page_section_ten_name',
                  'type' => 'text',
              ],
			  [
                  'name' => 'URL',
                  'id'   => $prefix . 'front_page_section_ten_url',
                  'type' => 'url',
              ]
            ]
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA 10',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_eleven',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'front_page_img_seven',
              'type' => 'single_image',
          ],
		  		  [
              'type' => 'heading',
              'name' => 'SEKCJA 11',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'front_page_section_twelve',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'front_page_img_eight',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'FORMULARZ KONTAKTOWY',
          ],
		  [
              'name' => 'Shortcode formularza',
              'id'   => $prefix . 'front_page_form_shortcode',
              'type' => 'text',
          ],
		  [
              'type' => 'heading',
              'name' => 'DANE KONTAKTOWE W STOPCE',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'footer_data_contact',
              'type' => 'wysiwyg',
          ],
          [
              'type' => 'heading',
              'name' => 'TEKST W STOPCE',
          ],
          [
              'name' => 'Opis',
              'id'   => $prefix . 'footer_text',
              'type' => 'wysiwyg',
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_frontpage' );

function register_meta_boxes_custom_blog( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Wybierz przypięte aktualności',
        'id'     => null,
        'post_types' => 'page',
        'include'    => [
            'relation' => 'OR',
            'ID'       => get_option('page_for_posts', true),
        ],
        'fields' => [
			[
                'type'       => 'post',
                'name'       => 'Wybierz',
                'id'         => $prefix . 'featureds_post',
                'post_type'  => 'post',
				'multiple'	 => true,
                'field_type' => 'select_advanced',
            ],
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_blog' );

function register_meta_boxes_custom_about_us( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Opcje',
        'id'     => null,
        'post_types' => 'page',
        'include'    => [
            'relation' => 'OR',
            'template' => ['about-us-data.php']
        ],
        'fields' => [
			[
              'type' => 'heading',
              'name' => 'POWTARZALNE SEKCJE',
			],
			[
            'name'       => 'Dodaj sekcje',
            'id'         => $prefix . 'about_us_group_section',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
			  [
                  'name' => 'Tytuł',
                  'id'   => $prefix . 'about_us_group_section_name',
                  'type' => 'text',
              ],
              [
                  'name' => 'Lewa kolumna',
                  'id'   => $prefix . 'about_us_group_section_left',
                  'type' => 'wysiwyg',
              ],
              [
                  'name' => 'Prawa kolumna',
                  'id'   => $prefix . 'about_us_group_section_right',
                  'type' => 'wysiwyg',
              ]
            ]
          ],
		  [
              'type' => 'heading',
              'name' => 'IKONY',
		  ],
		  [
            'name'       => 'Dodaj sekcje',
            'id'         => $prefix . 'about_us_icons_section',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
			  [
                  'name' => 'Tytuł 1',
                  'id'   => $prefix . 'about_us_icons_section_name_one',
                  'type' => 'text',
              ],
              [
                  'name' => 'Tytuł 2',
                  'id'   => $prefix . 'about_us_icons_section_name_two',
                  'type' => 'text',
              ],
			  [
                  'name' => 'Tytuł 1',
                  'id'   => $prefix . 'about_us_icons_section_name_three',
                  'type' => 'text',
              ],
              [
                  'name' => 'Ikonka',
                  'id'   => $prefix . 'about_us_icons_section_img',
                  'type' => 'single_image',
              ]
            ]
          ],
		  [
              'type' => 'heading',
              'name' => 'HISTORIA',
		  ],
		  [
            'name'       => 'Linia dat',
            'id'         => $prefix . 'about_us_history_line',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
			  [
                  'name' => 'Rok',
                  'id'   => $prefix . 'about_us_history_line_date',
                  'type' => 'text',
              ],
              [
                  'name' => 'Opis',
                  'id'   => $prefix . 'about_us_history_line_text',
                  'type' => 'text',
              ]
            ]
          ],
		  [
            'name' => 'Treść',
            'id'   => $prefix . 'about_us_history_text',
            'type' => 'wysiwyg',
          ],
		  [
              'type' => 'heading',
              'name' => 'DWIE KOLUMNY',
		  ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'about_us_two_column_name',
              'type' => 'text',
          ],
		  [
              'name' => 'Opis lewy',
              'id'   => $prefix . 'about_us_two_column_left',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Opis prawy',
              'id'   => $prefix . 'about_us_two_column_right',
              'type' => 'wysiwyg',
          ],
		  [
              'type' => 'heading',
              'name' => 'WPISY',
		  ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'about_us_post_name',
              'type' => 'text',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'about_us_post_text',
              'type' => 'textarea',
          ],
		  [
              'name' => 'Wybierz wpisy',
              'id'   => $prefix . 'about_us_post',
			  'type'        => 'post',
              'post_type'   => 'post',
			  'multiple'    => true,
			  'field_type'  => 'select_advanced',
			  'ajax'       => true,
				'query_args' => [
					'posts_per_page' => 10,
			  ],
				'js_options' => [
					'minimumInputLength' => 3,
			  ],
          ],
		  [
              'type' => 'heading',
              'name' => 'DWIE KOLUMNY',
		  ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'about_us_two_column_repeat_name',
              'type' => 'text',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'about_us_two_column_repeat_text',
              'type' => 'textarea',
          ],
		  [
              'name' => 'Treść',
              'id'   => $prefix . 'about_us_two_column_repeat',
              'type' => 'wysiwyg',
			  'clone'      => true,
			  'sort_clone' => true,
			  'add_button' => "Dodaj więcej",
          ],
		  [
              'type' => 'heading',
              'name' => 'ODDZIAŁY',
		  ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'about_us_departments_title',
              'type' => 'text',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'about_us_departments_subtitle',
              'type' => 'textarea',
          ],
		  [
            'name'       => 'Dodaj oddziały',
            'id'         => $prefix . 'about_us_departments',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
			  [
                  'name' => 'Tytuł',
                  'id'   => $prefix . 'about_us_departments_name',
                  'type' => 'text',
              ],
              [
                  'name' => 'Obrazek',
                  'id'   => $prefix . 'about_us_departments_img',
                  'type' => 'single_image',
              ]
            ]
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA TEKSTOWA',
		  ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'about_us_bottom_one_title',
              'type' => 'text',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'about_us_bottom_one_img',
              'type' => 'single_image',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'about_us_bottom_one_desc',
              'type' => 'wysiwyg',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA TEKSTOWA',
		  ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'about_us_bottom_columns_title',
              'type' => 'text',
          ],
		  [
              'name' => 'Opis lewy',
              'id'   => $prefix . 'about_us_bottom_columns_desc_one',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Opis prawy',
              'id'   => $prefix . 'about_us_bottom_columns_desc_two',
              'type' => 'wysiwyg',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA POWTARZALNA',
		  ],
		  [
            'name'       => 'Dodaj',
            'id'         => $prefix . 'about_us_bottom_columns_repeat',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
			  [
                  'name' => 'Tytuł',
                  'id'   => $prefix . 'about_us_bottom_columns_repeat_title',
                  'type' => 'text',
              ],
			  [
                  'name' => 'Lewy',
                  'id'   => $prefix . 'about_us_bottom_columns_repeat_left',
                  'type' => 'wysiwyg',
              ],
              [
                  'name' => 'Prawy',
                  'id'   => $prefix . 'about_us_bottom_columns_repeat_right',
                  'type' => 'wysiwyg',
              ]
            ]
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA TEKSTOWA',
		  ],
		  [
              'name' => 'Tytuł',
              'id'   => $prefix . 'about_us_bottom_two_title',
              'type' => 'text',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'about_us_bottom_two_img',
              'type' => 'single_image',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'about_us_bottom_two_desc',
              'type' => 'wysiwyg',
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_about_us' );

function register_meta_boxes_custom_contact( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Opcje',
        'id'     => null,
		'post_types' => 'page',
        'include'    => [
            'relation' => 'OR',
            'template' => ['contact-data.php']
        ],
        'fields' => [
		  [
              'type' => 'heading',
              'name' => 'MAPA',
		  ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'section_contact_map',
              'type' => 'wysiwyg',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA DODATKOWA',
		  ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'section_contact_img',
              'type' => 'single_image',
          ],
		  [
              'name' => 'Opis',
              'id'   => $prefix . 'section_contact_desc',
              'type' => 'wysiwyg',
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_contact' );

function register_meta_boxes_custom_representative( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Opcje',
        'id'     => null,
		'post_types' => 'przedstawiciel',
        'fields' => [
		  [
              'name' => 'Funkcja',
              'id'   => $prefix . 'representative_type',
              'type' => 'text',
          ],
		  [
              'name' => 'E-mail',
              'id'   => $prefix . 'representative_email',
              'type' => 'email',
          ],
		  [
              'name' => 'Telefon',
              'id'   => $prefix . 'representative_phone',
              'type' => 'text',
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_representative' );

function register_meta_boxes_custom_product_gallery( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Galeria',
        'id'     => null,
		'context' => 'side',
		'priority' => 'low',
        'post_types' => 'produkt',
        'fields' => [
		  [
              'name' => 'Dodaj',
              'id'   => $prefix . 'gallery_product',
              'type' => 'image_advanced',
          ],
		  [
              'name' => 'Label',
              'id'   => $prefix . 'label_product',
              'type' => 'text',
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_product_gallery' );

function register_meta_boxes_custom_function_tax( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => null,
        'id'     => null,
		'taxonomies' => 'funkcja',
        'fields' => [
		  [
			  'name'  => 'Ikonka',
              'id'   => $prefix . 'function_icon',
              'type' => 'single_image',
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_function_tax' );

function register_meta_boxes_custom_brand_tax( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => null,
        'id'     => null,
		'taxonomies' => 'producent',
        'fields' => [
		  [
		      'name'  => 'Logo',
              'id'   => $prefix . 'brand_logo',
              'type' => 'single_image',
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_brand_tax' );

function register_meta_boxes_custom_page_columns( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'SEKCJE TEKSTOWE',
        'id'     => null,
        'post_types' => 'page',
        'include'    => [
            'relation' => 'OR',
            'template' => ['columns-data.php']
        ],
        'fields' => [
		  [
            'name'       => 'Dodaj',
            'id'         => $prefix . 'extra_columns_page',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
			  [
                  'name' => 'Opis',
                  'id'   => $prefix . 'extra_columns_page_desc',
                  'type' => 'wysiwyg',
              ],
              [
                  'name' => 'Obrazek',
                  'id'   => $prefix . 'extra_columns_page_img',
                  'type' => 'single_image',
              ]
            ]
          ],
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_page_columns' );

function register_meta_boxes_custom_page_three_columns( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'KOLEJNE KOLUMNY',
        'id'     => null,
        'post_types' => 'page',
        'include'    => [
            'relation' => 'OR',
            'template' => ['three-columns-data.php', 'two-columns-data.php']
        ],
        'fields' => [
		  [
            'name'       => 'Dodaj',
            'id'         => $prefix . 'extra_column_page',
            'type'       => 'wysiwyg',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej"
          ],
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_page_three_columns' );

function register_meta_boxes_custom_page_course( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'OPCJE',
        'id'     => null,
        'post_types' => 'page',
        'include'    => [
            'relation' => 'OR',
            'template' => ['course-archive-data.php']
        ],
        'fields' => [
		  [
              'type' => 'heading',
              'name' => 'ZGODY PRAWNE FORMULARZA ZAPISU',
		  ],
		  [
            'name'       => 'Dodaj',
            'id'         => $prefix . 'rodo_form_cource',
            'type'       => 'textarea',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej"
          ],
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_page_course' );

function register_meta_boxes_custom_page_file( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Plik',
        'id'     => null,
        'post_types' => 'pliki',
        'fields' => [
		  [
            'name'       => 'Dodaj plik',
            'id'         => $prefix . 'file_attachment',
            'type'       => 'file_advanced',
			'max_file_uploads' => 1,
          ],
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_page_file' );

function register_meta_boxes_custom_page_repeat( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'TREŚĆ',
        'id'     => null,
        'post_types' => 'page',
        'include'    => [
            'relation' => 'OR',
            'template' => ['repeat-page.php']
        ],
        'fields' => [
		  [
            'name'       => 'Dodaj',
            'id'         => $prefix . 'repeat_section',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
			  [
                  'name' => 'Opis',
                  'id'   => $prefix . 'repeat_section_name',
                  'type' => 'text',
              ],
              [
                  'name' => 'Obrazek',
                  'id'   => $prefix . 'repeat_section_text',
                  'type' => 'wysiwyg',
              ]
            ]
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes_custom_page_repeat' );

if (!function_exists('rwmb_the_value')) {
  function rwmb_the_value($key, $args = [], $post_id = null) {
    return null;
  }
}
if (!function_exists('rwmb_get_value')) {
  function rwmb_get_value($key, $args = [], $post_id = null) {
    return null;
  }
}
if (!function_exists('rwmb_meta')) {
  function rwmb_meta($key, $args = [], $post_id = null) {
    return null;
  }
}

function product_taxonomy_filter($post_type) {
	if('produkt' !== $post_type){
		return;
	}
	$taxonomies = array('producent', 'typ');
	foreach( $taxonomies as $taxonomy ){

		$taxonomy_object = get_taxonomy($taxonomy);
		$selected = isset( $_GET[ $taxonomy ] ) ? $_GET[ $taxonomy ] : '';

		wp_dropdown_categories(
			array(
				'show_option_all' =>  $taxonomy_object->labels->all_items,
				'taxonomy'        =>  $taxonomy,
				'name'            =>  $taxonomy,
				'orderby'         =>  'name',
				'value_field'     =>  'slug',
				'selected'        =>  $selected,
				'hierarchical'    =>  true,
			)
		);
	}
}
add_action( 'restrict_manage_posts', 'product_taxonomy_filter' );

function rewrite_course() {
	add_rewrite_rule('szkolenia/(?!all)([a-z-_]+)/?','index.php?pagename=szkolenia&course_slug=$matches[1]','top');
}
add_action('init', 'rewrite_course');

function rewrite_course_query_vars($query_vars) {
	$query_vars[] = 'course_slug';
	return $query_vars;
}
add_filter('query_vars', 'rewrite_course_query_vars');

function breadcrumb_add_course_link($links) {
    if(!empty(get_query_var('course_slug')))
	{
        $breadcrumb[] = array(
            'url' => get_permalink(),
            'text' => 'Szkolenia',
        );
        array_splice($links, 1, -2, $breadcrumb);
    }
    return $links;
}
add_filter('wpseo_breadcrumb_links', 'breadcrumb_add_course_link');

function breadcrumb_change_course_title($link_output) {
	$get_query_var = get_query_var('course_slug');
	if(strpos($link_output, 'breadcrumb_last') !== false && !empty(get_query_var('course_slug')))
	{
		$course_api_url = get_api_course_url().'/api/get_single_course_name/'.$get_query_var;
		$course_api = file_get_contents($course_api_url);
		$course_list = json_decode($course_api, true);
		if(isset($course_list['data'][0]['name']))
		{
			$link_output = $course_list['data'][0]['name'];
		}
	}
   	return $link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'breadcrumb_change_course_title');

function seo_change_course_title($title) {
	$get_query_var = get_query_var('course_slug');
	if(!empty($get_query_var))
	{
		$course_api_url = get_api_course_url().'/api/get_single_course_name/'.$get_query_var;
		$course_api = file_get_contents($course_api_url);
		$course_list = json_decode($course_api, true);
		if(isset($course_list['data'][0]['name']))
		{
			$title = $course_list['data'][0]['name'].' - '.get_bloginfo('name');
		}
	}
    return $title;
}
add_filter('wpseo_title', 'seo_change_course_title');
add_filter('wpseo_opengraph_title', 'seo_change_course_title');

function seo_change_course_desc($desc) {
	$get_query_var = get_query_var('course_slug');
	if(!empty($get_query_var))
	{
		$course_api_url = get_api_course_url().'/api/get_single_course_name/'.$get_query_var;
		$course_api = file_get_contents($course_api_url);
		$course_list = json_decode($course_api, true);
		if(isset($course_list['data'][0]['excerpt']))
		{
			$desc = $course_list['data'][0]['excerpt'];
		}
	}
    return $desc;
}
add_filter('wpseo_metadesc', 'seo_change_course_desc');
add_filter('wpseo_opengraph_desc', 'seo_change_course_desc');

add_action(
    'wpcf7_before_send_mail',
    function($WPCF7_ContactForm) {

        if(1033 != $WPCF7_ContactForm->id) {
            return $WPCF7_ContactForm;
        }

        $wpcf7 = WPCF7_ContactForm :: get_current() ;
        $submission = WPCF7_Submission :: get_instance() ;
        if (empty($submission)){
            return false;
        }

        $posted_data = $submission->get_posted_data() ;
        if ( empty ($posted_data)) {
            return false;
        }

        $number = get_option('options_service_number');
        $current_number = $number + 1;
        update_option('options_service_number', $current_number);

        $mail = $WPCF7_ContactForm->prop('mail');
        $mail['subject'] = str_replace('[SERVICE_NUMBER]', $current_number."/".date('m')."/".date('Y'), $mail['subject']);
        $mail['body'] = str_replace('[SERVICE_NUMBER]', $current_number."/".date('m')."/".date('Y'), $mail['body']);
        $WPCF7_ContactForm->set_properties( array("mail" => $mail)) ;

        $mail = $WPCF7_ContactForm->prop('mail_2');
        $mail['subject'] = str_replace('[SERVICE_NUMBER]', $current_number."/".date('m')."/".date('Y'), $mail['subject']);
        $mail['body'] = str_replace('[SERVICE_NUMBER]', $current_number."/".date('m')."/".date('Y'), $mail['body']);
        $WPCF7_ContactForm->set_properties( array("mail_2" => $mail)) ;

        return $WPCF7_ContactForm ;
    },
    10,
    1
);