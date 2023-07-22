<?php 
    require '../private/display.php';
    require '../Databases/Database.php';
    require '../private/libraries.php';
    require '../private/session.php';

    if (!$session -> is_loged_in()) {
        header('Location:register.php');
    }
    
    $UserID = $session -> getSessionData();
    
   

 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GMS - Assigned Complains</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!----======== CSS ======== -->
    <link rel="stylesheet" href="../Docs/css/dashboard.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        
    </head>
    <body>
         <nav>
            <div class="logo-name">
                <div class="logo-image">
                    <img src="../Docs/img/logo.png" alt="">
                </div>
    
                <span class="logo_name">GMS</span>
            </div>
    
            <div class="menu-items">
            <ul class="nav-links">
                    <li><a href="driver.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                    <li><a href="assignedComplain.php">
                        <i class='bx bx-bell-plus'></i>
                        <span class="link-name">Assigned complain</span>
                    </a></li>
                    <li><a href="search.php">
                        <i class='bx bx-search-alt-2' style='color:#969696' ></i>
                        <span class="link-name">Search</span>
                    </a></li>
                </ul>
                
                <ul class="logout-mode">
                    <li><a href="../logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
    
                    <li class="mode">
                        <a href="#">
                            <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
    
                    <div class="mode-toggle">
                      <span class="switch"></span>
                    </div>
                </li>
                </ul>
            </div>
        </nav>
    
        <section class="dashboard">
            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>
            </div>
    
            <div class="dash-content" id="dashboard">
            <main class="table">
        <section class="table__header">
            <h1>New Complain</h1>
        </section>
        <section class="table__body">

            <?php 
            
              echo Librarie::getComplainDriver_2($UserID);

            ?>

        </section>
             </div>
             
             </main>
               
        </section>
       <script src="../Docs/js/dashboard.js"></script>
        
        <script src="" async defer></script>
    </body>
</html>