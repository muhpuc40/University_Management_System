<?php
    ob_start();
    session_start();
    include '../conn.php';
    //authentication
    if(!isset($_SESSION['user'])){
        header('Location: ../logout.php');
    }
    //Authorization
   if($_SESSION['user'] != 'student'){
      header('Location: ../unauthorized.php');
    }
    $student_id = $_SESSION['user_id'];
    $s = "SELECT * FROM student_login WHERE id= $student_id";
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
                <div class="col-lg-6">
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

                <div class="col-lg-6">
                                                                               
                                                                
                              <?php
                                                
                                  $x = "SELECT name FROM student_image WHERE user_id= $student_id ORDER BY id DESC LIMIT 1";
                                  $y = mysqli_query($conn, $x);
                                  $img = mysqli_fetch_array($y);
                                  //echo $img['name'];
                              ?>
                              <img class="img-profile rounded-square" src="img/<?php echo $img['name'];?>" style="max-width: 160px">
                              <form method="post" enctype="multipart/form-data">
                              <div class="form-group">
                              <label for="usr">Image:</label>
                              <input type="file" class="form-control" id="imgInp" name="image">
                              <img id="blah" src="#" height="150px" weight="150px" />   
                              </div>
                              <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                              </form>   
                      
                
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
            function readURL(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#blah').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imgInp").change(function() {
                readURL(this);
            });
        </script>
  </body>
</html>
<?php
                if(isset($_POST['submit'])){
                    $image = $_FILES['image']['name'];
                    $splitted_name = explode(".",$image);
                    $name = $splitted_name[0];
                    $ext = $splitted_name[sizeof($splitted_name)-1];
                    //echo $name,".",$ext,"<br>";
                    $new_name = md5(date('Y-m-d H:i:s')) ;
                    //echo $new_name,"<br>";
                    $final_name =$new_name.".".$ext;
                    echo $final_name;
                    $query = "INSERT INTO student_image(user_id,name) VALUES ('$student_id' ,'$final_name')";
                    if(mysqli_query($conn, $query)){
                        echo '<br><span style="color:blue;"> Successfully inserted </span>';
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], "img/$final_name")){
                            echo '<br><span style="color:green;"> Successfully transfered </span>';
                        }
                    }
                }
            ?>
<?php 
    if(isset($_POST['submitBtn'])){
      $student_email = $_POST["email"];
      $student_password = $_POST["password"];
      $str = "UPDATE student_login SET email='".$student_email."',password='".$student_password."'WHERE id='$student_id'";
      if(mysqli_query($conn, $str)){
          header('Location: dashboard.php');
        }
    }
    ob_end_flush();
?>