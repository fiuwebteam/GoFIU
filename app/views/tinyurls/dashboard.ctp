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
		
		
		if ( $('#my_clip_button').length ) 
		{
			copyToClipboard();
    	}



		$("#aliasTable").tablesorter({sortList: [[0,0]]});

		//$("#bunchTable").tablesorter({sortList: [[0,0]]});
	
		$('span.formInfo a[title]').qtip(
		{
			position:{
				adjust:{
					 x:15,
					 y:-40
				},
			},
			style:{
				tip:'leftMiddle',
				width:200,
				name:'cream'
			}
		});
				
	});		
</script>

<?php if (isset($copyFunction) && isset($alias)) { ?>
	<div class="linkMessage grid_20 push_2 message">	
		You can view the link at <?php echo str_replace( "https", "http", $html->link(
   	 	$html->url(array("controller" => $alias), true),
   			 $html->url(array("controller" => $alias), true),
  	 			 array('id'=>'newLink')));?>

	</div>
	
	
	<div class="clear"></div>
	<div id="d_clip_container" class="grid_1 push_15 vMarginTop_1 vMarginBottom_5">	
 		<div id="my_clip_button" class="my_clip_button">Copy Link</div>
	</div>
	<div class="clear"></div>

	
<?php } else if (isset($copyFunction) && isset($bunch)) { ?>
	
	
	<div class="linkMessage grid_20 push_2 message">		
		You can view the bunch at <?php echo str_replace( "https", "http", $html->link(
   	 	$html->url(array("controller" => "b", "action" => $bunch), true),
   			 $html->url(array("controller" => "b", "action" => $bunch), true),
  	 			 array('id'=>'newLink')));?>

	</div>
	<div class="clear"></div>
	<div id="d_clip_container" class="grid_1 push_15 vMarginTop_1 vMarginBottom_5">	
 		<div id="my_clip_button" class="my_clip_button">Copy Link</div>
	</div>
	<div class="clear"></div>
<?php } ?>

