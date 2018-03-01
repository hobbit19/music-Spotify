<?php
	include("includes/config.php");
	include("includes/classes/Account.php"); 
	include("includes/classes/Constants.php");
	$account = new Account($con);
	include("includes/handlers/register-handler.php"); 
	include("includes/handlers/login-handler.php");
	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		}
	}
?>
<!DOCTYPE html>

<html>
<head>
	<title>Welcome to Slotify</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/register.js"></script>
</head>
<body>
	<?php

	if(isset($_POST['registerButton'])) {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
	}
	else {
		echo '<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>';
	}

	?>

	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFalied); ?>
						<label for="loginUsername">Username</label>
				<input id="loginUsername" type="text" name="loginUsername" placeholder="e.g kirk" value="<?php getInputValue('loginUsername'); ?>" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
							<input id="loginPassword" type="password" name="loginPassword" placeholder="e.g kk123"  required>
					</p>
					<button type="submit" name="loginButton">LOG IN</button>
					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Signup here.</span>
					</div>
				</form>

				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$UserNameLength); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<label for="username">Username</label>
				<input id="username" type="text" name="username" placeholder="e.g kirk" value="<?php getInputValue('username'); ?>" required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$FirstNameLength); ?>
						<label for="firstname">First Name</label>
				<input id="firstname" type="text" name="firstname" placeholder="e.g kirk" value="<?php getInputValue('firstname'); ?>"  required>
					</p>
					<p>
						<?php echo $account->getError(Constants::$LastNameLength); ?>
						<label for="lastname">Last Name</label>
						<input id="lastname" type="text" name="lastname" placeholder="e.g zhang" value="<?php getInputValue('lastname'); ?>"  required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$EmailsNotMatch); ?>
						<?php echo $account->getError(Constants::$EmailInvalid); ?>
						<?php echo $account->getError(Constants::$EmailTaken); ?>
						<label for="email">Email</label>
						<input id="email" type="email" name="email" placeholder="e.g kk@gmail.com" value="<?php getInputValue('email'); ?>" required>
					</p>

					<p>
						<label for="email2">Comfire Email</label>
						<input id="email2" type="email" name="email2" placeholder="e.g kk@gmail.com" value="<?php getInputValue('email2'); ?>"required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordLength); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
						<label for="password">Password</label>
						<input id="password" type="password" name="password"  placeholder="e.g 123asd"  required>
					</p>
					<p>
						<label for="npassword">Password</label>
							<input id="npassword" type="password" name="npassword"  placeholder="e.g 123asd"  required>
					</p>
					<button type="submit" name="registerButton">SIGN UP</button>
					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Login here.</span>
					</div>
				</form>
			</div>
			<div id="loginText">
				<h1>Get great muisc, right now</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Create your own playlists</li>
					<li>Follow artists to keep up to date</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>