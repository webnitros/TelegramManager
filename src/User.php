<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 30.07.2022
 * Time: 10:57
 */

namespace TelegramManager;


class User
{
    /**
     * @var int
     */
    private $chat_id;
    /**
     * @var Bot
     */
    private $bot;

    public function __construct(int $chat_id, Bot $Bot)
    {
        $this->chat_id = $chat_id;
        $this->bot = $Bot;
    }

    public function chatId()
    {
        return $this->chat_id;
    }

    public function message(string $body)
    {
        return $this->bot->message($this->chatId(), $body);
    }

    public function typing()
    {
        return $this->bot->typing($this->chatId());
    }
}
