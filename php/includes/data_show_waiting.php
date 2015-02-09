<?php
$dynStr .= <<<EOF
<div class="col-md-12">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
		<th>User</th>
        <th>Start</th>
        <th>End</th>
		<th>Status</th>
        <th>Location/Link</th>
        <th>Slots Available</th>
		<th>Actions</th>
      </tr>
    </thead>
    <tbody>
EOF;

	foreach($waitingList as $key=>$event){
		$dynStr .= "<tr>";
		$dynStr .= "<td>" . $key . "</td>";
        $dynStr .= "<td>" . $event->getTitle() . "</td>";
		$dynStr .= "<td>" . $event->getUser() . "</td>";
        $dynStr .= "<td>" . $event->getStartTime() . "</td>";
        $dynStr .= "<td>" . $event->getEndTime() . "</td>";
		$dynStr .= "<td>" . $event->getStatus() . "</td>";
        $dynStr .= "<td>" . $event->getLocation() . "</td>";
        $dynStr .= "<td>" . $event->getAvailablePositions() . "</td>";
		$dynStr .= "<td><a onClick='return showEditDialog(event, ".$event->getId().",\"".$event->getTitle()."\",\"".$event->getType()."\",\"".$event->getLocation()."\",\"".$event->getBody()."\",\"".$event->getStatus()."\",\"".$event->getUser()."\")'  href='?action=edit&q=event&q1=" . $event->getId() . "'>Edit</a></td>";
		
		$dynStr .= "</tr>";
	}
	
$dynStr .= <<<EOT
		</tbody>
	</table>
</div>
EOT;
?>