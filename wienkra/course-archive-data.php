<?php

/* Template name: Lista szkoleń */

get_header();
if(have_posts()): while (have_posts()): the_post();
$id_page = get_the_ID();
$url = get_the_permalink();
$get_query_var = get_query_var('course_slug');
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<?php
					if(!empty($get_query_var)):
					$course_api_url = get_api_course_url().'/api/get_course/'.$get_query_var;
					$course_api = file_get_contents($course_api_url);
					$course_list = json_decode($course_api, true);
					if(isset($course_list['data'][0]['id'])):
				?>
					<div class="section-title-content text-center"><h1 class="section-title"><?php echo $course_list['data'][0]['name']; ?></h1></div>
					<?php 
					
						$get_total_person_course_url = get_api_course_url().'/api/get_total_person_course/'.$course_list['data'][0]['id'];
						$get_total_person_course = file_get_contents($get_total_person_course_url);
						$count_total = json_decode($get_total_person_course, true);
						?>
						<div class="course-entry">
							<ul>
								<li><strong><?php echo __('Data szkolenia', 'wienkra'); ?></strong>: <?php echo date("d/m/Y", strtotime($course_list['data'][0]['date'])); ?></li>
								<li><strong><?php echo __('Godziny', 'wienkra'); ?></strong>: <?php echo $course_list['data'][0]['hour_start'].' - '.$course_list['data'][0]['hour_end']; ?></li>
								<?php if($course_list['data'][0]['count'] > 0): if($course_list['data'][0]['registration'] == 1): ?>
								<li><strong><?php echo __('Liczba miejsc', 'wienkra'); ?></strong>: <?php echo $course_list['data'][0]['count']; ?></li>
								<li><strong><?php echo __('Liczba wolnych miejsc', 'wienkra'); ?></strong>: <?php echo $course_list['data'][0]['count'] - $count_total['data']; ?></li>
								<?php endif; endif; ?>
							</ul>
						</div>
						<?php
						echo apply_filters("the_content", $course_list['data'][0]['content']);
													
						if($course_list['data'][0]['count'] > 0 && $count_total['data'] < $course_list['data'][0]['count'] && $course_list['data'][0]['registration'] == 1 )
						{
						
							$rodo_form_cource = rwmb_meta('rodo_form_cource', '', $id_page);
							
							echo '<div class="form-save-course">';
							echo '<p class="custom-title-section text-center">'.__('Zapisz się na szkolenie', 'wienkra').'</p>';
							echo '<div class="form-save-course-info"></div>';
							require_once 'Formr/class.formr.php';
							$form = new Formr\Formr('bulma');
							$form->action = $url;
							$form->id = 'form_save_course';
							$form->open();
							
							$form->hidden('id_course', $course_list['data'][0]['id']);
							$form->hidden('code_course', hash('sha256', $course_list['data'][0]['slug']));
							
							$form->required = 'manager';
							$form->required_indicator = '*';
							$form->text('manager',__('Imię i nazwisko opiekuna handlowego', 'wienkra'));
							
							$form->required = 'name';
							$form->required_indicator = '*';
							$form->text('name',__('Nazwa firmy', 'wienkra'), '', '', 'maxlength="35"');
							
							$form->required = 'nip';
							$form->required_indicator = '*';
							$form->number('nip',__('NIP', 'wienkra'));
							
							echo '<div class="grid"><div class="col-7_xs-7">';
							$form->required = 'street';
							$form->required_indicator = '*';
							$form->text('street',__('Ulica', 'wienkra'));
							echo '</div><div class="col-2_xs-5">';
							$form->required = 'street_number';
							$form->required_indicator = '*';
							$form->text('street_number',__('Numer', 'wienkra'));
							echo '</div><div class="col-3_xs-12">';;
							$form->text('flat_number',__('Numer lokalu', 'wienkra'));
							echo '</div></div>';
							
							$form->required = 'zipcode';
							$form->required_indicator = '*';
							$form->text('zipcode',__('Kod pocztowy', 'wienkra'), '', '', 'maxlength="6"');
							
							$form->required = 'city';
							$form->required_indicator = '*';
							$form->text('city',__('Miasto', 'wienkra'));
							
							$options = [
								'Dolnośląskie' => 'Dolnośląskie',
								'Kujawsko-pomorskie' => 'Kujawsko-pomorskie',
								'Lubelskie' => 'Lubelskie',
								'Lubuskie' => 'Lubuskie',
								'Łódzkie' => 'Łódzkie',
								'Małopolskie' => 'Małopolskie',
								'Mazowieckie' => 'Mazowieckie',
								'Opolskie' => 'Opolskie',
								'Podkarpackie' => 'Podkarpackie',
								'Podlaskie' => 'Podlaskie',
								'Pomorskie' => 'Pomorskie',
								'Śląskie' => 'Śląskie',
								'Świętokrzyskie' => 'Świętokrzyskie',
								'Warmińsko-mazurskie' => 'Warmińsko-mazurskie',
								'Wielkopolskie' => 'Wielkopolskie',
								'Zachodniopomorskie' => 'Zachodniopomorskie'
							];
							
							$form->required = 'voivodeship';
							$form->required_indicator = '*';
							$form->select('voivodeship',__('Województwo', 'wienkra'), '', '', '', '', __('Wybierz województwo', 'wienkra'), $options);
							
							$form->required = 'person';
							$form->required_indicator = '*';
							$form->text('person',__('Imię i nazwisko uczestnika', 'wienkra'));
							
							$form->required = 'email';
							$form->required_indicator = '*';
							$form->email('email',__('E-mail', 'wienkra'));
							
							$form->required = 'phone';
							$form->required_indicator = '*';
							$form->number('phone',__('Telefon', 'wienkra'));
							
							$form->required = 'count';
							$form->required_indicator = '*';
							$form->number('count',__('Ilość osób biorących w szkoleniu', 'wienkra'), '', '', 'min="1"');
							
							$form->text('message',__('Wiadomość dodatkowa', 'wienkra'));
							
							if(isset($rodo_form_cource[0]))
							{
								$agree_count = 1;
								foreach($rodo_form_cource as $single)
								{
									$form->required = 'agree_'.$agree_count;
									$form->checkbox('agree_'.$agree_count,$single,'agree_'.$agree_count,'agree_'.$agree_count);
									$agree_count++;
								}
							}
							
							$form->submit = __('Zapisz się', 'wienkra');
							$form->input_submit();
							
							$form->close();
							echo '</div>';
							
						}
					?>
				<?php
					else:
						echo 'Brak szkolenia';
					endif;
					else:
					$course_api_url = get_api_course_url().'/api/get_course/all';
					$course_api = file_get_contents($course_api_url);
					$course_list = json_decode($course_api, true);
					
					the_content(); ?>
				<br/>
				<?php if(isset($course_list['data'][0]['name'])): ?>
				<div id="course_calendar"></div>
				<script>
					let ec = new EventCalendar(document.getElementById('course_calendar'), {
						view: 'dayGridMonth',
						headerToolbar: {
							start: 'prev,next today',
							center: '',
							end: 'title'
						},
						eventClick: event_click,
						noEventsContent: '<?php echo __('Brak szkoleń', 'wienkra'); ?>',
						buttonText: {today: '<?php echo __('Dzisiaj', 'wienkra'); ?>', dayGridMonth: '<?php echo __('Miesiąc', 'wienkra'); ?>', timeGridWeek: '<?php echo __('Tydzień', 'wienkra'); ?>', listWeek: '<?php echo __('Lista tygodniowa', 'wienkra'); ?>' },
						events: [
							<?php foreach($course_list['data'] as $single): ?>
							{
								resourceId: '<?php echo $url; echo $single['slug']; ?>',
								start: '<?php echo $single['date']; ?> <?php echo $single['hour_start']; ?>',
								end: '<?php echo $single['date']; ?> <?php echo $single['hour_end']; ?>',
								title: '<?php echo $single['name']; ?>',
								editable: false,
								startEditable: false,
								backgroundColor: "#b9a97a"
							},
							<?php endforeach; ?>
						]
					});
					
					function event_click(e) {
						window.location = (e.event.resourceIds);
					}
				</script>
				<br/>
				<?php endif; ?>
				<br/>
				<?php if(isset($course_list['data'][0]['name'])): ?>
				<div class="section-title-content text-center"><p class="section-title"><?php echo __("Aktualne szkolenia", "wienkra"); ?></p></div>
				<div class="grid-2_md-1">
					<?php foreach($course_list['data'] as $single): ?>
					<div class="col">
						<div class="list-post post-type">
							<h2 class="list-post-name"><?php echo $single['name']; ?></h2>
							<div class="list-post-date"><?php echo __("Data szkolenia", "wienkra"); ?>: <?php echo date("d/m/Y", strtotime($single['date'])) ?></div>
							<p><?php echo $single['excerpt'];  ?></p>
							<p><a rel="nofollow" class="custom-read-more" href="<?php echo $url; echo $single['slug']; ?>"><?php echo __("Zobacz więcej", "wienkra"); ?></a></p>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; endif; ?>
			</div>
		</div>
	</div>
<?php endwhile; endif; get_footer(); ?>