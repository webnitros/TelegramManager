<?php
/**
 * Created by Andrey Stepanenko.
 * User: webnitros
 * Date: 14.08.2022
 * Time: 11:08
 */

namespace TelegramManager\Clients;


interface Hook
{
    public function process();
}
