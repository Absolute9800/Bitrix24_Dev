<?php

declare(strict_types=1);
use Bitrix24\SDK\Services\ServiceBuilderFactory;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once '../vendor/autoload.php';
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

$B24crm = ServiceBuilderFactory::createServiceBuilderFromWebhook(
    webhookUrl: 'https://xga007.bitrix24.ru/rest/1/n2mm0p2kzfgxecbh/',
    logger: $logger
);

$B24tasks = ServiceBuilderFactory::createServiceBuilderFromWebhook(
    webhookUrl: 'https://xga007.bitrix24.ru/rest/1/3idfz76z0qqhbaq2/',
    logger: $logger
);

/*
// Создание контакта CORE
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
*/

/*
// Создание контакта SDK
$result = $B24crm->getCRMScope()->contact()->add([
    'NAME' => 'Глеб',
    'SECOND_NAME' => 'Егорович',
    'LAST_NAME' => 'Жеглов',
    'OPENED' => 'Y',
    'POST' => 'Сыщик',
    'ASSIGNED_BY_ID' => 1,
])->getId();
print_r($result);
*/

/*
// Получение списка контактов CORE
$result = $B24crm->core->call('crm.contact.list', [
    'filter' => [],
    'order' => ['ID' => 'ASC'],
    'select' => ['NAME', 'LAST_NAME'],
])->getResponseData()->getResult();
print_r($result);
*/


// Получение списка контактов SDK
$result = $B24crm->getCRMScope()->contact()->list(
    $order = ['ID' => 'ASC'],
    $filter = [],
    $select = ['NAME', 'LAST_NAME'],
    $start = 1,
)->getCoreResponse()->getResponseData()->getResult();
print_r($result);
$debug->debug('Получение списка контактов методом SDK', $result);


/*
// Создание задачи CORE
$result = $B24tasks->core->call('tasks.task.add', [
    'fields' => [
        'RESPONSIBLE_ID' => 1,
        'TITLE' => 'REST task',
        'DESCRIPTION' => 'Description...',
        'DEADLINE' => '31.12.2024 12:00'
    ]
])->getResponseData()->getResult();
print_r($result);
*/

/*
// Получение списка задач core
$result = $B24tasks->core->call('tasks.task.list', [
    'order' => ['ID' => 'ASC'],
    'filter' => [],
    'select' => ['ID', 'TITLE'],
])->getResponseData()->getResult();
print_r($result);
*/
