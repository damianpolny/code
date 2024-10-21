<?php

function menus() {
	$locations = array(
		'primary_menu' => 'Header',
		'footer_menu' => 'Footer'
	);
	register_nav_menus($locations);
}
add_action('init', 'menus');

function add_styles() {
	wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.5');
}
add_action('wp_enqueue_scripts', 'add_styles', 55);

function add_scripts() {
	wp_enqueue_script('script-file', get_template_directory_uri().'/js/script.js', array(), '1.5');
}
add_action('wp_footer', 'add_scripts');

function wp_script_page() {
	echo "<script>
	
		gsap.registerPlugin(ScrollTrigger, ScrollSmoother, DrawSVGPlugin);
		
		ScrollSmoother.create({
			smooth: 1.2,
			effects: true,
		});
		
		if(document.getElementById('preloader_svg_1') && document.getElementById('preloader_svg_2'))
		{
			gsap.from('#preloader_svg_1', {duration:3,drawSVG:0,opacity:1});
			gsap.from('#preloader_svg_2', {duration:6,drawSVG:0,opacity:1});
		}
		
		if(document.getElementById('custom_cursor'))
		{
			const isTouchDevice = 'ontouchstart' in window;
			const createCursorFollower = () => {
				const el = document.querySelector('#custom_cursor');
				window.addEventListener('mousemove', (e) => {
					const { target, x, y } = e;
					const isTargetLinkOrBtn = target?.closest('a') || target?.closest('button') || target?.closest('#menu_bar_top');
					gsap.to(el, {
						x: x + 3,
						y: y + 3,
						duration: 0.7,
						ease: 'power4',
						opacity: isTargetLinkOrBtn ? 0.6 : 1,
						scale: isTargetLinkOrBtn ? 1.3 : 1
					});
				});
				document.addEventListener('mouseleave', (e) => {
						gsap.to(el, {
						duration: 0.7,
						opacity: 0,
					});
				});
			};
			if(!isTouchDevice)
			{
				createCursorFollower();
			}
		}
				
		if(document.getElementsByClassName('preloader').length > 0)
		{
			const tl = gsap.timeline();
			tl.to('.logo-top, .menu-bar-top', {
				opacity: 0,
				duration: 0
			})
			.to('.preloader, .preloader .preloader-content svg', {
				duration: 2,
				delay: 2.8, 
				height: '0vh',
				ease: 'Power3.easeOut'
			})
			.to('.logo-top, .menu-bar-top', {
				opacity: 1
			});
		}
	
		if(document.getElementById('menu_bar_top') && document.getElementById('menu_top'))
		{
			document.getElementById('menu_bar_top').addEventListener('click', function() {
				document.getElementById('menu_bar').classList.toggle('active-bar');
				document.getElementById('menu_top').classList.toggle('active-menu');
			});
		}
		
		if(document.querySelectorAll('[data-animate-text]').length > 0 && document.getElementsByClassName('char').length > 0)
		{
			let typeSplit = new SplitType('[data-animate-text]', {
				types: 'lines, words, chars',
				tagName: 'span'
			});
			gsap.from('[data-animate-text] .char', {
				y: '130%',
				opacity: 0,
				rotationZ: '5',
				delay: 3.1,
				duration: 0.5,
				ease: 'power1.out',
				stagger: 0.1
			});
		}

		if(document.getElementsByClassName('change-color-footer').length > 0)
		{
			gsap.fromTo('body', {
				backgroundColor: gsap.getProperty('html', '--light'),
				color: gsap.getProperty('html', '--default')
			}, {
				scrollTrigger: {
					trigger: 'footer .footer',
					scrub: true,
					end: 'top top',
				},
				backgroundColor: gsap.getProperty('html', '--second'),
				color: gsap.getProperty('html', '--light')
			});
			
			gsap.fromTo('footer .footer a', {
				color: gsap.getProperty('html', '--default')
			}, {
				scrollTrigger: {
					trigger: 'footer .footer',
					scrub: true,
					end: 'top top',
				},
				color: gsap.getProperty('html', '--light')
			});
		}
		
		if(document.getElementsByClassName('merge-text').length > 0)
		{
			let marquee = '';
			gsap.to('.merge-text', {
				scrollTrigger: {
					trigger: '.merge-container',
					scrub: 0.25,
					start: 'top bottom',
					end: 'bottom top',
					ease: 'power2'
				},
				xPercent: -50
			});
			gsap.utils.toArray('.merge-text').forEach((heading) => {
				ScrollTrigger.create({
					trigger: heading,
					start: 'bottom',
					end: 'top',
					toggleActions: 'play reset play reset',
					ease: 'power2',
					onEnter: () =>
						marquee !== heading.textContent,
					onEnterBack: () =>
						marquee !== heading.textContent
				});
			});
		}
		
		if(document.querySelectorAll('[data-scrollbg]').length > 0 && document.getElementsByClassName('change-color-front-page').length > 0)
		{
			const scrollColorBg = document.querySelectorAll('[data-scrollbg]');
			scrollColorBg.forEach((colorSection, i) => {
				const prevColor = i === 0 ? '#CAD8A9' : scrollColorBg[i - 1].dataset.scrollbg;
				ScrollTrigger.create({
					trigger: colorSection,
					start: 'top 35%',
					markers: false,
					onEnter: () => gsap.to('body', {backgroundColor: colorSection.dataset.scrollbg}),
					onLeaveBack: () => gsap.to('body', {backgroundColor: prevColor})
				});
			});
		}
		
		if(document.querySelectorAll('[data-scrollcolor]').length > 0 && document.getElementsByClassName('change-color-front-page').length > 0)
		{
			const scrollColor = document.querySelectorAll('[data-scrollcolor]');
			scrollColor.forEach((ColorSection, i) => {
				const PrevColor = i === 0 ? '#283125' : scrollColor[i - 1].dataset.scrollcolor;
				const PrevColorMenu = i === 0 ? '#FFFFFF' : scrollColor[i - 1].dataset.scrollcolor;
				ScrollTrigger.create({
					trigger: ColorSection,
					start: 'top 35%',
					markers: false,
					onEnter: () => gsap.to('body, [data-scrollcolor] a', {color: ColorSection.dataset.scrollcolor}),
					onLeaveBack: () => gsap.to('body, [data-scrollcolor] a', {color: PrevColor})
				});
				ScrollTrigger.create({
					trigger: ColorSection,
					start: 'top 35%',
					markers: false,
					onEnter: () => gsap.to('.menu-bar span', {backgroundColor: ColorSection.dataset.scrollcolor}),
					onLeaveBack: () => gsap.to('.menu-bar span', {backgroundColor: PrevColorMenu})
				});
				ScrollTrigger.create({
					trigger: ColorSection,
					start: 'top 35%',
					markers: false,
					onEnter: () => gsap.to('.logo-top svg #Pfad_2, .logo-top svg #Pfad_1', {fill: ColorSection.dataset.scrollcolor}),
					onLeaveBack: () => gsap.to('.logo-top svg #Pfad_2, .logo-top svg #Pfad_1', {fill: PrevColorMenu})
				});
			});
		}
		
		if(document.querySelectorAll('[data-scrollbg]').length > 0 && document.getElementsByClassName('change-color-offer').length > 0)
		{
			const scrollColorBg = document.querySelectorAll('[data-scrollbg]');
			scrollColorBg.forEach((colorSection, i) => {
				const prevColor = i === 0 ? '#CAD8A9' : scrollColorBg[i - 1].dataset.scrollbg;
				ScrollTrigger.create({
					trigger: colorSection,
					start: 'top 35%',
					markers: false,
					onEnter: () => gsap.to('body', {backgroundColor: colorSection.dataset.scrollbg}),
					onLeaveBack: () => gsap.to('body', {backgroundColor: prevColor})
				});
			});
		}
		
		if(document.querySelectorAll('[data-scrollbg]').length > 0 && document.getElementsByClassName('change-color-portfolio').length > 0)
		{
			const scrollColorBg = document.querySelectorAll('[data-scrollbg]');
			scrollColorBg.forEach((colorSection, i) => {
				const prevColor = i === 0 ? '#FFFFFF' : scrollColorBg[i - 1].dataset.scrollbg;
				ScrollTrigger.create({
					trigger: colorSection,
					start: 'top 35%',
					markers: false,
					onEnter: () => gsap.to('body', {backgroundColor: colorSection.dataset.scrollbg}),
					onLeaveBack: () => gsap.to('body', {backgroundColor: prevColor})
				});
			});
		}
		
		if(document.querySelectorAll('[data-scrollcolor]').length > 0 && (document.getElementsByClassName('change-color-offer').length > 0 || document.getElementsByClassName('change-color-portfolio').length > 0))
		{
			const scrollColor = document.querySelectorAll('[data-scrollcolor]');
			scrollColor.forEach((ColorSection, i) => {
				const PrevColor = i === 0 ? '#283125' : scrollColor[i - 1].dataset.scrollcolor;
				ScrollTrigger.create({
					trigger: ColorSection,
					start: 'top 35%',
					markers: false,
					onEnter: () => gsap.to('body, [data-scrollcolor] a', {color: ColorSection.dataset.scrollcolor}),
					onLeaveBack: () => gsap.to('body, [data-scrollcolor] a', {color: PrevColor})
				});
			});
		}
		
		if(document.getElementsByClassName('section-column-animate-content-img').length > 0)
		{
			let animate_img = document.querySelectorAll('.section-column-animate-content-img');
			animate_img.forEach(container => {
				let wrapper = container.querySelectorAll('.section-column-animate-img');
				let image = container.querySelectorAll('img');
				let tl = gsap.timeline({
					scrollTrigger: {
					  trigger: container,
					  start: 'top 70%',
					},
				});
				tl.set(wrapper, {autoAlpha: 1});
				tl.from(wrapper, 1.5, {
					xPercent: -100,
					ease: Power2.out,
				});
				tl.from(image, 1.5, {
					xPercent: 100,
					scale: 1.3,
					delay: -1.5,
					ease: Power2.out,
				});
			});
		}
		
		if(document.getElementsByClassName('section-zoom').length > 0 && document.getElementsByClassName('section-img-zoom').length > 0)
		{
			const section_zoom = gsap.timeline({
				scrollTrigger: {
					trigger: '.section-zoom',
					scrub: 0.5,
					start: 'top top',
					end: '+=100% 0%',
					markers: false,
					pin: true
				}
			});
			section_zoom.to('.section-zoom .section-img-zoom', {
				scale: 0.6
			})
		}
		
		if(document.getElementsByClassName('fade-in').length > 0)
		{
			gsap.utils.toArray('.fade-in').forEach((elem) => {
				let h = gsap.timeline({
					scrollTrigger: {
						trigger: elem,
						start: 'top bottom',
						end: 'bottom 100%',
					},
				}).from(elem, {y:40, duration:2, opacity: 0, ease:'none'})
			});
		}
		
		if(document.getElementsByClassName('fade-up').length > 0)
		{
			gsap.utils.toArray('.fade-up').forEach((elem) => {
				let f = gsap.timeline({
				scrollTrigger: {
					trigger: elem,
					start: 'top 80%',
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
						start: 'top 80%',
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
						start: 'top 80%',
						end: 'top 50%',
					},
				}).from(elem, {x:-70, duration:1, opacity: 0, ease:'none'})
			});
		}
		
		if(document.getElementById('swiper_testimonials'))
		{
			var swiper_testimonials = new Swiper('#swiper_testimonials', {
				rewind: true,
				delay: 10000,
				autoplay: false,
				speed: 1500,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
					renderBullet: function (index, className) {
						return '<span class=\"' + className + '\">' + (index + 1) + '<span class=\"progress\"></span></span>';
					}
				}
			});
		}
		
		if(document.getElementById('mobile_menu'))
		{
			let scrollpos = window.scrollY;
			const header = document.querySelector('#mobile_menu');
			const header_height = header.offsetHeight;
			const add_class_on_scroll = () => header.classList.add('scroll-mobile-menu');
			const remove_class_on_scroll = () => header.classList.remove('scroll-mobile-menu');
			
			window.addEventListener('scroll', function()
			{
				scrollpos = window.scrollY;
				if (scrollpos <= header_height)
				{
					remove_class_on_scroll()
				}
				else
				{
					add_class_on_scroll()
				}
			});
		}
		
	</script>";
}
add_action('wp_footer', 'wp_script_page', 55);

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