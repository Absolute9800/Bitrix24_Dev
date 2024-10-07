<?php
declare(strict_types=1);

const USER_TASKS_WEBHOOK = 'https://xga007.bitrix24.ru/rest/1/3idfz76z0qqhbaq2/';
const CRM_WEBHOOK = 'https://xga007.bitrix24.ru/rest/1/n2mm0p2kzfgxecbh/';


// Получение списка контактов GET запросом
$restMethod = 'crm.contact.list';
$parameters = [
    'filter' => [],
    'order' => ['ID' => 'ASC'],
    'select' => ['NAME', 'LAST_NAME', 'HAS_PHONE'],
];
$queryData = http_build_query($parameters);

$url = CRM_WEBHOOK . $restMethod . '?' . $queryData;

print_r($url);

// Initialize a cURL session
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url,
]);

// Execute the session and store the result in $response
$response = curl_exec($curl);
// Check for cURL errors
if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
    curl_close($curl);
    exit();
}
curl_close($curl);
// Print the response
print_r(json_decode($response, true));



// Создание контакта POST запросом
$restMethod = 'crm.contact.add';
$data = [
    'fields' => [
        'NAME' => 'Дмитрий',
        'SECOND_NAME' => 'Николаевич',
        'LAST_NAME' => 'Макаров',
        'OPENED' => 'Y',
        'POST' => 'Главный инженер',
        'ASSIGNED_BY_ID' => 1,
    ]
];

$url = CRM_WEBHOOK . $restMethod;

// Initialize a cURL session
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_HTTPHEADER => ['Content-Type:application/json'],
    CURLOPT_POST => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url,
    CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE),
    CURLOPT_HEADER => false,
]);

// Execute the session and store the result in $response
$response = curl_exec($curl);
// Check for cURL errors
if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
    curl_close($curl);
    exit();
}
curl_close($curl);
// Print the response
print_r(json_decode($response, true));



// Получение списка задач GET запросом
$restMethod = 'tasks.task.list';
$parameters = [
    'order' => ['ID' => 'ASC'],
    'filter' => [],
    'select' => ['ID', 'TITLE', 'DESCRIPTION'],
];
$queryData = http_build_query($parameters);

$url = USER_TASKS_WEBHOOK . $restMethod . '?' . $queryData;

print_r($url);

// Initialize a cURL session
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url,
]);

// Execute the session and store the result in $response
$response = curl_exec($curl);
// Check for cURL errors
if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
    curl_close($curl);
    exit();
}
curl_close($curl);
// Print the response
print_r(json_decode($response, true));



// Создание задачи POST запросом
$restMethod = 'tasks.task.add';
$data = [
    'fields' => [
        'RESPONSIBLE_ID' => 1,
        'TITLE' => 'CURL REST task',
        'DESCRIPTION' => 'Description...',
        'DEADLINE' => '31.12.2024 15:00'
    ]
];

$url = USER_TASKS_WEBHOOK . $restMethod;

// Initialize a cURL session
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_HTTPHEADER => ['Content-Type:application/json'],
    CURLOPT_POST => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url,
    CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE),
    CURLOPT_HEADER => false,
]);

// Execute the session and store the result in $response
$response = curl_exec($curl);
// Check for cURL errors
if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
    curl_close($curl);
    exit();
}
curl_close($curl);
// Print the response
print_r(json_decode($response, true));

