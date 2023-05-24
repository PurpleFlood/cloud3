<?php
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['fr', 'en'];
$culture = in_array($lang, $acceptLang) ? $lang : 'en';

header("Location: ".$culture.'/index.php');
die();
