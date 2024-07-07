<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'razao_social',
        'cpf_cnpj',
        'email',
        'telefone',
    ];

    // Relacionamento 1:N
    public function enderecos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClienteEnderecos::class, 'cliente_id', 'id')->with('cidade');
    }
}
