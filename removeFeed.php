<!DOCTYPE html>
<?php
require('CameraFeed.php');
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' type='text/css' href='newfeedstyle.css' />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<title>Add New Feed</title>
</head>
<body>

<?php
$nameError = $addressError = "";
$name = $address = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$camerasList = getCamerasListFromFile();
	if (!empty($_POST['camera'])) {
		$checked = $_POST['camera'];
		foreach($camerasList as $key => $camera) {
			if (in_array($camera->getName(), $checked)) {
				echo $camera->getName()."REMOVED";
				unset($camerasList[$key]);
			}
		}
	}
	saveCameras($camerasList);
	header('Location: stream.php');
}
?>

<h2>Remove Camera Feed</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<?php
	$camerasList = getCamerasListFromFile();
	foreach($camerasList as $feed) {
		echo "<input type='checkbox' name='camera[]' value=".$feed->getName().">".$feed->getName()."<br>";
	}
	?>
	<input type="submit" name="submit" value="Submit">
</form>	
