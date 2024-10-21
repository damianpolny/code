			<?php if(have_posts()): ?>
				<div class="flat-table-head">
					<div class="grid">
						<div class="col-5_md-12">
							<div class="flat-table-head-range">
								<?php echo __('Metraż', 'contigo'); ?>:
								<div class="flat-table-head-range-input">
									<div class="multi-range">
										<input type="range" min="70" max="135" value="0" id="range_from">
										<input type="range" min="70" max="135" value="135" id="range_to">
									</div>
									<div class="multi-range-output">
										<div id="range_from_output">70 m<sup>2</sup></div>
										<div id="range_to_output">135 m<sup>2</sup></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-7_md-12">
							<div class="grid">
								<div class="col-6_sm-12">
									<p><?php echo __('Liczba pokoi', 'contigo'); ?>: <span class="filter-flat-table" data-number="4" data-column="3">4</span> <span class="filter-flat-table" data-number="5" data-column="3">5</span></p>
								</div>
								<div class="col-6_sm-12">
									<p><?php echo __('Piętro', 'contigo'); ?>: <span class="filter-flat-table" data-number="parter" data-column="4">0</span> <span class="filter-flat-table" data-number="1" data-column="4">1</span> <span class="filter-flat-table" data-number="2" data-column="4">2</span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<table id="flat_table" class="display">
					<thead>
						<tr>
							<th><?php echo __('Typ', 'contigo'); ?></th>
							<th><?php echo __('Numer', 'contigo'); ?></th>
							<th><?php echo __('Metraż', 'contigo'); ?></th>
							<th><?php echo __('Pokoje', 'contigo'); ?></th>
							<th><?php echo __('Piętro', 'contigo'); ?></th>
							<th><?php echo __('Status', 'contigo'); ?></th>
							<th><?php echo __('Rzut', 'contigo'); ?></th>
							<th><?php echo __('Szczegóły', 'contigo'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
							while(have_posts()): the_post();
							$id_post = get_the_ID();
						?>
						<tr>
							<td><?php echo strip_tags(get_the_term_list($id_post, 'typ', '', ', ')); ?></td>
							<td><?php echo rwmb_meta('flat_number', '', $id_post); ?></td>
							<td><?php echo rwmb_meta('flat_size', '', $id_post); ?></td>
							<td><?php echo rwmb_meta('flat_rooms', '', $id_post); ?></td>
							<td><?php echo strip_tags(get_the_term_list($id_post, 'pietro', '', ', ')); ?></td>
							<td><?php 
								$flat_status = rwmb_meta('flat_status', '', $id_post);
								if($flat_status == 0)
								{
									echo __('SPRZEDANE', 'contigo');
								}
								elseif($flat_status == 1)
								{
									echo __('WOLNE', 'contigo');
								}
								else
								{
									echo __('REZERWACJA', 'contigo');
								}
							?></td>
							<td>
								<?php
									$flat_file = rwmb_meta('flat_file', '', $id_post);
									if(is_array($flat_file)):
									foreach($flat_file as $single):
									if(isset($single['ID'])):
								?>
								<a class="custom-button" style="text-wrap:nowrap" href="<?php echo wp_get_attachment_url($single['ID']); ?>"><?php echo __('pobierz pdf', 'contigo'); ?></a>
								<?php endif; endforeach; endif; ?>
							</td>
							<td><a class="custom-button outline" href="<?php the_permalink(); ?>"><?php echo __('SZCZEGÓŁY', 'contigo'); ?></a></td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
				<?php else: ?>
				<p><?php echo __('Nic nie znaleziono.', 'contigo'); ?></p>
				<?php endif; ?>