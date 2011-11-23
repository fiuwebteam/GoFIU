<p><a href='https://go.fiu.edu/administrators/index'>Back to the Dashboard</a></p>
<h1>Create New</h1>
<h2>Reminder: These aliases will not be queued to be dropped.</h2>

<?php
echo $form->create("Tinyurl", array("url" => array("controller" => "administrators", "action" => "tinyurl_alias")) );
echo $form->input('alias');	
echo $form->input('url');
echo $form->submit('Submit');
echo $form->end();
?>