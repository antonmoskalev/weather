Ипортнуть погоду для Севастополя
```
php artisan weather:import 44.590356 33.491229 --format=json
php artisan weather:import 44.590356 33.491229 --format=xml
```
Данные сохранятся в папку storage/app

Можно использовать этот токен, но он тестовый и активный только 7 дней. Получен он 2019-09-20
```
YANDEX_WEATHER_TOKEN=bc3c54f8-2d0e-49fc-ad3b-e5c7a24e83db
```
