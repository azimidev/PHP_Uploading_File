<?php 
use foundationphp\UploadFile;

$max = 50 * 1024;
$result = array();
if (isset($_POST['upload'])) {
	require_once 'src/foundationphp/UploadFile.php';
	$destination = __DIR__ . '/uploaded/';
    try {
    	$upload = new UploadFile($destination);
    	$upload->setMaxSize($max);
    	$upload->allowAllTypes('');
    	$upload->upload();
    	$result = $upload->getMessages();
    } catch (Exception $e) {
    	$result[] = $e->getMessage();
    }
}
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
<?php if ($result) { ?>
<ul class="result">
<?php  foreach ($result as $message) {
    echo "<li>$message</li>";
}?>
</ul>
<?php } ?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max;?>">
<label for="filename">Select File:</label>
<input type="file" name="filename" id="filename">
</p>
<p>
<input type="submit" name="upload" value="Upload File">
</p>
</form>
</body>
</html>