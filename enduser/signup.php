<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
  {

    $nidno=$_POST['nidno'];
    $mobno=$_POST['mobno'];
    $name=$_POST['fname'];
    $mobno=$_POST['mobno'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $ret="SELECT MobileNumber from enduser where MobileNumber=:mobno";
    $ret2="SELECT UserID from tblregistration where HusbandMobno=:mobno OR WifeMobNo=:mobno";
    $query= $dbh -> prepare($ret);
    $query2= $dbh -> prepare($ret2);
    $query-> bindParam(':mobno', $mobno, PDO::PARAM_STR);
    $query2-> bindParam(':mobno', $mobno, PDO::PARAM_STR);
    $query-> execute();
    $query2-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    $results2 = $query2 -> fetch();
    
  
if($query -> rowCount() == 0)
{
// $sql="Insert Into enduser(Name,MobileNumber,password,email)Values(:name,:mobno,:password:email)";
  $userid=$results2['UserID'];
$sql="INSERT INTO `enduser`(`Name`, `MobileNumber`, `password`, `email`,`under_register_id`) VALUES ('$name','$mobno','$password','$email','$userid')";
$query = $dbh->prepare($sql);
// $query->bindParam(':name',$name,PDO::PARAM_STR);
// $query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
// $query->bindParam(':email',$email,PDO::PARAM_STR);
// $query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();

$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

echo "<script>alert('You have signup  Succesfully');</script>";
header('location:login.php');
}
else
{

echo "<script>alert('Something went wrong.Please try again');</script>";
}
}
 else
{

echo "<script>alert('This Mobile Number already exist. Please try again');</script>";
}
}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
   

    <title>Online Marriage Registration System||Sign Up page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
   
     <script src="script/jquery-3.5.1.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>
    <script src="lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>

    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">

    <!-- Amanda CSS -->
    <link rel="stylesheet" href="css/amanda.css">
  </head>

  <body>




<navbar class="container">
    <nav style="background-color: green !important;"  style="background-color: green !important;"  class="navbar sticky-top navbar-expand-lg navbar-light shadow mb-5 bg-body rounded mb-0" >
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
                <a style="color:white;" class="nav-link fs-5" href="../admin/login.php">Admin Login</a>
              </li>
               <li class="nav-item ms-2">
                <a style="color:white;" class="nav-link fs-5" href="login.php">Registrar  Login</a>
              </li>
              <li class="nav-item ms-2">
                <a style="color:white;" class="nav-link fs-5" href="login.php">User  Login</a>
              </li>
              <li class="nav-item ms-2">
                <a style="color:white;" class="nav-link fs-5" href="check.php">Check Marital Status</a>
              </li>
              
            </ul>
            
          </div>
        </div>
      </nav>
</navbar>


    <div class="am-signin-wrapper">
      <div class="am-signin-box">
        <div class="row no-gutters">
          <div class="col-lg-5">
            <div>
              <h2>amanda</h2>
              <p>The Responsive Bootstrap 4 Admin Template</p>
              <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate.</p>

              <hr>
              <p><br> <a href="../index.php">Back Home</a></p>
            </div>
          </div>
          <div class="col-lg-7">
            <h5 class="tx-gray-800 mg-b-25">Registrar Registration Form</h5>
          <form class="form-auth-small" action="" method="post">
            
            <div class="form-group">
              <label class="form-control-label">Nid Number:</label>
              <input type="text" class="form-control" placeholder="Nid Number" required="true" name="nidno"  maxlength="10" pattern="[0-9]+" value="<?php if(isset($_POST['nidno'])) echo $_POST['nidno']?>" >
            </div>
            <button type="submit" class="btn" name="validate">Validate</button>
            <div class="form-group" id="sender">
              <label class=" form-control-label">Mobile Number:</label>
              <div class="justify-content-center">
                <input type="text" id="number" class="form-control d-inline-block" placeholder="Mobile Number" required="true" name="mobno"  maxlength="11" pattern="[0-9]+" value="<?php if(isset($_POST['mobno'])) echo $_POST['mobno']?>"  >
                <div id="recaptcha-container" ></div> 
                <input type="button" id="send" value="Send" onclick="phoneAuth()">
              </div>
              <div id="verifier">
                <input type="text" id="verificationcode" placeholder="OTP Code">
                <input type="button" value="Verify" id="verify" onclick="codeverify()">
                <div class="p-conf" style="display: none;">Number Verified</div>
                <div class="n-conf" style="display: none;">OTP Error</div>

              </div>
            </div>






          <!--   <div class=" form-group">
              <label class=" form-control-label">Enter Code to verify:</label>
              <div class="d-flex justify-content-center">
                <input type="text" class="form-control" placeholder="Enter Code" required="false" name="mobno"  maxlength="10" pattern="[0-9]+" value="" >
              <button type="submit" class="btn btn-flex" name="verify">Verify</button>
              </div>
            </div> -->

             
            <div class="form-group">
              <label class="form-control-label">First Name:</label>
              <input type="text" class="form-control" placeholder="First Name" readonly="readonly" id="fname"  name="fname" required="true" value="" >
            </div><!-- form-group -->
          
            
