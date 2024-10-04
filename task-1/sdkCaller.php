<?php

declare(strict_types=1);
use Bitrix24\SDK\Services\ServiceBuilderFactory;
require_once '../vendor/autoload.php';

$B24crm = ServiceBuilderFactory::createServiceBuilderFromWebhook(
    'https://xga007.bitrix24.ru/rest/1/n2mm0p2kzfgxecbh/'
);

$B24tasks = ServiceBuilderFactory::createServiceBuilderFromWebhook(
    'https://xga007.bitrix24.ru/rest/1/3idfz76z0qqhbaq2/'
);


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



// Получение списка контактов CORE
$result = $B24crm->core->call('crm.contact.list', [
    'filter' => [],
    'order' => ['ID' => 'ASC'],
    'select' => ['NAME', 'LAST_NAME'],
])->getResponseData()->getResult();
print_r($result);



// Получение списка контактов SDK
$result = $B24crm->getCRMScope()->contact()->list(
    $order = ['ID' => 'ASC'],
    $filter = [],
    $select = ['NAME', 'LAST_NAME'],
    $start = 1,
)->getCoreResponse()->getResponseData()->getResult();
print_r($result);



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



// Получение списка задач core
$result = $B24tasks->core->call('tasks.task.list', [
    'order' => ['ID' => 'ASC'],
    'filter' => [],
    'select' => ['ID', 'TITLE'],
])->getResponseData()->getResult();
print_r($result);
