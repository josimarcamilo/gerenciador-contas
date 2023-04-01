<?php

// php connect-ftp.php ftp_server ftp_user ftp_password
$ftp_server = $argv[1];
$ftp_user_name = $argv[2];
$ftp_user_pass = $argv[3];

function connectFtp($ftp_server, $ftp_user_name, $ftp_user_pass)
{
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

    return $ftp;
}

function zipCode()
{
}

function uploadCode($ftp, $source_file, $destination_file)
{
    $upload = ftp_put($ftp, $destination_file, $source_file, FTP_BINARY);

    // check upload status
    if (!$upload) {
        echo "FTP upload has failed!";
    } else {
        echo "Upload com sucesso.". PHP_EOL;
    }

    ftp_close($ftp);
}

exec('cd code && git pull origin master');

$newVersion = file_get_contents('code/version.txt');
$source_file = $newVersion . '.zip';
$destination_file = $source_file;

exec("cp -R code/ $newVersion");

//zip
exec("zip -vr $newVersion.zip $newVersion/ -x '*.DS_Store'");

//upload

$ftp = connectFtp($ftp_server, $ftp_user_name, $ftp_user_pass);

uploadCode($ftp, $source_file, $destination_file);
