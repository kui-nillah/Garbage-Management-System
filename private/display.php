<?php 

class Display {
  
  	public static function getDisplayMessage($message){
			return "<p id = 'p_error_message' class='alert alert-danger fade in'>  ".$message."</p>";
      } 
	
     public static function getDisplayMessage2($message){
     		
     	return  $message;
		
		
		
      }  
}
?>