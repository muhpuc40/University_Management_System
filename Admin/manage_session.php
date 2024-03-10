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
    include '../conn.php';
    $query = "Select * from sessions";
    $sessions = mysqli_query($conn,$query);
    $sessions2 = mysqli_query($conn,$query);
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
    <title>CSE- Create Course </title>
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
                    <h1 class="h3 mb-0 text-gray-800">Manage Session</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item">Manage</li>
                        <li class="breadcrumb-item active" aria-current="page">Session</li>
                    </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Form Basic -->
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Active Sessions </h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="manage_session.php">
                                        <div class="form-group" >
                                        <label> Choose Session </label>
                                        <select class="form-control mb-3" type="text" name="active_session" id="type" required >
                                            <option  value="" >Select</option>
                                            <?php
                                                while($sa = mysqli_fetch_array($sessions)){
                                                   if($sa['status']==1){
                                                       echo "<option value=".$sa['id'].">". $sa['name']. "</option>";
                                                  }
                                                }
                                            ?>
                                        </select>
                                        </div>
                                        <div class="text-center">
                                        <button type="submit" class="btn btn-danger mb-1"  name="deactiveBtn" id="button">Deactive</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Deactive Sessions</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="manage_session.php">                             
                                        <div class="form-group" >
                                        <label > Choose Session </label>
                                        <select class="form-control mb-3" type="text" name="deactive_session" id="type" required >
                                            <option  value="" >Select</option>
                                            <?php
                                                while($sa = mysqli_fetch_array($sessions2)){
                                                   if($sa['status']==0){
                                                       echo "<option value=".$sa['id'].">". $sa['name']. "</option>";
                                                  }
                                                    
                                                }
                                               
                                            ?>
                                        </select>
                                        </div>
                                        <div class="text-center">
                                        <button  type="submit" class="btn btn-success mb-1"  name="activeBtn" id="button"> Active </button>
                                        </div>
                                    </form>
                                </div>
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
    if(isset($_POST['activeBtn'])){
        $AS = $_POST['deactive_session'];
        $Query = "UPDATE sessions SET status = 1 WHERE id = $AS";
        $a = mysqli_query($conn,$Query);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
  
        
    }
    if(isset($_POST['deactiveBtn'])){
        $AS = $_POST['active_session'];
        $Query2 = "UPDATE sessions SET status = 0 WHERE id = $AS";
        $b = mysqli_query($conn,$Query2);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
  
    }
    ob_end_flush();
?>