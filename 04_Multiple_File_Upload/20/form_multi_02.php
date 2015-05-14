<?php
$max = 400 * 1024;
if (isset($_POST['upload'])) {
    echo '<pre>';
    print_r($_FILES['filename']);
    echo '</pre>';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Multiple File Upload</title>
    <link rel="stylesheet" href="styles/form.css" type="text/css">
</head>
<body>
<h1>Uploading Multiple Files</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
enctype="multipart/form-data">
    <p>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max; ?>">
        <label for="filename01">Select file: </label>
        <input type="file" name="filename[]" id="filename01">
    </p>
    <p>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max; ?>">
        <label for="filename02">Select file: </label>
        <input type="file" name="filename[]" id="filename02">
    </p>
	<p>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max; ?>">
        <label for="filename03">Select file: </label>
        <input type="file" name="filename[]" id="filename03">
    </p>
        <p>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max; ?>">
        <label for="filename04">Select file: </label>
        <input type="file" name="filename[]" id="filename04">
    </p>
    <p>
        <input type="submit" name="upload" value="Upload Files">
    </p>
</form>
</body>
</html>