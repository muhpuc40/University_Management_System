<?php
    ob_start();
    session_start();
    //authentication
    if(!isset($_SESSION['user'])){
        header('Location: ../logout.php');
    }
    //Authorization
   if($_SESSION['user'] != 'student'){
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
    <title>CSE- Student Enroll</title>
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
                    <div class="d-sm-flex align-items-center justify-content-between ">
                    <h1 class="h3 mb-0 text-gray-800">Enroll Course</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Student</a></li>
                        <li class="breadcrumb-item">Enroll</li>
                        <li class="breadcrumb-item active" aria-current="page">Course</li>
                    </ol>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <!-- Form Basic -->
                            <div class="card mb-2">
                                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Active Session </h6>
                                </div>
                                <div class="card-body">                            
                                        <?php
                                            $str = "SELECT * FROM sessions where status=1";
                                            $q = mysqli_query($conn, $str);
                                        ?>
                                        <select class="form-control mb-3" type="text" name="session" id="session" onchange="sessionChange()"required>
                                            <option value="">Select</option>
                                            <?php while ($row = $q->fetch_assoc()) {
                                            ?>
                                            <option><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-12">
              <div class="card mb-4">
                <form action="" method="post"></form>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush" id="table">
                    <thead>
                        <th>No.</th>
                        <th>Select</th>
                        <th>Semester</th>
                        <th>Name</th>
                        <th>Exam Type</th>
                        <th>Status/Msg</th>
                    </thead>
                    <tbody>
                        <?php 
                            $qry="SELECT * FROM courses";
                            $r=mysqli_query($conn,$qry);
                            while($row=mysqli_fetch_array($r)){ ?>
                                <tr>
                                    <td> <?php echo $row['id']?> </td>
                                    <td>                    
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck<?php echo $row['id']; ?>">
                                            <label class="custom-control-label" for="customCheck<?php echo $row['id']; ?>"></label>
                                        </div>
                                    </td>
                                    <td> <?php echo $row['semester']?> </td>                     
                                    <td> <?php echo $row['name']?> </td>
                                    <td> 
                                        <select class="form-control mb-3">
                                            <option>Select</option>
                                            <option>Regular</option>
                                            <option>Retake</option>
                                            <option>Rcourse</option>
                                        </select> 
                                    </td>

                                    <td> </td>
                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
                

                </div>
                </form>
                <button type="submit" name="submitBtn" id="button" class="btn btn-success">Submit</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
            //var table = document.getElementById('table');
            $('#table').hide();
            $('#button').hide();
            function sessionChange(){
                var session = document.getElementById('session').value;
                if(session==""){
                    $('#table').hide();
                    $('#button').hide();
                }
                else{
                    $('#table').show();
                    $('#button').show();
                }
            }
        </script>
  </body>
</html>
<?php 

    ob_end_flush();
?>