<?php 
    require 'private/display.php';
    require 'Databases/Database.php';
    require 'private/libraries.php';
    require 'private/session.php';

 
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
                      $message  = "";
                      if(Librarie::setUsersRegistration('002', $fname , $lname , sha1($password) , $email , $phone_no , $username)){
                        // $session -> login($email);
                       header('Location:register.php');
                        exit();
                                  // $message = " you have successfully registered";
                          }else{
                              $message = " Not Successfully Try again ";
                              
                          }
                }
              }
  }
}else{
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    if (empty($username) || empty($password)){
      if(empty($username)){
        $message2 =  " PLease fill your Username ";
      }elseif(empty($password)){
        $message2 =  " PLease fill your Password ";
      }
    }else{
      $message2 = "";
      $username_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$username);
      $password_ = sha1($password);
      $sql = "SELECT user_id , user_type  FROM user_info WHERE username = '$username_' AND password = '$password_' AND  status ='active' ";
      $query = Database::query($sql);
      if ($row = Database::mysqli_fetch_array($query)) { 
        $session -> login($row['user_id']);
        if($row['user_type'] === "002"){
          header('Location:user/user.php');
        }elseif($row['user_type'] === "001"){
          header('Location:admin/admin.php');
        }
        elseif($row['user_type'] === "003"){
          header('Location:driver/driver.php');
        }
      else{
          $message2 = " Invalid username and password !! ";
      }  
    }
    }
  }else{
    $username = "";
    $password = "";
     $message2 = "";
  }
    $message = "";
    $username = "";
    $password = "";
}



 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>GMS - Login & Register</title>
    <link rel="stylesheet" href="Docs/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form method="POST" action="<?php echo $s = $_SERVER['SCRIPT_NAME']; ?>"  class="login">
          <b><?php echo $message2; ?></b>
            <div class="field">
              <input type="text" placeholder="Username" required name="username">
            </div>
            <div class="field">
              <input type="password" placeholder="Password" required name="password">
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            
            <div class="field btn">
             
              <div class="btn-layer"></div>
              <input type="submit" value="Login" name="login">
            </div>
            <div class="signup-link">Not a member? <a href="">Signup now</a></div>
            <div class="signup-link"><a href="index.php">Back home</a></div>
          </form>
          <form method="POST" action="<?php echo $s = $_SERVER['SCRIPT_NAME']; ?>" class="signup">
            <p><?php echo $message; ?></p>
            <div class="field">
              <input type="text" placeholder="Enter your First name" maxlength="255" required name="fname">
            </div>
            <div class="field">
              <input type="text" placeholder="Enter your Last name" maxlength="255" required name="lname">
            </div>
            <div class="field">
              <input type="email" placeholder="Enter your Email address" maxlength="255" required name="email">
            </div>
            <div class="field">
              <input type="text" placeholder="Enter your Phone number" maxlength="255" required name="phone_no">
            </div>
            <div class="field">
              <input type="text" placeholder="Create Username" maxlength="255" required name="username">
            </div>
            <div class="field">
              <input type="password" placeholder="Create Password" maxlength="255" required name="password">
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Signup" name="register">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>

  </body>
</html>
