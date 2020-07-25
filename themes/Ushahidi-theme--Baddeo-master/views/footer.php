	<!-- footer -->
	<footer id="global-footer">
		<div class="center cf">
			<div class="footer-credits">
				Powered by the &nbsp;
				<a href="http://www.ushahidi.com/">
					<img src="<?php echo url::file_loc('img'); ?>media/img/footer-logo.png" alt="Ushahidi" style="vertical-align:middle" />
				</a>
				&nbsp; Platform
			</div>
	
			<!-- footer menu -->
			<nav>
			<ul class="footer-menu">
				<li>
					<a class="item1" href="<?php echo url::site(); ?>">
						<?php echo Kohana::lang('ui_main.home'); ?>
					</a>
				</li>
	
				<?php if (Kohana::config('settings.allow_reports')): ?>
				<li>
					<a href="<?php echo url::site()."reports/submit"; ?>">
						<?php echo Kohana::lang('ui_main.submit'); ?>
					</a>
				</li>
				<?php endif; ?>
				
				<?php if (Kohana::config('settings.allow_alerts')): ?>
					<li>
						<a href="<?php echo url::site()."alerts"; ?>">
							<?php echo Kohana::lang('ui_main.alerts'); ?></a>
					</li>
				<?php endif; ?>
	
				<?php if (Kohana::config('settings.site_contact_page')): ?>
				<li>
					<a href="<?php echo url::site()."contact"; ?>">
						<?php echo Kohana::lang('ui_main.contact'); ?>
					</a>
				</li>
				<?php endif; ?>
	
				<?php
				// Action::nav_main_bottom - Add items to the bottom links
				Event::run('ushahidi_action.nav_main_bottom');
				?>
			</ul>
			</nav>
	
			<?php if ($site_copyright_statement != ''): ?>
			<p><?php echo $site_copyright_statement; ?></p>
			<?php endif; ?>

		</div>
	</footer>
	<!-- / footer -->

	<?php
	echo $footer_block;
	// Action::main_footer - Add items before the </body> tag
	Event::run('ushahidi_action.main_footer');
	?>
</body>
</html>
