<?php if (isset($this->params["pass"][0])) { ?>

<div id="bar">
	
		<div class="bannerLogo">
			<?php echo $html->image("fiu-logo-30h-gray.gif", array("alt" => "Link to FIU homepage",'url' => 'http://www.fiu.edu')); ?>
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
					<span id="clicks">This page has <?= $Tinyurl["Tinyurl"]["count"] ?> clicks.</span> 
				</td>
				<td id="spam"><a id="spamLink" href='http://www.google.com/safebrowsing/report_badware/?url=<?= $Tinyurl["Tinyurl"]["url"] ?>'>Spam?</a></td>
				<td id="closeBar">
					
					<a href='<?= $Tinyurl["Tinyurl"]["url"] ?>'>
					<?php echo $html->image("close-19.gif", array("id"=>"closeBox","alt" => "Remove the frame", "align"=>'top')); ?>
				</a>		
				</td>
			</tr>
		 	</tbody>
		 </table>

		</div>
		<div class="clear"></div>
	
</div> <!-- end bar -->
<div class="clear"></div>
<!-- what is this? -->
<!--<div class="iframeDiv">-->
	<iframe src ="<?= $Tinyurl["Tinyurl"]["url"] ?>" frameborder="0" class="urlFrame">
	  <p>Your browser does not support iframes.</p>
	</iframe>
<!-- </div> -->

<?php } else { ?>
<script type="text/javascript">
	$(function() {
		if ( $('#my_clip_button').length ) 
		{
			copyToClipboard();
    	}


	// Create the tooltips only on document load
	// Will Display title of link

		$('span.formInfo a[title]').qtip(
		{
			position:{
				adjust:{
					 x:15,
					 y:-35
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



<!-- MODIFY THIS HOW YOU WISH -->

	<?php if (isset($copyFunction)) { ?>
		<div class="linkMessage grid_20 push_2 message">
			You can view the link at <?php echo $html->link(
   	 			$html->url(array("controller" => $alias), true),
   				 $html->url(array("controller" => $alias), true),
  			 		 array('id'=>'newLink'));?>
		</div>
		<div class="clear"></div>
		<div id="d_clip_container" class="grid_1 push_15 vMarginTop_1 vMarginBottom_5">	
 			  <div id="my_clip_button" class="my_clip_button">Copy Link</div>
		</div>

		<div class="clear"></div>
	<?php } ?>


<!--  -->

<div class="thebox grid_14 push_6 ">
	<div class="adminMenu grid_2 push_10 alpha omega clearfix">
		<ul class="hMenu">
			<li><?php echo $html->link('Login', array("controller" => "tinyurls", "action" => "login")); ?></li>
		</ul>
		
	</div>
	<div class="clear"></div>
	
	<div class="createUrl grid_12 alpha omega vPaddingTop_2 vPaddingBottom_4">		
		<span class="formInfo">
			<a id="uniqueUrl" href="#" title="Enter a long URL to make it a tiny URL" class="tooltip">?</a>
		</span>
		<h2 class="headings">Create a Url</h2>
			
		<div class="action padding_0 vMarginTop_2">		
			<?php
				echo $form->create("Tinyurl", array( "url" => array("controller" => "tinyurls", "action" => "index") ) );	
				echo $form->input("url2", array('type' => "hidden"));
				echo $form->input('url', 
				array( "maxlength" => "450", "div" => array("class" => "input text padding_0") , 'default' => 'http://', 'class' => 'fields addMarginBottom', 'error' => array('class'=> 'error-message grid_6 push_12 negMarginTop_0 addMarginBottom alpha omega', "urlRule" =>  __('<div class="theTip">Please make sure that your url is in the proper format. ie "http://www.google.com"</div>', true), "notEmpty" => __('<div class="theTip">Please type in a valid url.</div>', true) )));
			
				echo $form->submit('Submit', array('div' => array('class'=> 'submitDiv push_9 padding_0 grid_2 alpha omega vNegMargin_3'), 'class' => 'submit'));
				echo $form->end();
		?>
		</div>
	</div><!--createUrl-->
</div><!--end thebox-->
<div class="clear"></div>
<div class="grid_6 push_6 vMarginTop_2 vPaddingBottom_2 topLinks">
	<h3 class="headings">Top 5 Links</h3>
	<ol>
	<?php foreach ($topFive as $value) { ?>
	<li><a href='<?= $value["Tinyurl"]["url"] ?>' ><?= $value["Tinyurl"]["url"] ?></a></li>
	<?php } ?>
	</ol>
</div>
<div class="grid_6 push_6 vPaddingBottom_0">
	<div class="grid_6 alpha omega vMarginTop_2 vPaddingBottom_0 aboutGoFIU">
		
		<h3 class="headings"><?php echo $html->link('How to use GoFIU', array("controller" => "tinyurls", "action" => "faq")); ?></h3>

	</div>
	
	<div class="grid_6 alpha omega vMarginTop_2 vPaddingBottom_1 bookmarklet">
	
	<h3 class="headings">
		<a href="javascript:location.href=('<?= $html->url(array( "controller" => "tinyurls",  "action" => "bookmarklet", "?create="), true); ?>' + location.href)">GoFIU Bookmarklet</a></h3>
		<p>Drag the link above to your Bookmarks Toolbar</p>
	</div>

</div>


<?php } ?>