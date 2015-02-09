<?php
/**
*/
class Booking{
	
	private $id;
	private $event;
	private $user;
	private $positions;
	private $added;
	
	public function __construct(){
		$this->event = new Event();
	}
	
	public function setId($id){
		$this->id=$id;
	}
	public function getId(){
		return $this->id;
	}
	
	public function setAdded($added){
		$this->added = $added;
	}
	public function getAdded(){
		return $this->added;
	}
	
	public function setEvent($event){
		$this->event = $event;
	}
	public function getEvent(){
		return $this->event;
	}
	
	public function setPositions($positions){
		$this->positions = $positions;
	}
	public function getPositions(){
		return $this->positions;
	}
	
	public function setUser($user){
		$this->user = $user;
	}
	public function getUser(){
		return $this->user;
	}
	
	public  function save(){
		try{
			$query = "INSERT INTO tbl_event_bookings(event_id, positions, user) VALUES(
															".$this->event->getId().", 
															$this->positions,
															$this->user
			)";
			DBConnection::save ( $query );
		}
		catch(Exception $ex){
			echo $ex->getMessage();
		}
	}
	
	
	
	public function read($id){
		$obj = new Booking();
		try{
			$query = "SELECT B.* FROM tbl_event_calendar A INNER JOIN tbl_event_bookings B ON A.id = B.event_id WHERE B.id=$id";
			
			$result = DBConnection::read($query);
			$resultRow = mysql_fetch_object($result);
			
			$obj->id=$resultRow->id;
			$obj->event=Event::getEventObj($resultRow->event_id);
			$obj->positions=$resultRow->positions;
			$obj->user=$resultRow->user;
			$obj->added=$resultRow->added;
			
		}
		catch(Exception $ex){
			$ex->getMessage();
		}
		return $obj;
	}
	
	public function sendToWaiting(){
		try{
			$query = "INSERT INTO tbl_event_waiting_list(event_id, user_id) VALUES(
															".$this->event->getId().", 
															$this->user
			)";
			echo $query;
			DBConnection::save ( $query );
			//Remove booking
			$query = "DELETE FROM tbl_event_bookings WHERE id = $this->id";
			DBConnection::save ( $query );
			
		}
		catch(Exception $ex){
			$ex->getMessage();
		}
	}
	
	public static function getAllBookings($event_id=""){
		$bookings = array();
		try{
			if($event_id == ""){
				$query = "SELECT B.id FROM tbl_event_calendar A INNER JOIN tbl_event_bookings B ON A.id = B.event_id ORDER BY B.added DESC";
			}
			else{
				$query = "SELECT B.id FROM tbl_event_calendar A INNER JOIN tbl_event_bookings B ON A.id = B.event_id WHERE B.event_id=$event_id ORDER BY B.added DESC";
			}
			
			$results = DBConnection::read($query);
			while($resultsRow = mysql_fetch_object($results)){
				$booking = new Booking();
				
				array_push($bookings, $booking->read($resultsRow->id));
			}
			
		}
		catch(Exception $ex){
			$ex->getMessage();
		}
		
		return $bookings;
	}
	
	
	public static function delete($id) {
		try {
			$query = "DELETE FROM tbl_event_bookings WHERE id = $id";
			DBConnection::save ( $query );
			
		} catch ( Exception $ex ) {
			$ex->getMessage ();
		}
	}
}
?>