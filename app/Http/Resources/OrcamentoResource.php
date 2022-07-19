<?php

namespace App\Http\Resources;

use App\Models\Orcamento;
use Illuminate\Http\Resources\Json\JsonResource;

class OrcamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'codigo' => Orcamento::encode($this->id),
            'descricao' => $this->descricao,
            'padrao' => $this->padrao,
            'visibilidade' => $this->visibilidade,
            'distribuicao' => $this->distribuicoes
        ];
    }
}
