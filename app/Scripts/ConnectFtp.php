<?php

namespace App\Scripts;

// set up basic connection
$ftp_server = config('FTP_SERVER');
$ftp_user_name = env('FTP_USER');
$ftp_user_pass = env('FTP_PASSWORD');

$ftp = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($ftp, $ftp_user_name, $ftp_user_pass);

// check connection
if ((!$ftp) || (!$login_result)) {
    echo "FTP connection has failed!". PHP_EOL;
    echo "Attempted to connect to $ftp_server for user $ftp_user_name". PHP_EOL;
    exit;
} else {
    echo "Connected to $ftp_server, for user $ftp_user_name". PHP_EOL;
}

return;

$source_file = 'josimar.zip';
$destination_file = $source_file;
// upload the file
$upload = ftp_put($ftp, $destination_file, $source_file, FTP_BINARY);

// check upload status
if (!$upload) {
    echo "FTP upload has failed!";
} else {
    echo "Uploaded $source_file to $ftp_server as $destination_file". PHP_EOL;
}

// close the FTP connection
ftp_close($ftp);
