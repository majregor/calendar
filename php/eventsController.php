<?php
    session_start();

    require_once 'DBConnection.php';
    require_once 'Event.php';
    require_once 'user.php';

 
   // $userObj = getUser($_SESSION['LOGGED_USER_ID']);

    $action = null;
    if(isset($_REQUEST['action']))
      $action = $_REQUEST['action'];
    
    if($action == 'save'){
    	$title = addslashes($_REQUEST['title']);
    	$body = addslashes($_REQUEST['body']);
    	$start = $_REQUEST['start'];
    	$end = $_REQUEST['end'];

      $location = addslashes($_REQUEST['location']);
      //first determine the status of the logged in user...is the user district admin or sub district user...
      $modifiedBy = 1;
      
      
      //now create the Event object...
      $eventObj = new Event();
      $eventObj->setTitle($title);
      $eventObj->setBody($body);
      $eventObj->setStartTime($start);
      $eventObj->setEndTime($end);
      $eventObj->setModifiedBy($modifiedBy);
      $eventObj->setLocation($location);
      $event = new Event();
      $event->save($eventObj);
    }else if($action == 'read'){
          //now I need to read all events only created by the session owner...
          $eventList = null;
          
        $eventList = Event::getAllEventsForUser(1);
    	$events = array();
		/*foreach($eventList as &$event){
			$event->setAvailablePositions();
		}
		unset ($event);*/
		
    	while ($row = mysql_fetch_object($eventList)) {
    	   $eventArray['id'] = $row->id;
    	   $eventArray['title'] =  stripslashes($row->title);
    	   $eventArray['body'] =  stripslashes($row->body);
    	   $eventArray['start'] = $row->startTime;
    	   $eventArray['end'] = $row->endTime;
           $eventArray['location'] = $row->location;
		   $eventArray['max'] = $row->max;
		   $eventArray['color'] = $row->color;
		   $eventArray['type'] = $row->type;
		   $eventArray['all-day'] = $row->allDay;
		   $eventArray['availablePositions'] = Event::getEventAvailablePositions($row->id, $row->max);
    	   $events[] = $eventArray;
    	}
    	echo json_encode($events);
    }else if($action == 'update'){
      $id = $_REQUEST['id'];
      $title = addslashes($_REQUEST['title']);
      $body = addslashes($_REQUEST['body']);
      $start = $_REQUEST['start'];
      $end = $_REQUEST['end'];
     
      $location = addslashes($_POST['location']);
      //now fetch the event object form the database...using title, start and end...
      $eventObj = Event::getEvent($id);
      //now set the new value to the object.
      $modifiedBy = null;
      if($userObj->user_level == '01'){
          $userObject = getUserFromThisSubDistrictWithStatus($_SESSION['SUB_DISTRICT_ID'], 'Active');
          if(!empty($userObject)){
              $modifiedBy = $userObject->id;
          }
      }else if($userObj->user_level == '02'){
          $modifiedBy = $_SESSION['LOGGED_USER_ID'];
      }
      $eventObj->id = $id;
      $eventObj->title = $title;
      $eventObj->body = $body;
      $eventObj->startTime = $start;
      $eventObj->endTime = $end;
      $eventObj->modifiedBy = $modifiedBy;
      $eventObj->location = $location;
      if($eventObj != null){
        Event::update($eventObj);
      }
    }else if($action == 'delete'){
      $id = $_POST['id'];
      Event::delete($id);
    }
	else if($action == 'createEvent'){
		$title = isset($_REQUEST['title']) ? $_REQUEST['title'] : "";
    	$body = isset($_REQUEST['eventNotes']) ? $_REQUEST['eventNotes'] : "";
    	$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : "";
    	$end = isset($_REQUEST['end']) ? $_REQUEST['end'] : "";
		$type = isset($_REQUEST['eventType']) ? $_REQUEST['eventType'] : "";
      	$location = isset($_REQUEST['eventLocation']) ? $_REQUEST['eventLocation'] : "";
		$max = isset($_REQUEST['max']) ? $_REQUEST['max'] : "";
		$type = isset($_REQUEST['eventType']) ? $_REQUEST['eventType'] : "";
		$color = isset($_REQUEST['eventColor']) ? $_REQUEST['eventColor'] : "";
      
      //now create the Event object...
      $eventObj = new Event();
      $eventObj->setTitle($title);
      $eventObj->setBody($body);
      $eventObj->setStartTime($start);
      $eventObj->setEndTime($end);
      $eventObj->setModifiedBy(1);
      $eventObj->setLocation($location);
	  $eventObj->setMax($max);
	  $eventObj->setColor($color);
	  $eventObj->setType($type);
      $event = new Event();
      $event->save($eventObj);
	  //echo $end;
	  header("Location:../admin.php?q=saved");
	}
	else if($action == 'book'){
		$eventId 		=	isset($_REQUEST['id'])			? 	$_REQUEST['id']			: 	"";
		$positions		=	isset($_REQUEST['positions'])	? 	$_REQUEST['positions'] 	: 	0;
		$user			=	isset($_REQUEST['user'])			? 	$_REQUEST['user'] 		: 	"";
		$eventObj = Event::getEventObj($eventId);
		$eventObj->makeBooking($eventId,$user,$positions);
		
		echo ("Booked Successfully");
	}
	else if($action == 'queue'){
		$eventId 		=	isset($_REQUEST['id'])			? 	$_REQUEST['id']			: 	"";
		$user			=	isset($_REQUEST['user'])			? 	$_REQUEST['user'] 		: 	"";
		$eventObj = Event::getEventObj($eventId);
        if($user!=""){
		  $eventObj->addUserToWaitingList($user);
            echo ("Added Successfully");
        }
	}
?>
