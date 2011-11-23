<?php
echo $form->create("Tinyurl", array( "url" => array("controller" => "administrators", "action" => "edit")) );
echo $form->input('alias');	
echo $form->input('url');
echo $form->input('take', array("type" => "checkbox", "label" => "Take ownership?"));	
echo $form->submit('Submit');
echo $form->end();
?>