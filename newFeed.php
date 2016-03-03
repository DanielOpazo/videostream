<!DOCTYPE html>
<?php
require('CameraFeed.php');
?>
<html>
<head>
	<title>Add New Feed</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' type='text/css' href='newfeedstyle.css' />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Video Surveillance System Dashboard</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="#">Home</a></li>
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/stream.php>Live Feeds</a></li>
			<li class="active"><a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php>Add Feed</a></li> 
			<li><a href="#">Remove Feed</a></li>
			<li><a href="#">About</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Careers
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Dropdown Menu Maker</a></li>
					<li><a href="#">List Item Creator</a></li>
					<li><a href="#">Caterer</a></li>
				</ul>
			</li>
		</ul>
	</div>
	</nav>
<?php
$nameError = $addressError = "";
$name = $address = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["name"])) {
		$nameError = "name is required";
	}else {
		$name = clean_input($_POST["name"]);
	}

	if (empty($_POST["address"])) {
		$addressError = "address is required";
	}else {
		$address = clean_input($_POST["address"]);
		if (!preg_match("/^[a-zA-Z0-9\.]+$/", $address)) {
			$addressError = "Only letters and numbers allowed";
		}
	}
	
	if (empty($nameError) && empty($addressError)) {
		updateCameraFeeds($name, $address);
		header('Location: stream.php');
	}
}

function updateCameraFeeds($name, $address) {
	$camerasList = getCamerasListFromFile();
	array_push($camerasList, new CameraFeed($name, "http://".$address.":8080/stream"));
	saveCameras($camerasList);
}

function clean_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<!--
<h2>Add New Camera Feed</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Name: <input type="text" name="name" value="<?php echo $name;?>">
	<span class="error">* <?php echo $nameError;?></span>
	<br><br>
	Address: <input type="text" name="address" value="<?php echo $address;?>">
	<span class="error">* <?php echo $addressError;?></span>
	<br><br>
	<input type="submit" name="submit" value="Submit">
</form>
-->
<div class="container">
<form role="form">
	<div class="form-group">
		<label for="name">Camera Name:</label>
		<input type="text" class="form-control" id="name" placeholder="Enter Camera name">
	</div>
	<div class="form-group">
		<label for="address">Address:</label>
		<input type="text" class="form-control" id="address" placeholder="Enter address">
	</div>
	<div class="form-group">
		<label for="username">Username:</label>
		<input type="text" class="form-control" id="username" placeholder="Enter camera's username">
	</div>
	<div class="form-group">
		<label for="password">Password:</label>
		<input type="password" class="form-control" id="password" placeholder="Enter camera's password">
	</div>
	<button type="submit" class="btn btn-success">Add</button>
</form>
</div>

</body>
</html>
