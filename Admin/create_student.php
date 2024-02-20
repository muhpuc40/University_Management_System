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
    <title>CSE- Create Student </title>
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
              <h1 class="h3 mb-0 text-gray-800">Student Create</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                <li class="breadcrumb-item">Create</li>
                <li class="breadcrumb-item active" aria-current="page">Student</li>
              </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Basic -->
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Provide Student Information </h6>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" aria-describedby="emailHelp"
                                    placeholder="Enter email"  name="email" id="email" required  required onkeyup="checkEmail()">
                                    <span class="text-danger" id="email-danger-span"></span>
                                    <span class="text-success" id="email-success-span"></span>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" 
                                required onkeyup="displaypwd()">
                                <span class="text-danger" id="pwd-danger-span"></span>
                                <span class="text-primary" id="pwd-medium-span"></span>
                                <span class="text-success" id="pwd-success-span"></span>
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
    <script>
      //js
      var button = document.getElementById("button");
        button.disabled = true;
        function checkEmail(){           
          var email = document.getElementById("email").value;
          valids = ["gmail.com", "yahoo.com", "outlook.com"]
          if(email.indexOf('@') != -1 ){
            var domain = email.split('@')[1];
            for(let i=0; i<valids.length; i++){
              if(domain == valids[i]){
                document.getElementById("email-success-span").innerHTML = "valid email";
                document.getElementById("email-danger-span").innerHTML = "";
                button.disabled = false;
                break;
              
              }
              else{
                document.getElementById("email-success-span").innerHTML = "";
                document.getElementById("email-danger-span").innerHTML = "invalid email";
                button.disabled = true;
              }
            }              
          }
          else{
            document.getElementById("email-success-span").innerHTML = "";
              document.getElementById("email-danger-span").innerHTML = "";
              button.disabled = true;
          }
        }
        function displaypwd(){
          var pwd = document.getElementById("password").value;
        // alert(email.value);
        if(pwd.length<4){
          document.getElementById("pwd-danger-span").innerHTML = "Password not secure. Must 8 character long";
          document.getElementById("pwd-success-span").innerHTML = "";
          document.getElementById("pwd-medium-span").innerHTML = "";
          button.disabled = true;
        }
        else if(pwd.length<8){
          document.getElementById("pwd-medium-span").innerHTML = "Password medium secure. Give 8 character for better";
          document.getElementById("pwd-success-span").innerHTML = "";
          document.getElementById("pwd-danger-span").innerHTML = "";
          button.disabled = true;
        }
        else{
          document.getElementById("pwd-success-span").innerHTML = "Your password is secure";
          document.getElementById("pwd-danger-span").innerHTML = "";
          document.getElementById("pwd-medium-span").innerHTML = "";
          button.disabled = false;
        }
        }
      </script>
  </body>
</html>
<?php 
    if(isset($_POST['submitBtn'])){

        $email = $_POST["email"];
        $password = $_POST["password"];
        $str = "INSERT INTO student_login(email,password)
        VALUES 
        ('".$email."','".md5($password)."')";
        if(mysqli_query($conn, $str)){
            echo 'Success !!!';
            header('Location: student_list.php');
        }
  
        
    }
    ob_end_flush();
?>