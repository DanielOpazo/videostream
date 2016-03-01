<?php
class CameraFeed implements JsonSerializable {
	private $name = "";
	private $url = "";
	
	public function __construct($name, $url) {
		$this->name = $name;
		$this->url = $url;
	}

	public function getName() {
		return $this->name;
	}

	public function getUrl() {
		return $this->url;
	}

	public function jsonSerialize() {
		return[
			'name' => $this->name,
			'url' => $this->url
		];
	}
}

function getCamerasListFromFile() {
	$camerasFromFile = json_decode(file_get_contents("cameras/cameras.json"));
        $camerasList = array();
        foreach  ($camerasFromFile as $camera) {
                array_push($camerasList, new CameraFeed($camera->name, $camera->url));
        }
	return $camerasList;
}

function saveCameras($camerasList) {
	file_put_contents("cameras/cameras.json", json_encode($camerasList));
}
?>
