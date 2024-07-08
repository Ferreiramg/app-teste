<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteEnderecos extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'cidade_id',
        'logradouro',
        'numero',
        'complemento',
        'bairro'
    ];

    protected $appends = ['city', 'state'];

    //Relacionamento 1:1
    public function cidade(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cidades::class);
    }

    public function getCityAttribute(): string
    {
        return $this->cidade->nome ?? '';
    }

    public function getStateAttribute(): string
    {
        return $this->cidade->uf ?? '';
    }
}
