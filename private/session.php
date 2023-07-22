<?php 
  class Session{
  	  
	  private $is_login = false;
	  public  $user_id ;
	   function __construct(){
	 	  session_start();
		  $this->check_login();
	   }
	   
	public   function check_login(){
		 if(isset($_SESSION['IDCODE'])){
		 	 $this->user_id = $_SESSION['IDCODE'];
			 $this->is_login = true;
		 }else{
		 	unset($this->user_id);
			$this->is_login = false;
		 }
	}
	
	public  function is_loged_in(){
		 return $this->is_login;
	}
	
	public function getSessionData(){
		return $_SESSION['IDCODE'];
	}
	
	public  function login($isnumberId){
		$this->user_id = $_SESSION['IDCODE'] = $isnumberId;
		$this->is_login = true; 
	}
	
	public  function logout(){
		unset($_SESSION['IDCODE']);
		unset($this->user_id);
		$this->is_login = false;
	}
	
  }
 $session = new Session();
 
 ?>  