<?php include 'conn.php'; 
session_start();
if(isset($_SESSION['user'])){
   if($_SESSION['user']=='admin'){
	   header('Location: Admin/dashboard.php');
   }
   else if($_SESSION['user']=='student'){
	   header('Location: Student/dashboard.php');
   }
	else if ($_SESSION['user']=='teacher'){
	header('Location: Teacher/dashboard.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="description" content="This is a login page template based on Bootstrap 5">
		<title>PUC || Login Page</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<style>
			body {
			background-color: #8fc0db;
			}
			form{
				background-color: whitesmoke;
			}
		</style>
	</head>
	<body>
		<section class="h-100">		
			<div class="container h-100">		  
				<div class="row justify-content-sm-center h-100">
					<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
						<form action="" method="post" class="my">
							<div class="text-center my-5">
								<img src="logo.png" alt="logo" width="100">
								<div class="text">
									<b><h3>PREMIER UNIVERSITY</h3></b>
								</div>
							</div>
							<div class="card shadow-lg">
								<div class="card-body p-4">
									<h1 class="fs-4 card-title fw-bold mb-2">Login</h1>
									<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
										<div class="mb-3">
											<label class="mb-2 text-muted" for="email">E-Mail Address</label>
											<input type="text" name="email" class="form-control" id="" required autofocus>
											<div class="invalid-feedback">
												Email is invalid
											</div>
										</div>
										<div class="mb-3">
											<div class="mb-2 w-100">
												<label class="text-muted" for="password">Password</label>
											</div>
											<input type="password" name="password" class="form-control" id="" required>
											<div class="invalid-feedback">
												Password is required
											</div>
										</div>
										<div class="d-flex align-items-center">
											<div class="form-check">
												<input type="checkbox" name="remember" id="remember" class="form-check-input">
												<label for="remember" class="form-check-label">Remember Me</label>
											</div>
											<button type="submit" name="loginBtn" class="btn btn-primary ms-auto" >
												Login
											</button>
										</div>
									</form>
								</div>
								<div class="card-footer py-3 border-0">
									<div class="text-center">
										Don't have an account? <a href="admin/create_account.php" class="text-dark">Create</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<script src="js/login.js"></script>
	</body>
</html>

<?php 
    if(isset($_POST['loginBtn']))
	{
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $query = "select * from admin_login where email='".$email."' 
        and password='".$password."'";
        $result = mysqli_query($conn, $query);
		$admin = mysqli_fetch_array($result);

		$query = "select * from teacher_login where email='".$email."' 
        and password='".$password."'";
        $result = mysqli_query($conn, $query);
		$teacher = mysqli_fetch_array($result);

		$query = "select * from student_login where email='".$email."' 
        and password='".$password."'";
        $result = mysqli_query($conn, $query);
		$student = mysqli_fetch_array($result);

        if($admin){
                // save user data into session
					$_SESSION['user'] = 'admin';
					$_SESSION['user_email'] = $admin['email'];
					$_SESSION['user_id']=$admin['id'];
                    header('Location: Admin/dashboard.php'); 
					exit();
                }
		else if($teacher){
					// save user data into session
					$_SESSION['user'] = 'teacher';
					$_SESSION['user_email'] = $teacher['email'];
					$_SESSION['user_id']=$teacher['id'];
					header('Location: Teacher/dashboard.php'); 
					exit();
				}
		else if($student){
					// save user data into session
					$_SESSION['user'] = 'student';
					$_SESSION['user_email'] = $student['email'];
					$_SESSION['user_id']=$student['id'];
					header('Location: Student/dashboard.php'); 
					exit();
				}
		else {?>
			<div class="from - group" > Wrong  !!! </div><?php
				}
	}  
?>

	