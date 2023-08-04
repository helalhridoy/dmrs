<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['omrsaid']=$result->ID;
}

  if(!empty($_POST["remember"])) {
//COOKIES for username
setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
} else {
if(isset($_COOKIE["user_login"])) {
setcookie ("user_login","");
if(isset($_COOKIE["userpassword"])) {
setcookie ("userpassword","");
        }
      }
}
$_SESSION['login']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
   

    <title>Digital Marriage Registration System|| Admin Sign In Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
   
     <script src="script/jquery-3.5.1.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">

    <!-- Amanda CSS -->
    <link rel="stylesheet" href="css/amanda.css">
  </head>

  <body>


 <navbar class="container-fluid">
    <nav  style="background-color: green !important;"  class="navbar sticky-top navbar-expand-lg navbar-light shadow mb-5 bg-body rounded mb-0" >
        <div class="container">
          <a style="color:white;" class="navbar-brand" href="#">DMRS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav  mb-2 ms-auto">
              <li class="nav-item ms-2">
                <a style="color:white;" class="nav-link fs-5"  href="../index.php">Home</a>
              </li>
              <li class="nav-item ms-2">
                <a style="color:white;" class="nav-link fs-5" href="login.php">Admin Login</a>
              </li>
               <li class="nav-item ms-2">
                <a style="color:white;" class="nav-link fs-5" href="../user/login.php">Registrar  Login</a>
              </li>
                <li class="nav-item ms-2">
                <a style="color:white;" class="nav-link fs-5" href="../enduser/login.php">User  Login</a>
              </li>
              <li class="nav-item ms-2">
                <a style="color:white;" class="nav-link fs-5" href="../check.php">Check Marital Status</a>
              </li>
              
            </ul>
            
          </div>
        </div>
      </nav>
</navbar>
 

    <div class="am-signin-wrapper">

              <img  style=" width: 220px;" class="img-fluid" src="images/dowry 2.png">
           
       

          <div class="am-signin-box">
        <div class="row no-gutters">
          
          <div >
            
            <form class="form-auth-small" action="" method="post">
            <div class="form-group">
              <h5 class="tx-gray-800 mg-b-25 d-inline">Signin to Your Account</h5>
              <span class="d-block"></span>
              <label class="form-control-label d-inline">User Name:</label>
              <input type="text" class="form-control" placeholder="User Name" required="true" name="username" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" >
            </div><!-- form-group -->

            <div class="form-group">
              <label class="form-control-label">Password:</label>
              <input type="password" class="form-control" placeholder="Password" name="password" required="true" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
            </div><!-- form-group -->
          <div class="form-group">
              <label class="fancy-checkbox element-left">
                                           <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
                                            <span style="color:green !important">Remember me</span>
                                        </label>  
            </div>
           

            <button type="submit" class="btn btn-block" name="login">Sign In</button>
             <div class="form-group mg-b-20" style="padding-top: 20px"><a style="color:green" href="forgot-password.php">Reset password</a></div>
          </div>
         </form>
        </div><!-- row -->
        
      </div><!-- signin-box -->

              <img  style=" width: 220px;" class="img-fluid" src="images/sontan.png">
           
       
    </div><!-- am-signin-wrapper -->

    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>
    <script src="lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>

    <script src="js/amanda.js"></script>
  </body>
</html>
