<?php
  session_start();
$result = isset($_GET['result'])? $_GET['result'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "show";
$q = isset($_GET['q']) ? $_GET['q'] : "events";
$q1 = isset($_GET['q1']) ? $_GET['q1'] : "";

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Events Availability Calendar Management Panel</title>

<!-- BOOTSTRAP -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<link href='../fullcalendar.css' rel='stylesheet' />
<link href='../fullcalendar.print.css' rel='stylesheet' media='print' />
<link  href='../jquery-ui.css' rel='stylesheet' media="screen">
<link  href='../timepicker.css' rel='stylesheet' media="screen">
<link href="css/custom.css" rel="stylesheet" media="screen" />
<script src='../lib/moment.min.js'></script>
<script src='../lib/jquery.min.js'></script>
<script src='../lib/fullcalendar.min.js'></script>
<script src="../lib/jquery-ui.js"></script>
<script src="../lib/jquery-ui-timepicker-addon.js"></script>
<script src="../lib/jquery-ui-sliderAccess.js"></script>
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
		altSeparator: "T"
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

</head>

<body>
<div id="wrapper">
	<div id="left-wrapper">
    	<div class="col-sm-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Events</h3>
            </div>
            <div class="panel-body">
              <div class="list-group">
            <a href="#" class="list-group-item active">
              Manage Events</a>
            <a href="#" class="list-group-item">Bookings</a>
            <a href="#" class="list-group-item">Waiting List</a></div>
            </div>
          </div>
        </div>
    </div>
    
    
    <div id="content-wrapper">
     <?php if($result!=""): ?>
        <div class="alert alert-success" role="alert">
        <strong>Success!</strong> <?php echo $result; ?>
      </div>
        <?php endif; 
        
        if(isset($_SESSION['errors'])){
			?>
                <div class="alert alert-danger" role="alert">
				<strong>Error!</strong>
                <?
				foreach($_SESSION['errors'] as $error){ 
        			  echo (" [ " . $error . " ]"); 
				}
				?>
      			</div>
            <?
        }
?>
    
    
    
    <?php if($action=="show"): ?>
    	<?php if($q=="events"){
        	include("embeds/show_events.php");
			}
			?>
    <?php endif ?>
    
    <?php if($action=="add"): ?>
    	<?php if($q=="event"){
        	include("embeds/add_event.php");
			}
			?>
    <?php endif ?>
    
    </div>
    
    <br style="clear:both;"/>
</div>

</body>
</html>
<?php 
unset($_SESSION['errors']);
session_unset();
 ?>