		<?php
			$id_front_page = get_option('page_on_front');
			$footer_text = get_field('footer_text', $id_front_page);
			$page_email = get_field('page_email', $id_front_page);
			$page_phone = get_field('page_phone', $id_front_page);
			$page_instagram = get_field('page_instagram', $id_front_page);
		?>
		<footer<?php if(is_front_page() || is_page_template('offer.php') || is_page_template('portfolio.php')): ?> data-scrollbg="#8CA486"  data-scrollcolor="#ffffff"<?php endif; ?>>
			<div class="footer fade-in">
				<div class="container-small">
					<?php if(!empty($page_instagram)): ?>
					<div class="section-title-content">
						<p class="section-title fade-left"><?php echo __('INSTAGRAM', 'ullrichgarten'); ?></p>
					</div>
					<div class="footer-button text-center">
						<a class="custom-big-button fade-left" href="<?php echo esc_url($page_instagram); ?>"><span><?php echo __('FOLGEN', 'ullrichgarten'); ?></span></a>
					</div>
					<?php endif; if(!empty($footer_text)): ?>
					<div class="section-title-content text-center">
						<p class="section-title"><?php echo nl2br($footer_text); ?></p>
					</div>
					<?php
						endif;
						if(!empty($page_email) && !empty($page_phone)):
					?>
					<div class="section-title-content text-center">
						<?php if(!empty($page_phone)): ?>
						<p><a href="tel:<?php echo $page_phone; ?>"><?php echo $page_phone; ?></a></p>
						<?php
							endif;
							if(!empty($page_email)):
						?>
						<p><a href="mailto:<?php echo antispambot($page_email); ?>"><?php echo antispambot($page_email); ?></a></p>
						<?php
							endif;
						?>
					</div>
					<?php endif; ?>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="grid-3_md-1-middle">
							<div class="col">
								<div class="logo">
									<p><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="227.288" height="72.828" viewBox="0 0 227.288 72.828"> <g transform="translate(0 0)"> <path d="M72.433,72.442H0V0H72.433ZM68,47.968V68H4.438V31.645l.713-1.256a20.878,20.878,0,0,1,6.878-6.432,13.829,13.829,0,0,1,6.619-2.16h.021c7.493-.081,13,4.218,14.04,11.77A30.588,30.588,0,0,0,37.05,46.258a20.005,20.005,0,0,0,8.987,7.9,17.1,17.1,0,0,0,6.56,1.315,20.093,20.093,0,0,0,10.777-3.411A21.289,21.289,0,0,0,68,47.968M4.438,4.447H68v34l-1.057,2.686a15.257,15.257,0,0,1-6.012,7.226A16.31,16.31,0,0,1,53.8,50.985V46.228a9.526,9.526,0,1,0-1.994.051v4.739a12.644,12.644,0,0,1-4.044-.955A15.576,15.576,0,0,1,40.8,43.882,26.407,26.407,0,0,1,37.11,33.015v-.038c-1.345-9.789-8.753-15.729-18.487-15.619a18.047,18.047,0,0,0-8.868,2.783,29.077,29.077,0,0,0-5.317,4.107Z" transform="translate(0 0)" fill="#fff" fill-rule="evenodd"/> <path  d="M159.272,46.266V38.624H158.22V36.532h1.052V33.715h2.686v2.817h1.052v2.092h-1.052v7.642ZM157.97,30.8v2.274h-.132c-.055,0-.106,0-.182,0a.753.753,0,0,0-.687.28,3.671,3.671,0,0,0-.182,1.519v1.659h1.184v2.049h-1.184v7.684h-2.677V38.581h-.976V36.532h.976V33.948a6.008,6.008,0,0,1,.127-1.464,2.13,2.13,0,0,1,.395-.861,2.493,2.493,0,0,1,.95-.7,3.7,3.7,0,0,1,1.345-.233c.136,0,.28.008.467.021.157.021.348.051.577.093M152,46.266h-2.529V44.827a3.506,3.506,0,0,1-.959,1.218,2.05,2.05,0,0,1-1.218.407,2.324,2.324,0,0,1-2.13-1.3,7.5,7.5,0,0,1-.738-3.734,7.585,7.585,0,0,1,.743-3.683,2.4,2.4,0,0,1,2.134-1.307,1.977,1.977,0,0,1,1.18.39,3.65,3.65,0,0,1,.989,1.2V36.532H152Zm-2.529-5.02a4.824,4.824,0,0,0-.3-1.973,1.02,1.02,0,0,0-.976-.649.863.863,0,0,0-.84.615,5.435,5.435,0,0,0-.276,2.024,5.646,5.646,0,0,0,.305,2.079.937.937,0,0,0,.883.687.951.951,0,0,0,.916-.662,5.331,5.331,0,0,0,.284-2.122m-9.114,5.02V40.372a2.3,2.3,0,0,0-.2-1.146.733.733,0,0,0-.683-.314.827.827,0,0,0-.743.361,2.392,2.392,0,0,0-.221,1.209v5.783h-2.69V30.88h2.69v6.831a3.506,3.506,0,0,1,1.154-.967A2.947,2.947,0,0,1,141,36.426a1.8,1.8,0,0,1,1.583.636,4.822,4.822,0,0,1,.446,2.55v6.653Zm-5.715-6.971a2.966,2.966,0,0,0-.628-.352,1.763,1.763,0,0,0-.6-.106,1.4,1.4,0,0,0-1.214.675,3.059,3.059,0,0,0-.467,1.812,3.114,3.114,0,0,0,.467,1.854,1.511,1.511,0,0,0,1.3.653,1.42,1.42,0,0,0,.6-.127,2.312,2.312,0,0,0,.539-.382v2.563a3.475,3.475,0,0,1-.878.42,3.54,3.54,0,0,1-.967.149,3.271,3.271,0,0,1-2.733-1.366,6.1,6.1,0,0,1-1-3.7,5.92,5.92,0,0,1,1.018-3.674,3.2,3.2,0,0,1,2.711-1.362,3.749,3.749,0,0,1,.933.1,4.918,4.918,0,0,1,.912.284Zm-12.513,6.14,1.116-1.977a5.809,5.809,0,0,0,.861.484,1.8,1.8,0,0,0,.67.153.681.681,0,0,0,.5-.2.636.636,0,0,0,.221-.488c0-.352-.339-.726-1.01-1.137l-.395-.255a4.649,4.649,0,0,1-1.337-1.256,2.7,2.7,0,0,1-.382-1.443,2.815,2.815,0,0,1,.849-2.164,3.241,3.241,0,0,1,2.3-.8,4.8,4.8,0,0,1,1.383.2,4.751,4.751,0,0,1,1.273.632L127.042,39.1a3.827,3.827,0,0,0-.717-.479,1.478,1.478,0,0,0-.619-.161.768.768,0,0,0-.53.182.558.558,0,0,0-.191.458c0,.284.289.615.912,1,.191.115.335.225.437.289a5.062,5.062,0,0,1,1.434,1.354,2.692,2.692,0,0,1,.412,1.515,3,3,0,0,1-.925,2.3,3.432,3.432,0,0,1-2.452.891,3.838,3.838,0,0,1-1.392-.255,4.779,4.779,0,0,1-1.286-.764m-1.154.832h-2.605V44.848a2.955,2.955,0,0,1-.925,1.209,1.972,1.972,0,0,1-1.243.407,2.272,2.272,0,0,1-2.071-1.315,7.793,7.793,0,0,1-.734-3.734,7.381,7.381,0,0,1,.755-3.687,2.351,2.351,0,0,1,2.134-1.3,1.993,1.993,0,0,1,1.15.369,3.547,3.547,0,0,1,.933,1.116V30.88h2.605Zm-2.605-5.02a5.7,5.7,0,0,0-.267-2.02.962.962,0,0,0-.921-.624.885.885,0,0,0-.853.628,5.636,5.636,0,0,0-.263,2.032,5.885,5.885,0,0,0,.284,2.1.965.965,0,0,0,.9.687.87.87,0,0,0,.857-.636,6.008,6.008,0,0,0,.263-2.168m-9.05,5.02V40.372a2.269,2.269,0,0,0-.191-1.146.728.728,0,0,0-.675-.314.815.815,0,0,0-.738.361,2.341,2.341,0,0,0-.225,1.209v5.783h-2.7V36.532h2.508v1.506a3.833,3.833,0,0,1,1.18-1.209,2.843,2.843,0,0,1,1.5-.4,1.782,1.782,0,0,1,1.578.645,4.917,4.917,0,0,1,.458,2.542v6.653Zm-6.365,0h-2.529V44.827a3.666,3.666,0,0,1-.963,1.218,2.085,2.085,0,0,1-1.214.407,2.331,2.331,0,0,1-2.134-1.3,7.546,7.546,0,0,1-.734-3.734,7.533,7.533,0,0,1,.747-3.683,2.386,2.386,0,0,1,2.134-1.307,1.987,1.987,0,0,1,1.18.39,3.7,3.7,0,0,1,.984,1.2V36.532h2.529Zm-2.529-5.02a4.9,4.9,0,0,0-.3-1.973,1.036,1.036,0,0,0-.976-.649.86.86,0,0,0-.84.615,5.347,5.347,0,0,0-.276,2.024,5.708,5.708,0,0,0,.289,2.079.968.968,0,0,0,.9.687.943.943,0,0,0,.912-.662,5.752,5.752,0,0,0,.284-2.122m-11.673,5.02V31.771H91.6v11.66H94.9v2.834Zm-9.267-1.014a3.93,3.93,0,0,1-1.243.827,3.584,3.584,0,0,1-1.438.289,3.672,3.672,0,0,1-2.826-1.243,4.308,4.308,0,0,1-1.137-3.034,4.045,4.045,0,0,1,.573-2.071,5.81,5.81,0,0,1,1.7-1.748,11.941,11.941,0,0,1-.883-1.723A3.982,3.982,0,0,1,74,35.225a2.979,2.979,0,0,1,.925-2.312,3.572,3.572,0,0,1,2.5-.857,3.23,3.23,0,0,1,2.274.832,2.884,2.884,0,0,1,.883,2.164,3.744,3.744,0,0,1-.594,1.99,6.108,6.108,0,0,1-1.744,1.774l1.85,2.911,1.443-1.532,1.455,2.041-1.634,1.489,1.612,2.542H80.114Zm-2.448-8.316.305-.267a2.446,2.446,0,0,0,.577-.721,1.691,1.691,0,0,0,.2-.776,1.043,1.043,0,0,0-.221-.709.677.677,0,0,0-.564-.272.873.873,0,0,0-.721.3,1.041,1.041,0,0,0-.284.755,1.561,1.561,0,0,0,.093.522,1.28,1.28,0,0,0,.2.467Zm1.243,6.4-1.808-2.868a2.72,2.72,0,0,0-.81.717,1.5,1.5,0,0,0-.242.832,1.746,1.746,0,0,0,.458,1.243,1.412,1.412,0,0,0,1.095.509,2.174,2.174,0,0,0,.6-.106,4.063,4.063,0,0,0,.7-.327M64.245,46.266V40.372a2.318,2.318,0,0,0-.191-1.146.733.733,0,0,0-.683-.314.832.832,0,0,0-.743.361,2.392,2.392,0,0,0-.221,1.209v5.783h-2.69V36.532h2.495v1.506a3.925,3.925,0,0,1,1.18-1.209,2.871,2.871,0,0,1,1.5-.4,1.792,1.792,0,0,1,1.591.645,4.982,4.982,0,0,1,.45,2.542v6.653ZM53.285,42.12v.072a3.012,3.012,0,0,0,.382,1.68,1.229,1.229,0,0,0,1.1.581,1.172,1.172,0,0,0,.789-.276,1.825,1.825,0,0,0,.509-.844h2.325a4.06,4.06,0,0,1-1.315,2.291,3.733,3.733,0,0,1-2.448.827,3.521,3.521,0,0,1-2.894-1.366,5.8,5.8,0,0,1-1.073-3.679,5.82,5.82,0,0,1,1.073-3.7,3.494,3.494,0,0,1,2.894-1.362,3.385,3.385,0,0,1,2.906,1.341,6.615,6.615,0,0,1,.976,3.955v.475Zm2.868-1.557A2.968,2.968,0,0,0,55.771,39a1.175,1.175,0,0,0-1.057-.513,1.241,1.241,0,0,0-1.073.535,2.862,2.862,0,0,0-.356,1.561Zm-9.789,5.7V38.624H45.312V36.532h1.052V33.715h2.69v2.817H50.1v2.092H49.055v7.642Zm-5.957,0V36.532H42.9v1.731a3.171,3.171,0,0,1,.87-1.434A2.014,2.014,0,0,1,45.1,36.35v2.563h-.178a1.739,1.739,0,0,0-1.447.5,4.361,4.361,0,0,0-.382,2.274v4.582Zm-1.892,0H35.986V44.827a3.666,3.666,0,0,1-.963,1.218,2.028,2.028,0,0,1-1.214.407,2.324,2.324,0,0,1-2.13-1.3,7.5,7.5,0,0,1-.738-3.734,7.586,7.586,0,0,1,.743-3.683,2.406,2.406,0,0,1,2.139-1.307,1.987,1.987,0,0,1,1.18.39,3.7,3.7,0,0,1,.984,1.2V36.532h2.529Zm-2.529-5.02a4.824,4.824,0,0,0-.3-1.973,1.02,1.02,0,0,0-.976-.649.863.863,0,0,0-.84.615,5.526,5.526,0,0,0-.276,2.024,5.707,5.707,0,0,0,.289,2.079.975.975,0,0,0,.9.687.944.944,0,0,0,.917-.662,5.752,5.752,0,0,0,.284-2.122m-11.575-3.17H29.8v.335c.008.144.008.255.008.331a10.354,10.354,0,0,1-1.328,5.669,4.322,4.322,0,0,1-7.315.042,9.5,9.5,0,0,1-1.341-5.427A9.37,9.37,0,0,1,21.2,33.579a4.389,4.389,0,0,1,3.785-2,4.232,4.232,0,0,1,2.775.959,5.485,5.485,0,0,1,1.659,2.766l-2.614,1.205a3.084,3.084,0,0,0-.624-1.621,1.56,1.56,0,0,0-1.243-.535,1.785,1.785,0,0,0-1.71,1.124,8.844,8.844,0,0,0-.539,3.547,8.365,8.365,0,0,0,.573,3.5,1.8,1.8,0,0,0,1.676,1.192,1.7,1.7,0,0,0,1.485-.81,3.953,3.953,0,0,0,.564-2.27h-2.58Zm90.958-14.367V13.967h2.495V15.7a3.136,3.136,0,0,1,.87-1.426,2,2,0,0,1,1.332-.484v2.559h-.191a1.7,1.7,0,0,0-1.438.5,4.475,4.475,0,0,0-.382,2.279v4.578Zm-4.888-12.865a1.128,1.128,0,0,1,.356-.827,1.147,1.147,0,0,1,.823-.356,1.161,1.161,0,0,1,.849.356,1.121,1.121,0,0,1,.365.827,1.174,1.174,0,0,1-.352.844,1.188,1.188,0,0,1-.861.348,1.134,1.134,0,0,1-.823-.352,1.149,1.149,0,0,1-.356-.84m-3.25,0a1.128,1.128,0,0,1,.356-.827,1.148,1.148,0,0,1,1.663,0,1.093,1.093,0,0,1,.352.827,1.117,1.117,0,0,1-.344.844,1.173,1.173,0,0,1-.849.348,1.129,1.129,0,0,1-.827-.352,1.162,1.162,0,0,1-.352-.84m6.373,3.123v5.049c0,1.943-.276,3.237-.785,3.891a3.348,3.348,0,0,1-2.783.984,3.426,3.426,0,0,1-2.8-.98c-.509-.641-.785-1.948-.785-3.9V13.967h2.635v6.267a1.81,1.81,0,0,0,.2,1.031.9.9,0,0,0,.747.267.83.83,0,0,0,.721-.276,1.687,1.687,0,0,0,.225-1.023V13.967Zm-8.113-5.72v2.279c-.034,0-.076-.008-.127-.008s-.1,0-.17,0a.793.793,0,0,0-.7.284,3.821,3.821,0,0,0-.178,1.523v1.646h1.18v2.058h-1.18v7.684h-2.677V16.025h-.976V13.967h.976v-2.58a5.923,5.923,0,0,1,.123-1.468,2.222,2.222,0,0,1,.407-.857,2.267,2.267,0,0,1,.933-.687,3.756,3.756,0,0,1,1.371-.246,3.2,3.2,0,0,1,.441.034,3.918,3.918,0,0,1,.581.085M90.471,19.564v.068a3.12,3.12,0,0,0,.382,1.689,1.23,1.23,0,0,0,1.095.581,1.189,1.189,0,0,0,.785-.276,1.916,1.916,0,0,0,.513-.849h2.321a4.027,4.027,0,0,1-1.315,2.283,3.694,3.694,0,0,1-2.444.832,3.513,3.513,0,0,1-2.9-1.362,5.753,5.753,0,0,1-1.065-3.674,5.822,5.822,0,0,1,1.065-3.708,3.51,3.51,0,0,1,2.9-1.358,3.4,3.4,0,0,1,2.9,1.337,6.774,6.774,0,0,1,.976,3.963v.475Zm2.868-1.557a3.04,3.04,0,0,0-.386-1.57,1.349,1.349,0,0,0-2.134.03,2.756,2.756,0,0,0-.348,1.549Zm-9.793,5.7V16.064H82.494v-2.1h1.052v-2.8h2.686v2.8h1.052v2.1H86.232v7.646Zm-5.974,0V13.967H80.08V15.7a3.214,3.214,0,0,1,.874-1.426,1.987,1.987,0,0,1,1.328-.484v2.559H82.1a1.715,1.715,0,0,0-1.443.5,4.282,4.282,0,0,0-.386,2.279v4.578Zm-6.466-4.145v.068a3.12,3.12,0,0,0,.382,1.689A1.268,1.268,0,0,0,72.6,21.9a1.137,1.137,0,0,0,.768-.276,2.054,2.054,0,0,0,.53-.849h2.308a3.957,3.957,0,0,1-1.315,2.283,3.69,3.69,0,0,1-2.448.832,3.525,3.525,0,0,1-2.9-1.362,5.8,5.8,0,0,1-1.057-3.674,5.872,5.872,0,0,1,1.057-3.708,3.521,3.521,0,0,1,2.9-1.358,3.349,3.349,0,0,1,2.9,1.337,6.675,6.675,0,0,1,.989,3.963v.475Zm2.868-1.557a3,3,0,0,0-.382-1.57,1.327,1.327,0,0,0-2.113.03,2.612,2.612,0,0,0-.373,1.549ZM59.951,27.63V13.967h2.52v1.5a3.98,3.98,0,0,1,1.006-1.209,1.969,1.969,0,0,1,1.18-.382,2.307,2.307,0,0,1,2.109,1.307,7.438,7.438,0,0,1,.76,3.713,7.644,7.644,0,0,1-.751,3.721,2.24,2.24,0,0,1-2.062,1.32,2.036,2.036,0,0,1-1.256-.42,3.114,3.114,0,0,1-.921-1.226V27.63Zm3.785-11.567a.969.969,0,0,0-.917.615,5.132,5.132,0,0,0-.284,2.007,6.1,6.1,0,0,0,.276,2.168.911.911,0,0,0,.891.636.923.923,0,0,0,.866-.687,6.017,6.017,0,0,0,.289-2.16,5.447,5.447,0,0,0-.263-1.965.906.906,0,0,0-.857-.615m-12.3,7.646,2.486-5.227-2.325-4.515h2.58l.81,1.638a2.815,2.815,0,0,1,.242.586,1.786,1.786,0,0,1,.106.518,4.254,4.254,0,0,1,.127-.552,4.158,4.158,0,0,1,.246-.573l.743-1.617h2.673l-2.461,4.481,2.529,5.261H56.51L55.64,21.5a4.858,4.858,0,0,1-.161-.6c-.064-.225-.093-.462-.149-.73-.038.255-.085.488-.136.7a3.084,3.084,0,0,1-.212.6l-.938,2.236Zm-6.653,0V9.219h6.093V11.9H47.578V14.82h2.983v2.665H47.578v3.39h3.293v2.834Zm-10.323,0V13.967h2.491V15.7a3.3,3.3,0,0,1,.878-1.426,2,2,0,0,1,1.32-.484v2.559h-.17a1.733,1.733,0,0,0-1.455.5,4.428,4.428,0,0,0-.382,2.279v4.578Zm-4.455,0V17.816a2.4,2.4,0,0,0-.2-1.154.773.773,0,0,0-.679-.314.809.809,0,0,0-.743.373,2.409,2.409,0,0,0-.233,1.209v5.779H25.468V8.32h2.682v6.827a4.1,4.1,0,0,1,1.167-.967,2.93,2.93,0,0,1,1.32-.306,1.8,1.8,0,0,1,1.591.636,4.731,4.731,0,0,1,.458,2.55v6.649Zm-6.636,0H20.427V9.219h2.936Z" transform="translate(64.277 26.363)" fill="#fff"/> </g> </svg></p>
								</div>
							</div>
							<div class="col-bottom text-center">
								<?php
									if(has_nav_menu('footer_menu'))
									{
										wp_nav_menu(array('theme_location' => 'footer_menu', 'depth' => 1));
									}
								?>
							</div>
							<div class="col-bottom text-right">
								<p><?php printf(__('©%u Ullrich Gärten', 'ullrichgarten'), date('Y'));?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		</div></div>
		<?php wp_footer(); ?>
	</body>
</html>
