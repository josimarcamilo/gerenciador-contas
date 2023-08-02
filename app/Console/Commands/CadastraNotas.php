<?php

namespace App\Console\Commands;

use DOMDocument;
use DOMElement;
use Illuminate\Console\Command;

class CadastraNotas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:nota {nota}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Le os itens de uma nota e cadastra no banco.';

    /**
     * Execute the console command.
     * https://medium.com/@valdeirpsr/extraindo-informa%C3%A7%C3%B5es-de-um-site-com-php-bd3e3dec98e5
     * é na tabela 5 (indice 4) que fica o valor total, no primeiro td
     */
    public function handle(): void
    {
        $nota = $this->argument('nota');

        $file = file_get_contents(storage_path("app/$nota.html"), true);

        $dom = new DOMDocument();
        @$dom->loadHTML($file);
        $teste = $dom->getElementsByTagName('table');

        /**
         * @var DOMElement
         */
        $tabelaItens = $teste->item($teste->count() -2);
        $trs = $tabelaItens->getElementsByTagName('tr');
        $itensComprados = [];
        foreach($trs as $key => $tr){
            if($key == 0){continue;}
            $item = $tr->getElementsByTagName('td')->item(1)->textContent;
            $this->info("$key - $item");
            $itensComprados[] = $item;
        }
    }
}
