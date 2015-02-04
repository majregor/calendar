
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
<input type="text" name="title" id="title" value="" class="text ui-widget-content ui-corner-all">
</li>


<div id="lists-container">

</div>

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
<label for="title">Name / Title</label>
<input type="text" name="title" id="title-ed" value="" class="text ui-widget-content ui-corner-all">
</li>

<div id="edit-lists-container">

</div>

<li>
<label for="location">Location:</label>
<textarea rows="3" cols="25" name="location" id="location-ed" class="text ui-widget-content ui-corner-all"></textarea>
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