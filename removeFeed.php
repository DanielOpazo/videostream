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
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type='text/javascript'>
		$(document).ready(function(){
			$("button").click(function() {
				$.ajax({
					type: "POST",
					data: {camera: $(this).attr('id')},
					success: function(data, status) {
						document.location.href = "stream.php";
					}
				});
			})	
		});
	</script>
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
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php>Add Feed</a></li> 
			<li class="active"><a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php>Remove Feed</a></li>
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
	$camerasList = getCamerasListFromFile();
	if (!empty($_POST['camera'])) {
		$checked = $_POST['camera'];
		foreach($camerasList as $key => $camera) {
			if ($camera->getName()== $checked) {
				unset($camerasList[$key]);
			}
		}
	}
	saveCameras($camerasList);
}
?>

<div class="container-fluid">
  <h2>Remove Camera Feeds</h2>
	<?php
	$camerasList = getCamerasListFromFile();
	foreach($camerasList as $feed) {
		echo "<button type='button' id=".$feed->getName()." class='btn btn-danger btn-lg btn-block'>".$feed->getName()."</button>";
	}
	?>
</div>

</body>
</html>