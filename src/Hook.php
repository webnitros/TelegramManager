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
    private $command;

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
        }
        return $this->user;
    }

    public function run(CommandAction $commandAction)
    {
        if ($actions = $commandAction->find($this->command())) {
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

    public function command()
    {
        if (is_null($this->command)) {

            $text = @$this->properties['message']['text'];
            if (empty($text)) {
                throw new \Exception('Произошла ошибка не удалось определить команду');
            }

            list($command, $text) = explode(' ', $text);
            $command = trim($command);
            $command = ltrim($command, '/');
            $command = str_ireplace('_', ' ', $command);
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
