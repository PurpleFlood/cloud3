<?php
require_once 'crypt.req.php';

function readCSV($csvFile) {
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle)) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}

$uploadDir = 'c:\\temp\\uploads\\';
$csvFile = $uploadDir.'data.db';
$lines = readCSV($csvFile);

for ($i = 0; $i < sizeof($lines); $i++) {
    $line = $lines[$i];
    if(empty($line)) continue;
    $guid = $line[0];
    $fileName = $line[1];
    if($guid == $_GET["guid"])
    {
        $cryptedFileContent = file_get_contents($uploadDir.$guid);
        $decrypted = openssl_decrypt($cryptedFileContent
            , 'AES-128-CBC', GetPassPhrase(), 0, GetIv());

        header('Content-Type: '.mime_content_type($fileName));
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-length: ".strlen($decrypted));

        echo $decrypted;
        break;
    }
}
