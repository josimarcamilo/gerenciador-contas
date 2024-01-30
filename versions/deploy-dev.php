<?php

$directory_versions = 'versions';
$file_currete_version = 'version.txt';
// $file_currete_version = "public_html/version.txt";

$content = scandir($directory_versions);

if (! $content) {
    echo 'directory empty'.PHP_EOL;

    return;
}

$versions = array_filter($content, function ($value) {
    return str_contains($value, '.zip');
});

if (count($versions) == 0) {
    echo 'never version '.PHP_EOL;

    return;
}

foreach ($versions as $version) {
    echo $version.PHP_EOL;
}

sort($versions);

foreach ($versions as $version) {
    echo $version.PHP_EOL;
}

$last_version = str_replace('.zip', '', end($versions));
echo PHP_EOL.$last_version.PHP_EOL;

$current_version = file_get_contents($file_currete_version);

echo PHP_EOL.'current version '.$current_version.PHP_EOL;

echo PHP_EOL.'last version '.$last_version.PHP_EOL;

if ($current_version >= $last_version) {
    echo 'not implant '.PHP_EOL;

    return;
}

$from = $directory_versions.'/'.$last_version.'.zip';
$to = 'releases'.'/'.$last_version.'.zip';

copy($from, $to);

$zip = new ZipArchive();

$zip->open($to);

$ok = $zip->extractTo('./releases');

$zip->close();

echo PHP_EOL.'ok '.$ok.PHP_EOL;
unlink($to);

//symbolic
if (is_link('releases/current')) {
    unlink('releases/current');
    // $this->laravel->make('files')->delete($link);
}

// chmod('/releases/20232', 0766);
$result = '';
exec('cd ..');
exec('cd releases;');
exec('pwd', $result);
// "../releases/";

chdir('releases');
exec('pwd', $result);
print_r($result);

// $ok = symlink('/releases/20232','/current');

//create link limbolic
exec("ln -s $last_version current", $result);
print_r($result);

// chdir('/');
// exec("pwd", $result);
// print_r($result);

// if (! is_link('/public_html')) {
//     echo(PHP_EOL. 'nao e link '. PHP_EOL);

//     link('public_html', 'releases/current');
//     // $this->laravel->make('files')->delete($link);
// }
// echo(PHP_EOL. 'E link '. PHP_EOL);

echo PHP_EOL."version $last_version in production".PHP_EOL;
