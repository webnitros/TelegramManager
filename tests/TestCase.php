<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 24.03.2021
 * Time: 22:49
 */

namespace Tests;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use TelegramManager\CommandAction;
use TelegramManager\Bot;
use TelegramManager\Hook;

abstract class TestCase extends MockeryTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function action()
    {
        $Action = new CommandAction();
        $Action->addCommandHandler('start', function (Hook $Hook) {
            $Hook->user()->message('Привет андрей');
        });

        $Action->addCommandHandler('help', \TelegramManager\Hooks\CallbackMessage::class);
        return $Action;
    }

    public function bot()
    {
        return new Bot(TELEGRAM_TOKEN, TELEGRAM_USERNAME);
    }
}
