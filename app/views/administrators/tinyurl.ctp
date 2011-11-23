<p><a href='https://go.fiu.edu/administrators/index'>Back to the Dashboard</a></p>

<div style='padding:5px;'>
<?php echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));?>
</div>

<?php echo $form->create("Tinyurl", array("url" => array("controller" => "administrators", "action" => "tinyurl")) );?>

<div style='padding:5px;'>
	<?php echo $paginator->first(__('First', true));?>
	<?php echo $paginator->prev(__('Previous', true));?>  
	  <?php echo $paginator->numbers(array('modulus' => 10));?>
	  <?php if ($paginator->numbers(array('modulus' => 10)) != "") { ?>
	  <span>|</span>
	  <?php } ?>
	<?php echo $paginator->next(__('Next', true));?>
	<?php echo $paginator->last(__('Last', true));?>
</div>

<div style='padding:5px;'>
	<?php
		$args = $this->passedArgs;
		$url = "";
		foreach ($args as $key => $value) {
			if ($key != "limit") {
				$url .= "/$key:$value";
			}
		}
		echo "Limit per page: ";
		echo $html->link("10", "tinyurl$url/limit:10") . " | ";
		echo $html->link("25", "tinyurl$url/limit:25") . " | ";
		echo $html->link("50", "tinyurl$url/limit:50") . " | ";
		echo $html->link("75", "tinyurl$url/limit:75") . " | ";
		echo $html->link("100", "tinyurl$url/limit:100");
	?>
</div>

<?php
echo $form->submit('Flag', array("name" => "flag", "div" => array("style" => "float:right")));
echo $form->submit('Drop', array( "name" => "drop","div" => array("style" => "float:right")));
echo $form->submit('Renew', array( "name" => "renew", "div" => array("style" => "float:right")));
?>

<div class='clear'></div>



<table>
	<tr>
		<th>
			<?php echo $paginator->sort( 'ID', 'Tinyurl.id');?>			
		</th>
		<th>
			<?php echo $paginator->sort( 'Alias', 'Tinyurl.alias');?>			
		</th>
		<th>
			<?php echo $paginator->sort( 'Url', 'Tinyurl.url');?>			
		</th>
	</tr>
<?php
$mark = 1;
foreach ($tinyUrls as $tinyurl) {
	if ($mark == 1) $mark = 0; else $mark = 1;
	echo "<tr class='zebra_$mark'>";
	echo "<td style='padding:5px;' > {$tinyurl["Tinyurl"]["id"]} </td>";
	echo "<td style='padding:5px;'> {$tinyurl["Tinyurl"]["alias"]} </td>";
	echo "<td style='padding:5px;'> <a href='{$tinyurl["Tinyurl"]["url"]}'>" . substr($tinyurl["Tinyurl"]["url"], 0, 160) . "</a></td>";
	
	echo "<td style='padding:5px;'>" . $html->link("Edit", array("controller" => "administrators", "action" => "edit", $tinyurl["Tinyurl"]["id"])) . "</td>";
	echo "<td><input type='checkbox' name='data[Tinyurl][mark][{$tinyurl["Tinyurl"]["id"]}]' id='mark_{$tinyurl["Tinyurl"]["id"]}' />" ;
	//echo "<td>" . $form->input("foo") . "</td>";
	/*
	echo "<td style='padding:5px;'>" . $html->link("Renew", array("controller" => "administrators", "action" => "renew", $tinyurl["Tinyurl"]["id"])) . "</td>";
	echo "<td style='padding:5px;'>" . $html->link("Drop", array("controller" => "administrators", "action" => "drop", $tinyurl["Tinyurl"]["id"])) . "</td>";
	echo "<td style='padding:5px;'>" . $html->link("Flag", array("controller" => "administrators", "action" => "flag", $tinyurl["Tinyurl"]["id"])) . "</td>";
	*/
	echo "</tr>";
}

?>
</table>
<?php
echo $form->submit('Flag', array("name" => "flag", "div" => array("style" => "float:right")));
echo $form->submit('Drop', array( "name" => "drop","div" => array("style" => "float:right")));
echo $form->submit('Renew', array( "name" => "renew", "div" => array("style" => "float:right")));
?>

<div class='clear'></div>

<div >
	<?php echo $paginator->first(__('First', true));?>
	<?php echo $paginator->prev(__('Previous', true));?>  
	 <?php echo $paginator->numbers(array('modulus' => 10));?> 
	  <?php if ($paginator->numbers(array('modulus' => 10)) != "") { ?>
	  <span>|</span>
	  <?php } ?>
	<?php echo $paginator->next(__('Next', true));?>
	<?php echo $paginator->last(__('Last', true));?>
</div>

<?php 
echo $form->end();
?>