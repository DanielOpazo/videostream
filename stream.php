<!DOCTYPE html>
<?php
require('CameraFeed.php');
?>
<html>
	<head>
		<link rel='stylesheet' type='text/css' href='streamstyle.css' />
		<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
		<script type='text/javascript' src='streamjs.js'></script>
		<title>Live Stream</title>
	</head>
	<body>
		<p>
        		<?php echo date('Y-m-d H:i:s');?>
		</p>
		<h1>Camera Feeds</h1>
			<table>
			<tr>
				<?php
                        		//$camera1 = new CameraFeed("bedroom", "http://192.168.0.18:8080/stream");
					//$camera2 = new CameraFeed("kitchen", "http://192.168.0.18:8080/stream");
					//$camerasList = array($camera1, $camera2);
					//file_put_contents("cameras/cameras.json", json_encode($camerasList));
					$camerasListFromJson = json_decode(file_get_contents("cameras/cameras.json"));
					$camerasList = array();
					foreach  ($camerasListFromJson as $camera) {
						echo $camera->name . " " . $camera->url;
						array_push($camerasList, new CameraFeed($camera->name, $camera->url));
					}
					$cameras = array("http://192.168.0.18:8080/stream", "http://192.168.0.41:8080/stream", "http://192.168.0.18:8080/stream");
					foreach($camerasList as $feed) {
						echo "<td><p>".$feed->getName()."</p><p><div class='iframe'><iframe src=".$feed->getUrl()."></iframe><div class=\"overlay\"></div></p></td>";
					}
				?>
				</td>
                        </tr>
			<table>
		<div id="newFeed"><a href=<?php $_SERVER["HTTP_HOST"];?>/newFeed.php>Add New Feed</a></div>
		<div id="removeFeed"><a href=<?php $_SERVER["HTTP_HOST"];?>/removeFeed.php>Remove Feed</a></div>
	</body>
</html>
