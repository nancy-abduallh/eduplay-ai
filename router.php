<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$realPath = __DIR__ . '/public' . $uri;

if ($uri !== '/' && file_exists($realPath) && !is_dir($realPath)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
