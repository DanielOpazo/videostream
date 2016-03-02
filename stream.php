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
	<div class="container-fluid">
		<h1>Camera Feeds</h1>
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
				echo "<div class='col-sm-4'><div class='bg-info'>".$feed->getName()."</div><div class='embed-responsive embed-responsive-4by3'><iframe src=".$feed->getUrl()."></iframe><div class=\"overlay\"></div></div></div>";
				$count++;
			}
			if ((($count) % 3) != 0) {
				echo "</div>";
			}
		?>
		<div class="row">
			<div class="col-sm-6"><div id="newFeed"><a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php>Add New Feed</a></div></div>
			<div class="col-sm-6"><div id="removeFeed"><a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php>Remove Feed</a></div></div>
		</div>
</div>	
	
	
</body>
</html>
