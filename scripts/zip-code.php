<?php

date_default_timezone_set('America/Sao_Paulo');
$dateTime = (new DateTime('now'))->format('YmdHis');

$result = '';
$resultCode = false;

function connectFtp($ftp_server, $ftp_user_name, $ftp_user_pass)
{
    $ftp = ftp_connect($ftp_server);

    // login with username and password
    $login_result = ftp_login($ftp, $ftp_user_name, $ftp_user_pass);

    // check connection
    if ((! $ftp) || (! $login_result)) {
        echo 'FTP connection has failed!'.PHP_EOL;
        echo "Attempted to connect to $ftp_server for user $ftp_user_name".PHP_EOL;
        exit;
    } else {
        echo "Connected to $ftp_server, for user $ftp_user_name".PHP_EOL;
    }

    return $ftp;
}

function uploadCode($ftp, $source_file, $destination_file)
{
    $upload = ftp_put($ftp, $destination_file, $source_file, FTP_BINARY);

    // check upload status
    if (! $upload) {
        echo 'FTP upload has failed!'.PHP_EOL;
    } else {
        echo 'Upload com sucesso.'.PHP_EOL;
    }

    ftp_close($ftp);
}

$ftp_server = $argv[1];
$ftp_user_name = $argv[2];
$ftp_user_pass = $argv[3];

exec("cp -R gerenciador-contas/ $dateTime", $result, $resultCode);

exec("zip -vr $dateTime.zip $dateTime/ -x '*.DS_Store'", $result, $resultCode);

$ftp = connectFtp($ftp_server, $ftp_user_name, $ftp_user_pass);

uploadCode($ftp, "$dateTime.zip", "$dateTime.zip");
