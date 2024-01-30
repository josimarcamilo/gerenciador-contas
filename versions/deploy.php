<?php

/**
 * esse arquivo deve ficar na pasta version no servidor compartilhado.
 */

/**
 * fazer uma copia da pasta public_html
 * cp -r public_html public_html_back.
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
 * php artisan view:cache.
 */
$directory_versions = '.';
$file_currete_version = '/releases/current/version.txt';

$content = scandir($directory_versions);

if (! $content) {
    echo 'directory empty'.PHP_EOL;

    return;
}

echo 'tem versao'.PHP_EOL;

$versions = array_filter($content, function ($value) {
    return str_contains($value, '.zip') && str_starts_with($value, '20');
});

if (count($versions) == 0) {
    echo 'nenhum versao encontrada '.PHP_EOL;

    return;
}

foreach ($versions as $key => $version) {
    $versions[$key] = str_replace('.zip', '', $version);
}

sort($versions);

$last_version = end($versions);

echo "versao encontrada $last_version".PHP_EOL;

$result = '';
$resultCode = false;

$from = $last_version.'.zip';
$to = '../releases'.'/'.$last_version.'.zip';

copy($from, $to);

echo "arquivo copiado de $from".PHP_EOL;
echo "para $to".PHP_EOL;

$zip = new ZipArchive();

$zip->open($to);

$ok = $zip->extractTo("../releases/$last_version");

$zip->close();

echo "extracao do arquivo $to concluida".PHP_EOL;

unlink($to);

echo "arquivo $to excluido".PHP_EOL;

$pasta_current = '../releases/current';
//symbolic
if (is_link($pasta_current)) {
    echo "$pasta_current é um link".PHP_EOL;
    unlink($pasta_current);
    echo 'link deletado'.PHP_EOL;
} else {
    echo "$pasta_current nao é link".PHP_EOL;
}

chdir('../releases');

exec("ln -s $last_version current", $result, $resultCode);

if ($result === false) {
    echo 'erro ao criar o link limbolico.'.PHP_EOL;

    return;
} else {
    echo "link criado com sucesso $last_version para current ".PHP_EOL;
}

echo 'criando link limbolico para o .env'.PHP_EOL;
exec("ln -s ~/releases/shared/.env ~/releases/$last_version/.env", $result, $resultCode);

if ($result === false) {
    echo 'erro ao criar o link do .env.'.PHP_EOL;

    return;
} else {
    echo 'link do .env criado com sucesso!'.PHP_EOL;
}

echo PHP_EOL."versao $last_version publicada".PHP_EOL;
