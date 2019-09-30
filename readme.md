### Установка на сервере

##### Файл конфигурации из шаблона
```shell script
cp .env.example .env
```

Необходимо указать параметры подключения к базе postgresql

Параметры приложения:
- ```ELEVATORS_COUNT``` - количество лифтов (по умолчанию 4)
- ```ELEVATORS_SPEED``` - скорость движения лифтов (по умолчанию 1 этаж в секунду)
- ```FLOORS_COUNT``` - количество этажей (по умолчанию 10)

##### Установка зависимостей composer
```shell script
composer install
```

##### Генерация секретного ключа
```shell script
php artisan key:generate
```

##### Зависимости NPM
```shell script
npm install
```

##### Компиляция ассетов (css и js файлы)
```shell script
npm run prod
```

##### Выполнение миграций
```shell script
php artisan migrate
```
При выполнении миграций лифты займут случайное положение

##### Настройка веб-сервера
[Конфигурация NGINX](https://laravel.com/docs/5.7/deployment#nginx)

##### Запуск движения лифтов
Движения лифтов выполняется с указанным в настройках интервалом
```shell script
php artisan elevators:motion
```

Рекомендуется настроить supervisord для атвоматическго запуска программы обработки движений лифтов

Пример файла конфигурации:
```shell script
/etc/supervisor/conf.d/elevators.conf

[program:elevators-worker]
command=php /path/to/elevators/artisan elevators:motion
autostart=true
autorestart=true
user=www-data
```
