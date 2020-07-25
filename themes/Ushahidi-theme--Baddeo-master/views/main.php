<script type="text/javascript">
$(function(){
  
  // show/hide report filters and layers boxes on home page map
  $("a.toggle").toggle(
    function() { 
      $($(this).attr("href")).show();
      $(this).addClass("active-toggle");
    },
    function() { 
      $($(this).attr("href")).hide();
      $(this).removeClass("active-toggle");
    }
  );
  
});

</script>

	<div id="content">
		<div class="center">
			<div id="map" class="col_12">
				<?php
				// Map and Timeline Blocks
				echo $div_map;
				echo $div_timeline;
				?>	
			</div>
			<div id="map-controls" class="cf">
				<div class="col_6 categories">

				</div>
				<div class="col_6 filters">

				</div> 
			</div>
		</div>
	</div>