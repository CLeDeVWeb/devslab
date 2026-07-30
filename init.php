<?php


declare(strict_types=1);

// echo '__DIR__ = ' . __DIR__ . '<br>';
// echo 'ROOT_DIR = ' . ROOT_DIR . '<br>';
// die();

use DevLab\Core\Autoloader;

if(!defined('ROOT_DIR')){
    define('ROOT_DIR', __DIR__);
}


require_once ROOT_DIR . '/core/Autoloader.php';

Autoloader::register();