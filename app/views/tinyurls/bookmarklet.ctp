<script type="text/javascript">
	$(function() {
		copyToClipboard();
	});
</script>

<?php if (isset($copyFunction)) { ?>
		<div class="linkMessage grid_20 push_2  message">
			You can view the link at <?php echo $html->link(
   	 			$html->url(array("controller" => $alias), true),
   				 $html->url(array("controller" => $alias), true),
  			 		 array('id'=>'newLink'));?>
		</div>
		<div class="clear"></div>

		<div id="d_clip_container" class="grid_3 push_15 vMarginTop_1 vMarginBottom_5">	
 			  <div id="my_clip_button" class="my_clip_button">Copy Link</div>
		</div>
		<div class="clear"></div>
	<?php } ?>



<a href="javascript:location.href=('<?/*= $html->url(array( "controller" => "tinyurls",  "action" => "bookmarklet", "?create="), true); */?>' + location.href)"><!-- bookmarklet--></a>