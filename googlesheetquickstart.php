<?php 
// Our service account access key
$googleAccountKeyFilePath = __DIR__ . '/servicekey.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);

// Create new client
$client = new Google_Client();
// Set credentials
$client->useApplicationDefaultCredentials();

// Adding an access area for reading, editing, creating and deleting tables
$client->addScope('https://www.googleapis.com/auth/spreadsheets');

$service = new Google_Service_Sheets($client);

// you spreadsheet ID
$spreadsheetId = '1AHAnKShwCKbtJCnQvAYQAN2UrX0lp5aZdKB71MHQpdw';
$currentRow=2;
$data = [];

        $updateRange = 'A1:C3';
        $updateBody = new \Google_Service_Sheets_ValueRange([
            'range' => $updateRange,
            'majorDimension' => 'ROWS',
            'values' => [
               ['name','famili','date'],
               ['mohammad','taheri',date('c')],
               ['vahid','yaseri',date('c')],
            ],
        ]);
        $service->spreadsheets_values->update(
            $spreadsheetId,
            $updateRange,
            $updateBody,
            ['valueInputOption' => 'USER_ENTERED']
        );
$range = 'A2:C3';

$rows = $service->spreadsheets_values->get($spreadsheetId, $range, ['majorDimension' => 'ROWS']);

if (isset($rows['values'])) {
	print_r($rows);
}

// if (isset($rows['values'])) {
//     foreach ($rows['values'] as $row) {
//         /*
//          * If first column is empty, consider it an empty row and skip (this is just for example)
//          */
//         if (empty($row[0])) {
//             break;
//         }

//         $data[] = [
//             'col-a' => $row[0],
//             'col-b' => $row[1]
//         ];

//         /*
//          * Now for each row we've seen, lets update the I column with the current date
//          */
//         $updateRange = 'C'.$currentRow;
//         $updateBody = new \Google_Service_Sheets_ValueRange([
//             'range' => $updateRange,
//             'majorDimension' => 'ROWS',
//             'values' => ['values' => date('c')],
//         ]);
//         $service->spreadsheets_values->update(
//             $spreadsheetId,
//             $updateRange,
//             $updateBody,
//             ['valueInputOption' => 'USER_ENTERED']
//         );

//         $currentRow++;
//     }
// }

// print_r($data);


//***************************************************************
//read data with get function 
// $response = $service->spreadsheets->get($spreadsheetId);

// // TODO: Change code below to process the `response` object:
// echo '<pre>', var_export($response, true), '</pre>', "\n";


// $response = $service->spreadsheets->get($spreadsheetId);

// var_dump($response);
