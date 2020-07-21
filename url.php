<?php
// URL Amigavel ----- 
$url = (isset($_GET['url'])) ? $_GET['url'] : 'index.php';
$url = array_filter(explode('/', $url));

$file = $url[0] . '.php';

if (is_file($file)) {
    include $file;
}
