<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 30.07.2022
 * Time: 11:11
 */

namespace TelegramManager;

class CommandAction
{
    /**
     * @var array
     */
    private $actions = [];

    /**
     * @param string $command
     * @param $handler
     */
    public function addCommandHandler(string $command, $handler)
    {
        $this->actions[$command][] = $handler;
    }

    public function find(string $command)
    {
        if (array_key_exists($command, $this->actions)) {
            return $this->actions[$command];
        }
        return null;
    }

}
