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
 */

$directory_versions = "versions";
$file_currete_version = "public_html/version.txt";

$content = scandir($directory_versions);

if (! $content) {
    echo("directory empty". PHP_EOL);
    return;
}

$versions = array_filter($content, function ($value) {
    return str_contains($value, '.zip');
});

if (count($versions) == 0) {
    echo("never version ". PHP_EOL);
    return;
}

sort($versions);

$last_version = str_replace('.zip', "", end($versions));

$current_version = file_get_contents($file_currete_version);

if ($current_version >= $last_version) {
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

exec("ln -s $last_version current", $result);

echo(PHP_EOL. "version $last_version in production". PHP_EOL);
