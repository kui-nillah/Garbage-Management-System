<?php 
    require '../private/display.php';
    require '../Databases/Database.php';
    require '../private/libraries.php';
    require '../private/session.php';

    if (!$session -> is_loged_in()) {
        header('Location:register.php');
    }
    
    $UserID = $session -> getSessionData();
    
    

    if (isset($_POST['register'])) {
        if (isset($_POST['register'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $phone_no = $_POST['phone_no'];
            $username = $_POST['username'];
            $password = $_POST['password'];
      
            if (empty($email) || empty($phone_no) || empty($email)  || empty($password) || empty($fname) || empty($lname)) {
              if(empty($email)){
                  $message =  " PLease fill you Email ";
              }elseif(empty($phone_no)){
                  $message =  " PLease fill you Phone number ";
              }elseif(empty($email)){
                  $message =  " PLease fill your email ";
              }elseif(empty($password) ){
                  $message =  " PLease fill your Password ";
              }elseif(strlen($password) >= 6){
                  $message =  " Your Password must be at least 6 characters and above ";
              }elseif(empty($fname)){
                  $message =  " PLease fill your first name ";
              }elseif(empty($lname)){
                  $message =  " PLease fill your last name ";
              }
          } else{
                      if(Librarie::getcheckPhonenumaberIfExist($phone_no)){
                          $message =  " That Phone number is taken  ";
                      }else{
                          if(Librarie::getcheckEmailIfExist($email)){
                              $message =  " That email address is taken  ";
                          }else{
                            
                            if(Librarie::setUsersRegistration('003', $fname , $lname , sha1($password) , $email , $phone_no , $username)){
                              // $session -> login($email);
                             header('Location:manageDriver.php');
                              exit();
                                        // $message = " you have successfully registered";
                                }else{
                                    $message = " Not Successfully Try again ";
                                    
                                }
                      }
                    }
        }
}

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GMS - Register Driver</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!----======== CSS ======== -->
    <link rel="stylesheet" href="../Docs/css/dashboard.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

/* Style the sidenav links and the dropdown button */
 a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
 a:hover, .dropdown-btn:hover {
  color: #0E4BF1;
}


/* Add an active class to the active dropdown button */
.active {
  background-color: #0E4BF1;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: none;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
  color: #818181;
}


</style>
        
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
            <ul class="nav-links sub-menu">
                    <li><a href="admin.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                    <button class="dropdown-btn">Create Admin 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="addAdmin.php">Add Admin</a>
                        <a href="manageAdmin.php">Manage Admin</a>
                    </div>
                    <button class="dropdown-btn">Create Driver 
                    <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="addDriver.php">Add Driver</a>
                        <a href="manageDriver.php">Manage Driver</a>
                    </div>
                    <li><a href="manageUser.php">
                        <i class='bx bxs-bell-ring' style='color:#969696'></i>
                        <span class="link-name">Manage User</span>
                    </a></li>
                    <li><a href="newComplain.php">
                        <i class='bx bxs-bell-ring' style='color:#969696'></i>
                        <span class="link-name">Complain</span>
                    </a></li>
                    <li><a href="driverResponse.php">
                        <i class='bx bx-repost' style='color:#969696'  ></i>
                         <span class="link-name">Driver response</span>
                        </a></li>
                    <li><a href="search.php">
                        <i class='bx bx-search-alt-2' style='color:#969696' ></i>
                        <span class="link-name">Search</span>
                    </a></li>
                    <li><a href="report.php">
                        <i class='bx bxs-report' style='color:#969696' ></i>
                        <span class="link-name">Report</span>
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
                        <span class="text">Admin Dashboard</span>
                    </div>
                    <div class="dash-content" id="dashboard">
                  <section class="container">
                    <header>Register driver</header>
                    <form method="POST" action="<?php echo $s = $_SERVER['SCRIPT_NAME']; ?>" class="form">
                      <div class="input-box address">
                        <div class="fields">
                            <div class="input-field">
                                <label>First Name</label>
                                <input type="text" placeholder="Enter First name" name="fname" required>
                            </div>
    
                            <div class="input-field">
                                <label>Last Name</label>
                                <input type="text" placeholder="Enter Last name" name="lname" required>
                            </div>
                            <div class="input-field">
                                <label>Email</label>
                                <input type="email" placeholder="Enter Email" name="email" required>
                            </div>
    
                            <div class="input-field">
                                <label>Phone Number</label>
                                <input type="number" placeholder="Enter Phone number" name="phone_no" required>
                            </div>
                            <div class="input-field">
                                <label>Username</label>
                                <input type="text" placeholder="Create Username" name="username" required>
                            </div>
                            <div class="input-field">
                                <label>Create Password</label>
                                <input type="password" placeholder="Create Password" name="password" required>
                            </div>
                      </div>
                      <button value="submit" name="register">Submit</button>
                    </form>
                  </section>
                </div>
    
               
        </section>
       <script src="../Docs/js/dashboard.js"></script>
        
       <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
    </body>
</html>