<?php
$result = isset($_GET['q'])? $_GET['q'] : "";
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link href='fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar.print.css' rel='stylesheet' media='print' />
<link  href='jquery-ui.css' rel='stylesheet' media="screen">
<link  href='timepicker.css' rel='stylesheet' media="screen">
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='lib/fullcalendar.min.js'></script>
<script src="lib/jquery-ui.js"></script>
<script src="lib/jquery-ui-timepicker-addon.js"></script>
<script src="lib/jquery-ui-sliderAccess.js"></script>
 <script>
$(function() {
	$( "#startDate" ).datetimepicker({
		timeFormat: 'hh:mm tt z',
		addSliderAccess: true,
		sliderAccessArgs: { touchonly: false },
		altField: "#start",
		timezone:"-05:00",
		altFieldTimeOnly: false,
		altFormat: "yy-mm-dd",
		altTimeFormat: "HH:mm:ssz",
		altSeparator: "T",
		/*timezoneList: [ 
			{ value: '-05:00', label: 'Eastern'}, 
			{ value: '-03:60', label: 'Central' }, 
			{ value: '-04:20', label: 'Mountain' }, 
			{ value: '-04:80', label: 'Pacific' } 
		]*/
	});
	$( "#startDate" ).datetimepicker("option", "dateFormat", "yy-mm-dd");
	
	
	
	$( "#endDate" ).datetimepicker({
		timeFormat: 'hh:mm tt z',
		addSliderAccess: true,
		sliderAccessArgs: { touchonly: false },
		altField: "#end",
		timezone:"-05:00",
		altFieldTimeOnly: false,
		altFormat: "yy-mm-dd",
		altTimeFormat: "HH:mm:ssz",
		altSeparator: "T"
		/*timezoneList: [ 
			{ value: '-05:00', label: 'Eastern'}, 
			{ value: '-03:60', label: 'Central' }, 
			{ value: '-04:20', label: 'Mountain' }, 
			{ value: '-04:80', label: 'Pacific' } 
		]*/
		});
	$( "#endDate" ).datepicker("option", "dateFormat", "yy-mm-dd");

});
//$( "#datepicker" ).datepicker( "option", "dateFormat", "DD, d MM, yy" );
</script>

<style tyle=text/css>
	option.pink {background-color: #ffcccc;}
    option.red {background-color: #cc0000; font-weight: bold; font-size: 12px;}
    option.pink {background-color: #ffcccc;}
	option.blue{background-color:#3A87AD;}
    </style>
</head>

<body>
<?php if($result!=""): ?>
<h3><?php echo $result; ?></h3>
<?php endif; ?>

<form name="newEvent" action="php/eventsController.php" method="post">
<input type="hidden" name="action" value="createEvent"/>
<input type="hidden" name="start" id="start">
<input type="hidden" name="end" id="end">
<ul>
<li><lable for="eventTitle">Event Title</label><input name ="title" type="text" id="eventTitle" value=""></li>
<li>
	<lable for="eventType">Event Type</label>
    <select id="eventType" name="eventType">
    	<option value="webinar">Webinar</option>
        <option value="webinar">Seminar</option>
        <option value="webinar">Meeting</option>
     </select>
</li>
<li><lable for="eventLocation">Location/Venue</label><input type="text" id="eventLocation" name="eventLocation"></li>
<li> <label for="startDate">Start Date/Time:</label> <input id="startDate" name="startDate" type="text"></li>
<li> <label for="endDate">End Date/Time: </label><input id="endDate" name="endDate" type="text" ></li>
<li><lable for="eventNotes">Notes</label><textarea name="eventNotes" id="eventNotes"></textarea></li>
<li><lable for="eventTitle">Maximum Allowed</label><input name="max" type="text" id="eventNumber" value="10"></li>
<li>
	<lable for="eventColor">Event Marker</label>
    <select id="eventColor" name="eventColor">
    	<option class="blue" value="#3A87AD" selected>Blue</option>
    	<!-- <option class="red" value="#FF0000">Red</option>
        <option class="pink" value="#ffcccc">Pink</option>
        -->
     </select>
</li>
<li><input type="submit" value="Save"></li>
</ul>
</form>
</body>
</html>