<?php

include 'vendor/autoload.php';

$url = parse_url($_SERVER["REQUEST_URI"]);

$path = isset($url["path"]) ? $url["path"] : "/";

dump($path);