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
    $c_id = $_REQUEST['Cid'];
    $s = "Select * from courses where id=".$c_id;
    $query = mysqli_query($conn, $s);
    $r = mysqli_fetch_assoc($query);
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
    <title>CSE - Edit Course</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link href="css/ruang-admin.css" rel="stylesheet">
  </head>
  <body id="page-top">
    <div id="wrapper">
      <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
      <!-- Sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <!-- Navbar -->
            <?php include 'navbar.php'; ?>
          <!-- Navbar -->
          <!-- Container Fluid-->
          <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Edit Course Information</h1>
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item">Preview</li>
              <li class="breadcrumb-item"><a href="student_list.php">Course list</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                                <label for="exampleInputEmail1">Course Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $r['name'] ?>" id="">
                                </div>
                                <div class="form-group">
                                <label for="">Course Code</label>
                                <input type="text" name="code" class="form-control" value="<?php echo $r['code'] ?>" id="">
                                </div>
                                <div class="form-group" >
                                    <label >Course Type</label>
                                    <select class="form-control mb-3" type="text" name="type" id="type" required >
                                        <option  value="" >Select</option>
                                        <option value="theory">Theory</option>
                                        <option value="lab">Lab</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="">Semester</label>
                                <input type="text" name="semester" class="form-control" value="<?php echo $r['semester'] ?>" id="">
                                </div>
                                <div class="form-group">
                                <label for="">Course Credit</label>
                                <input type="text" name="credit" class="form-control" value="<?php echo $r['credit'] ?>" id="">
                                </div>
                                <button type="submit" name="submitBtn" class="btn btn-success">Update</button>
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
        $c_name = $_POST["name"];
        $c_code = $_POST["code"];
        $c_type = $_POST["type"];
        $c_semester = $_POST["semester"];
        $c_credit = $_POST["credit"];

        $s = "UPDATE courses  SET name='".$c_name."',  code='".$c_code."',  type='".$c_type."', 
        semester='.$c_semester.',  credit='".$c_credit."' WHERE id = $r[id]";
        if(mysqli_query($conn, $s)){
        //echo 'sucesss';
        header('Location: course_list.php');
        }
    }
    ob_end_flush();
?>
