<?php 
echo $form->create("Administrator", array("controller" => "administrators", "action" => "login"));	
echo $form->input('username');
echo $form->input('password');
echo $form->end("Submit");
?>