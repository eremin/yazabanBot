#!/usr/bin/env php
<?php

if ('cli' !== PHP_SAPI) {
    return;
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

$builder = new DI\ContainerBuilder();
$builder->useAnnotations(false);
$builder->addDefinitions(__DIR__ . '/../config/botConfig.php');
$builder->addDefinitions(__DIR__ . '/../config/config.php');
$container = $builder->build();

$api = $container->get(Telegram\Bot\Api::class);
$messageHandler = $container->get(\YazabanBot\MessageHandler::class);

$lastUpdateId = 0;

while(true) {
    $updates = $api->getUpdates($lastUpdateId ? ['offset' => $lastUpdateId + 1] : []);
    foreach ($updates as $update) {
        $messageHandler->handle($update->getMessage());
        $lastUpdateId = $update->getUpdateId();
    }
    usleep(100000);
}
