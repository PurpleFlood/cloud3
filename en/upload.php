<?php
require_once 'crypt.req.php';

if (
    isset($_FILES['fileToUpload'])
    && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK
) {
    $name = basename($_FILES['fileToUpload']['name']);
    $guid = uniqid() . '-' . uniqid();
    $upload_dir = "c:\\temp\\uploads\\";
    // télécharger le fichier en tant que .tmp
    $tmpFile = $upload_dir . $guid . ".tmp";
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $tmpFile);
    // lire le contenu du fichier .tmp
    $fileContent = file_get_contents($tmpFile);
    // chiffrer le contenu
    $cryptedFileContent = openssl_encrypt($fileContent
        , 'AES-128-CBC', GetPassPhrase(), 0, GetIv());
    if(false === $cryptedFileContent)
    {
        echo openssl_error_string();
        die;
    }
    // écrire un fichier avec le contenu chiffré
    file_put_contents($upload_dir . $guid, $cryptedFileContent);
    // supprimer le .tmp
    unlink($tmpFile);

    file_put_contents($upload_dir . 'data.db', "$guid,$name\r\n", FILE_APPEND);
    echo "<p>You can download your file with the code : $guid </p>";
    echo "<p>or use this think :</p>";
    echo "<p>https://localhost/benjamin.egon/be-bookstore2/cloud2/download.php?guid=$guid</p>";
    echo "<p><a href=\"index.php\">Back to home</a></p>";
}
