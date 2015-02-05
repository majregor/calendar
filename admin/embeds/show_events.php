<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="<?php echo (($action=="show" && $q=="events") ? 'active' : ''); ?>"><a href="?action=show&q=events">All Events</a></li>
    <li role="presentation" class="<?php echo (($action=="add" && $q="event") ? 'active' : ''); ?>"><a href="?action=add&q=event">Add New</a></li>
    <li role="presentation" class="<?php echo (($action=="show" && $q=="booked") ? 'active' : ''); ?>"><a href="?action=show&q=booked">Booked</a></li>
    <li role="presentation" class="<?php echo (($action=="show" && $q=="booked") ? 'active' : ''); ?>"><a href="?action=show&q=booked">Booked</a></li>
    <li role="presentation" class="<?php echo (($action=="show" && $q=="booked") ? 'active' : ''); ?>"><a href="?action=show&q=booked">Webinar</a></li>
</ul>
<div id="events-container">
</div>
<script language="javascript">
$(document).ready(function() {
	populateEvents();
	});
	
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
</script>