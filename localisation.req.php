<?php // writed by Benjamin EG0N
$GLOBALS['localisation'] = [
  'fr' => [
    'download' => 'Télécharger'
    , 'upload' => 'Envoyer'
    , 'download_file' => 'Télécharger le fichier'
    , 'upload_file' => 'Envoyer le fichier'
    , 'drop_a_file' => 'Déposer un fichier'
    , 'get_a_file' => 'Récupérer un fichier'
  ],
  'en' => [
    'download' => 'Download'
    , 'upload' => 'Upload'
    , 'download_file' => 'Download file'
    , 'upload_file' => 'Upload file'
    , 'drop_a_file' => 'Drop a file'
    , 'get_a_file' => 'Get a file'
  ]
];

function local($key)
{
  $iso = $GLOBALS['culture'];
  $arr = $GLOBALS['localisation'][$iso];
  return array_key_exists($key, $arr) ? $arr[$key] : "{{{$key}}}";
}
