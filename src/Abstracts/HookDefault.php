<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 14.08.2022
 * Time: 11:08
 */

namespace TelegramManager\Abstracts;


use TelegramManager\Hook;

abstract class HookDefault
{
    /**
     * @var Hook
     */
    public $hook;

    public function __construct(Hook $hook)
    {
        $this->hook = $hook;
    }

}
