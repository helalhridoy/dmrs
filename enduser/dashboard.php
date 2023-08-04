<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['omrsuid']==0)) {
  header('location:logout.php');
  } else{


  ?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Online Marriage Registration System: Dashboard</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
   
     <script src="script/jquery-3.5.1.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="lib/jquery-toggles/toggles-full.css" rel="stylesheet">
    <!-- Amanda CSS -->
    <link rel="stylesheet" href="css/amanda.css">
  </head>

  <body>

    <?php include_once('includes/header.php');?>

   <?php include_once('includes/sidebar.php');?>

    <div class="am-mainpanel">
      

      <div class="am-pagebody">
        <div class="row row-sm">
          <div class="col-lg-12">
            <div class="card">
              <div id="rs" class="wd-100p ht-50"></div>
              <div class="overlay-body pd-x-20 pd-t-20">
                <div class="d-flex justify-content-between">
                  <div>
                     <?php
$uid=$_SESSION['omrsuid'];
$sql="SELECT Name from  enduser where id=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                    <h4>Welcome to Your Space respected user  || <?php  echo $row->Name;?> </h4><?php $cnt=$cnt+1;}} ?>
                    
                  </div>
                                  </div><!-- d-flex -->
               
              </div>
            </div><!-- card -->
          </div><!-- col-4 -->
         
          
        </div><!-- row -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Marriage Application</h6>
        

          <div class="table-wrapper" style="padding-top: 20px">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">S.No</th>
                
                  <th class="wd-15p">Name</th>
                  <th class="wd-20p">Mobile</th>
                  <th class="wd-10p">Full Address</th>
                  <th class="wd-10p">Status</th>

                </tr>
              </thead>
              <tbody> 
                <?php
                 $uid=$_SESSION['omrsuid'];



$sql="SELECT certificaterequest.name, certificaterequest.mobile, certificaterequest.fullAddress, certificaterequest.status from certificaterequest where id=$uid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                <tr>
                  <td><?php echo htmlentities($cnt);?></td>
                  <td><?php  echo htmlentities($row->name);?></td>
                  <td><?php  echo htmlentities($row->mobile);?></td>
                  <td><?php  echo htmlentities($row->fullAddress);?></td>
                <?php if($row->status=="pending"){ ?>

                     <td><?php echo "Not Delivered"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->status);?>
                  </td>
                  <?php } ?>
                  

                </tr>
              <?php $cnt=$cnt+1;}} ?> 
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->


      </div><!-- am-pagebody -->
     <?php include_once('includes/footer.php');?>
    </div><!-- am-mainpanel -->

    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>
    <script src="lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="lib/jquery-toggles/toggles.min.js"></script>
    <script src="lib/d3/d3.js"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAEt_DBLTknLexNbTVwbXyq2HSf2UbRBU8"></script>
    <script src="lib/gmaps/gmaps.js"></script>
    <script src="lib/Flot/jquery.flot.js"></script>
    <script src="lib/Flot/jquery.flot.pie.js"></script>
    <script src="lib/Flot/jquery.flot.resize.js"></script>
    <script src="lib/flot-spline/jquery.flot.spline.js"></script>

    <script src="js/amanda.js"></script>
    <script src="js/ResizeSensor.js"></script>
    <script src="js/dashboard.js"></script>
  </body>
</html>
<?php }  ?>