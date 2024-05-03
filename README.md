Currency field for MoonShine
============================

Поле с валютой для MoonShine. Наследует поле Number.

## Установка

```
$ composer require yurizoom/moonshine-currency
```

## Настройки

В файле config/moonshine.php добавьте конфигурации.

```php
[
    'currency' => [
        // Код валюты по-умолчанию (ISO 4217)
        'default' => 'RUB',
        // Доступные коды валют. Используются, если код валюты хранится в БД
        'currencies' => [
            'RUB',
            'USD',
            'EUR',
        ],
    ]
]
```

## Использование

В базе данных денежная единица хранится в минимальном значении. Например, 100₽ = 10000.

При отображении значение будет делиться на 100.

```php
use YuriZoom\MoonShineCurrency\Fields\Currency;

Currency::make('Label');
```

Для указания поля, где хранится код валюты:

```php
use YuriZoom\MoonShineCurrency\Fields\Currency;

Currency::make('Label')->currency('column');
```

Код валюты должен соответствовать ISO 4217

Лицензия
------------
[The MIT License (MIT)](LICENSE).
