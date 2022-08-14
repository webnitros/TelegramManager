<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 30.07.2022
 * Time: 11:11
 */

namespace TelegramManager;


use TelegramManager\Clients\Command;

class Hook
{
    /**
     * @var array
     */
    private $properties;

    /**
     * @var User
     */
    private $user;
    /* @var string $command */
    private $command;
    /* @var string $query */
    private $query;

    public function __construct(Bot $bot, array $properties)
    {
        $this->properties = $properties;
        $this->bot = $bot;
    }

    public function user()
    {
        if (is_null($this->user)) {
            $chatId = @(int)$this->properties['message']['chat']['id'];
            $this->user = new User($chatId, $this->bot);


            $from = @(array)$this->properties['message']['from'];
            if (!empty($from)) {
                $this->user->setTelegramId($from['id']);
                $this->user->setIsBot($from['is_bot']);
                $this->user->setFirstName(@$from['first_name']);
                $this->user->setUsername(@$from['username']);
                $this->user->setLanguageCode(@$from['language_code']);
            }
        }
        return $this->user;
    }

    public function run(CommandAction $commandAction)
    {
        $command = $this->command();
        if ($actions = $commandAction->find($command)) {
            foreach ($actions as $k => $action) {
                if (!empty($action)) {
                    if (gettype($action) === 'object') {
                        // Function run
                        $action($this);
                    } else {
                        if (class_exists($action)) {
                            $handler = new $action($this);
                            if ($handler instanceof \TelegramManager\Clients\Hook) {
                                $handler->process();
                            }
                        }
                    }
                }
            }
        }
    }

    public function query()
    {
        return $this->query;
    }

    public function command()
    {
        if (is_null($this->command)) {
            $text = @$this->properties['message']['text'];
            $type = @$this->properties['message']['entities'][0]['type'];
            if ($type === 'bot_command') {
                if (empty($text)) {
                    throw new \Exception('Произошла ошибка не удалось определить команду');
                }

                $array = explode(' ', $text);
                $command = $array[0];
                $this->query = implode(' ', $array);
                $command = trim($command);
                $command = ltrim($command, '/');
                $this->command = str_ireplace('_', ' ', $command);
            } else {
                $this->command = '';
                $this->query = $text;
            }
        }
        return $this->command;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param string $key
     * @param null|mixed $default
     *
     * @return mixed
     */
    public function getProperty(string $key, $default = null)
    {
        return $this->properties[$key] ?? $default;
    }

}
