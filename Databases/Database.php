<?php 

  class Database{
  	 
	 private static $connect = null;
	 private static $select_Db = null;
	 
  function __construct(){ // construct 
		  $this->connectDb();
		  $this->selectDb(); 
	}
 
  private function connectDb(){ // connect to the database
		 self::$connect = mysqli_connect("localhost","root","");
		if (!self::$connect) {
			die(" Error !!");
		}
	}
	
  private function selectDb(){ // select database 
	     self::$select_Db = mysqli_select_db(self::$connect,"garbage");
		 if(!self::$select_Db){
		 	die("Error");
		 }
	}

  public static function query($sql){
  	  return mysqli_query(self::$connect,$sql);
  }
   
  public static function mysqli_fetch_array($query){
  	   return mysqli_fetch_array($query);
  } 

  public static function getDatabaseConnect(){
  	   return self::$connect;
  }
  
  }

$database = new Database();
?>