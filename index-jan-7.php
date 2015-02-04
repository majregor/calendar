<?php 
// Require our Event class and datetime utilities
require dirname(__FILE__) . '/php/utils.php';

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='lib/fullcalendar.min.js'></script>

<link  href='jquery-ui.css' rel='stylesheet' media="screen">
<script src="lib/jquery-ui.js"></script>
<script>

	$(document).ready(function() {
		var global_defaultDate = '<?php echo currentDate('Y-m-d');?>';
		var global_start, global_end;
		 var dialog, editDialog, form,
		 // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
		title = $( "#titles" ),
		startTime = $( "#startTime" ),
		endTime = $( "#endTime" ),
		allFields = $( [] ).add( title ).add( startTime ).add( endTime );
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


		dialog = $( "#dialog-form" ).dialog({
			 autoOpen: false,
			 modal: true,
			 buttons: {
				 "Save": addEvent,
				 Cancel: function() {
				 $( this ).dialog( "close" );
				 }
				 
				 },
			 show: {
			 //effect: "blind",
			 //duration: 1000
			 },
			 hide: {
			 //effect: "explode",
			 //duration: 1000
			 }
			 });


		editDialog = $( "#dialog-edit-form" ).dialog({
			 autoOpen: false,
			 modal: true,
			 buttons: {
				 "Save": editEvent,
				 Cancel: function() {
				 $( this ).dialog( "close" );
				 }
				 
				 }
			 });


		 function editEvent(){
			 var valid=true;

			 valid = valid && checkLength( title, "Event Title", 3, 255 );
			 valid = valid && checkRegexp( title, /^[a-z]([0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );

			 if(valid){
				 var editTitle = $("#title-ed").val();
				 var editStart = $("#start-ed").val();
				 var editEnd = $("#end-ed").val();
				 var editBody = $("#body-ed").val();
                 var editLocation = $("#location-ed").val();

                 if (editTitle) {
 					eventData = {
 						title: editTitle,
 						start: new Date(editStart.val()),
 						end: new Date(editEnd.val())
 					};
			 }

                 var dataString = "action=update&start="+(new Date(editStart.val()).getTime()/1000)+"&end="+(new Date(editEnd.val()).getTime()/1000)+"&title="+encodeURIComponent(editTitle)+"&body="+encodeURIComponent(editBody)+
                 "&location="+encodeURIComponent(editLocation);
                 //alert(dataString);
                 $.ajax({
                   url: 'php/eventsController.php',
                   data: dataString,
                   type:'POST',
                   success:function(response){
                     //$calendar.weekCalendar("removeUnsavedEvents");
                     //$calendar.weekCalendar("updateEvent", calEvent);
                   	dialog.dialog( "close" );
                   },
                   error:function(error){
                     alert(error);
                   }
                 });
				$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
		 }
		
		 function addEvent() {
			var valid = true;
			allFields.removeClass( "ui-state-error" );
			valid = valid && checkLength( title, "Event Title", 3, 255 );
			
			valid = valid && checkRegexp( title, /^[a-z]([0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
			//valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
			//valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
			if ( valid ) {
				var title = titles.val();
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: new Date(startTime.val()),
						end: new Date(endTime.val())
					};

					
	                  var body = $("#body").val();
	                  var location = $("#location").val();

	                  var dataString = "action=save&start="+(new Date(startTime.val()).getTime()/1000)+"&end="+(new Date(endTime.val()).getTime()/1000)+"&title="+encodeURIComponent(title)+"&body="+encodeURIComponent(body)+
	                  "&location="+encodeURIComponent(location);
	                  
	                  $.ajax({
	                    url: 'php/eventsController.php',
	                    data: dataString,
	                    type:'POST',
	                    success:function(response){
	                      //$calendar.weekCalendar("removeUnsavedEvents");
	                      //$calendar.weekCalendar("updateEvent", calEvent);
	                    	dialog.dialog( "close" );
	                    },
	                    error:function(error){
	                      alert(error);
	                    }
	                  });
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				/*
			$( "#users tbody" ).append( "<tr>" +
			"<td>" + name.val() + "</td>" +
			"<td>" + email.val() + "</td>" +
			"<td>" + password.val() + "</td>" +
			"</tr>" );
			*/

			
				dialog.dialog( "close" );
			
			}
			return valid;
		}

			function populateStartEndLists(iniD){
				var d = dateIncrementor = new Date(iniD);
				
				$("#startTime").html("<option value=''>Select Start Time</option>");
				$("#endTime").html("<option value=''>Select End Time</option>");
				
				function addMinutes(date, minutes) {
				    return new Date(date.getTime() + minutes*60000);
				}
				
				for(i=0; i<96; i++){
					var minutes = 15;
					dateIncrementor = addMinutes(dateIncrementor, minutes);
					$("#startTime").append("<option value='" + dateIncrementor + "'>" + dateIncrementor.getHours() + ":" + dateIncrementor.getMinutes() + ":" + dateIncrementor.getSeconds() + "</option>");
					$("#endTime").append("<option value='" + dateIncrementor + "'>" + dateIncrementor.getHours() + ":" + dateIncrementor.getMinutes() + ":" + dateIncrementor.getSeconds() + "</option>");
				}
			}
		
		 $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: global_defaultDate,
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				//var title = prompt('Event Title:');
				global_start = start;
				global_end = end;

				
				$("#selectedDate").html(start.toISOString());
				populateStartEndLists(start.toISOString());
				
				dialog.dialog( "open" );
				
				/*
				var title = titles.val();
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				*/
				$('#calendar').fullCalendar('unselect');
			},
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
			loading: function(bool) {
				$('#loading').toggle(bool);
			},
			
			dayClick: function(date, jsEvent, view) {
				
				 
					 //$( "#dialog" ).dialog( "open" );
					 
				 //alert('Clicked on: ' + date.format());

			        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

			        //alert('Current view: ' + view.name);

			        // change the day's background color just for fun
			       // $(this).css('background-color', 'red');

		    },

			eventClick: function(calEvent, jsEvent, view) {

		        //alert('Event: ' + calEvent.title);
		        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
		        //alert('View: ' + view.name);

		        // change the border color just for fun
		        //$(this).css('border-color', 'red');

		    }
		});

		 form = dialog.find( "form" ).on( "submit", function( event ) {
			event.preventDefault();
			addEvent();
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}
	
	.calendar-fieldset{
	 border:0px;
	 margin:0px;
	 padding:0px;
	}
	
	.ui-dialog .ui-dialog-content{
		padding: .5em;
	}
	
	form#new-calendar-event-form label{
		display:block;
		margin:2px;
	}
	form#new-calendar-event-form ul{
		list-style-type:square;
		padding: .5em;
		margin:0em;
	}
	
	
</style>
</head>
<body>

	<div id='loading'>loading...</div>
	<div id='calendar'></div>

<div id="dialog-form" title="New Event">
<!--  <p class="validateTips">All form fields are required.</p> -->
<form id="new-calendar-event-form">
<fieldset class="calendar-fieldset">
<ul>
<li>
<label><span>Date:</span><span id="selectedDate"></span></label>
</li>
<li>
<label for="title">Name / Title</label>
<input type="text" name="title" id="titles" value="" class="text ui-widget-content ui-corner-all">
</li>
<li>
<label for="start">Start Time:</label>
<select name="start" id="startTime" class="text ui-widget-content ui-corner-all">
</select>
</li>

<li>
<label for="end">End Time:</label>
<select name="end" id="endTime" class="text ui-widget-content ui-corner-all">
</select>
</li>

<li>
<label for="location">Location:</label>
<textarea rows="3" cols="25" name="location" id="location" class="text ui-widget-content ui-corner-all"></textarea>
</li>

<li>
<label for="body">Body:</label>
<textarea rows="3" cols="25" name="body" id="body" class="text ui-widget-content ui-corner-all"></textarea>
</li>

<!-- Allow form submission with keyboard without duplicating the dialog button -->
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
</ul>
</fieldset>
</form>
</div>



<div id="dialog-edit-form" title="Edit Event">
<!--  <p class="validateTips">All form fields are required.</p> -->
<form id="new-calendar-event-form">
<fieldset class="calendar-fieldset">
<ul>
<li>
<label><span>Date:</span><span id="selectedDate"></span></label>
</li>
<li>
<label for="title">Name / Title</label>
<input type="text" name="title" id="title-ed" value="" class="text ui-widget-content ui-corner-all">
</li>
<li>
<label for="start">Start Time:</label>
<select name="start" id="startTime-ed" class="text ui-widget-content ui-corner-all">
</select>
</li>

<li>
<label for="end">End Time:</label>
<select name="end" id="endTime-ed" class="text ui-widget-content ui-corner-all">
</select>
</li>

<li>
<label for="location">Location:</label>
<textarea rows="3" cols="25" name="location-ed" id="location" class="text ui-widget-content ui-corner-all"></textarea>
</li>

<li>
<label for="body">Body:</label>
<textarea rows="3" cols="25" name="body" id="body-ed" class="text ui-widget-content ui-corner-all"></textarea>
</li>

<!-- Allow form submission with keyboard without duplicating the dialog button -->
<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
</ul>
</fieldset>
</form>
</div>

</body>
</html>
