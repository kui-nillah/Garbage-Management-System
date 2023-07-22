<?php 
    require 'private/libraries.php';
    require 'private/Session.php';
    $UserID = $session -> getSessionData();
    $session->logout();
    header('Location:register.php');
    
?>