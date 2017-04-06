<?php
use Telegram\Bot\Api;

use function DI\object;
use function DI\get;

return [
    Api::class => object()
        ->constructor(get('apiKey')),
];
