<?php
class CameraFeed implements JsonSerializable {
	private $name = "";
	private $address = "";
	private $username = "";
	private $password = "";
	
	public function __construct($name, $address, $username, $password) {
		$this->name = $name;
		$this->address = $address;
		$this->username = $username;
		$this->password = $password;
	}

	public function getName() {
		return $this->name;
	}

	public function getAddress() {
		return $this->url;
	}
	
	public function getUserName() {
		return $this->username;
	}
	
	public function getPassword() {
		return $this->password;
	}

	public function getFeedUrl() {
		return "http://".$this->username.":".$this->password."@".$this->address.":8080/stream";
	}
	
	public function jsonSerialize() {
		return[
			'name' => $this->name,
			'address' => $this->address,
			'username' => $this->username,
			'password' => $this->password
		];
	}
}

function getCamerasListFromFile() {
	$camerasFromFile = json_decode(file_get_contents("cameras/cameras.json"));
        $camerasList = array();
        foreach  ($camerasFromFile as $camera) {
                array_push($camerasList, new CameraFeed($camera->name, $camera->address, $camera->username, $camera->password));
        }
	return $camerasList;
}

function saveCameras($camerasList) {
	file_put_contents("cameras/cameras.json", json_encode($camerasList));
}
?>
