<?php
use foundationphp\UploadFile;

session_start();
require_once 'src/foundationphp/UploadFile.php';
if (!isset($_SESSION['maxfiles'])) {
	$_SESSION['maxfiles'] = ini_get('max_file_uploads');
	$_SESSION['postmax'] = UploadFile::convertToBytes(ini_get('post_max_size'));
	$_SESSION['displaymax'] = UploadFile::convertFromBytes($_SESSION['postmax']);
}
$max = 50 * 1024;
$result = array();
if (isset($_POST['upload'])) {
	$destination = __DIR__ . '/uploaded/';
	try {
		$upload = new UploadFile($destination);
		$upload->setMaxSize($max);
		$upload->allowAllTypes();
		$upload->upload();
		$result = $upload->getMessages();
	} catch (Exception $e) {
		$result[] = $e->getMessage();
	}
}
$error = error_get_last();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>File Uploads</title>
	<link href="styles/form.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Uploading Files</h1>
<?php if ($result || $error) { ?>
	<ul class="result">
		<?php
		if ($error) {
			echo "<li>{$error['message']}</li>";
		}
		if ($result) {
			foreach ($result as $message) {
				echo "<li>$message</li>";
			}
		}?>
	</ul>
<?php } ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max; ?>">
		<label for="filename">Select File:</label>
		<input type="file" name="filename[]" id="filename" multiple>
	</p>
	<ul>
		<li>Up to <?php echo $_SESSION['maxfiles'];?> files can be uploaded simultaneously.</li>
		<li>Each file should be no more than <?php echo UploadFile::convertFromBytes($max);?>.</li>
		<li>Combined total should not exceed <?php echo $_SESSION['displaymax'];?>.</li>
	</ul>
	<p>
		<input type="submit" name="upload" value="Upload File">
	</p>
</form>
</body>
</html>