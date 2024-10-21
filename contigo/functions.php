<?php

function menus() {
	$locations = array(
		'primary_menu' => 'Menu Główne',
		'footer_menu' => 'Menu w stopce'
	);
	register_nav_menus( $locations );
}
add_action('init', 'menus');

function add_styles() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.1');
}
add_action('wp_enqueue_scripts', 'add_styles', 55);

function add_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'script-file', get_template_directory_uri().'/js/script.js');
}
add_action('wp_footer', 'add_scripts');

function wp_script_page() {
	echo "<script>
	
		if(document.getElementById('slider_front_page'))
		{
			document.addEventListener( 'DOMContentLoaded', function() {
				var slider_front_page = new Splide('#slider_front_page', {
					rewind: true,
					autoplay: true,
					interval:3000,
				});
				slider_front_page.mount();
			});
		}
		
		if(document.getElementById('range_from') && document.getElementById('range_to'))
		{
			var range_from = document.getElementById('range_from'),
			range_to = document.getElementById('range_to'),
			lowerVal = parseInt(range_from.value);
			upperVal = parseInt(range_to.value);

			range_to.oninput = function () {
			  lowerVal = parseInt(range_from.value);
			  upperVal = parseInt(range_to.value);

			  if (upperVal < lowerVal + 4) {
				range_from.value = upperVal - 4;

				if (lowerVal == range_from.min) {
				  range_to.value = 4;
				}
			  }
			  
			  if(document.getElementById('range_to_output'))
			  {
				  document.getElementById('range_to_output').innerHTML = upperVal + ' m<sup>2</sup>';
			  }
			  
			};

			range_from.oninput = function () {
			  lowerVal = parseInt(range_from.value);
			  upperVal = parseInt(range_to.value);

			  if (lowerVal > upperVal - 4) {
				range_to.value = lowerVal + 4;

				if (upperVal == range_to.max) {
				  range_from.value = parseInt(range_to.max) - 4;
				}

			  }
			  
			  if(document.getElementById('range_from_output'))
			  {
				  document.getElementById('range_from_output').innerHTML = lowerVal + ' m<sup>2</sup>';
			  }
			  
			};
		}
		
		jQuery(document).ready(function() {
			
			jQuery(\"header .header .header-content .logo-brand .menu-bar\").click(function(){
				jQuery(\"header .header .header-content .menu-top\").toggleClass(\"active-menu\");
				jQuery(this).toggleClass(\"active-bar\");
			});
			
			if(jQuery(window).width() <= 1184)
			{
				jQuery(\"header .header .header-content .menu-top ul li a[href^='/#']\").click(function(){
					jQuery(\"header .header .header-content .menu-top\").toggleClass(\"active-menu\");
					jQuery(\"header .header .header-content .logo-brand .menu-bar\").toggleClass(\"active-bar\");
				});
			}
			
			if(document.getElementById('flat_table'))
			{

				jQuery('#flat_table').DataTable({
					pageLength: 15,
					searching: false,
					bInfo: false,
					bLengthChange: false,
					pagingType: 'numbers',
					order: [[4, 'desc']],
					columnDefs: [
						{targets: [6, 7], orderable: false}
					],
					'language': {
						'zeroRecords': '".__('Nie znaleziono', 'tilia')."',
					}
				});
				
				jQuery('.flat-table-head .filter-flat-table').on('click', function() {
					
					DataTable.ext.search.push(function (settings, data, dataIndex) {
			 
						return true;
						
					});
					
					if(!jQuery(this).hasClass('active'))
					{
						jQuery('#flat_table').DataTable({
							destroy: true,
							pageLength: 15,
							bInfo: false,
							pagingType: 'numbers',
							order: [[4, 'desc']],
							columnDefs: [
								{targets: [6, 7], orderable: false}
							],
							'language': {
								'zeroRecords': '".__('Nie znaleziono', 'tilia')."',
							}
						}).column(jQuery(this).data('column')).search(
							jQuery(this).data('number')
						).draw();
					}
					
					if(jQuery(this).hasClass('active'))
					{
						jQuery(this).removeClass('active');
						
						jQuery('#flat_table').DataTable({
							destroy: true,
							pageLength: 15,
							bInfo: false,
							pagingType: 'numbers',
							order: [[4, 'desc']],
							columnDefs: [
								{targets: [6, 7], orderable: false}
							],
							'language': {
								'zeroRecords': '".__('Nie znaleziono', 'tilia')."',
							}
						}).draw();
					}
					else
					{
						jQuery('.flat-table-head .filter-flat-table').removeClass('active');
						jQuery(this).addClass('active');
					}
					
				});
				
				jQuery('.flat-table-head .flat-table-head-range .flat-table-head-range-input input').change(function() {
					
					jQuery('.flat-table-head .filter-flat-table').removeClass('active');
										
					DataTable.ext.search.push(function (settings, data, dataIndex) {
						
						var flat_size_from = jQuery('.flat-table-head .flat-table-head-range .flat-table-head-range-input #range_from').val();
						var flat_size_to = jQuery('.flat-table-head .flat-table-head-range .flat-table-head-range-input #range_to').val();
						
						let min = parseInt(flat_size_from, 10);
						let max = parseInt(flat_size_to, 10);
						let size = parseFloat(data[2]) || 0;
					 
						if (
							(isNaN(min) && isNaN(max)) ||
							(isNaN(min) && size <= max) ||
							(min <= size && isNaN(max)) ||
							(min <= size && size <= max)
						) {
							return true;
						}
					 
						return false;
					});
										
					jQuery('#flat_table').DataTable({
						destroy: true,
						pageLength: 15,
						bInfo: false,
						pagingType: 'numbers',
						order: [[4, 'desc']],
						columnDefs: [
							{targets: [6, 7], orderable: false}
						],
						'language': {
							'zeroRecords': '".__('Nie znaleziono', 'tilia')."',
						}
					}).draw();
					
				});
				
			}
			
			if(document.getElementById('buildings_map') && typeof flat_array_legend !== 'undefined')
			{
				if(flat_array_legend.length > 0)
				{
					jQuery('#buildings_map').mapster({
						fillOpacity: 0.6,
						fillColor: '1f9639',
						selected: true,
						mapKey: 'data-key',
						onClick: function(data) {
							data.e.preventDefault();
							var url = jQuery(this).attr('href');
							if(url != '#' && url != '')
							{
								window.location = url;
							}
							return false;
						},
						areas: flat_array_legend
					});
				}
			}
			else if(document.getElementById('buildings_map'))
			{
				jQuery('#buildings_map').mapster({
					fillOpacity: 0.7,
					fillColor: '1f9639',
					onClick: function(data) {
						data.e.preventDefault();
						var url = jQuery(this).attr('href');
						if(url)
						{
							window.location = url;
							return false;
						}
					}
				});
			}
			
		});
		
	</script>";
}
add_action('wp_footer', 'wp_script_page', 55);

function remove_wp_block_library_css(){
	if(class_exists('Classic_Editor'))
	{
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('wp-block-library-theme');
		wp_dequeue_style('global-styles');
		wp_dequeue_style('wc-blocks-style');
	}
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

if(!function_exists('rwmb_meta'))
{
	function rwmb_meta($key, $args = [], $object_id = null)
	{
		return null;
	}
}

function remove_version_generator() {
	return '';
}
add_filter('the_generator', 'remove_version_generator');

function remove_version_from_style_js( $src ) {
    if(strpos($src, 'ver=' . get_bloginfo('version')))
        $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'remove_version_from_style_js');
add_filter('script_loader_src', 'remove_version_from_style_js');

add_theme_support('post-thumbnails');
add_theme_support('custom-logo');

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

function separator_content($atts) {
    return '<div class="separator-content"></div>';
}
add_shortcode('separator_content', 'separator_content');

function flat_post_type() {
	$args = [
		'label'  => 'Mieszkania',
		'labels' => [
			'menu_name'          => 'Mieszkania',
			'name_admin_bar'     => 'Mieszkanie',
			'add_new'            => 'Dodaj nowe',
			'add_new_item'       => 'Dodaj nowe mieszkanie',
			'new_item'           => 'Nowe mieszkanie',
			'edit_item'          => 'Edytuj mieszkanie',
			'view_item'          => 'Zobacz mieszkanie',
			'update_item'        => 'Zaktualizuj mieszkanie'
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
		'has_archive'         => 'mieszkania',
		'query_var'           => true,
		'can_export'          => true,
		'rewrite_no_front'    => false,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-admin-home',
		'supports' => [
			'title'
		],
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_post_type('mieszkanie', $args);
}
add_action('init', 'flat_post_type');

function platform_taxonomy() {
	$args = [
		'label'  => 'Piętro',
		'labels' => [
			'menu_name' => 'Piętro',
			'add_new_item' => 'Dodaj nowe piętro',
			'edit_item' => 'Edytuj piętro',
			'update_item' => 'Zaktualizuj piętro',
			'not_found' => 'Nie znaleziono żadnych pięter.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => false,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('pietro', [ 'mieszkanie' ], $args);
}
add_action('init', 'platform_taxonomy');

function type_flat_taxonomy() {
	$args = [
		'label'  => 'Typ',
		'labels' => [
			'menu_name' => 'Typ',
			'add_new_item' => 'Dodaj nowy typ',
			'edit_item' => 'Edytuj typ',
			'update_item' => 'Zaktualizuj typ',
			'not_found' => 'Nie znaleziono żadnych typu.'
		],
		'public'               => true,
		'show_ui'              => true,
		'show_in_menu'         => true,
		'show_in_nav_menus'    => true,
		'show_tagcloud'        => true,
		'show_in_quick_edit'   => true,
		'show_admin_column'    => false,
		'show_in_rest'         => true,
		'hierarchical'         => false,
		'query_var'            => true,
		'sort'                 => false,
		'rewrite_no_front'     => false,
		'rewrite_hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
		]
	];
	register_taxonomy('typ', [ 'mieszkanie' ], $args);
}
add_action('init', 'type_flat_taxonomy');

add_filter('mb_settings_pages', function ($settings_pages) {
    $settings_pages[] = [
        'id'          => 'contigo-settings',
        'option_name' => 'contigo_settings',
        'menu_title'  => 'Opcje strony',
        'submit_button' => 'Zapisz ustawienia'
    ];
    return $settings_pages;
});

function register_meta_boxes_tilia_settings($meta_boxes) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Ustawienia CONTIGO',
        'id'     => null,
        'settings_pages' => 'contigo-settings',
        'fields' => [
          [
              'type' => 'heading',
              'name' => 'LOGO DEWELOPERA',
          ],
		  [
              'name' => 'Dodaj',
              'id'   => $prefix . 'developers_logo',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'NUMER TELEFONU',
          ],
		  [
              'name' => 'Dodaj',
              'id'   => $prefix . 'phone_page',
              'type' => 'text',
          ],
		  [
              'type' => 'heading',
              'name' => 'FORMULARZ KONTAKTOWY MIESZKANIA',
          ],
		  [
              'name' => 'Dodaj',
              'id'   => $prefix . 'flat_shortcode_form',
              'type' => 'text',
          ],
		  [
              'type' => 'heading',
              'name' => 'PLAN BUDYNKÓW',
          ],
		  [
              'name' => 'Obrazek',
              'id'   => $prefix . 'map_building_img',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'ADRES W STOPCE',
          ],
		  [
              'name' => 'Dodaj',
              'id'   => $prefix . 'footer_adress',
              'type' => 'textarea',
          ],
		  [
              'type' => 'heading',
              'name' => 'DZIAŁ SPRZEDAŻY W STOPCE',
          ],
		  [
              'name' => 'Telefon',
              'id'   => $prefix . 'footer_phone',
              'type' => 'text',
          ],
		  [
              'name' => 'E-mail',
              'id'   => $prefix . 'footer_email',
              'type' => 'email',
          ],
		  [
              'type' => 'heading',
              'name' => 'TEXT W STOPCE',
          ],
		  [
              'name' => 'Dodaj',
              'id'   => $prefix . 'footer_text',
              'type' => 'textarea',
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
              'name' => 'Szerokość geograficzna',
              'id'   => $prefix . 'lat_google_maps',
              'type' => 'text',
          ],
          [
              'name' => 'Długość geograficzna',
              'id'   => $prefix . 'lng_google_maps',
              'type' => 'text',
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_tilia_settings');

function register_meta_boxes_custom_frontpage($meta_boxes) {
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
              'name' => 'Dodaj',
              'id'   => $prefix . 'slider_front_page',
              'type' => 'image_advanced',
          ],
		  [
              'type' => 'heading',
              'name' => 'IKONKI',
          ],
          [
              'name' => 'Dodaj',
              'id'   => $prefix . 'section_icons_one',
              'type' => 'image_advanced',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA TEKSTOWA',
          ],
          [
              'name' => 'Dodaj',
              'id'   => $prefix . 'section_one_text_front_page',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Grafika',
              'id'   => $prefix . 'section_one_img_front_page',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'SLOGAN',
          ],
          [
              'name' => 'Dodaj',
              'id'   => $prefix . 'section_slogan_front_page',
              'type' => 'wysiwyg',
          ],
		  [
              'type' => 'heading',
              'name' => 'IKONKI',
          ],
          [
              'name' => 'Dodaj',
              'id'   => $prefix . 'section_icons_two',
              'type' => 'image_advanced',
          ],
		  [
              'type' => 'heading',
              'name' => 'SEKCJA TEKSTOWA',
          ],
          [
              'name' => 'Dodaj',
              'id'   => $prefix . 'section_two_text_front_page',
              'type' => 'wysiwyg',
          ],
		  [
              'name' => 'Grafika',
              'id'   => $prefix . 'section_two_img_front_page',
              'type' => 'single_image',
          ],
		  [
              'type' => 'heading',
              'name' => 'SLOGAN',
          ],
          [
              'name' => 'Dodaj',
              'id'   => $prefix . 'section_slogan_location_front_page',
              'type' => 'wysiwyg',
          ],
		  [
              'type' => 'heading',
              'name' => 'GALERIA',
          ],
		  [
            'name'       => 'Dodaj',
            'id'         => $prefix . 'gallery_front_page',
            'type'       => 'group',
            'clone'      => true,
            'sort_clone' => true,
            'add_button' => "Dodaj więcej",
            'fields'     => [
              [
                  'name' => 'Obrazek',
                  'id'   => $prefix . 'gallery_front_page_img',
                  'type' => 'single_image',
              ],
			  [
                  'name' => 'Tytuł',
                  'id'   => $prefix . 'gallery_front_page_name',
                  'type' => 'text',
              ],
              [
                  'name' => 'Galeria',
                  'id'   => $prefix . 'gallery_front_page_item',
                  'type' => 'image_advanced',
              ],
            ]
          ],
		  [
              'type' => 'heading',
              'name' => 'GRAFIKA DOLNA',
          ],
          [
              'name' => 'Dodaj',
              'id'   => $prefix . 'bottom_img_front_page',
              'type' => 'single_image',
          ],
        ]
    ];
    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_frontpage');

function register_meta_boxes_custom_flat($meta_boxes) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Opcje',
        'id'     => null,
        'post_types' => 'mieszkanie',
        'fields' => [
		  [
              'type' => 'heading',
              'name' => 'PARAMETRY',
          ],
		  [
              'name' => 'Numer',
              'id'   => $prefix . 'flat_number',
              'type' => 'text'
          ],
		  [
              'name' => 'Metraż',
              'id'   => $prefix . 'flat_size',
              'type' => 'number',
			  'step' => 'any'
          ],
		  [
              'name' => 'Pokoje',
              'id'   => $prefix . 'flat_rooms',
              'type' => 'number'
          ],
		  [
              'name' => 'Status',
              'id'   => $prefix . 'flat_status',
              'type' => 'select',
			  'placeholder' => 'Wybierz',
			  'select_all_none' => true,
			  'options' => [
					'2' => 'REZERWACJA',
					'1' => 'WOLNE',
					'0' => 'SPRZEDANE'
			  ]
          ],
		  [
              'name' => 'Plik',
              'id'   => $prefix . 'flat_file',
              'type' => 'file_advanced',
			  'max_file_uploads' => 1,
          ],
		  [
              'name' => 'Karta mieszkania',
              'id'   => $prefix . 'flat_img',
              'type' => 'single_image'
          ],
		  [
              'name' => 'Koordynaty',
              'id'   => $prefix . 'flat_coords',
              'type' => 'text'
          ]
        ]
    ];
    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_flat');

function register_meta_boxes_custom_deweloper_page($meta_boxes) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Opcje',
        'id'     => null,
        'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['deweloper.php'],
        ],
        'fields' => [
			 [
				  'type' => 'heading',
				  'name' => 'ZDJĘCIE 1',
			 ],
			 [
				  'name' => 'Dodaj',
				  'id'   => $prefix . 'deweloper_page_img_one',
				  'type' => 'single_image'
			 ],
		     [
				  'type' => 'heading',
				  'name' => 'IKONKI',
             ],
			 [
				  'name' => 'Dodaj',
				  'id'   => $prefix . 'deweloper_page_icons',
				  'type' => 'image_advanced',
			 ],
			 [
				  'type' => 'heading',
				  'name' => 'SEKCJA TEKSTOWA',
             ],
			 [
				  'name' => 'Obrazek',
				  'id'   => $prefix . 'deweloper_page_img_two',
				  'type' => 'single_image',
			 ],
			 [
				  'name' => 'Opis',
				  'id'   => $prefix . 'deweloper_page_text_one',
				  'type' => 'wysiwyg',
			 ],
			 [
				  'type' => 'heading',
				  'name' => 'GRAFIKA DOLNA',
             ],
             [
				  'name' => 'Dodaj',
				  'id'   => $prefix . 'deweloper_page_img_bottom',
				  'type' => 'single_image',
             ],
        ]
    ];
    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_deweloper_page');

function register_meta_boxes_custom_client_page($meta_boxes) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Opcje',
        'id'     => null,
        'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['klient.php'],
        ],
        'fields' => [
			 [
				  'type' => 'heading',
				  'name' => 'ZDJĘCIE 1',
			 ],
			 [
				  'name' => 'Dodaj',
				  'id'   => $prefix . 'client_page_img_one',
				  'type' => 'single_image'
			 ],
			 [
				  'type' => 'heading',
				  'name' => 'SEKCJA TEKSTOWA',
			 ],
			 [
				  'name' => 'Dodaj',
				  'id'   => $prefix . 'client_page_text',
				  'type' => 'wysiwyg'
			 ],
			 [
				  'type' => 'heading',
				  'name' => 'SEKCJA TEKSTOWA',
			 ],
			 [
				  'name' => 'Dodaj',
				  'id'   => $prefix . 'client_page_text_one',
				  'type' => 'wysiwyg'
			 ],
			 [
				  'name' => 'Obrazek',
				  'id'   => $prefix . 'client_page_img_two',
				  'type' => 'single_image'
			 ],
			 [
				  'type' => 'heading',
				  'name' => 'SEKCJA GRUPOWA',
			 ],
			 [
				'name'       => 'Dodaj',
				'id'         => $prefix . 'client_page_group',
				'type'       => 'group',
				'clone'      => true,
				'sort_clone' => true,
				'add_button' => "Dodaj więcej",
				'fields'     => [
				  [
					  'name' => 'Obrazek',
					  'id'   => $prefix . 'client_page_group_img',
					  'type' => 'single_image',
				  ],
				  [
					  'name' => 'Plik',
					  'id'   => $prefix . 'client_page_group_file',
					  'type' => 'file',
				  ],
				  [
					  'name' => 'Opis',
					  'id'   => $prefix . 'client_page_group_text',
					  'type' => 'wysiwyg',
				  ]
				]
			 ],
			 [
				  'type' => 'heading',
				  'name' => 'SEKCJA TEKSTOWA',
			 ],
			 [
				  'name' => 'Dodaj',
				  'id'   => $prefix . 'client_page_text_two',
				  'type' => 'wysiwyg'
			 ],
        ]
    ];
    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_client_page');

function register_meta_boxes_custom_contact_page($meta_boxes) {
    $prefix = '';

    $meta_boxes[] = [
        'title'  => 'Opcje',
        'id'     => null,
        'post_types' => 'page',
		'include'    => [
            'relation' => 'OR',
            'template' => ['contact.php'],
        ],
        'fields' => [
			 [
				  'type' => 'heading',
				  'name' => 'SEKCJA TEKSTOWA',
			 ],
			 [
				  'name' => 'Dodaj',
				  'id'   => $prefix . 'contact_page_text',
				  'type' => 'wysiwyg'
			 ],
			 [
				  'type' => 'heading',
				  'name' => 'FORMULARZ KONTAKTOWY'
			 ],
			 [
				  'name' => 'Kod shortcode',
				  'id'   => $prefix . 'contact_page_form',
				  'type' => 'text'
			 ]
        ]
    ];
    return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'register_meta_boxes_custom_contact_page');