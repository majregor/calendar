<?php
/**
  * Event Class
  * for manipulating event object and serializing them to database
  */

class Event {
	private $id;
	private $title;
	private $body;
	private $startTime;
	private $endTime;
	private $location;
	private $modifiedBy;
	private $modificationDate;
	private $max;
	private $availablePositions;
	private $color;
	private $type;
	private $allDay=0;
	
	// Full Calendar Event properties
	private $url;
	private $className;
	private $editable=0;
	private $startEditable=0;
	private $durationEditable=0;
	private $rendering;
	private $overlap=0;
	private $source;
	private $backgroundColor;
	private $borderColor;
	private $textColor;
	
	
	public function __construct() {
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getId() {
		return $this->id;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setBody($body) {
		$this->body = $body;
	}
	public function getBody() {
		return $this->body;
	}
	public function setStartTime($startTime) {
		$this->startTime = $startTime;
	}
	public function getStartTime() {
		return $this->startTime;
	}
	public function setEndTime($endTime) {
		$this->endTime = $endTime;
	}
	public function getEndTime() {
		return $this->endTime;
	}
	public function setModifiedBy($modifiedBy) {
		$this->modifiedBy = $modifiedBy;
	}
	public function getModifiedBy() {
		return $this->modifiedBy;
	}
	public function setModificationDate($modificationDate) {
		$this->modificationDate = $modificationDate;
	}
	public function getModificationDate() {
		return $this->modificationDate;
	}
	public function setLocation($location) {
		$this->location = $location;
	}
	public function getLocation() {
		return $this->location;
	}
	public function setColor($color) {
		$this->color = $color;
	}
	public function getColor() {
		return $this->color;
	}
	
	public function setAllDay($allDay) {
		$this->allDay = $allDay;
	}
	public function isAllDay() {
		return $this->allDay;
	}
	
	public function setUrl($url) {
		$this->url = $url;
	}
	public function getUrl() {
		return $this->url;
	}
	public function setMax($max) {
		$this->max = $max;
	}
	public function getMax() {
		return $this->max;
	}
	public function setType($type) {
		$this->type = $type;
	}
	public function getType() {
		return $this->type;
	}
	
	public  function makeBooking($eventId, $userId, $positions=1){
		try{
			$query = "INSERT INTO tbl_event_bookings(event_id, positions, user) VALUES(
															$eventId, 
															$positions,
															$userId
			)";
			DBConnection::save ( $query );
			$this->setAvailablePositions();
		}
		catch(Exception $ex){
			echo $ex->getMessage();
		}
	}
	
	public  function addUserToWaitingList($userId){
		try{
			$query = "INSERT INTO tbl_event_waiting_list(event_id, user_id) VALUES(
															$this->id, 
															$userId
			)";
			DBConnection::save ( $query );
		}
		catch(Exception $ex){
			echo $ex->getMessage();
		}
	}
	
	
	
	public function setAvailablePositions(){
		try{
			$query = "select event_id, count(positions) as booked from tbl_event_bookings where event_id=$this->id GROUP BY event_id;";
			$result = DBConnection::read ( $query );
			if($resultRow = mysql_fetch_assoc ( $result )){
				$num_booked = $resultRow['booked'];
				$this->availablePositions=$this->max - $num_booked;
			}
			else{
				$this->availablePositions = $this->max;
			}
		}
		catch(Exception $ex){
			echo $ex->getMessage();
		}
	}
	
	public static function getEventAvailablePositions($eventId, $max){
		$availablePositions = $max;
		try{
			$query = "select event_id, count(positions) as booked from tbl_event_bookings where event_id=$eventId GROUP BY event_id;";
			$result = DBConnection::read ( $query );
			if($resultRow = mysql_fetch_assoc ( $result )){
				$num_booked = $resultRow['booked'];
				$availablePositions=$max - $num_booked;
			}
		}
		catch(Exception $ex){
			echo $ex->getMessage();
		}
		
		return $availablePositions;
	}
	
