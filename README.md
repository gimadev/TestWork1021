<h1>TestWork 1021</h1>

## Описание по развертыванию

1. Для установки зависимостей выполнить в корне проекта:
```
composer install

```

2. Далее, создать файл .env из образца (и заполнить актуальными данными подключения к БД):
```
cp .env.example .env

```

3. Сгенерировать секретный ключ jwt:
```
php artisan jwt:secret

```

4. Выполнить миграции:
```
php artisan migrate

```

5. Заполнить БД начальными данными:
```
php artisan db:seed

```

6. Запустить тестовый сервер:
```
php artisan serve

```

7. После этого можно прогнать тесты из Postman коллекции (файл коллекции в корне проекта, TestWorkApi.postman_collection.json)


