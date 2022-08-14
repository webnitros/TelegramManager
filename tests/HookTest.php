<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 14.08.2022
 * Time: 10:45
 */

namespace Tests;

use TelegramManager\Bot;
use TelegramManager\Hook;
use Tests\TestCase;

class HookTest extends TestCase
{

    public function testRun()
    {

        $Bot = $this->bot();
        $Hook = new Hook($Bot, [
            'message' => [
                'text' => '/help привет',
                #'text' => '/start привет',
                'from' => [
                    'id' => 420203062
                ],
                'chat' => [
                    'id' => 420203062
                ]
            ]
        ]);
        $Hook->run($this->action());

    }

}
