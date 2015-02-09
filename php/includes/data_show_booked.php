<?php
$dynStr .= <<<EOF
<div class="col-md-12">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
		<th>User</th>
        <th>Event</th>
        <th>From</th>
        <th>To</th>
        <th>Slots</th>
		<th>Status</th>
		<th>Actions</th>
      </tr>
    </thead>
    <tbody>
EOF;

	foreach($bookingList as $key=>$booking){
		$dynStr .= "<tr>";
		$dynStr .= "<td>" . $key . "</td>";
        $dynStr .= "<td>" . $booking->getUser() . "</td>";
        $dynStr .= "<td>" . $booking->getEvent()->getTitle() . "</td>";
        $dynStr .= "<td>" . $booking->getEvent()->getStartTime() . "</td>";
        $dynStr .= "<td>" . $booking->getEvent()->getEndTime() . "</td>";
		$dynStr .= "<td>" . $booking->getPositions() . "</td>";
        $dynStr .= "<td>" . $booking->getEvent()->getStatus() . "</td>";
		$dynStr .= "<td><a  onClick='return showBookedDialog(event, \"".$booking->getId()."\");' href='#'>Edit</a></td>";
		$dynStr .= "</tr>";
	}
	
$dynStr .= <<<EOT
		</tbody>
	</table>
</div>
EOT;
?>