<div class="thebox grid_14 push_6">
	<h4>Welcome User "<?= $userName ?>"</h4>
	<div class="reserveAlias grid_12 vMarginTop_0 vPaddingTop_2 vPaddingBottom_3 vMarginBottom_2 alpha omega clearfix">
		<span class="formInfo">
			<a id="ReserveTip" title="If you would like to control the URL, then enter the alias you would like to use." href="#" class="tooltip pull_2">?</a>
		</span>

		<h2 class="headings">Create a custom URL</h2>
		
		<div class="action grid_12 vPaddingTop_2 vPaddingBottom_1 padding_0 alpha omega">
			<?php
				echo $form->create("Tinyurl", array( "action" => "dashboard") );
				echo $form->input('alias', array('error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'class' => 'fields'));				
			?>
		
		<!--end action-->
	
		<!-- <div class="action finalInputUrl grid_6">-->
			
			<div class="action padding_0 vMarginTop_2">
				<?php
					/*echo $form->input('url',array('div' => array('class'=> 'prefix_0 input text'), 'class' => 'fields vPaddingTop_1 			
					vMarginBottom_2'));*/
							
					echo $form->input('url',array('maxlength' => '450','default' => 'http://', 'error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
				?>
			</div><!--end action-->
			<?php
					echo $form->submit('Submit', array('div' => array('class'=> 'submitDiv push_9 padding_0 grid_2 alpha omega vNegMargin_3'), 'class' => 'submit'));
					echo $form->end();
			?>
		</div>
		<!-- </div>--><!--end finalInputUrl-->
		
	</div><!--end reserveAlias-->
<div class="clear"></div>

	<div class="createBunch grid_12 vPaddingTop_2 vPaddingBottom_4 vMarginBottom_2 alpha omega clearfix">
		<span class="formInfo">
			<a href="#" title="Creating a 'bunch' allows you to combine multiple links into one short link that you can quickly and easily share " class="tooltip pull_2">?</a>
		</span>

		<h2 class="headings">Create a multi URL "bunch"</h2>
		
		<div class="action grid_12 vPaddingTop_2 vPaddingBottom_1 padding_0 alpha omega">
			<?php
				echo $form->create("Bunch", array("url" => array( "controller" => "tinyurls", "action" => "dashboard")) );
				echo $form->input('Bunch.alias', array('error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'class' => 'fields'));
				$options = array();
				for($x = 2; $x <= 25; $x++ ) {
					$options[$x] = $x;
				}
				echo $form->input("urls", array('div' => array('class'=> 'prefix_3 vMarginTop_2'),"options" => $options, "label" => "Number of urls: ", "onchange" => "updateBunch();"));
			?>	
		
		
		<div class="action padding_0 vMarginTop_2" id="bunchUrl0">
			<?php
				echo $form->input('BunchUrl.0.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
			?>
		</div>
		
		<div class="action padding_0 vMarginTop_2" id="bunchUrl1">
			<?php
				echo $form->input('BunchUrl.1.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
			?>
		</div>
		
		<div class="action padding_0 vMarginTop_2" id="bunchUrl2">
			<?php
				echo $form->input('BunchUrl.2.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl3">
			<?php
				echo $form->input('BunchUrl.3.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl4">
			<?php
				echo $form->input('BunchUrl.4.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl5">
			<?php
				echo $form->input('BunchUrl.5.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl6">
			<?php
				echo $form->input('BunchUrl.6.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl7">
			<?php
				echo $form->input('BunchUrl.7.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl8">
			<?php
				echo $form->input('BunchUrl.8.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl9">
			<?php
				echo $form->input('BunchUrl.9.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl10">
			<?php
				echo $form->input('BunchUrl.10.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl11">
			<?php
				echo $form->input('BunchUrl.11.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl12">
			<?php
				echo $form->input('BunchUrl.12.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl13">
			<?php
				echo $form->input('BunchUrl.13.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl14">
			<?php
				echo $form->input('BunchUrl.14.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl15">
			<?php
				echo $form->input('BunchUrl.15.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl16">
			<?php
				echo $form->input('BunchUrl.16.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl17">
			<?php
				echo $form->input('BunchUrl.17.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl18">
			<?php
				echo $form->input('BunchUrl.18.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl19">
			<?php
				echo $form->input('BunchUrl.19.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl20">
			<?php
				echo $form->input('BunchUrl.20.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl21">
			<?php
				echo $form->input('BunchUrl.21.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl22">
			<?php
				echo $form->input('BunchUrl.22.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl23">
			<?php
				echo $form->input('BunchUrl.23.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> ' input text'), 'class' => 'fields'));
			?>
		</div>
		<div class="action padding_0 vMarginTop_2" id="bunchUrl24">
			<?php
				echo $form->input('BunchUrl.24.url',array('maxlength' => '450','default' => 'http://','error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 
					addMarginBottom alpha omega'), 'div' => array('class'=> 'input text'), 'class' => 'fields'));
			?>
		</div>		
		
		
			
		<?php
			echo $form->submit('Submit', array('div' => array('class'=> 'submitDiv push_9 padding_0 grid_2 alpha omega vNegMargin_3'), 'class' => 'submit'));
			echo $form->end();
		?>
		</div>
		<!-- </div>--><!--end finalInputUrl-->

	</div><!--end createBunch-->
</div><!--end thebox-->
<div class="clear"></div>

	<div class="renewAlias grid_20 push_1 vMarginTop_2 vMarginBottom_2  vPaddingTop_1 vPaddingBottom_2 alpha omega clearfix">
		<h2 class="headings">Renew alias</h2>

		<h5 class="prefix_1a">GoFIU aliases:</h5>

		<table class="aliases" id="aliasTable">
			<thead>
	  			<tr>
		   		 <th id="aliasHead">Alias</th>
		   		 <th id="urlHead">URL</th>
		   		 <th id="views">Views</th>
		    	 <th id="daysLeft">Days left</th>
		    	 <th id="renew">Renew</th>		    	 
		    	 <th id="drop">Drop</th>
	  			</tr>
  			</thead>
  			<tbody>
				<?php foreach($ownedTinyUrls as $tinyurl) { ?>
	  				<tr>
		    			<td><?= str_replace( "https", "http", $html->link($tinyurl["Tinyurl"]["alias"], $html->url(array("controller" => $tinyurl["Tinyurl"]["alias"]), true) )); ?></td>
		    			<td><?= $tinyurl["Tinyurl"]["url"] ?></td>
		    			<td><?= $tinyurl["Tinyurl"]["count"] ?></td>
		  		  		<td><?= (30 + $date->date_diff($tinyurl["Tinyurl"]["timestamp"], date("Y-m-d"))); ?></td>
		  				<td><?= $html->link(("Renew \"" . $tinyurl["Tinyurl"]["alias"] . "\""), array("controller" => "tinyurls", "action" => 
		  				"renew", 
		  				$tinyurl["Tinyurl"]["id"])); ?></td>
		  				<td><?= $html->link(("Drop \"" . $tinyurl["Tinyurl"]["alias"] . "\""), array("controller" => "tinyurls" , "action" => "drop", 
		  				$tinyurl["Tinyurl"]["id"] ), array(), "Are you sure?" ); ?></td>
	  				</tr>
				<?php } ?>
  			</tbody>
		</table>

		<h5 class="prefix_1a">Bunches aliases:</h5>

		<table class="aliases" id="bunchTable">
			<thead>
	  			<tr>
		    		<th>Alias</th>
		    		<th>Views</th>
		    		<th>Days left</th>
		    		<th>Renew</th>
		    		<th>Drop</th>
	  			</tr>
  			</thead>
  			<tbody>
				<?php foreach($ownedBunches as $bunch) { ?>
					<tr>
		   		 		<td><?= str_replace( "https", "http", $html->link($bunch["Bunch"]["alias"], $html->url(array("controller" => "b", "action" => $bunch["Bunch"]["alias"]), true) )); ?></td>
		   		 		<td><?= $bunch["Bunch"]["count"] ?></td>
		    			<td><?= (30 + $date->date_diff($bunch["Bunch"]["timestamp"], date("Y-m-d"))); ?></td>
		    			<td><?= $html->link(("Renew \"" . $bunch["Bunch"]["alias"] . "\""), array("controller" => "bunches", "action" => "renew", 
		    			$bunch["Bunch"]["id"])); ?></td>
		    			<td><?= $html->link(("Drop \"" . $bunch["Bunch"]["alias"] . "\""), array("controller" => "bunches" , "action" => "drop", 
		    			$bunch["Bunch"]["id"] ), array(), "Are you sure?" ); ?></td>
	    			</tr>
	    			<tr>
	    				<td colspan="5">
			    			<ol>
			    				<?php foreach($bunch["BunchUrl"] as $bunchUrl) { ?>
			    				<li><?= $bunchUrl["url"]; ?></li>
			    				<?php } ?>
			    			</ol>
		    			</td>
	  				</tr>
				<?php } ?>
  			</tbody>
		</table>	
	</div><!--end renewAliases-->
	




