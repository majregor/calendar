<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="<?php echo (($action=="show" && $q=="events") ? 'active' : ''); ?>"><a href="?action=show&q=events">All Events</a></li>
    <li role="presentation" class="<?php echo (($action=="add" && $q="event") ? 'active' : ''); ?>"><a href="?action=add&q=event">Add New</a></li>
    <li role="presentation" class="<?php echo (($action=="show" && $q=="booked") ? 'active' : ''); ?>"><a href="?action=show&q=booked">Booked</a></li>
    <li role="presentation" class="<?php echo (($action=="show" && $q=="booked") ? 'active' : ''); ?>"><a href="?action=show&q=booked">Booked</a></li>
    <li role="presentation" class="<?php echo (($action=="show" && $q=="booked") ? 'active' : ''); ?>"><a href="?action=show&q=booked">Webinar</a></li>
</ul>
<div id="events-container">
</div>
<?php 
include("edit_event.php");
?>
<script language="javascript">
var selectedEventId, selectedEventTitle, selectedEventType, selectedEventLocation, selectedEventBody;
$(document).ready(function() {
	populateEvents();
			 
	});
	
	var editDialog = $( "#dialog-edit-form" ).dialog({
			 autoOpen: false,
			 modal: true,
			 buttons: {
				 "Save": editEvent,
				 "Delete": deleteEvent,
				 Cancel: function() {
				 $( this ).dialog( "close" );
				 }
				 
				 }
			 });
	
	function showEditDialog(event, eventId, title, type, location, body){
		event.preventDefault();
		selectedEventId 		= eventId;
		selectedEventTitle		= title; 
		selectedEventType		= type; 
		selectedEventLocation	= location; 
		selectedEventBody		= body;
		$("#title-ed").val(selectedEventTitle);
		$("#location-ed").val(selectedEventLocation);
		$("#body-ed").val(selectedEventBody);
		$("#eventType").val(selectedEventType);
		populateEditStartEndLists(eventId);
		editDialog.dialog( "open" );
		
		
	}
	
		function deleteEvent(){
			var c;
			 var editId = selectedEventId;
			 var editTitle = $("#title-ed");
			 var editStart = $("#start-ed");
			 var editEnd = $("#end-ed");
			 var editBody = $("#body-ed");
			 var editLocation = $("#location-ed");
			 var editType = $("#eventType");
			 

			if(confirm("Are you sure you want to delete this event permanently?")){

				var dataString = "action=delete&id=" + selectedEventId;
				
			    $.ajax({
	                   url: '../php/eventsController.php',
	                   data: dataString,
	                   type:'POST',
	                   success:function(response){
						 selectedEventId = null;
						 selectedEventTitle = null;
						 selectedEventStart = null;
						 selectedEventEnd = null
						 selectedEventLocation = null;
						 selectedEventBody = null;
						 selectedEventType = null;
						 
						$("#title-ed").val("");
						$("#start-ed").val("");
						$("#end-ed").val("");
						$("#location-ed").val("");
						$("#body-ed").val("");
						$("#eventType").val("");
						 
	                   	
	                   },
	                   error:function(error){
	                     alert(error);
	                   }
	                 });
					 editDialog.dialog( "close" );
					 location.reload();
			}
		}
		
		
		function editEvent(){
			 var valid=true;
			 
			 var editId = selectedEventId;
			 var editTitle = $("#title-ed");
			 var editStart = $("#start-ed");
			 var editEnd = $("#end-ed");
			 var editBody = $("#body-ed");
			 var editLocation = $("#location-ed");
			 var editType = $("#eventType");
			 
			 
			 	var dataString = "action=update&id=" + editId + "&start="+ editStart.val() +"&end="+ editEnd.val()+"&title="+encodeURIComponent(editTitle.val())+"&body="+encodeURIComponent(editBody.val())+
                 "&location="+encodeURIComponent(editLocation.val()) + "&type="+editType.val();
                 $.ajax({
                   url: '../php/eventsController.php',
                   data: dataString,
                   type:'POST',
                   success:function(response){
                     
					 selectedEventId = null;
					 selectedEventTitle = null;
					 selectedEventStart = null;
					 selectedEventEnd = null
					 selectedEventLocation = null;
					 selectedEventBody = null;
                   },
                   error:function(error){
                     alert(error);
                   }
                 });
        
		
		 	$("#title-ed").val("");
			$("#start-ed").val("");
			$("#end-ed").val("");
			$("#location-ed").val("");
			$("#body-ed").val("");
			$("#eventType").val("");
		 	editDialog.dialog("close");
			location.reload();
		 }
		 
	
	function populateEvents(){
			
			var dataString="action=show&q=events";
			//alert($('#selectedDate').html());
			 $.ajax({
	                   url: '../php/eventsController.php',
	                   data: dataString,
	                   type:'POST',
	                   success:function(response){
						//alert(response);
						 $("#events-container").html(response);
	                   },
	                   error:function(error){
	                     alert(error);
	                   }
	                 });	
			   
		}
		
		function populateEditStartEndLists(id){
			var dataString="action=list_time&event_id="+id;
			
			 $.ajax({
	                   url: '../php/datesController.php',
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
</script>