<!DOCTYPE html>
<?php
require('CameraFeed.php');
?>
<html>
<head>
	<title>Add New Feed</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel='stylesheet' type='text/css' href='streamstyle.css' />
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="#" class="pull-left"><img src="/48x48.png"></a>
			<a class="navbar-brand" href="#">Video Surveillance System Dashboard</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/stream.php>Live Feeds</a></li>
			<li class="active"><a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php>Add Feed</a></li> 
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php>Remove Feed</a></li>
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/recordings.php>Recordings</a></li>
		</ul>
		</ul>
		<ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
</nav>
<?php
$nameStatus = $addressStatus = $usernameStatus = $passwordStatus = "";
$name = $address = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nameStatus = $addressStatus = $usernameStatus = $passwordStatus = "";
	$name = $address = $username = $password = "";
	if (empty($_POST["name"])) {
		$nameStatus = "Name is required";
	}else {
		$name = clean_input($_POST["name"]);
		if (!preg_match("/^[a-zA-Z0-9]+$/", $name)) {
			$name = "";
			$nameStatus = "Name must be only characters and numbers";
		}
	}

	if (empty($_POST["address"])) {
		$addressStatus = "Address is required";
	}else {
		$address = clean_input($_POST["address"]);
		if (!preg_match("/^[a-zA-Z0-9\.]+$/", $address)) {
			$address = "";
			$addressStatus = "Invalid address";
		}
	}
	
	if (empty($_POST["username"])) {
		$usernameStatus = "Username is required";
	}else {
		$username = clean_input($_POST["username"]);
	}
	
	if (empty($_POST["password"])) {
		$passwordStatus = "Password is required";
	}else {
		$password = clean_input($_POST["password"]);
	}
	
	if (empty($nameStatus) && empty($addressStatus) && empty($usernameStatus)&& empty($passwordStatus)) {
		updateCameraFeeds($name, $address, $username, $password);
		header('Location: stream.php');
	}
}

function updateCameraFeeds($name, $address, $username, $password) {
	$camerasList = getCamerasListFromFile();
	array_push($camerasList, new CameraFeed($name, $address, $username, $password));
	saveCameras($camerasList);
}

function clean_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<div class="container-fluid">
<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="form-group <?php 
		if (empty($name)) {
			if (!empty($nameStatus)) {
				echo "has-error has-feedback";
			}
		}else {
			echo "has-success has-feedback";
		}?>">
		<label for="name">Camera Name:</label>
		<input type="text" class="form-control" name="name" id="name" placeholder="Enter Camera name" value=<?php echo $name?>>
		<?php if (!empty($nameStatus)) {echo "<span class='glyphicon glyphicon-remove form-control-feedback'></span><span class='label label-danger'>$nameStatus</span>";}?>
		<?php if (!empty($name)) {echo "<span class='glyphicon glyphicon-ok form-control-feedback'></span>";}?>
	</div>
	<div class="form-group <?php 
		if (empty($address)) {
			if (!empty($addressStatus)) {
				echo "has-error has-feedback";
			}
		}else {
			echo "has-success has-feedback";
		}?>">
		<label for="address">Address:</label>
		<input type="text" class="form-control" name="address" id="address" placeholder="Enter address" value=<?php echo $address?>>
		<?php if (!empty($addressStatus)) {echo "<span class='glyphicon glyphicon-remove form-control-feedback'></span><span class='label label-danger'>$addressStatus</span>";}?>
		<?php if (!empty($address)) {echo "<span class='glyphicon glyphicon-ok form-control-feedback'></span>";}?>
	</div>
	<div class="form-group <?php 
		if (empty($username)) {
			if (!empty($usernameStatus)) {
				echo "has-error has-feedback";
			}
		}else {
			echo "has-success has-feedback";
		}?>">
		<label for="username">Username:</label>
		<input type="text" class="form-control" name="username" id="username" placeholder="Enter camera's username" value=<?php echo $username?>>
		<?php if (!empty($usernameStatus)) {echo "<span class='glyphicon glyphicon-remove form-control-feedback'></span><span class='label label-danger'>$usernameStatus</span>";}?>
		<?php if (!empty($username)) {echo "<span class='glyphicon glyphicon-ok form-control-feedback'></span>";}?>
	</div>
	<div class="form-group <?php 
		if (empty($password)) {
			if (!empty($passwordStatus)) {
				echo "has-error has-feedback";
			}
		}else {
			echo "has-success has-feedback";
		}?>">
		<label for="password">Password:</label>
		<input type="password" class="form-control" name="password" id="password" placeholder="Enter camera's password" value=<?php echo $password?>>
		<?php if (!empty($passwordStatus)) {echo "<span class='glyphicon glyphicon-remove form-control-feedback'></span><span class='label label-danger'>$passwordStatus</span>";}?>
		<?php if (!empty($password)) {echo "<span class='glyphicon glyphicon-ok form-control-feedback'></span>";}?>
	</div>
	<button type="submit" class="btn btn-success">Add</button>
</form>
</div>
<div class="navbar navbar-fixed-bottom">
	<footer class="container-fluid text-center">
		<p>Carleton University 2016 Mobile Video Recording Apparatus Project 18</p>
	</footer>
	</div>
</body>
</html>
