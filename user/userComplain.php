<?php 
    require '../private/display.php';
    require '../Databases/Database.php';
    require '../private/libraries.php';
    require '../private/session.php';

    if (!$session -> is_loged_in()) {
        header('Location:register.php');
    }
    
    $UserID = $session -> getSessionData();
    
   
    if (isset($_POST['send'])) {
      $region = $_POST['region'];
      $municipal = $_POST['municipal'];
      $street = $_POST['street'];
      $house_no = $_POST['house_no'];
      $IMGfile =  basename($_FILES["fileToUpload"]["name"]);
      $imageFileType =  strtolower(pathinfo($IMGfile,PATHINFO_EXTENSION));


      if (empty($region) || empty($municipal) || empty($street)  || empty($house_no)  || $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        if(empty($region)){
            $message =  " PLease select your region ";
        }elseif(empty($municipal)){
            $message =  " PLease select your municipal ";
        }elseif(empty($street)){
            $message =  " PLease enter your street ";
        }elseif(empty($house_no) ){
            $message =  " PLease enter your house number ";
        }elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
            $message =  "Please upload the required file";
        }
    } else{
        $message =  $filename = md5(Librarie::getTodayDate()).".".$imageFileType;

        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../UploadIMG/".$filename)){
            $path = '../UploadIMG/'.$filename;
        if(Librarie::fileUsersComplain( $region , $municipal, $street, $house_no, $path  , $UserID )){
            header('Location: userComplain.php');
            exit();
            $message = " You have successfully filed your complaint. ";
        }else{
            
            $message = " Try again in a few minutes. ";
        }
       }else{
        $message = " Try again in a file. ";
       }
    }
}else{
    $message = "";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GMS - Lodge complains</title>
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
                    <li><a href="user.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                    <li><a href="userComplain.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Lodged complain</span>
                    </a></li>
                    <li><a href="userHistory.php">
                        <i class='bx bx-history' style='color:#838383'></i>
                         <span class="link-name">Complain history</span>
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
            <div class="overview">
                    <div class="title">
                        <i class="uil uil-tachometer-fast-alt"></i>
                        <span class="text">User Dashboard</span>
                    </div>
                <section class="container">
                    <header>Lodge Complain</header>
                    <form method="POST" action="<?php echo $s = $_SERVER['SCRIPT_NAME']; ?>"class="form"  enctype="multipart/form-data" >
                      <div class="input-box address">
                      <?php echo $message; ?>
                        <label>Address</label>
                        <div class="fields">
                            <div class="input-field">
                                <label>Region</label>
                                <select name="region" required>
                                    <option disabled selected>Select Region</option>
                                    <option value="Arusha">Arusha</option>
                                </select>
                            </div>
    
                            <div class="input-field">
                                <label>Municipal</label>
                                <select name="municipal" required>
                                    <option disabled selected>Select Municipal</option>
                                    <option  value="Arusha Urban">Arusha Urban</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Street</label>
                                <input type="text" placeholder="Enter your Street" name="street" required>
                            </div>
    
                            <div class="input-field">
                                <label>House Number</label>
                                <input type="number" placeholder="Enter your House number" name="house_no" required>
                            </div>
                            <div class="input-field">
                            <label for="firm-image">Trash Container Image:</label>
                             <input type="file" id="firm-image" name="fileToUpload" accept="image/*">
                            </div>
                      </div>
                      <button value="submit" name="send">Submit</button>
                    </form>
                  </section>
                </div>
    
               
        </section>
       <script src="../Docs/js/dashboard.js"></script>
        
        <script src="" async defer></script>
    </body>
</html>