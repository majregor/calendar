<?php
$dynStr .= <<<EOF
<div class="col-md-12">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Start</th>
        <th>End</th>
        <th>Type</th>
        <th>Location/Link</th>
        <th>Slots Available</th>
        <th>Total Slots</th>
		<th>Actions</th>
      </tr>
    </thead>
    <tbody>
EOF;

	foreach($eventList as $key=>$event){
		$dynStr .= "<tr>";
		$dynStr .= "<td>" . $key . "</td>";
        $dynStr .= "<td>" . $event->getTitle() . "</td>";
        $dynStr .= "<td>" . $event->getStartTime() . "</td>";
        $dynStr .= "<td>" . $event->getEndTime() . "</td>";
        $dynStr .= "<td>" . $event->getType() . "</td>";
        $dynStr .= "<td>" . $event->getLocation() . "</td>";
        $dynStr .= "<td>" . $event->getAvailablePositions() . "</td>";
        $dynStr .= "<td>" . $event->getMax() . "</td>";
		$dynStr .= "<td><a onClick='return showEditDialog(event, ".$event->getId().",\"".$event->getTitle()."\",\"".$event->getType()."\",\"".$event->getLocation()."\",\"".$event->getBody()."\")'  href='?action=edit&q=event&q1=" . $event->getId() . "'>Edit</a></td>";
		//$dynStr .= "<td><a onClick='return showDeleteDialog(event, ".$event->getId().")' href='?action=delete&q=event&q1=" . $event->getId() . "'>Delete</a></td>";
		$dynStr .= "</tr>";
	}
	
$dynStr .= <<<EOT
		</tbody>
	</table>
</div>
EOT;
?>