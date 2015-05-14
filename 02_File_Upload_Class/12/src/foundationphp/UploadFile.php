<?php
namespace foundationphp;

class UploadFile {

	protected $destination;
	protected $messages = array();
	protected $maxSize = 51200; //50 Kilobytes

	public function __construct ($uploadFolder) {
		if(!is_dir($uploadFolder) || !is_writable($uploadFolder)) {
			throw new \Exception("$uploadFolder must be a valid, writable folder.");
		}
		if($uploadFolder[strlen($uploadFolder) - 1] != '/') {
			$uploadFolder .= '/';
		}
		$this->destination = $uploadFolder;
	}

	//Setter
	public function setMaxSize ($bytes) {
		if(is_numeric($bytes) && $bytes > 0) {
			$this->maxSize = $bytes;
		}
	}

	public function upload () {
		$uploaded = current($_FILES);
		if($this->checkFile($uploaded)) {
			$this->moveFile($uploaded);
		}
	}

	//Getter
	public function getMessages () {
		return $this->messages;
	}

	protected function checkSize ($file) {
		if ($file['size'] == 0) {
		    $this->messages[] = $file['name'] . ' is empty.';
			return false;
		} else if($file['size'] > $this->maxSize) {
			$this->messages[] = $file['name'] . ' exceeds the maximum size  for the file.';
			return false;
		} else {
			return true;
		}
	}
	protected function checkFile ($file) {
		if($file['error'] != 0) {
			$this->getErrorMessage($file);
			return false;
		}
		if (!$this->checkSize($file)) {
		    return false;
		}
		return true;
	}

	protected function getErrorMessage ($file) {
		switch($file['error']) {
			case 1:
			case 2:
				$this->messages[] = $file['name'] . ' is too big.';
				break;
			case 3:
				$this->messages[] = $file['name'] . ' was only partially uploaded.';
				break;
			case 4:
				$this->messages[] = 'No file submitted.';
				break;
			default:
				$this->messages[] = 'Sorry, there was a problem uploading ' . $file['name'];
				break;
		}
	}

	protected function moveFile ($file) {
		$this->messages[] = $file['name'] . ' was uploaded successfully.';
	}
}