<?php
  require '../private/display.php';
  require '../Databases/Database.php';
  require '../private/libraries.php';
  require '../private/session.php';

  if (!$session -> is_loged_in()) {
      header('Location:register.php');
  }
  
  $UserID = $session -> getSessionData();

$complain_id = $_GET['id']; 

 if(Librarie::setUpdateDriverComplainStatus($complain_id)){
    if(Librarie::setUpdateDriverComplainStatus2($complain_id)){
        header('Location:assignedComplain.php');
    }
 }
    header('Location:assignedComplain.php');

?>