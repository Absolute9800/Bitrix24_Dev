<?php

declare(strict_types=1);
use Bitrix24\SDK\Services\ServiceBuilderFactory;
require_once '../vendor/autoload.php';

$B24 = ServiceBuilderFactory::createServiceBuilderFromWebhook(
    'https://xga007.bitrix24.ru/rest/1/n2mm0p2kzfgxecbh/'
);

$B24tasks = ServiceBuilderFactory::createServiceBuilderFromWebhook(
    'https://xga007.bitrix24.ru/rest/1/3idfz76z0qqhbaq2/'
);

/*
// Получение списка задач
$result = $B24tasks->core->call('tasks.task.list', [
    'order' => ['ID' => 'ASC'],
    'filter' => [],
    'select' => ['ID', 'TITLE'],
])->getResponseData()->getResult();
print_r($result);
*/

/*
// Создание контакта
$result = $B24->core->call('crm.contact.add', [
    'fields' => [
        'NAME' => 'Глеб',
        'SECOND_NAME' => 'Егорович',
        'LAST_NAME' => 'Титов',
        'OPENED' => 'N',
        'POST' => 'Директор',
        'ASSIGNED_BY_ID' => 1,
    ]
])->getResponseData()->getResult();
print_r($result[0]);
*/

/*
// Получение списка контактов
$result = $B24->core->call('crm.contact.list', [
    'filter' => [],
    'order' => ['ID' => 'ASC'],
    'select' => ['NAME', 'LAST_NAME'],
])->getResponseData()->getResult();
print_r($result);
*/

/*
$result = $B24->getCRMScope()->contact()->list(
    $order = ['ID' => 'ASC'],
    $filter = [],
    $select = ['NAME', 'LAST_NAME'],
    $start = 1,
)->getContacts();
print_r($result);
*/
