<?php
error_reporting ( 0 );
date_default_timezone_set ( "America/New_York" );

require_once ("DBConnection.php");
require_once ("Event.php");

$action = isset ( $_REQUEST ['action'] ) ? $_REQUEST ['action'] : "";
$selectedDate = isset ( $_REQUEST ['selectedDate'] ) ? $_REQUEST ['selectedDate'] : "";
$startDate = isset ( $_REQUEST ['startDate'] ) ? $_REQUEST ['startDate'] : "";
$endDate = isset ( $_REQUEST ['endDate'] ) ? $_REQUEST ['endDate'] : "";
$id = isset ( $_REQUEST ['event_id'] ) ? $_REQUEST ['event_id'] : "";

if ($action == 'list_time') {
	$event = Event::getEventObj ( $id );
	$selectedDate = $event->getStartTime ();
	$startDate = $event->getStartTime ();
	$endDate = $event->getEndTime ();
	listTime ( $selectedDate, $startDate, $endDate );
} elseif ($action == 'make_time_lists') {
	listTime ( $selectedDate );
}
function make_list_box($arr, $t, $selectedDate, $list_type) {
	$html_str = "";
	$script = "";
	$label = "";
	if ($list_type == 'start-ed') {
		echo "<li><label><span>Date:</span><span id='selectedDate-ed'>" . date ( 'Y-m-d', strtotime ( $selectedDate ) ) . "</span></label>
</li>";
	}
	if ($list_type == 'start-ed' || $list_type == 'startTime') {
		$label = "Start Time";
	} else if ($list_type == 'end-ed' || $list_type == 'endTime') {
		$label = "End Time";
	}
	
	if ($list_type == "startTime" || $list_type == "start-ed") {
		$script .= <<<EOF
		<script>
			$('#startTime').change(function(){
				var d = new Date($(this).val());
				$('#endTime option').each(function(){
					var e = new Date($(this).val());
					if(d > e){ //disable options with value less than selected time
						$(this).attr('disabled', true);
						}
						else{
							$(this).attr('disabled', false);
						}
					});
				});
                    
				$('#start-ed').change(function(){
				var d = new Date($(this).val());
				$('#end-ed option').each(function(){
					var e = new Date($(this).val());
					if(d>e){ //disable options with value less less than selected time
						$(this).attr('disabled', true);
						}
						else{
							$(this).attr('disabled', false);
						}
					});
				});
		</script>
EOF;
	}
	
	$html_str .= $script;
	
	$html_str .= "<li><label for='$list_type'>$label</label>";
	
	$html_str .= "<select id='$list_type' class='text ui-widget-content ui-corner-all' name='$list_type'>";
	foreach ( $arr as $key => $value ) {
		$item_selected = "";
		if ($value == $selectedDate) {
			$item_selected = "selected='selected'";
		}
		$html_str .= "<option $item_selected value='" . $value . "'>" . $t [$key] . "</option>";
	}
	$html_str .= "</select></li>";
	
	echo $html_str;
}
function listTime($selected, $startDate = "", $endDate = "", $interval = 15) {
	$timestamp = strtotime ( $selected );
	
	$arr = array ();
	$t = array ();
	
	$arr [0] = date ( 'c', $timestamp );
	$t [0] = date ( 'h:i A', $timestamp );
	
	for($i = 1; $i < 96; $i ++) {
		$timestamp = strtotime ( '+'.$interval .' minutes', $timestamp );
		$arr [$i] = date ( 'c', $timestamp );
		$t [$i] = date ( 'h:i A', $timestamp );
	}
	
	$startListType = ($startDate != "") ? "start-ed" : "startTime";
	$endListType = ($endDate != "") ? "end-ed" : "endTime";
	make_list_box ( $arr, $t, $startDate, $startListType );
	make_list_box ( $arr, $t, $endDate, $endListType );
}
?>