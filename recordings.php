<!DOCTYPE html>
<?php
require('CameraFeed.php');
?>
<html lang="en">
	<head>
		<link rel="icon" type="image/png" href="/16x16.png">
		<title>Recordings</title>
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
					<li><a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php>Add Feed</a></li> 
					<li><a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php>Remove Feed</a></li>
					<li class="active"><a href=<?php $_SERVER["HTTP_HOST"];?>/recordings.php>Recordings</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
		</nav>
		
		<div class="container-fluid">
		  <h2>Select Camera</h2>
			<?php
			$camerasList = getCamerasListFromFile();
			foreach($camerasList as $feed) {
				echo "<button type='button' class='btn btn-primary btn-lg btn-block' onclick=\"window.open('".$feed->getRecordingUrl()."')\">".$feed->getName()."</button>";
			}
			?>
		</div>
		
		<div class="navbar navbar-fixed-bottom">
			<footer class="container-fluid text-center">
				<p>Carleton University 2016 Mobile Video Recording Apparatus Project 18</p>
			</footer>
		</div>
	</body>
</html>