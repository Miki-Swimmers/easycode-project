# Запуск проекта:

1. Клонировать репозиторий
2. Запустить docker-compose up -d
3. Установить зависимости внутри контейнера:

* ```composer install```
* ```cp .env.example .env```
* ```Прописать данные к БД в .env```
* ```пустить миграции: php artisan migrate —seed```
* ```npm intsall```
* ```npm run build```

Приложение доступно по адресу: localhost
