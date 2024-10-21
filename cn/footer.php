		<footer>
			<div class="footer">
				<div class="container-medium">
					<div class="grid">
						<div class="col-3_lg-4_md-6_sm-12">
						<?php
							if(is_active_sidebar('footer_one_widget'))
							{
								dynamic_sidebar('footer_one_widget');
							}
						?>
						</div>
						<div class="col-3_lg-4_md-6_sm-12">
						<?php
							if(is_active_sidebar('footer_two_widget'))
							{
								dynamic_sidebar('footer_two_widget');
							}
						?>
						</div>
						<div class="col-5_lg-4_md-8_sm-12">
						<?php
							if(is_active_sidebar('footer_three_widget'))
							{
								dynamic_sidebar('footer_three_widget');
							}
						?>
						</div>
						<div class="col-1_lg-4_md-6_sm-12">
						<?php
							if(is_active_sidebar('footer_four_widget'))
							{
								dynamic_sidebar('footer_four_widget');
							}
						?>
						</div>
						<div class="col-3_lg-4_md-6_sm-12">
						<?php
							if(is_active_sidebar('footer_five_widget'))
							{
								dynamic_sidebar('footer_five_widget');
							}
						?>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container-medium">
					<div class="grid-2_sm-1-middle">
						<div class="col">
							<?php echo sprintf(__('Ⓒ %s, PO', 'cn'), date('Y')); ?>
						</div>
						<div class="col text-right">
							<a href="<?php echo get_url_for_slug('rodo'); ?>"><?php echo __('RODO', 'cn'); ?></a> | <a href="<?php echo get_url_for_slug('regulamin'); ?>"><?php echo __('Regulamin', 'cn'); ?></a> | <?php the_privacy_policy_link(); ?>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
