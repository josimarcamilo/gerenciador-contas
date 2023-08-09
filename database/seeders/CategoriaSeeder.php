<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Orcamento;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'se pagar',
            'doar',
            'poupar para os sonhos',
            'investir para ser rico',
            'pagar as contas',
            'abundar',
            'quitar as dívidas',
        ];

        Orcamento::all()->each(function ($orcamento) use ($categorias) {
            foreach ($categorias as $categoria) {
                Categoria::updateOrCreate([
                    'orcamento_id' => $orcamento->id,
                    'descricao' => $categoria,
                ]);
            }
        });
    }
}
