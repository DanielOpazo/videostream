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
			<li class="active"><a href="#">Live Feeds</a></li>
			<li><a href="#">Add Feed</a></li> 
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
				echo "<div class='col-sm-4'><div class='bg-info'>".$feed->getName()."</div><div class='well'><div class='embed-responsive embed-responsive-4by3'><iframe src=".$feed->getUrl()."></iframe><div class=\"overlay\"></div></div></div></div>";
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
