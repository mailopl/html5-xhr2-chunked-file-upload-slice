<?php 
$filename   = $_SERVER['HTTP_X_FILE_NAME'];
$filesize   = $_SERVER['HTTP_X_FILE_SIZE'];
$index      = $_SERVER['HTTP_X_INDEX'];

// name must be in proper format
if (!isset($_SERVER['HTTP_X_FILE_NAME'])) {
    throw new Exception('Name required');
}
if (!preg_match('/^[-a-z0-9_][-a-z0-9_.]*$/i', $_SERVER['HTTP_X_FILE_NAME'])) {
    throw new Exception('Name error');
}

// index must be set, and number
if (!isset($_SERVER['HTTP_X_INDEX'])) {
    throw new Exception('Index required');
}
if (!preg_match('/^[0-9]+$/', $_SERVER['HTTP_X_INDEX'])) {
    throw new Exception('Index error');
}

// we store chunks in directory named after filename
if (!file_exists("uploads/" . $filename .'/')){
	mkdir("uploads/" . $filename .'/');
}

$target = "uploads/" . $filename . '/' . $filename . '-' . $index;


/*
    // alternative way
    $putdata = fopen("php://input", "r");
    $fp = fopen($target, "w");
    while ($data = fread($putdata, 1024))
    fwrite($fp, $data);
    fclose($fp);
    fclose($putdata);
*/

$input = fopen("php://input", "r");
file_put_contents($target, $input);
