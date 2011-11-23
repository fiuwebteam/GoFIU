<script type="text/javascript">
	$(function() {
	// Create the tooltips only on document load
	// Will Display title of link

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

<div class="thebox grid_14 push_6 ">
	<div class="loginDiv grid_12 alpha omega vPaddingTop_2 vPaddingBottom_1">		
		<span class="formInfo">
			<a id="uniqueUrl" href="#" title="You must be a registered student or staff to use additional features of goFIU" class="tooltip">?</a>
		</span>
		<h2 class="headings">Login</h2>
		<span>Login with your FIU credentials.</span>
		<div class="action vMarginTop_2">	
			<?php 

				echo $form->create("Login", array( "url" => array( "controller" => "tinyurls", "action" => "login") ) );	
				/*echo $form->input('username');*/
				
				echo $form->input('username', array( "div" => array("class" => "input text padding_0 vMarginBottom_2") , 'class' => 'fields addMarginBottom', 'error' => 
					array('class'=> 'error-message grid_6 push_12 negMarginTop_0 addMarginBottom alpha omega', "urlRule" =>  __('<div class="theTip">Please make sure your user name is 
					correct"</div>', true), "notEmpty" => __('<div class="theTip">Please type in a valid user name.</div>', true) )));
				
				echo $form->input('password', array( "div" => array("class" => "input text padding_0") , 'class' => 'fields addMarginBottom', 'error' => 
					array('class'=> 'error-message grid_6 push_12 negMarginTop_0 addMarginBottom alpha omega', "urlRule" =>  __('<div class="theTip">Please make sure your password is 
					correct"</div>', true), "notEmpty" => __('<div class="theTip">Please type in a valid password.</div>', true) )));
				
				/*echo $form->input('password');*/
				
				echo $form->submit('Submit', array('div' => array('class'=> 'submitDiv push_10 grid_2 alpha omega vNegMargin_3'), 'class' => 'submit'));
				echo $form->end();
			?>
			<div class="forgotPassword">
				<p><a href="https://myaccounts.fiu.edu/">Forgot password?</a></p>
			</div>
		</div>
	</div><!--end loginDiv-->
</div><!--end thebox-->
