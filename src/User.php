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

    public function message(string $body, $parse_mode = 'markdown')
    {
        return $this->bot->message($this->chatId(), $body, $parse_mode);
    }

    public function typing()
    {
        return $this->bot->typing($this->chatId());
    }

    public function setTelegramId($id)
    {
        $this->telegram_id = (int)$id;
        return $this;
    }

    public function setIsBot($is_bot)
    {
        $this->is_bot = (bool)$is_bot;
        return $this;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setLanguageCode($language_code)
    {
        $this->language_code = $language_code;
        return $this;
    }


    public function telegramId()
    {
        return $this->telegram_id;
    }

    public function isBot()
    {
        return $this->is_bot;
    }

    public function firstName()
    {
        return $this->first_name;
    }

    public function username()
    {
        return $this->username;
    }

    public function languageCode()
    {
        return $this->language_code;
    }

}
