<?php

require __DIR__ . '/../vendor/autoload.php';

$builder = new DI\ContainerBuilder();
$builder->useAnnotations(false);
$builder->addDefinitions(__DIR__ . '/../config/botConfig.php');
$builder->addDefinitions(__DIR__ . '/../config/config.php');
$container = $builder->build();

$api = $container->get(Telegram\Bot\Api::class);
$messageHandler = $container->get(\YazabanBot\MessageHandler::class);

$update = $api->getWebhookUpdates();
$message = $update->getMessage();
if ($message) {
    $messageHandler->handle($message);
}
