## TelegramManager

Управление ботами telegram и реакциями на вызываемые команды

```php

Код который необходимо посместить 
$token = '';
$username = '';
$properties = []; // Сюда положить POST что присылается на WebHook от телеграм бота

// Создаем Бота
$Bot = new Bot($token,$username);

// Создаем hook
$Hook = new Hook($Bot,$properties):


// Хранилище для хуков
$Action = new CommandAction();
 
// Добавляем хук на команду start
$Action->addCommandHandler('start', function (Hook $Hook) {
    // В классе Hook автоматически определяется чат и пользователь куда будет возвращаться сообщение, по этому напишем ему привет
    $Hook->user()->message('Hello');
});

// Для Класс обработчика пример в классе \TelegramManager\Hooks\CallbackMessage обязательно должен быть подключен интерфейс TelegramManager\Client\Hook
$Action->addCommandHandler('help', \TelegramManager\Hooks\CallbackMessage::class);

// Запускаем ниши хуки на команды
$Hook->run();
```
