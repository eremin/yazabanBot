<?php

namespace YazabanBot;

use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class MessageHandler
{
    /**
     * @var Api
     */
    private $api;

    /**
     * MessageHandler constructor.
     *
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * @param Message $message
     */
    public function handle(Message $message)
    {
        if (false !== strpos($message->getText(), '/yazaban')) {
            $this->api->sendMessage([
                'reply_to_message_id' => $message->getMessageId(),
                'text' => 'Хуем тебе по губам!',
                'chat_id' => $message->getChat()->getId()
            ]);
        }
    }
}
