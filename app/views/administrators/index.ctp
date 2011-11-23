<h1>What do you want to do?</h1>
<ul>
	<li><?= $html->link("Manage TinyUrls", array("controller" => "administrators", "action" => "tinyurl")) ?></li>
	<li><?= $html->link("Make New TinyUrl Alias", array("controller" => "administrators", "action" => "tinyurl_alias")) ?></li>
	<li><?= $html->link("Manage Bunches", array("controller" => "administrators", "action" => "bunches")) ?></li>	
</ul>