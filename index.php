<?php 
session_start();
// Require our Event class and datetime utilities
require dirname(__FILE__) . '/php/utils.php';

 $_SESSION['user']['id']= isset($_GET['user_id']) ? $_GET['user_id'] : "";
 $_SESSION['user']['email']= isset($_GET['email']) ? $_GET['email'] : "";
 $_SESSION['user']['username']= isset($_GET['username']) ? $_GET['username'] : "";
 
/*echo $_SESSION['user']['id'] ."<br>";
echo $_SESSION['user']['username'] ."<br>";
echo $_SESSION['user']['email'] ."<br>";*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />

<style type="text/css">
ul#keymap{
	list-style:none;
	list-style-type:none;
	padding:0px;
	margin:0px;
	font-size:.97em;
}

ul#keymap li{
	float:left;
	margin:10px;
	list-style:none;
	list-style-type:none;
}
ul#keymap span{
	margin:0px 4px -2px 4px;
	display:inline-block; 
	width:15px; height:15px; 
}
ul#keymap span.blue{background-color:#3A87AD}
ul#keymap span.pink{background-color:#ff9f89 }
ul#keymap span.grey{background-color:#BFEFFF}
</style>
</head>
<body>
<div>
    	<ul id="keymap">
        	<li><span class="blue"></span>SME eventsdafasfsd</li>
            <li><span class="pink"></span>Webinar</li>
            <li><span class="grey"></span>Fully booked SME event</li>
        </ul>
    </div>
    <br style="clear:both;"/>
	<div id='loading'>loading...</div>
	<div id='calendar'></div>
	
    
    <div id="waiting-dialog" title="Event Fully Booked!">
    	<div id="">
        </div>
        
    </div>
    
    
    <div id="webinar-dialog" title="Webinar Information">
    	<div id="webinar-info">
        </div>
        <input type="hidden" id="resource-link" class="resource-link">
    </div>
    
    
	<div id="dialog-edit-form" title="Make Reservations">
<!--  <p class="validateTips">All form fields are required.</p> -->
<form id="new-calendar-event-form">
<fieldset class="calendar-fieldset">
<ul>

<li>
<label for="title">Name / Title</label>
<input disabled type="text" name="title" id="title-ed" value="" class="text ui-widget-content ui-corner-all">
</li>
<li>
<label for="title">Available Slots:</label>
<input disabled type="text" name="available" id="available" value="" class="text ui-widget-content ui-corner-all"> of 
<input disabled type="text" name="positions" id="positions" value="" class="text ui-widget-content ui-corner-all">
</li>

<div id="edit-lists-container">

</div>

<li>
<label for="location">Location / Call in number:</label>
<textarea disabled rows="3" cols="25" name="location" id="location-ed" class="text ui-widget-content ui-corner-all"></textarea>
</li>

<li>
<label for="body">Notes:</label>
<textarea disabled rows="3" cols="25" name="body" id="body-ed" class="text ui-widget-content ui-corner-all"></textarea>
</li>

<!-- Allow form submission with keyboard without duplicating the dialog button -->
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
</ul>
</fieldset>
</form>
</div>
<link href='fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar.print.css' rel='stylesheet' media='print' />
<link href="custom.css" rel="stylesheet" media="screen" />
<link  href='jquery-ui.css' rel='stylesheet' media="screen" />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='lib/fullcalendar.min.js'></script>
<script src="lib/jquery-ui.js"></script>

<script>

	$(document).ready(function() {
		var global_defaultDate = '<?php echo currentDate('Y-m-d');?>';
		var global_start, global_end;
		 var editDialog, form,
		 // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
		title = $( "#title" );
		
		var selectedEventId, 
				selectedEventTitle,
				selectedEventStart,
				selectedEventEnd,
				selectedEventLocation,
				selectedEventBody,
				selectedAvailable,
				selectedEventMax;
		//tips = $( ".validateTips" );
		
		 function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
			o.addClass( "ui-state-error" );
			updateTips( "Length of " + n + " must be between " +
			min + " and " + max + "." );
			return false;
			} else {
			return true;
			}
		}
		 function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
			} else {
			return true;
			}
		}
		
		waitingListDialog = $( "#waiting-dialog" ).dialog({
			autoOpen:	false,
			modal:		true,
			buttons:{
				"Add To Waiting List"		:	addToWaitingList,
				Cancel	:	function(){
						$(this).dialog("close");
					}
				}
			});
		
        webinarDialog = $("#webinar-dialog").dialog({
            autoOpen: false,
            modal: true,
            buttons:{
                "Visit Resource Site": gotoResource,
                Cancel: function(){
                    $(this).dialog("close");
                }
            }
        });

		editDialog = $( "#dialog-edit-form" ).dialog({
			 autoOpen: false,
			 modal: true,
			 buttons: {
				 "Book Now": bookEvent,
				 Cancel: function() {
				 $( this ).dialog( "close" );
				 }
				 
				 }
			 });
        
		function addToWaitingList(){
			var valid=true;
			var editId = selectedEventId;
			valid = (selectedAvailable<=0) ? true : false;
			
			if(valid){
				var dataString = "action=queue&id=" + editId + "&user=<?php echo $_SESSION['user']['id'] ?>";
				$.ajax({
                   url: 'php/eventsController.php',
                   data: dataString,
                   type:'POST',
                   success:function(response){
					   alert(response);
                   },
                   error:function(error){
                     alert(error);
                   }
                 });
                 $("#calendar").fullCalendar( 'refetchEvents' );
		 	}
		 	
		 	waitingListDialog.dialog("close");
		}
		
        function gotoResource(){
            var link = $("#resource-link").val();
            window.location.replace(link);
        }
        
		 function bookEvent(){
			 var valid=true;
	
			 var editId = selectedEventId;
			 
			 //alert(selectedEventMax + "of " + selectedAvailable);
			 //valid = valid && checkRegexp( editTitle, /^[0-9a-z]([0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
			 valid = (selectedAvailable>=1) ? true : false;
			 
			 if(valid){
			 
			 	var dataString = "action=book&id=" + editId + "&positions=1&user=<?php echo $_SESSION['user']['id'] ?>";
                
                 $.ajax({
                   url: 'php/eventsController.php',
                   data: dataString,
                   type:'POST',
                   success:function(response){
					   //alert(response);
                   },
                   error:function(error){
                     alert(error);
                   }
                 });
                 $("#calendar").fullCalendar( 'refetchEvents' );
		 	}
		 	
		 	editDialog.dialog("close");
		 }
		
		
		function pad(num, size) {
			var s = num+"";
			while (s.length < size) s = "0" + s;
			return s;
		}
		
		function populateStartEndLists(selectedDate){
			
			var dataString="action=make_time_lists&selectedDate="+ $('#selectedDate').html();
			//alert($('#selectedDate').html());
			 $.ajax({
	                   url: 'php/datesController.php',
	                   data: dataString,
	                   type:'POST',
	                   success:function(response){
						//alert(response);
						 $("#lists-container").html(response);
	                   },
	                   error:function(error){
	                     alert(error);
	                   }
	                 });	
			   
		}
				
		function populateEditStartEndLists(eventStart, id){
			var dataString="action=list_time&event_id="+id;
			
			 $.ajax({
	                   url: 'php/datesController.php',
	                   data: dataString,
	                   type:'POST',
	                   success:function(response){
						//alert(response);
						 $("#edit-lists-container").html(response);
	                   },
	                   error:function(error){
	                     alert(error);
	                   }
	                 });	
			   
		}
		
		 $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: global_defaultDate,
			timezone: "America/New_York",
			/*selectable: true,
			selectHelper: true,
			select: function(start, end) {
				global_start = start;
				global_end = end;

				$("#selectedDate").html(start.toISOString());
				
				
				populateStartEndLists();
				
				dialog.dialog( "open" );
				$('#calendar').fullCalendar('unselect');
			},
			*/
			editable: true,
			eventLimit: true, // allow "more" link when too many events

			events: {
				url: 'php/eventsController.php',
				type: 'POST',
		        data: {
		            action: 'read'
		        },
				error: function() {
					$('#script-warning').show();
				}
			},
			timeFormat: 'h(:mm)A',
			loading: function(bool) {
				$('#loading').toggle(bool);
			},
			eventClick: function(calEvent, jsEvent, view) {
				selectedEventId = calEvent.id;
				selectedEventTitle = calEvent.title;
				selectedEventStart = calEvent.start
				selectedEventEnd = calEvent.end;
				selectedEventLocation = calEvent.location;
				selectedEventBody = calEvent.body;
				selectedEventMax = calEvent.max;
				selectedAvailable = calEvent.availablePositions;
								
				var startDate  = new Date(selectedEventStart);
				var endDate = new Date(selectedEventEnd);
				
				$("#title-ed").val(selectedEventTitle);
				
				populateEditStartEndLists(selectedEventStart, selectedEventId);
				
				$("#location-ed").val(selectedEventLocation);
				$("#body-ed").val(selectedEventBody);
				$("#positions").val(selectedEventMax);
				$("#available").val(selectedAvailable);
				
                if(calEvent.type.toLowerCase() == "webinar"){
                    webinarDialog.dialog("open");
					$("#webinar-info").text(selectedEventBody);
					$("#resource-link").val(selectedEventLocation);
                }
                else{
					if(selectedAvailable <=0 ){
						waitingListDialog.dialog( "open" );
					}
					else{
				    	editDialog.dialog( "open" );
					}
                }
		    }
		});

		
		form = editDialog.find( "form" ).on( "submit", function( event ) {
			event.preventDefault();
			bookEvent();
		});
		
		formWaitingList = waitingListDialog.find( "form" ).on("submit", function(event){
			event.preventDefault();
			addToWaitingList();
			});
		
	});
</script>
</body>
</html>
