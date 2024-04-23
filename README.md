
# Запуск проекта:

1. Клонировать репозиторий
2. Запустить docker-compose up -d
3. Установить зависимости внутри контейнера
3.1 composer install
3.2 cp .env.example .env
3.3 Прописать данные к БД в .env
3.4 Запустить миграции: php artisan migrate —seed
3.5 npm intsall
3.6 npm run build

Приложение доступно по адресу: localhost
