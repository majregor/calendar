<?php include("top-menu.php"); ?>
<div style="margin:10px;">
<label for="refine-booked">Select Event</label>
    <select id="refine-booked" name="refine-booked">
    	<option value="all" selected="selected">All</option>
        <?php
			$eventsCollection = Event::getAllEventObjs();
			foreach($eventsCollection as $key=>$value){
				if($value->getTitle()==""){
					print("<option value='".$value->getId()."'>".$value->getId()."</option>");
				}
				else{
					print("<option value='".$value->getId()."'>".$value->getTitle()."</option>");
				}
				
			}
		?>
    </select>
</div>
<div id="events-container">
</div>
<?php 
include("edit_booking.php");
?>
<script language="javascript">
var selectedBookingId;

$(document).ready(function() {
	populateBooked();
	
	$("#refine-booked").change(function(){
		populateBookedByEvent($(this).val());
		});
		
	});
	
	function showBookedDialog( event, booking_id ){
		event.preventDefault();
		selectedBookingId 		= booking_id;
		editBookingDialog.dialog( "open" );
	}
	
	var editBookingDialog = $( "#dialog-edit-form" ).dialog({
			 autoOpen: false,
			 modal: true,
			 buttons: {
				 "Delete Booking": deleteBooking,
				 "Send to waiting list	" : makeWaiting,
				 Cancel: function() {
					 $( this ).dialog( "close" );
					 }
				 
				 }
			 });
	
		function makeWaiting(){
			if(confirm("Will add booking to waiting list. Click Ok to Confirm")){
				
				var dataString = "action=queue&q=booking&q1=" + selectedBookingId;
				alert(dataString);
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

				editBookingDialog.dialog( "close" );
				location.reload();
			}
		}
		function deleteBooking(){
			
			if(confirm("Are you sure you want to delete this booking permanently?")){
				
				var dataString = "action=delete&q=booking&id=" + selectedBookingId;
				
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

				editBookingDialog.dialog( "close" );
				location.reload();
			}
		}
		
	function populateBooked(){
			
			var dataString="action=show&q=booked";
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
		
		function populateBookedByEvent(event_id){
			
			var dataString="action=show&q=booked&q1="+event_id;
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
		
		form = editBookingDialog.find( "form" ).on( "submit", function( event ) {
			event.preventDefault();
			deleteBooking();
		});
		
</script>