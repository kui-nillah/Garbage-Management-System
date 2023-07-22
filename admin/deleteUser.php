<?php
    require '../private/display.php';
    require '../Databases/Database.php';
    require '../private/libraries.php';
    require '../private/session.php';
    
    $UserID = $session -> getSessionData();
    
   
    $id = $_GET['id'];
    if(Librarie::setDeleteUserInfo($id)){
      header('Location:manage.php');
    }


?>