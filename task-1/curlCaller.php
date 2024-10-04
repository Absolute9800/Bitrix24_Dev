<?php
declare(strict_types=1);

const USER_TASKS_WEBHOOK = 'https://xga007.bitrix24.ru/rest/1/ju1tvcdwlnszxga8/';
const CRM_WEBHOOK = 'https://xga007.bitrix24.ru/rest/1/n2mm0p2kzfgxecbh/';
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
    //CURLOPT_POSTFIELDS => $queryData,
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
var_dump(json_decode($response, true));
