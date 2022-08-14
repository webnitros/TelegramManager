<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 14.08.2022
 * Time: 11:08
 */

namespace TelegramManager\Hooks;


use TelegramManager\Abstracts\HookDefault;
use TelegramManager\Clients\Hook;

class CallbackMessage extends HookDefault implements Hook
{

    public function process()
    {
        $this->hook->user()->message('Hello');
    }
}
