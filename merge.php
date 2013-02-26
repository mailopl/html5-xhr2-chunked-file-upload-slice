<?php
// name must be in proper format
if (!isset($_REQUEST['name'])) {
    throw new Exception('Name required');
}
if (!preg_match('/^[-a-z0-9_][-a-z0-9_.]*$/i', $_REQUEST['name'])) {
    throw new Exception('Name error');
}

// index must be set, and number
if (!isset($_REQUEST['index'])) {
    throw new Exception('Index required');
}

if (!preg_match('/^[0-9]+$/', $_REQUEST['index'])) {
    throw new Exception('Index error');
}

$target = "uploads/full_" . $_REQUEST['name'];
$dst = fopen($target, 'wb');

for ($i = 0; $i < $_REQUEST['index']; $i++) {
    $slice = 'uploads/' . $_REQUEST['name'] . '/' . $_REQUEST['name'] . '-' . $i;
    $src = fopen($slice, 'rb');
    stream_copy_to_stream($src, $dst);
    fclose($src);
    unlink($slice);
}

fclose($dst);
rmdir("uploads/" . $_REQUEST['name']);
copy("uploads/full_" . $_REQUEST['name'], "uploads/" . $_REQUEST['name']);
unlink("uploads/full_" . $_REQUEST['name']);