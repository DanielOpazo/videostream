<!DOCTYPE html>
<?php
require('CameraFeed.php');
?>
<html lang="en">
	<head>
		<link rel="icon" type="image/png" href="/16x16.png">
		<title>Live Stream</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel='stylesheet' type='text/css' href='streamstyle.css' />
		<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<!-- my javascript -->
		<script type='text/javascript' src='streamjs.js'></script>
	</head>
	<body>
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="#" class="pull-left"><img src="/48x48.png"></a>
			<a class="navbar-brand" href="#">Video Surveillance System Dashboard</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href=<?php $_SERVER["HTTP_HOST"];?>/stream.php>Live Feeds</a></li>
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php>Add Feed</a></li> 
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php>Remove Feed</a></li>
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/recordings.php>Recordings</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
	</nav>
	
	<div class="container-fluid">
		<?php
			$camerasList = getCamerasListFromFile();
			$count = 0;
			foreach($camerasList as $feed) {
				if (($count % 3) == 0) {
					if ($count != 0) {
						echo "</div>";
					}
					echo "<div class='row'>";
				}
				//echo "<div class='col-sm-6'><div class='bg-info text-center'><strong>".$feed->getName()."</strong></div><div class='well text-center'><div class='embed-responsive embed-responsive-4by3'><iframe class='embed-responsive-item' src=".$feed->getFeedUrl()."></iframe></div></div></div>";
				echo "<div class='col-sm-4'><div class='bg-info text-center'><strong>".$feed->getName()."</strong></div><div class='well text-center'><img class='img-responsive' src=".$feed->getImgFeedUrl()." alt=\"unable to load camera\"></div></div>";
				$count++;
			}
			if ((($count) % 3) != 0) {
				echo "</div>";
			}
		?>
		<div class="text-center">
			<a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php class="btn btn-info" role="button">Add New Feed</a>
			<a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php class="btn btn-danger" role="button">Remove Feed</a>
		</div>
	</div>	
	
	<div class="navbar navbar-fixed-bottom">
	<footer class="container-fluid text-center">
		<p>Carleton University 2016 Mobile Video Recording Apparatus Project 18</p>
	</footer>
	</div>
</body>
</html>
