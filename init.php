<?php


declare(strict_types=1);

use DevLab\Core\Autoloader;

define('ROOT_DIR', dirname(__DIR__));

require_once ROOT_DIR . '/core/Autoloader.php';

Autoloader::register();