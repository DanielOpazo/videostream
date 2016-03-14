<!DOCTYPE html>
<?php
require('CameraFeed.php');
?>
<html lang="en">
	<head>
		<title>Live Stream</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel='stylesheet' type='text/css' href='streamstyle.css' />
		<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<!-- my javascript -->
		<script type='text/javascript' src='streamjs.js'></script>
	</head>
	<body>
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Video Surveillance System Dashboard</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="#">Home</a></li>
			<li class="active"><a href=<?php $_SERVER["HTTP_HOST"];?>/stream.php>Live Feeds</a></li>
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php>Add Feed</a></li> 
			<li><a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php>Remove Feed</a></li>
			<li><a href="#">Recordings</a></li>
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
					$temp = $count % 3;
				}
				echo "<div class='col-sm-4'><div class='bg-info'>".$feed->getName()."</div><div class='well'><div class='embed-responsive embed-responsive-4by3'><iframe src=".$feed->getFeedUrl()."></iframe><div class=\"overlay\"></div></div></div></div>";
				$count++;
			}
			if ((($count) % 3) != 0) {
				echo "</div>";
			}
		?>
		<a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php class="btn btn-info" role="button">Add New Feed</a>
		<a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php class="btn btn-danger" role="button">Remove Feed</a>
</div>	
	
</body>
</html>
