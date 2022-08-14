<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 30.07.2022
 * Time: 11:09
 */

namespace TelegramManager\Abstracts;


use TelegramManager\Hook;

abstract class CommandDefault
{

    /**
     * @var Hook
     */
    public $hook;

    public function __construct(Hook $hook)
    {
        $this->hook = $hook;
    }

    public function hook()
    {
        return $this->hook;
    }

    public function query()
    {
        $array = $this->hook()->getProperty('message');
        if (!empty($array)) {
            list($command, $text) = explode(' ', $array['text']);
            if (!empty($text)) {
                return trim($text);
            }
        }
        return '';
    }
}
