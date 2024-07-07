<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cidades;
use App\Models\ClienteEnderecos;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class EnderecoController extends Controller
{

    /**
     * Store a newly created or update resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->validate($request, [
                'ibge'          => ['required', Rule::exists('cidades', 'codigo_ibge')],
                'cliente_id'    => 'required',
                'logradouro'    => 'required',
                'numero'        => 'required',
                'bairro'        => 'required'
            ]);

            $cidade_id = Cidades::where('codigo_ibge', $request->input('ibge'))->first()->id;

            return  ClienteEnderecos::updateOrCreate(
                ['id' => $request->input('endereco.id')],
                [
                    'cidade_id'     => $cidade_id,
                    'cliente_id'    => $request->input('cliente_id'),
                    'logradouro'    => $request->input('logradouro'),
                    'numero'        => $request->input('numero'),
                    'complemento'   => $request->input('complemento'),
                    'bairro'        => $request->input('bairro')
                ]
            );
        } catch (ValidationException $th) {
            throw new ValidationException($th->validator, $th->response, $th->errorBag, $th->redirectTo);
        }
    }

  
}
