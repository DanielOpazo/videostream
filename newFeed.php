<!DOCTYPE html>
<?php
require('CameraFeed.php');
?>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='newfeedstyle.css' />
	<title>Add New Feed</title>
</head>
<body>

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
