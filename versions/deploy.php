<?php

/**
 * fazer uma copia da pasta public_html
 * cp -r public_html public_html_back
 *
 * deletar a public_html
 * rm -r public_html
 *
 * criar o link simbolico para public_html
 * ln -s ~/releases/current ~/public_html
 * ln -s ~/releases/current/public ~/public_html
 */

/**
 * composer install --optimize-autoloader --no-dev
 * php artisan config:clear
 * php artisan config:cache
 * php artisan route:cache
 * php artisan view:cache
 */

$directory_versions = "versions";
$file_currete_version = "releases/current/version.txt";

$content = scandir($directory_versions);

if (! $content) {
    echo("directory empty". PHP_EOL);
    return;
}

$versions = array_filter($content, function ($value) {
    return str_contains($value, '.zip') && str_starts_with($value, '20');
});

if (count($versions) == 0) {
    echo("never version ". PHP_EOL);
    return;
}

foreach($versions as $key => $version) {
    $versions[$key] = str_replace('.zip', "", $version);
}

sort($versions);

$last_version = end($versions);

$current_version = file_get_contents($file_currete_version);

if ($current_version >= $last_version) {
    // echo("nao fazer deploy ". PHP_EOL);
    // echo("versao atual $current_version". PHP_EOL);
    // echo("ultima $last_version". PHP_EOL);

    return;
}

$result = '';
$resultCode = false;

try {
    exec('cd releases/current && php artisan migrate', $result, $resultCode);
} catch(Throwable $tr) {
    echo "erro ao executar as migrates". PHP_EOL;
    echo $tr->getMessage(). PHP_EOL;
    return;
}

if ($result === false) {
    echo "erro ao executar as migrates". PHP_EOL;
    return;
}

$from = $directory_versions.'/'. $last_version.'.zip';
$to = 'releases'.'/'.$last_version.'.zip';

copy($from, $to);

$zip = new ZipArchive();

$zip->open($to);

$ok = $zip->extractTo('./releases');

$zip->close();

unlink($to);

//symbolic
if (is_link('releases/current')) {
    unlink('releases/current');
}

chdir('releases');

exec("ln -s $last_version current", $result, $resultCode);

if ($result === false) {
    echo "erro ao criar o link limbolico.". PHP_EOL;
    return;
}

echo(PHP_EOL. "version $last_version in production". PHP_EOL);