<?php 
                  $nidno=$_POST['nidno'];
                  $mobno=$_POST['mobno'];

                  if (isset($_POST['validate'])) {
                    $ret1=" SELECT HusbandName from tblregistration where HusbandMobno='$mobno' && HusbandNidno='$nidno'";
                    $ret2=" SELECT WifeName from tblregistration where WifeMobno='$mobno' && WifeNidno='$nidno' ";
                    $query1= $dbh -> prepare($ret1);
                    $query2= $dbh -> prepare($ret2);
                    $query1-> execute();
                    $query2-> execute();
                    $result1=$query1->fetch();
                    // $result1 = $query1 -> fetchAll(PDO::FETCH_OBJ);
                    $result2 ==$query2->fetch();
                   
                     if($query1 -> rowCount() > 0)
                    {
                          $name=$result1['HusbandName'];  
                                 
                         echo '<script>document.getElementById("fname").value="'.$name.'";</script>';
                      // echo '<script>alert("Provide Information doesnt matching with database!!'.$name.'");</script>';
                    }
                    elseif($query2 -> rowCount() > 0)
                        {
                          $name=$result1['WifeName'];  
                         echo '<script>document.getElementById("fname").value = "'.$name.'";</script>';
                        }
                    
                     else
                        {
                                              echo '<script>alert("Provide Information doesnt matching with database!!");</script>';
                        }
               
                  }
 ?>
            
            <div class="form-group">
              <label class="form-control-label">Email Address:</label>
              <input type="text" class="form-control" placeholder="Address" required="true" name="email" value="" >
            </div>
            <div class="form-group">
              <label class="form-control-label">Password:</label>
              <input type="password" class="form-control" placeholder="Password" name="password" required="true" value="">
            </div><!-- form-group -->

           

            <button type="submit" class="btn btn-block" name="submit" disabled="true" id="Buttons">Sign Up</button>
             <div class="form-group mg-b-20" style="padding-top: 20px"><a href="login.php">Do you have an account ? || signin</a></div>
          </div>
         </form>
        </div><!-- row -->
              </div><!-- signin-box -->
    </div><!-- am-signin-wrapper -->

    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>
    <script src="lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>

    <script src="js/amanda.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>


    <!--Firebase-->
  <script >
  
  const firebaseConfig = {
  apiKey: "AIzaSyAyhKDTwYPlOoyHpxbK_U4c-IBMzg0usio",
  authDomain: "omrs-a9162.firebaseapp.com",
  databaseURL: "https://omrs-a9162-default-rtdb.firebaseio.com",
  projectId: "omrs-a9162",
  storageBucket: "omrs-a9162.appspot.com",
  messagingSenderId: "896611316111",
  appId: "1:896611316111:web:548f96384ed80900fb1bfa",
  measurementId: "G-N42Q09XFR7"
};
 // initializing firebase SDK
firebase.initializeApp(firebaseConfig);

 // render recaptcha verifier
render();
function render() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}

// function for send OTP
function phoneAuth() {
    var number = "+88"+document.getElementById('number').value;
    firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        console.log('OTP Sent');
    }).catch(function (error) {
        // error in sending OTP
        alert(error.message);
    });
}

// function for OTP verify
function codeverify() {
    var code = document.getElementById('verificationcode').value;
    coderesult.confirm(code).then(function () {
      alert("Verified");
      document.getElementById("Buttons").disabled = false;
    }).catch(function () {
      alert(error.message);
    })
}
  // Initialize Firebase
</script>



  </body>
</html>
