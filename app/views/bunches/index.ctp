<div id="bar">
		<div class="bannerLogo">
			<?php echo $html->image("fiu-logo-30h-gray.gif", array("alt" => "Link to FIU homepage",'url' => 'http://www.fiu.edu')); ?>
			<div class="multiurl">
				<?php 
					echo $form->create("BunchJumper", array("url" => array("controller" => "bunches", "action" => "index", $this->params["pass"][0]), true));
					echo $form->input("page", array("div"=>array("class"=>"input select divBunch"),"label"=>array("class"=>"labelBunch"),"class"=>"input select selectBunch","options" => $options));
					
					echo $form->submit('Submit', array('div' => array('class'=> 'submit divSubmit'), 'class' => 'submit'));
				echo $form->end();
				?>
			</div>
		</div>	
	
		<div id="tools">
				
				<table>
		
		 	<tbody>
		 	<tr>
		 		<td id="at"><!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style">
						<a href="http://www.addthis.com/bookmark.php?v=250&amp;pub=xa-4b17dda85e85b120" class="addthis_button_compact">Share</a>
						<span class="addthis_separator">|</span>
						<a class="addthis_button_facebook"></a>
						<a class="addthis_button_myspace"></a>
						<a class="addthis_button_google"></a>
						<a class="addthis_button_twitter"></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub=xa-4b17dda85e85b120"></script>
					<!-- AddThis Button END -->
		 		</td>
				<td id="click">
						<span id="clicks">This page has <?= $results["Bunch"]["count"]  ?> clicks. </span>
				</td>
				<td id="spam"><a id="spamLink" href='http://www.google.com/safebrowsing/report_badware/?url=<?= $results["BunchUrl"][$page]["url"] ?>'>Spam?</a></td>
				<td id="closeBar">
					
					<a href='<?=  $results["BunchUrl"][$page]["url"] ?>'>
					<?php echo $html->image("close-19.gif", array("id"=>"closeBox","alt" => "Remove the frame", "align"=>'top')); ?>
				</a>		
				</td>
			</tr>
		 	</tbody>
		 </table>
		</div>
		<div class="clear"></div>
	</div><!-- end tools -->
	
</div><!-- end bar -->

<div class="clear"></div>
<!-- what is this? -->
<!--<div class="iframeDiv">-->
	<iframe class="urlFrame" src ="<?= $results["BunchUrl"][$page]["url"] ?>" frameborder="0">
 	 	<p>Your browser does not support iframes.</p>
	</iframe>
<!-- </div> -->