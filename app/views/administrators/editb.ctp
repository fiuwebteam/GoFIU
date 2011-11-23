<script type="text/javascript">
	function updateBunch() {
		var inputs = $("#BunchUrls").val();
		for (var x = 0; x < inputs; x++ ) {
			$("#bunchUrl" + x).show();
		}
		while (x < 25) {
			$("#bunchUrl" + x).hide();
			$("#BunchUrl" + x + "Url").val("http://");
			
			x++;
		}
		
	}
	
	$(function() {
		updateBunch();
	});		
</script>
		
<h2 class="headings">Create a multi URL "bunch"</h2>
		
<div class="action grid_12 vPaddingTop_2 vPaddingBottom_1 padding_0 alpha omega">
	<?php
		echo $form->create("Bunch", array("url" => array( "controller" => "administrators", "action" => "editb", "id" => $this->params["pass"][0])) );
		echo $form->input('Bunch.alias', array('error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'class' => 'fields'));
		$options = array();
		for($x = 2; $x <= 25; $x++ ) {
			$options[$x] = $x;
		}
		echo $form->input("urls", array( "default" => $urlNumber, 'div' => array('class'=> 'prefix_3 vMarginTop_2'),"options" => $options, "label" => "Number of urls: ", "onchange" => "updateBunch();"));
	?>	


<div class="action padding_0 vMarginTop_2" id="bunchUrl0">
	<?php
		echo $form->input('BunchUrl.0.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
	?>
</div>

<div class="action padding_0 vMarginTop_2" id="bunchUrl1">
	<?php
		echo $form->input('BunchUrl.1.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
	?>
</div>

<div class="action padding_0 vMarginTop_2" id="bunchUrl2">
	<?php
		echo $form->input('BunchUrl.2.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl3">
	<?php
		echo $form->input('BunchUrl.3.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl4">
	<?php
		echo $form->input('BunchUrl.4.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl5">
	<?php
		echo $form->input('BunchUrl.5.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl6">
	<?php
		echo $form->input('BunchUrl.6.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl7">
	<?php
		echo $form->input('BunchUrl.7.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl8">
	<?php
		echo $form->input('BunchUrl.8.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl9">
	<?php
		echo $form->input('BunchUrl.9.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl10">
	<?php
		echo $form->input('BunchUrl.10.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl11">
	<?php
		echo $form->input('BunchUrl.11.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl12">
	<?php
		echo $form->input('BunchUrl.12.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl13">
	<?php
		echo $form->input('BunchUrl.13.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl14">
	<?php
		echo $form->input('BunchUrl.14.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl15">
	<?php
		echo $form->input('BunchUrl.15.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl16">
	<?php
		echo $form->input('BunchUrl.16.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl17">
	<?php
		echo $form->input('BunchUrl.17.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl18">
	<?php
		echo $form->input('BunchUrl.18.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl19">
	<?php
		echo $form->input('BunchUrl.19.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl20">
	<?php
		echo $form->input('BunchUrl.20.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl21">
	<?php
		echo $form->input('BunchUrl.21.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl22">
	<?php
		echo $form->input('BunchUrl.22.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl23">
	<?php
		echo $form->input('BunchUrl.23.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
	?>
</div>
<div class="action padding_0 vMarginTop_2" id="bunchUrl24">
	<?php
		echo $form->input('BunchUrl.24.url',array('default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
			addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
	?>
</div>		


	
<?php
	echo $form->submit('Submit', array('div' => array('class'=> 'submitDiv push_9 padding_0 grid_2 alpha omega vNegMargin_3'), 'class' => 'submit'));
	echo $form->end();
?>
</div>