<?php
$error_description = mysqli_error($dbc);
$error_type = "database error";

$text = $error_description.PHP_EOL;
$filename = "../setup/errors.txt";
$fh = fopen($filename, "a");
fwrite($fh, $text);
fclose($fh);

?>
