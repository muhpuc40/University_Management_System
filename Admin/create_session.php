<?php
    ob_start();
    session_start();
    //authentication
    if(!isset($_SESSION['user'])){
        header('Location: ../logout.php');
    }
    //Authorization
   if($_SESSION['user'] != 'admin'){
      header('Location: ../unauthorized.php');
    }
?>
<?php include '../conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/puc.png" rel="icon">
    <title>CSE- Create Session </title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link href="css/ruang-admin.css" rel="stylesheet">
  </head>
  <body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
            <?php    include 'sidebar.php'; ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
            <!-- Navbar -->
                <?php  include 'navbar.php'; ?>
            <!-- Navbar -->
            <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Session Create</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                            <li class="breadcrumb-item">Create</li>
                            <li class="breadcrumb-item active" aria-current="page">Session</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Provide Session Information </h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                        <label>Session Name</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Session Name"  name="name" id="name"  required >
                                        </div>
                                        <!-- <div class="form-group" >
                                            <label>Session Status</label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio3">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio4">Deactive</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" class="btn btn-primary"  name="submitBtn" id="button">Create</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!---Container Fluid-->
            </div>
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
  </body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){
        $S_name = $_POST["name"];
        $S_status = 0;
        $str = "INSERT INTO `sessions`(`name`, `status`)
        VALUES 
        ('".$S_name."','$S_status')";
        if(mysqli_query($conn, $str)){
            echo 'Success !!!';
            header('Location: session_list.php');
        }
  
        
    }
    ob_end_flush();
?>