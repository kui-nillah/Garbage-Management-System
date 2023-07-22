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
        <title>GMS - Driver dashboard</title>
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
                
                <a href="edit-profile.php"><img src="../Docs/img/profile.png" alt=""></a>
            </div>
    
            <div class="dash-content" id="dashboard">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-tachometer-fast-alt"></i>
                        <span class="text">Driver Dashboard</span>
                    </div>
    
                    <div class="boxes">
                        <div class="box box1">
                            <i class='bx bxs-file-plus' ></i>
                            <a href="#" style="text-decoration: none;">
                                <span class="text">New assigned complain</span>
                            </a>
                            <span class="number">
                            <?php echo Librarie::getStatusAssignedComplainTotal2($UserID); ?>
                            </span>
                        </div>
                        <div class="box box2">
                            <i class='bx bx-loader'></i>
                            <a href="#" style="text-decoration: none;">
                                <span class="text">Completed complain</span>
                            </a>
                            <span class="number">
                            <?php echo Librarie::getStatusCompleteComplainTotal2($UserID); ?>
                            </span>
                        </div>
                        <div class="box box3">
                            <i class='bx bx-check-square'></i>
                                <span class="text">Total assigned complain</span>
                            </a>
                            <span class="number">
                            <?php echo Librarie::getTotalComplain2($UserID); ?>
                            </span>
                        </div>
                    </div>
                </div>
    
               
        </section>
       <script src="../Docs/js/dashboard.js"></script>
        
        <script src="" async defer></script>
    </body>
</html>