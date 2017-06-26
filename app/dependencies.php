<?php

use Psr\Container\ContainerInterface;

$container = $app->getContainer();

// PDO database library
$container['db'] = function (ContainerInterface $c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO(
        'mysql:host=' . $settings['host'] . ';dbname=' . $settings['dbname'],
        $settings['user'],
        $settings['pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
};

// Logger
$container['logger'] = function (ContainerInterface $c) {
    $settings = $c->get('settings')['logger'];
    if ($settings['enabled'] === false) {
        return false;
    }
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler(
        $settings['path'], $settings['level'])
    );

    return $logger;
};