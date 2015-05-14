<?php
namespace foundationphp;

class UploadFile {

	protected $destination;

	public function __construct($uploadFolder) {
		if (!is_dir($uploadFolder) || !is_writable($uploadFolder)) {
			throw new \Exception("$uploadFolder must be a valid, writable folder.");
		}
		if ($uploadFolder[strlen($uploadFolder) - 1] != '/') {
			$uploadFolder .= '/';
		}
		$this->destination = $uploadFolder;
	}

	public function upload() {
		$uploaded = current($_FILES);
		if ($this->checkFile($uploaded)) {
		    $this->moveFile($uploaded);
		}
	}

	protected function checkFile($file) {
		return true;
	}

	protected function moveFile($file) {
		echo $file['name'] . ' was uploaded successfully.';
	}
}