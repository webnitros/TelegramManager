<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 10.08.2022
 * Time: 22:30
 */

namespace TelegramManager;


use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use TelegramManager\Clients\Action;
use TelegramManager\Helpers\RequestClient;

class Bot
{

    private string $bot_api_key;
    private string $bot_username;
    /* @var Telegram $telegram */
    private $telegram;

    public function __construct($token, $username)
    {
        $this->bot_api_key = $token;
        $this->bot_username = $username;

        // Create Telegram API object
        $this->telegram = new Telegram($this->bot_api_key, $this->bot_username);
        $Client = new RequestClient([
            'debug' => true,
            'base_uri' => 'https://api.telegram.org',
        ]);
        Request::setClient($Client);
    }

    public function telegram()
    {
        return $this->telegram;
    }

    public function registration()
    {
    }

    public function action(Action $action)
    {
        return $action->run();
    }

    public function setToken(string $token)
    {
        $this->token = $token;
        return $this;
    }

    public function getMyCommands()
    {
        return Request::getMyCommands([
            'bot_username' => $this->bot_username,
            'bot_api_key' => $this->bot_api_key,
        ]);
    }

    public function setMyCommands(array $commands)
    {
        return Request::setMyCommands($commands);
    }

    public function deleteMyCommands(array $commands)
    {
        return Request::deleteMyCommands($commands);
    }


    public function installWebHook($url)
    {
        try {
            // Set webhook
            $result = $this->telegram->setWebhook($url);
            if ($result->isOk()) {
                return $result->getDescription();
            }
        } catch (\Longman\TelegramBot\Exception\TelegramException $e) {
            // log telegram errors
            return $e->getMessage();
        }
        return false;
    }

    public function unInstallWebHook()
    {
        try {
            // Set webhook
            $result = $this->telegram->deleteWebhook();
            if ($result->isOk()) {
                return $result->getDescription();
            }
        } catch (\Longman\TelegramBot\Exception\TelegramException $e) {
            // log telegram errors
            return $e->getMessage();
        }
        return false;
    }


    public function typing(int $chat_id)
    {
        return Request::sendChatAction([
            'chat_id' => $chat_id,
            'action' => \Longman\TelegramBot\ChatAction::TYPING,
        ]);
    }

    public function message(int $chat_id, string $body)
    {
        return Request::sendMessage([
            'chat_id' => $chat_id,
            'text' => $body,
            'parse_mode' => 'markdown',
        ]);
    }

    public function getWebhookInfo()
    {
        return Request::getWebhookInfo();
    }

}
