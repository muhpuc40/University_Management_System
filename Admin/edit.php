<?php
    ob_start();
    session_start();
    include '../conn.php';
    //authentication
    if(!isset($_SESSION['user'])){
        header('Location: ../logout.php');
    }
    //Authorization
   if($_SESSION['user'] != 'admin'){
      header('Location: ../unauthorized.php');
    }
    $Admin_id = $_SESSION['user_id'];
    $s = "SELECT * FROM admin_login WHERE id= $Admin_id";
    $q = mysqli_query($conn, $s);
    $r = mysqli_fetch_array($q);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/puc.png" rel="icon">
    <title>Edit Me</title>
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
              <h1 class="h3 mb-0 text-gray-800">Edit My Information</h1>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item">Edit Me</li>
                </ol>
            </div>
            <!-- Form  -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Basic -->
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Update Form</h6>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                <label for="">Email address</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $r['email'] ?>" id="">
                                </div>
                                <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control" value="<?php echo $r['password'] ?>" id="">
                                </div>
                                <button type="submit" class="btn btn-success" name="submitBtn">Update</button>
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
      $admin_email = $_POST["email"];
      $admin_password = $_POST["password"];
      $str = "UPDATE admin_login SET email='".$admin_email."',password='".$admin_password."'WHERE id='$Admin_id'";
      if(mysqli_query($conn, $str)){
          header('Location: dashboard.php');
        }
    }
    ob_end_flush();
?>