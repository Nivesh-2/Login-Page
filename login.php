<?php 
	$msg = '';
	$msgClass = '';
	if(filter_has_var(INPUT_POST, "login")){
		session_start();
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['pass']);
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;

		if(!empty($email) && !empty($password)){
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				# code...
				$msg = 'Please give valid email';
				$msgClass = 'alert-danger';
			}else{
				$con = mysqli_connect("localhost", "root", "123456", "doctor");
				if(mysqli_connect_errno()){
					echo "failed to connect MySQL: " .mysqli_connect_errno();
				}
				$result = mysqli_query($con, "SELECT * FROM `loginform` WHERE `Password` = '$password' && `Email` = '$email'");
				$count = mysqli_num_rows($result);
				//echo $count;
				if($count === 1){
					$msg = 'Log In Successful';
					$msgClass = 'alert-success';
					header('location:welcome2.php');
				}else{
					$msg = 'Log In failed';
					$msgClass = 'alert-dismissible alert-danger';
					//header("location:login.php");
				}
			}
		}else{
			$msg = 'Please Fill in all Fields';
			$msgClass = 'alert-danger';
		}
	}
	if(filter_has_var(INPUT_POST, 'signup')){
		header('location:signup.php');
	}
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1>Login Page</h1>
	</div>
	<div class="container">
		<?php if ($msg != ''): ?>
			<div class="alert <?php echo($msgClass); ?>"><?php echo $msg; ?></div>
		<?php endif; ?>
		<form method="post" action="#">
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control" placeholder="Email">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="pass" placeholder="Password" class="form-control">
			</div>
			<button name="login" class="btn btn-primary">Log In</button>
			<button name="signup" class="btn btn-secondary">Sign Up</button>
		</form> 
	</div>
</body>
</html>