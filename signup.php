<?php 
	$msg = '';
	$msgClass = '';
	if(filter_has_var(INPUT_POST, 'creat')){
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['pass']);
		$conPass = htmlspecialchars($_POST['pass-con']);
		if(!empty($email) && !empty($password) && !empty($conPass)){
			if(strlen($password) < 6){
				$msgClass = 'alert-danger';
				$msg = 'Password should contain atleast 6 characters';
			}elseif($password != $conPass){
				$msg = 'Please check the password';
				$msgClass = 'alert-danger';
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				$msg = 'Please give valid email';
				$msgClass = 'alert-danger';
			}else{
				$con = mysqli_connect("localhost", "root", "123456", "doctor");
				if(mysqli_connect_errno()){
					echo "Failed to connect MySQL: " . mysqli_connect_errno();
				}
				$result = mysqli_query($con, "SELECT * FROM `loginform` WHERE `Password` = '$password' && `Email` = '$email'");
				$count = mysqli_num_rows($result);
				if ($count === 0) {
					# code...
					mysqli_query($con, "INSERT INTO loginform (Email, Password) VALUES ('$email', '$password');");
					$msg = 'Account has been Created Successfully';
					$msgClass = 'alert-success';
					header('location:login.php');
				}else{
					$msg = 'Please try with other email';
					$msgClass = 'alert-danger';
					exit();
				}
			}
		}else{
			$msg = 'Please Fill in all Fields';
			$msgClass = 'alert-danger';
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1>Sign Up</h1>
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
			<div class="form-group">
				<label>Confirm Password</label>
				<input type="password" name="pass-con" placeholder="Password" class="form-control">
			</div>
			<button name="creat" class="btn btn-primary">Creat Account</button>
		</form> 
	</div>
</body>
</html>