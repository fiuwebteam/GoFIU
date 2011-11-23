<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 	<?php echo $html->charset(); ?>
  <title><?php __('Florida International University - GOFIU'); ?></title>
  <?=  $html->css('banner');?>
  <?= $html->css('core/960_24_col.css', NULL, array('media' => 'all')); 
  		echo '<!--[if IE]>';
		echo $html->css('ie-only');
		echo '<![endif]-->';
		
		echo '<!--[if IE 6]>';
		echo $html->css('ie6');
		echo '<![endif]-->';
  
  ?>
  
  
  <?php
		echo $html->meta('icon');

		/*echo $html->css('cake.generic');*/
		
		
		
	/*	echo $html->css('core/reset', NULL, array('media' => 'all'));
		echo $html->css('core/text', NULL, array('media' => 'all'));
	*/
?>
  
 </head>
 <body>
 	<?php $session->flash(); ?>
 	<?php echo $content_for_layout; ?>
 	<?php echo $cakeDebug; ?>
 </body>
</html>



<?php 

/*
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Florida International University - TinyUrl'); ?>
		<?php // echo $title_for_layout; ?>
	</title>
	
	
	<?php
		echo $html->meta('icon');

		/*echo $html->css('cake.generic');*/
		/*
		
		
		echo $html->css('core/reset', NULL, array('media' => 'all'));
		echo $html->css('core/text', NULL, array('media' => 'all'));
		
		
		
		echo '<!--[if IE]>';
		echo $html->css('ie-only');
		echo '<![endif]-->';
		
		echo '<!--[if IE 6]>';
		echo $html->css('ie6');
		echo '<![endif]-->';


		echo $scripts_for_layout;
	?>


</head>
<body style="height: 100%;">
	<div id ="container" style="width:100%;min-width:950px;">
		<div id="header">
			<h1>FIU TinyUrl</h1>
		</div></div><!-- end container -->
		<!--end header-->
		
			<?php echo $content_for_layout; ?>
			<?php $session->flash(); ?>
			
		
		
		
	
       
    	
   
   

<?php /* echo $cakeDebug; */ /* ?>
</body>
</html>
*/
?>