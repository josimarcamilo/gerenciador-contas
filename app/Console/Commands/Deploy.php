<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ZipArchive;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy release';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $directory_versions = '/versions';

        $content = scandir($directory_versions);

        if (!$content) {
            $this->info("directory $directory_versions empty");

            return;
        }

        $versions = array_filter($content, function ($value) {
            return str_contains($value, '.zip') && str_starts_with($value, '20');
        });

        if (count($versions) == 0) {
            $this->info('never version found');

            return;
        }

        foreach ($versions as $key => $version) {
            $versions[$key] = str_replace('.zip', '', $version);
        }

        sort($versions);

        $last_version = end($versions);

        $this->info("versao a ser aplicada $last_version");

        $result = '';
        $resultCode = false;

        $from = $directory_versions . '/' . $last_version . '.zip';
        $to = '/releases' . '/' . $last_version . '.zip';

        $this->warn('copiando para pasta releases');
        copy($from, $to);
        $this->info('copiado!');

        $zip = new ZipArchive();

        $zip->open($to);

        $this->warn('extraindo os arquivos');
        $ok = $zip->extractTo('/releases');
        $this->info('terminado!');

        $zip->close();

        $this->warn("apagando o arquivo $to");
        unlink($to);
        $this->info('terminado!');

        $this->warn('criando link simbolico');

        if (is_link('/releases/current')) {
            unlink('/releases/current');
        }
        $this->info('terminado!');

        chdir('/releases');

        exec("ln -s $last_version current", $result, $resultCode);

        if ($result === false) {
            $this->warn('erro ao criar o link limbolico.');

            return;
        }

        $this->info("version $last_version in production");
    }
}
