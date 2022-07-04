Для запуска проекта необходимо сделать клон репозитория

git clone https://github.com/VladimirMusatov/VendingTest

Установить все зависимости через composer
composer install

Скопировать файл env.example и переименовать его в .env

Сгенерировать app_key 
php artisan key:generate

Изменить в файлке .env строчки 
DB_DATABASE=laravel 
DB_USERNAME=root 
DB_PASSWORD=

Запустить миграции 
php artisan migrate

Запустить Сиды 
php artisan db:seed