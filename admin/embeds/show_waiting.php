<?php include("top-menu.php"); ?>
<div id="events-container">
</div>
<?php 
include("edit_event.php");
?>
<script language="javascript">
var selectedEventId, selectedEventTitle, selectedEventType, selectedEventLocation, selectedEventBody,selectedEventStatus, selectedEventUser;

$(document).ready(function() {
	populateEvents();
			 
	});
	
	var editDialog = $( "#dialog-edit-form" ).dialog({
			 autoOpen: false,
			 modal: true,
			 buttons: {
				 "Save": editEvent,
				 "Close Event" : closeEvent,
				 "Book Slot": bookUser,
				 "Delete": deleteEvent,
				 Cancel: function() {
					 $( this ).dialog( "close" );
					 }
				 
				 }
			 });
			 
	var editDialogOpenEvent = $( "#dialog-edit-open-form" ).dialog({
			 autoOpen: false,
			 modal: true,
			 buttons: {
				 "Save": editEvent,
				 "Open Event" : openEvent,
				 "Delete": deleteEvent,
				 Cancel: function() {
					 $( this ).dialog( "close" );
					 }
				 
				 }
			 });
	
	function showEditDialog(event, eventId, title, type, location, body, status, user){
		event.preventDefault();
		selectedEventId 		= eventId;
		selectedEventTitle		= title; 
		selectedEventType		= type; 
		selectedEventLocation	= location; 
		selectedEventBody		= body;
		selectedEventStatus		= status;
		selectedEventUser		= user;
		$("#title-ed").val(selectedEventTitle);
		$("#location-ed").val(selectedEventLocation);
		$("#body-ed").val(selectedEventBody);
		$("#eventType").val(selectedEventType);
		populateEditStartEndLists(eventId);
		if(selectedEventStatus=="open"){
			editDialog.dialog( "open" )
		}else{
			editDialogOpenEvent.dialog( "open" );
		}
		
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
						 selectedEventStatus = null;
						 
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
		
		function closeEvent(){
			
			if(confirm("Are you sure you want to close this event?")){
				
				var dataString = "action=close_event&id=" + selectedEventId;
				
			    $.ajax({
	                   url: '../php/eventsController.php',
	                   data: dataString,
	                   type:'POST',
	                   success:function(response){
	                   },
	                   error:function(error){
	                     alert(error);
	                   }
	                 });

				editDialog.dialog( "close" );
				location.reload();
			}
		}
		
		function openEvent(){
			
			if(confirm("Are you sure you want to open this event?")){
				
				var dataString = "action=open_event&id=" + selectedEventId;
				
			    $.ajax({
	                   url: '../php/eventsController.php',
	                   data: dataString,
	                   type:'POST',
	                   success:function(response){
	                   	
	                   },
	                   error:function(error){
	                     alert(error);
	                   }
	                 });

				editDialogOpenEvent.dialog( "close" );
				location.reload();
			}
		}
		function bookUser(){
			
			if(confirm("Send to booking list?")){
				
				var dataString = "action=book&id=" + selectedEventId+"&user="+selectedEventUser+"&positions=1";
			    $.ajax({
	                   url: '../php/eventsController.php',
	                   data: dataString,
	                   type:'POST',
	                   success:function(response){
	                   	
	                   },
	                   error:function(error){
	                     alert(error);
	                   }
	                 });

				editDialogOpenEvent.dialog( "close" );
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
			
			var dataString="action=show&q=waiting";
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