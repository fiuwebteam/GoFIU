<p><a href='https://go.fiu.edu/administrators/index'>Back to the Dashboard</a></p>
<table>
	<thead>
  		<tr>
    		<th>Alias</th>
    		<th>Views</th>
    		<th>Edit</th>
    		<th>Renew</th>
    		<th>Drop</th>
  		</tr>
  	</thead>
  	<tbody>
		<?php foreach($bunches as $bunch) { ?>
			<tr>
   		 		<td style='border:solid black;' ><?= $html->link($bunch["Bunch"]["alias"], $html->url(array("controller" => "b", "action" => $bunch["Bunch"]["alias"]), true) ); ?></td>
   		 		<td style='border:solid black;' ><?= $bunch["Bunch"]["count"] ?></td>
   		 		<td style='border:solid black;' ><?= $html->link(("Edit \"" . $bunch["Bunch"]["alias"] . "\""), array("controller" => "administrators", "action" => "editb", 
    			$bunch["Bunch"]["id"])); ?></td>    			
    			<td style='border:solid black;' ><?= $html->link(("Renew \"" . $bunch["Bunch"]["alias"] . "\""), array("controller" => "administrators", "action" => "renewb", 
    			$bunch["Bunch"]["id"])); ?></td>
    			<td style='border:solid black;' ><?= $html->link(("Drop \"" . $bunch["Bunch"]["alias"] . "\""), array("controller" => "administrators" , "action" => "dropb", 
    			$bunch["Bunch"]["id"] ), array(), "Are you sure?" ); ?></td>
    		</tr>
    		<tr>
    			<td colspan="5"  style='border:solid black;' >
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