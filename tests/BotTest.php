<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 14.08.2022
 * Time: 10:43
 */

namespace Tests;

use Longman\TelegramBot\Entities\BotCommand;
use Longman\TelegramBot\Entities\BotCommandScope\BotCommandScopeDefault;
use TelegramManager\Bot;
use Tests\TestCase;

class BotTest extends TestCase
{

    public function testSetMyCommands()
    {
        $Bot = $this->bot();
        $commands = [
            'scope' => new BotCommandScopeDefault(),
            'commands' => [
                new BotCommand(
                    [
                        'command' => 'help',
                        'description' => 'All help',
                    ]
                ),
                new BotCommand(
                    [
                        'command' => 'start',
                        'description' => 'start',
                    ]
                ),
            ],
        ];
        $Bot->setMyCommands($commands);
    }
}
