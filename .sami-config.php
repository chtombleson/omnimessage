<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Sami\Sami;

return new Sami(__DIR__ . '/src', array(
    'title' => 'Omnimessage API',
    'build_dir' => __DIR__ . '/api',
    'cache_dir' => __DIR__ . '/cache',
));
