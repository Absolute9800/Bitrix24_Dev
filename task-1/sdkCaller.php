<?php

declare(strict_types=1);
use Bitrix24\SDK\Services\ServiceBuilderFactory;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;
//use Monolog\Handler\StreamHandler;
use Bitrix24\SDK\Core\Exceptions;
use Symfony\Component\Dotenv\Dotenv;

require_once '../vendor/autoload.php';
//$dotenv->load(__DIR__.'/.env'););
$dotenv = new Dotenv();
$dotenv->load('../.env');

/*
$debug = new Logger('debug');
$currentDate = date('d-m-Y');
$logFileName = $currentDate . '.log';
$debug->pushHandler(new StreamHandler(__DIR__.'/logs/'.$logFileName, Level::Debug));
*/

// Логгер для создания записей из кода самостоятельно
$rotatingFileHandler = new RotatingFileHandler('logs', 7, Level::Debug);
$rotatingFileHandler->setFilenameFormat('{filename}/{date}.log', 'Y-m-d');
$debug = new Logger('debug');
$debug->pushHandler($rotatingFileHandler);

// Логгер подключаемый в SDK
$sdkRotatingFileHandler = new RotatingFileHandler('logs', 7, Level::Debug);
$sdkRotatingFileHandler->setFilenameFormat('{filename}/{date}.log', 'Y-m-d');
$logger = new Logger('sdkDebug');
$logger->pushHandler($sdkRotatingFileHandler);


try
{
    $crmWebhook = $_ENV['B24_CRM_WEBHOOK'];
    $B24crm = ServiceBuilderFactory::createServiceBuilderFromWebhook(
        webhookUrl: $crmWebhook,
        logger: $logger
    );
}
catch (Exceptions\InvalidArgumentException $sdkCoreException)
{
    $debug->error('Ошибка ServiceBuilderFactory: ' . $sdkCoreException->getMessage());
    echo 'Ошибка ServiceBuilderFactory: ' . $sdkCoreException->getMessage() . PHP_EOL;
    die();
}


try
{
    $tasksWebhook = $_ENV['B24_TASKS_WEBHOOK'];
    $B24tasks = ServiceBuilderFactory::createServiceBuilderFromWebhook(
        webhookUrl: 'https://xga007.bitrix24.ru/rest/1/3idfz76z0qqhbaq2/',
        logger: $logger
    );
}
catch (Exceptions\InvalidArgumentException $sdkCoreException)
{
    $debug->error('Ошибка ServiceBuilderFactory: ' . $sdkCoreException->getMessage());
    echo 'Ошибка ServiceBuilderFactory: ' . $sdkCoreException->getMessage() . PHP_EOL;
    die();
}


/*
// Создание контакта CORE
try
{
    $result = $B24crm->core->call('crm.contact.add', [
        'fields' => [
            'NAME' => 'Глеб',
            'SECOND_NAME' => 'Егорович',
            'LAST_NAME' => 'Титов',
            'OPENED' => 'N',
            'POST' => 'Директор',
            'ASSIGNED_BY_ID' => 1,
        ]
    ])->getResponseData()->getResult();
    print_r($result);
}
catch (Exceptions\BaseException $sdkBaseException)
{
    $logger->error('Ошибка при создании контакта core: ' . $sdkBaseException->getMessage());
    echo 'Ошибка при создании контакта core: ' . $sdkBaseException->getMessage() . PHP_EOL;
    die();
}
*/

/*
// Создание контакта SDK
try
{
    $result = $B24crm->getCRMScope()->contact()->add([
        'NAME' => 'Глеб',
        'SECOND_NAME' => 'Егорович',
        'LAST_NAME' => 'Жеглов',
        'OPENED' => 'Y',
        'POST' => 'Сыщик',
        'ASSIGNED_BY_ID' => 1,
    ])->getId();
    print_r($result);
}
catch (Exceptions\BaseException $sdkBaseException)
{
    $logger->error('Ошибка при создании контакта SDK: ' . $sdkBaseException->getMessage());
    echo 'Ошибка при создании контакта SDK: ' . $sdkBaseException->getMessage() . PHP_EOL;
    die();
}
*/


// Получение списка контактов CORE
try
{
    $result = $B24crm->core->call('crm.contact.list', [
        'filter' => [],
        'order' => ['ID' => 'ASC'],
        'select' => ['NAME', 'LAST_NAME'],
    ])->getResponseData()->getResult();
    print_r($result);
}
catch (Exceptions\BaseException $sdkBaseException)
{
    $logger->error('Ошибка при получении списка контактов core: ' . $sdkBaseException->getMessage());
    echo 'Ошибка при получении списка контактов core: ' . $sdkBaseException->getMessage() . PHP_EOL;
    die();
}


/*
// Получение списка контактов SDK
try
{
    $result = $B24crm->getCRMScope()->contact()->list(
        $order = ['ID' => 'ASC'],
        $filter = [],
        $select = ['NAME', 'LAST_NAME'],
        $start = 1,
    )->getCoreResponse()->getResponseData()->getResult();
    print_r($result);
}
catch (Exceptions\BaseException $sdkBaseException)
{
    $logger->error('Ошибка при получении списка контактов SDK: ' . $sdkBaseException->getMessage());
    echo 'Ошибка при получении списка контактов SDK: ' . $sdkBaseException->getMessage() . PHP_EOL;
    die();
}
*/

/*
// Создание задачи CORE
try
{
    $result = $B24tasks->core->call('tasks.task.add', [
        'fields' => [
            'RESPONSIBLE_ID' => 1,
            'TITLE' => 'REST task',
            'DESCRIPTION' => 'Description...',
            'DEADLINE' => '31.12.2024 12:00'
        ]
    ])->getResponseData()->getResult();
    print_r($result);
}
catch (Exceptions\BaseException $sdkBaseException)
{
    $logger->error('Ошибка при создании задачи core: ' . $sdkBaseException->getMessage());
    echo 'Ошибка при создании задачи core: ' . $sdkBaseException->getMessage() . PHP_EOL;
    die();
}
*/

/*
// Получение списка задач core
try
{
    $result = $B24tasks->core->call('tasks.task.list', [
        'order' => ['ID' => 'ASC'],
        'filter' => [],
        'select' => ['ID', 'TITLE'],
    ])->getResponseData()->getResult();
    print_r($result);
}
catch (Exceptions\BaseException $sdkBaseException)
{
    $logger->error('Ошибка при получении списка задач core: ' . $sdkBaseException->getMessage());
    echo 'Ошибка при получении списка задач core: ' . $sdkBaseException->getMessage() . PHP_EOL;
    die();
}
*/
