<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

$builder = new DI\ContainerBuilder();
$builder->useAnnotations(false);
$builder->addDefinitions(__DIR__ . '/../config/botConfig.php');
$builder->addDefinitions(__DIR__ . '/../config/config.php');
$container = $builder->build();

$api = $container->get(Telegram\Bot\Api::class);

$response = $api->setWebhook(['url' => $container->get('botUrl')]);