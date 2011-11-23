<?php
header("Content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>"; 
?>

<gofiu>
<url><?= $url; ?></url>
<link><?= $html->url(array("controller" => $alias), true); ?></link>
</gofiu>
