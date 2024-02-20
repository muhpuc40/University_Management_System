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
                    <h1 class="h3 mb-0 text-gray-800">Course Create</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item">Create</li>
                        <li class="breadcrumb-item active" aria-current="page">Course</li>
                    </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Provide Course Information </h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" onsubmit="validateForm()">
                                        <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Course Name"  name="name" id="name"  required >
                                        </div>
                                        <div class="form-group">
                                        <label>Course Code</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Course Code"  name="code" id="code"  required >
                                        </div>                                
                                        <div class="form-group">
                                        <label>Course Credit</label>
                                        <input type="number" class="form-control"
                                            placeholder="Enter Course Credit"  name="credit" id="credit"  required >
                                        </div>
                                        <div class="form-group" >
                                        <label >Course Type</label>
                                        <select class="form-control mb-3" type="text" name="type" id="type" required >
                                            <option  value="" >Select</option>
                                            <option value="theory">Theory</option>
                                            <option value="lab">Lab</option>
                                        </select>
                                        </div>
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

        $C_name = $_POST["name"];
        $C_code = $_POST["code"];
        $C_credit = $_POST["credit"];
        $C_type = $_POST["type"];
        $str = "INSERT INTO `courses`(`name`, `code`, `credit`, `type`)
        VALUES 
        ('".$C_name."','".$C_code."','$C_credit','".$C_type."')";
        if(mysqli_query($conn, $str)){
            echo 'Success !!!';
            header('Location: course_list.php');
        }
  
        
    }
    ob_end_flush();
?>