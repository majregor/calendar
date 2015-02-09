<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="<?php echo (($action=="show" && $q=="events") ? 'active' : ''); ?>">
    	<a href="?action=show&q=events">All Events</a>
    </li>
    <li role="presentation" class="<?php echo (($action=="add" && $q="event") ? 'active' : ''); ?>">
    	<a href="?action=add&q=event">Add New</a>
    </li>
    <li role="presentation" class="<?php echo (($action=="show" && $q=="booked") ? 'active' : ''); ?>">
    	<a href="?action=show&q=booked">Booked</a>
    </li>
    <li role="presentation" class="<?php echo (($action=="show" && $q=="waiting") ? 'active' : ''); ?>">
    	<a href="?action=show&q=waiting">Waiting</a>
    </li>
</ul>