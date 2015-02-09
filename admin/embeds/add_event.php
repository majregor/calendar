<?php include("top-menu.php"); ?>
<p>&nbsp;</p>


<form name="newEvent" action="../php/eventsController.php" method="post">
<input type="hidden" name="action" value="createEvent"/>
<input type="hidden" name="start" id="start" />
<input type="hidden" name="end" id="end" />
<input type="hidden" name="eventColor" value="#3A87AD" />
<table cellpadding="5" cellspacing="5" class="newEvent">
<tr>
    <td align="right">
    	<label for="eventTitle">Event Title</label>
        </td>
        <td>
    	<input name ="title" type="text" id="eventTitle">
    </td>
    </tr>
    <tr>
    <td align="right">
        <label for="eventType">Event Type</label>
        </td>
        <td>
        <select id="eventType" name="eventType">
            <option value="SME">SME Event</option>
            <option value="webinar">Webinar</option>
         </select>
    </td>
    </tr>
    <tr>
    <td align="right"><label for="eventLocation">Location/Link</label></td>
        <td><input type="text" id="eventLocation" name="eventLocation"></td>
        </tr>
    <tr>
    <td align="right"> <label for="startDate">Start Date/Time:</label> </td>
        <td><input id="startDate" name="startDate" type="text"></td>
        </tr>
    <tr>
    <td align="right"> <label for="endDate">End Date/Time: </label></td>
        <td><input id="endDate" name="endDate" type="text" ></td>
        </tr>
    <tr>
    <td align="right"><label for="eventNotes">Notes</label></td>
        <td><textarea name="eventNotes" cols="30" rows="5" id="eventNotes"></textarea></td>
        </tr>
    <tr>
    <td align="right"><label for="eventTitle">Maximum Allowed</label></td>
        <td><input name="max" type="text" id="eventNumber" value="10"></td>
        </tr>
    <tr>
<td align="right"><input type="submit" value="Save"></td>
<td></td>
</tr>
</table>
</form>