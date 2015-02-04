<?php
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
/**
* Description of DBConnection
*
*
*/
const DBHOST = "localhost";
const DBUSER = "root";
const DBPASSWORD = "glyde1";
const DATABASE = "y4y_db1";


require_once("DBConnection.php");

class DBConnection {
  public static function connect(){
    //configuration...
    $server = DBHOST;
    $username = DBUSER;
    $password = DBPASSWORD;
    $database = DATABASE;
    @$connection = mysql_pconnect($server, $username, $password);
    return $connection;
  }

  public static function executeQuery($query){
    $dbConnection = DBConnection::connect();
    @mysql_select_db(DATABASE, $dbConnection);
    $result = mysql_query($query);
    return $result;
  }

  public static function read($query){
    $result = DBConnection::executeQuery($query);
    return $result;
  }

  public static function save($query){
    $result = DBConnection::executeQuery($query);
    return;
  }

}//end class
?>