	public function getAvailablePositions(){
		return $this->availablePositions;
	}
	
	
	public function save($event) {
		try {
			$query = "INSERT INTO tbl_event_calendar VALUES(
															0, 
															'$event->title', 
															'$event->body', 
															'$event->startTime', 
															'$event->endTime', 
															'$event->location', 
															$event->modifiedBy, 
															NOW(),
															$event->allDay,
															'$event->url',
															'$event->className',
															$event->editable,
															$event->startEditable,
															$event->durationEditable,
															'$event->rendering',
															$event->overlap,
															'$event->source',
															'$event->color',
															'$event->backgroundColor',
															'$event->borderColor',
															'$event->textColor',
															$event->max,
															'$event->type'
			)";
			//echo $query;
			DBConnection::save ( $query );
			$this->availablePositions = $event->max;
		} catch ( Exception $ex ) {
			echo $ex->getMessage ();
		}
	}
	public static function update($event) {
		try {
			$query = "UPDATE tbl_event_calendar SET title = '$event->title', body = '$event->body', start_time='$event->startTime', end_time='$event->endTime', location = '$event->location', modified_by = $event->modifiedBy, modification_date = NOW(), max=$event->max, color='$event->color', type='$event->type', allDay=$event->allDay WHERE id = $event->id";
			echo $query;
			DBConnection::save ( $query );
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	public static function delete($id) {
		try {
			$query = "DELETE FROM tbl_event_calendar WHERE id = $id";
			DBConnection::save ( $query );
			
			//Delete from bookings table too
			$query = "DELETE FROM tbl_event_bookings WHERE event_id = $id";
			DBConnection::save ( $query );
			
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	public static function getEvent($id) {
		try {
			$query = "SELECT * FROM tbl_event_calendar WHERE id = $id";
			$result = DBConnection::read ( $query );
			$resultRow = mysql_fetch_object ( $result );
			return $resultRow;
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	
	public static function getEventObj($id) {
		try {
			$query = "SELECT * FROM tbl_event_calendar WHERE id = $id";
			$result = DBConnection::read ( $query );
			$resultRow = mysql_fetch_object ( $result );
			$eventObj = null;
			$eventObj = new Event ();
			$eventObj->id = $resultRow->id;
			$eventObj->title = $resultRow->title;
			$eventObj->body = $resultRow->body;
			$eventObj->startTime = $resultRow->start_time;
			$eventObj->endTime = $resultRow->end_time;
			$eventObj->location = $resultRow->location;
			$eventObj->max = $resultRow->max;
			$eventObj->color = $resultRow->color;
			$eventObj->type = $resultRow->type;
			$eventObj->allDay = $resultRow->allDay;
			$eventObj->setAvailablePositions();
			return $eventObj;
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	public static function getAllEventObjs() {
		try {
			$query = "SELECT id, title, body, DATE_FORMAT(start_time, '%Y-%m-%dT%H:%i') AS startTime, DATE_FORMAT(end_time, '%Y-%m-%dT%H:%i') AS endTime, location, max, color, type, allDay FROM tbl_event_calendar";
			$result = DBConnection::read ( $query );
			$eventObjs = array();
			
			while($resultRow = mysql_fetch_object ( $result )){
				$eventObj = null;
				$eventObj = new Event ();
				$eventObj->id = $resultRow->id;
				$eventObj->title = $resultRow->title;
				$eventObj->body = $resultRow->body;
				$eventObj->startTime = $resultRow->startTime;
				$eventObj->endTime = $resultRow->endTime;
				$eventObj->location = $resultRow->location;
				$eventObj->max = $resultRow->max;
				$eventObj->color = $resultRow->color;
				$eventObj->type = $resultRow->type;
				$eventObj->allDay = $resultRow->allDay;
				$eventObj->setAvailablePositions();
				array_push($eventObjs, $eventObj);
			}
			return $eventObjs;
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	
	
	public static function getEventUsing($title, $start, $end) {
		try {
			$query = "SELECT id, title, body, DATE_FORMAT(start_time, '%Y-%m-%dT%H:%i') AS startTime, DATE_FORMAT(end_time, '%Y-%m-%dT%H:%i') AS endTime, location, max, color, type, allDay FROM tbl_event_calendar WHERE title = '$title' and start_time = '$start' and end_time = '$end'";
			// echo $query;
			$result = DBConnection::read ( $query );
			$resultRow = mysql_fetch_object ( $result );
			$eventObj = null;
			$eventObj = new Event ();
			$eventObj->id = $resultRow->id;
			$eventObj->title = $resultRow->title;
			$eventObj->body = $resultRow->body;
			$eventObj->startTime = $resultRow->startTime;
			$eventObj->endTime = $resultRow->endTime;
			$eventObj->location = $resultRow->location;
			$eventObj->max = $resultRow->max;
			$eventObj->color = $resultRow->color;
			$eventObj->type = $resultRow->type;
			$eventObj->allDay = $resultRow->allDay;
			$eventObj->setAvailablePositions();
			return $eventObj;
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	public static function getAllEvents() {
		try {
			$query = "SELECT id, title, body, DATE_FORMAT(start_time, '%Y-%m-%dT%H:%i' ) AS startTime, DATE_FORMAT(end_time, '%Y-%m-%dT%H:%i' ) AS endTime, location, max, color, type, allDay FROM tbl_event_calendar ORDER BY start_time DESC";
			$result = DBConnection::read ( $query );
			return $result;
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	public static function getAllEventsModifiedByUsingUserLevel($userLevel, $divisionId) {
		try {
			$query = "SELECT tbl_event_calendar.id as eId, title, body, DATE_FORMAT(start_time, '%Y-%m-%dT%H:%i' ) AS startTime, DATE_FORMAT(end_time, '%Y-%m-%dT%H:%i' ) AS endTime, location, max, color, type, allDay FROM tbl_event_calendar, " . "tbl_user_sub_district WHERE tbl_event_calendar.modified_by = tbl_user_sub_district.user_id and tbl_user_sub_district.sub_district_id = $divisionId ORDER BY start_time DESC";
			 
			$result = DBConnection::read ( $query );
			return $result;
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	public static function getAllEventsForUser($userId) {
		try {
			$query = "SELECT id, title, body, DATE_FORMAT(start_time, '%Y-%m-%dT%H:%i' ) AS startTime, DATE_FORMAT(end_time, '%Y-%m-%dT%H:%i' ) AS endTime, location, max, color, type, allDay FROM tbl_event_calendar WHERE modified_by = $userId ORDER BY start_time DESC";
			$result = DBConnection::read ( $query );
			return $result;
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
	
	
	
	
} // end class
?>
