This is an example of HTML5 asynchronous sliced (chunked) file upload (using XmlHttpRequest level 2) with progress bar, that works well on Android 4.0.4 default browser (there's a bug that requires you to send(ArrayBuffer) instead of send(Blob)) and all of the modern HTML5 compatible browsers.

index.html represents a frontend that slices a file, uploads it's chunks (upload.php) separately and updates progress bar. After uploading last slice, mergeFile() function is executed which requests merge.php.

upload.php and merge.php requires that ./uploads directory is created with proper access rights.
