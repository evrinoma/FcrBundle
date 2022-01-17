# Configuration

преопределение штатного класса сущности

    contractor:
        db_driver: orm модель данных
        factory: App\Fcr\Factory\FcrFactory фабрика для создания объектов,
                 не достающие значения можно разрешить на уровне Mediator или переопределив фабрику
        entity: App\Fcr\Entity\Fcr сущность
        dto_class: App\Fcr\Dto\FcrDto класс dto с которым работает сущность

# CQRS model

Actions в контроллере разбиты на две группы
создание, редактирование, удаление данных

        1. putAction(PUT), postAction(POST), deleteAction(DELETE)
получение данных

        2. getAction(GET), criteriaAction(GET)

каждый метод работает со своим менеджером

        1. CommandManagerInterface
        2. QueryManagerInterface

При переопределении штатного класса сущности, дополнение данными осуществляется декорированием, с помощью MediatorInterface


группы  сериализации

    1. api_get_fcr - получение цфо
    2. api_post_fcr - создание цфо
    3. api_put_fcr -  редактирование цфо

# Статусы:

    создание:
        цфо создан HTTP_CREATED 201
    обновление:
        цфо обновление HTTP_OK 200
    удаление:
        цфо удален HTTP_ACCEPTED 202
    получение:
        цфо(ы) найдены HTTP_OK 200
    ошибки:
        если цфо не найден FcrNotFoundException возвращает HTTP_NOT_FOUND 404
        если цфо не уникален UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если цфо не прошел валидацию FcrInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если цфо не может быть сохранен FcrCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400


# Тесты:

    composer install --dev
### run all tests
    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests --teamcity

### run personal test for example testPost
    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests/Functional/Controller/TypeApiControllerTest.php --filter "/::testPost( .*)?$/" 
