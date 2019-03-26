<?php 
	session_start();

	
	$con = mysqli_connect("localhost", "root", "123456", "doctor");
	//echo $email;
	if(mysqli_connect_errno()){
		echo "failed to connect MySQL: " .mysqli_connect_errno();
	}
	if (filter_has_var(INPUT_POST, 'submit')) {
		# code...
		$symptom = [$_POST['symptom1'], $_POST['symptom2'], $_POST['symptom3'], $_POST['symptom4'], $_POST['symptom5']];
		$measles = ['Pain in Muscles', 'Fever', 'Malaise', 'Fatigue', 'Loss of Appetite', 'Sneezing', 'Runny Nose', 'Skin Rash', 'Cough'];
		//echo count($symptom - $measles);
		if (count($symptom - $measles) === 0) {
			# code...
			echo "measles";
		}
	}
	//echo $count;
	if(filter_has_var(INPUT_POST, "log")){
		//echo 'hello';
		$_SESSION['email'] = '';
		$_SESSION['password'] = '';
	}
	$email = $_SESSION['email'];
	$password = $_SESSION['password'];
	$result = mysqli_query($con, "SELECT * FROM `loginform` WHERE `Password` = '$password' && `Email` = '$email'");
	$count = mysqli_num_rows($result);

?>
<?php if($count === 1):?>
<!DOCTYPE html>
<html>
<head>
	<title>Hello</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>
	<div class="container">
		<blockquote class="blockquote">
			<h1>Welcome</h1>
		</blockquote>
		<blockquote class="blockquote text-right">
			<p>You Are Logged in with <?php echo $email ?><br></p>
			<form method="post" action="#">
				<button name="log" class="btn btn-success">Log Out</button>
			</form>
		</blockquote>
	</div>
	<div class="container">
        <h4>Hello user</h4>
	</div>
</body>
</html>
<?php endif;
	if($count === 0	){
		header("Location:login.php");
	}
 ?>