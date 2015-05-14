<?php
if (isset($_POST['upload'])) {
	$name = $_FILES['filename']['name'];
	if ($_FILES['filename']['error'] == 0) {
		$result = "Browser reports type of $name as: " . $_FILES['filename']['type'] . '.';
	} else {
		switch ($_FILES['filename']['error']) {
			case 1:
				$result = "$name exceeds server limit for size of individual files.";
				break;
			case 4:
				$result = 'No file selected.';
				break;
			default:
				$result = "Error handling $name.";
		}
	}
}
$error = error_get_last();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MIME test</title>
	<link rel="stylesheet" href="styles/form.css" type="text/css">
</head>
<body>
<h1>Check MIME Type</h1>
<?php if (isset($error)) {
	echo "<p class='result'>{$error['message']}</p>";
} elseif (isset($result)) {
	echo "<p class='result'>$result</p>";
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
      enctype="multipart/form-data">
	<p>
		<label for="filename">Select file: </label>
		<input type="file" name="filename" id="filename">
	</p>

	<p>
		<input type="submit" name="upload" value="Check File">
	</p>
</form>
</body>
</html>