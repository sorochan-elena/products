<?php

require_once './app/loader.php';
require_once './app/lib.php';

// контроллер
$filter = new Filter();

$controller = isset($_GET['controller']) ? $filter->sanitize($_GET['controller'], 'string!') : 'index';
$controller = ucfirst($controller) . 'Controller';

$action = isset($_GET['action']) ? $filter->sanitize($_GET['action'], 'string!') : 'index';
$action = processingAction($action);

if (!method_exists($controller, $action)) {
    $controller = 'IndexController';
    $action = 'notFound';
}

$c = new $controller();
$c->$action();