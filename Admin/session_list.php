<?php    
  include '../conn.php'; 
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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/puc.png" rel="icon">
    <title>CSE - Session List</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
              <h1 class="h3 mb-0 text-gray-800">All Session List</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Preview</li>
                <li class="breadcrumb-item active" aria-current="page">Session List</li>
              </ol>
            </div>
    <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <!--
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                </div>
                -->
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">

                <thead>
                    <th>ID</th>
                    <th>Session</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                        $s = "select * from sessions";
                        $q = mysqli_query($conn, $s);
                        while($r = mysqli_fetch_array($q)){ ?>
                            <tr>
                                <td><?php echo $r['id'] ?></td>
                                <td><?php echo $r['name'] ?></td>
                                 <td><?php echo $r['status'] ?></td>
                                <td>
                                <a href="edit_session.php?Edit_id=<?php echo $r['id'] ?>" class="btn btn-secondary">Edit</a>
                                </td>
                                <td>
                                <a href="<?php echo $r['id'] ?>&email=<?php echo $r['name'] ?>" class="btn btn-warning"
                                data-target="#exampleModalCenter<?php echo $r['id'] ?>" data-toggle="modal" type="button" id="#modalCenter">Delete</a>
                                <div class="modal fade" id="exampleModalCenter<?php echo $r['id'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure you want to delete <?php echo $r['name'] ?> ?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                          <a class="btn btn-danger" href="delete_session.php?dlt_id=<?php echo $r['id'] ?>&email=<?php echo $r['name'] ?>">Confirm Delete</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </td>
                            </tr>
                        <?php  }
                    ?>
                </tbody>
            </table>
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
    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
  </body>
</html>