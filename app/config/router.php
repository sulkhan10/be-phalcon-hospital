<?php
$router = $di->getRouter();

// Define your routes here
$router->add('/patients', 'Index::index')->via(['GET']);
$router->add('/patients', 'Index::create')->via(['POST']);
$router->add('/patients/{id:[0-9]+}', 'Index::update')->via(['PUT']);
$router->add('/patients/{id:[0-9]+}', 'Index::show')->via(['GET']);
$router->add('/patients/{id:[0-9]+}', 'Index::delete')->via(['DELETE']);

$router->handle($_SERVER['REQUEST_URI']);

