	<div id="content">
		<div class="center">
			<?php if ($site_message != ''): ?>
			<div class="green-box col_12">
				<h3><?php echo $site_message; ?></h3>
			</div>
			<?php endif; ?>
			<div id="map-container" class="col_12">
				<?php								
				// Map and Timeline Blocks
				echo $div_map;
				?>	
			</div>
			<div id="map-controls" class="cf">
				<div class="col_4">
					<h3>Filter by category</h3>
					<ul id="category_switch" class="filters">
						<?php
						$color_css = 'class="swatch" style="background-color:#'.$default_map_all.'"';
						$all_cat_image = '';
						if ($default_map_all_icon != NULL)
						{
							$all_cat_image = html::image(array(
								'src'=>$default_map_all_icon,
								'style'=>'float:left;padding-right:5px;'
							));
							$color_css = '';
						}
						?>
						<li>
							<a class="active" id="cat_0" href="#">
								<span <?php echo $color_css; ?>><?php echo $all_cat_image; ?></span>
								<span class="category-title"><?php echo Kohana::lang('ui_main.all_categories');?></span>
							</a>
						</li>
						<?php
							foreach ($categories as $category => $category_info)
							{
								$category_title = $category_info[0];
								$category_color = $category_info[1];
								$category_image = ($category_info[2] != NULL)
									? url::convert_uploaded_to_abs($category_info[2])
									: NULL;
		
								$color_css = 'class="swatch" style="background-color:#'.$category_color.'"';
								if ($category_info[2] != NULL)
								{
									$category_image = html::image(array(
										'src'=>$category_image,
										'style'=>'float:left;padding-right:5px;'
										));
									$color_css = '';
								}
		
								echo '<li>'
									. '<a href="#" id="cat_'. $category .'">'
									. '<span '.$color_css.'>'.$category_image.'</span>'
									. '<span class="category-title">'.$category_title.'</span>'
									. '</a>';
		
								// Get Children
								echo '<div class="hide" id="child_'. $category .'">';
								if (sizeof($category_info[3]) != 0)
								{
									echo '<ul>';
									foreach ($category_info[3] as $child => $child_info)
									{
										$child_title = $child_info[0];
										$child_color = $child_info[1];
										$child_image = ($child_info[2] != NULL)
											? url::convert_uploaded_to_abs($child_info[2])
											: NULL;
										
										$color_css = 'class="swatch" style="background-color:#'.$child_color.'"';
										if ($child_info[2] != NULL)
										{
											$child_image = html::image(array(
												'src' => $child_image,
												'style' => 'float:left;padding-right:5px;'
											));
		
											$color_css = '';
										}
		
										echo '<li style="padding-left:20px;">'
											. '<a href="#" id="cat_'. $child .'">'
											. '<span '.$color_css.'>'.$child_image.'</span>'
											. '<span class="category-title">'.$child_title.'</span>'
											. '</a>'
											. '</li>';
									}
									echo '</ul>';
								}
								echo '</div></li>';
							}
						?>
					</ul>
				</div>
				<div class="col_4">
					<h3>Filter by media type</h3>
					<ul class="filters">
						<li><a id="media_0" class="active" href="#"><span><?php echo Kohana::lang('ui_main.reports'); ?></span></a></li>
						<li><a id="media_4" href="#"><span><?php echo Kohana::lang('ui_main.news'); ?></span></a></li>
						<li><a id="media_1" href="#"><span><?php echo Kohana::lang('ui_main.pictures'); ?></span></a></li>
						<li><a id="media_2" href="#"><span><?php echo Kohana::lang('ui_main.video'); ?></span></a></li>
						<li><a id="media_0" href="#"><span><?php echo Kohana::lang('ui_main.all'); ?></span></a></li>
					</ul>
				</div>
				<div class="col_4">
					<?php if ($layers): ?>
						<!-- Layers (KML/KMZ) -->
						<h3>Filter by layers</h3>
						<ul id="kml_switch" class="category-filters">
						<?php
							foreach ($layers as $layer => $layer_info)
							{
								$layer_name = $layer_info[0];
								$layer_color = $layer_info[1];
								$layer_url = $layer_info[2];
								$layer_file = $layer_info[3];
		
								$layer_link = ( ! $layer_url)
									? url::base().Kohana::config('upload.relative_directory').'/'.$layer_file
									: $layer_url;
								
								echo '<li>'
									. '<a href="#" id="layer_'. $layer .'">'
									. '<div class="swatch" style="background-color:#'.$layer_color.'"></div>'
									. '<div class="layer-name">'.$layer_name.'</div>'
									. '</a>'
									. '</li>';
							}
						?>
						</ul>
						<!-- /Layers -->
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div id="modules">
		<div class="center cf">
			<!-- additional content -->
			<?php if (Kohana::config('settings.allow_reports')): ?>
				<article class="module col_4">
					<h1><?php echo Kohana::lang('ui_main.how_to_report'); ?></h1>
					<!-- Phone -->
					<?php if ( ! empty($phone_array)): ?>
						<?php echo Kohana::lang('ui_main.report_option_1'); ?>
						<?php foreach ($phone_array as $phone): ?>
							<h2><?php echo $phone; ?></h2>
							<?php if ($phone != end($phone_array)): ?>

							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
						
					<!-- External Apps -->
					<?php if (count($external_apps) > 0): ?>
						<h2><?php echo Kohana::lang('ui_main.report_option_external_apps'); ?>:</h2>
						<ul>
						<?php foreach ($external_apps as $app): ?>
							<li><a href="<?php echo $app->url; ?>"><?php echo $app->name; ?></a></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<!-- Email -->
					<?php if ( ! empty($report_email)): ?>
						<h2><?php echo Kohana::lang('ui_main.report_option_2'); ?>:</h2>
						<p><a href="mailto:<?php echo $report_email?>"><?php echo $report_email?></a></p>
					<?php endif; ?>

					<!-- Twitter -->
					<?php if ( ! empty($twitter_hashtag_array)): ?>
						<h2><?php echo Kohana::lang('ui_main.report_option_3'); ?>:</h2>
						<?php foreach ($twitter_hashtag_array as $twitter_hashtag): ?>
							<span class="hashtag">#<?php echo $twitter_hashtag; ?></span>
							<?php if ($twitter_hashtag != end($twitter_hashtag_array)): ?>

							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>

					<!-- Web Form -->
					<h2><a href="<?php echo url::site().'reports/submit/'; ?>"><?php echo Kohana::lang('ui_main.report_option_4'); ?></a></h2>

				</article>
			<?php endif; ?>
			<!-- / additional content -->

			<!-- Checkins -->
			<?php if (Kohana::config('settings.checkins')): ?>
			<article class="module">
				<h5><?php echo Kohana::lang('ui_admin.checkins'); ?></h5>
				<div id="cilist"></div>
			</article>
			<?php endif; ?>
			<!-- /Checkins -->

			<?php
			// Action::main_sidebar - Add Items to the Entry Page Sidebar
			Event::run('ushahidi_action.main_sidebar');
			?>

			<?php
			// Action::main_filters - Add items to the main_filters
			Event::run('ushahidi_action.map_main_filters');
			?>

			<?php blocks::render(); ?>
		</div>
	</div>






			

			
