<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 10.08.2022
 * Time: 22:39
 */

namespace TelegramManager\Clients;

interface Action
{
    public function uri(): string;
}
