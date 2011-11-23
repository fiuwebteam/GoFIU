<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Florida International University - GOFIU'); ?>
		<?php // echo $title_for_layout; ?>
	</title>
	
	
	<?php
		echo $html->meta('icon');

		/*echo $html->css('cake.generic');*/
		
		
		
		echo $html->css('core/reset', NULL, array('media' => 'all'));
		echo $html->css('core/text', NULL, array('media' => 'all'));
		echo $html->css('core/960_24_col.css', NULL, array('media' => 'all'));
		echo $html->css('main', NULL, array('media' => 'all'));
		
		echo '<!--[if IE]>';
		echo $html->css('ie-only');
		echo '<![endif]-->';
		
		echo '<!--[if IE 6]>';
		echo $html->css('ie6');
		echo '<![endif]-->';


		echo $scripts_for_layout;
		
		/*calling javascript files*/
		echo $javascript->link('jquery');
		echo $javascript->link('jquery_qtip')."\n";
		echo $javascript->link('ZeroClipboard')."\n";
		echo $javascript->link('actions')."\n";
		echo $javascript->link('jquery.tablesorter')."\n";
	?>

</head>
<body>
	<div id ="container" class="container_24 addMargins clearfix">
		<div id="header" class="grid_24 vMarginTop_6 clearfix">
		
		<?php echo $html->image("go-fiu-05.gif", array("alt" => "Link to GoFIU page", 'class' => 'gofiu', 'url' => array('controller' => 'tinyurls', 'action' => 'index'))); ?>
			<!-- <span class='go'>GO</span>-->
				
		<?/*php echo $html->image("green-light-108h.gif", array("alt" => "Link to GoFIU page", 'class' => 'light', 'url' => array('controller' => 'tinyurls', 'action' => 'index')));*/ ?>

		<?/*php echo $html->image("fiu-logo-plain.gif", array("alt" => "Link to GoFIU page", 'class' => 'fiu', 'url' => array('controller' => 'tinyurls', 'action' => 'index')));*/ ?>
		
		</div><!--end header-->
		
		<div class="clear"></div>
		<div class="grid_12 push_6 vMarginTop_4 vMarginBottom_2"><?php $session->flash(); ?></div>
		<div class="clear"></div>
		<div id="content">
			<?php echo $content_for_layout; ?>
		</div>
		
			
		<div id="footer" class="grid_24 clearfix">
	    	     	<p>&copy; 2009. Florida International University || Created by <a href="http://webcomm.fiu.edu">Web Communications</a></p>
          
    	</div>
    	<!-- end footer -->	
   </div>
   <!-- end container -->



<?php echo $cakeDebug; ?>
</body>
</html>