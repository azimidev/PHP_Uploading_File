<?php
namespace foundationphp;

class UploadFile {
	protected $destination;

	public function __construct($uploadFolder) {
		if (!is_dir($uploadFolder) || !is_writable($uploadFolder)) {
			throw new \Exception("$uploadFolder must be a valid, writable folder.");
		}
		if ($uploadFolder[strlen($uploadFolder)-1] != '/') {
			$uploadFolder .= '/';
		}
		$this->destination = $uploadFolder;
	}
}