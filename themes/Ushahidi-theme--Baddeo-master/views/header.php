<!DOCTYPE html> 
<html> 
<head> 
	<title><?php echo $page_title.$site_name; ?></title>
	<meta charset="utf-8"> 
	<?php echo $header_block; ?>
		<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>
	<script>
	$(document).ready(function() {
		$("LINK[href='<?php echo url::site();?>media/css/global.css']").remove();

		// Create the dropdown base
		$("<select />").appendTo("nav#global-menu");
		
		// Create default option "Go to..."
		$("<option />", {
		   "selected": "selected",
		   "value"   : "",
		   "text"    : "Go to..."
		}).appendTo("nav select");
		
		// Populate dropdown with menu items
		$("nav#global-menu a").each(function() {
		 var el = $(this);
		 $("<option />", {
			 "value"   : el.attr("href"),
			 "text"    : el.text()
		 }).appendTo("nav#global-menu select");
		});

		$("nav select").change(function() {
		  window.location = $(this).find("option:selected").val();
		});
	});
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
  // Add a class to the body tag according to the page URI
  // we're on the home page
  if (count($uri_segments) == 0)
  {
    $body_class = "page-main";
  }
  // 1st tier pages
  elseif (count($uri_segments) == 1)
  {
    $body_class = "page-".$uri_segments[0];
  }
  // 2nd tier pages... ie "/reports/submit"
  elseif (count($uri_segments) >= 2)
  {
    $body_class = "page-".$uri_segments[0]."-".$uri_segments[1];
  }

?>

<body class="<?php echo $body_class; ?>">

<?php echo $header_nav; ?>

	<header id="global-header">
		<div class="center cf">
			<?php if ($banner == NULL): ?>
			<hgroup class="col_12">
				<h1><a href="<?php echo url::site();?>"><?php echo $site_name; ?></a></h1>
				<h2><?php echo $site_tagline; ?></h2>
			</hgroup>
			<?php else: ?>
			<hgroup class="col_12 nodisplay">
				<h1><a href="<?php echo url::site();?>"><?php echo $site_name; ?></a></h1>
				<h2><?php echo $site_tagline; ?></h2>
			</hgroup>
			<a href="<?php echo url::site();?>"><img src="<?php echo $banner; ?>" alt="<?php echo $site_name; ?>" /></a>
			<?php endif; ?>

			<nav id="global-menu" class="col_8">
				<ul>
					<?php nav::main_tabs($this_page); ?>
				</ul>
			</nav>
			<div id="global-search" class="col_4">
				<!-- languages -->
				<?php echo $languages;?>
				<!-- / languages -->
	
				<!-- searchform -->
				<?php echo $search; ?>
				<!-- / searchform -->
			</div>
		</div>
	</header>

			<?php
				// Action::main_sidebar - Add Items to the Entry Page Sidebar
				Event::run('ushahidi_action.main_sidebar');
			?>
			
			<?php if(isset($site_message) AND $site_message != '') { ?>
				<div class="site-message">
					<?php echo $site_message; ?>
				</div>
			<?php } ?>

        <?php
            // Action::header_item - Additional items to be added by plugins
	        Event::run('ushahidi_action.header_item');
        ?>