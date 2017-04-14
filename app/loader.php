<?php

require __DIR__ . '/../app/models/Loader.php';

// Регистрация путей для автозагрузки классов
$loader = new Loader();

$loader->registerPaths([
    __DIR__ . '/../app/models',
    __DIR__ . '/../app/controllers'
]);

$loader->register();