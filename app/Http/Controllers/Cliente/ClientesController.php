<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function fetch(Request $request)
    {

        $pages = $request->per_page ?? $request->pages ?? 10;

        $default_search = $request->has('search') && $request->has('type') && $request->type !== '3';
        $uf_search = $request->has('search') && $request->has('type') && $request->type === '3';

        $clientes = Clientes::when($default_search, fn ($query) => $query->where('razao_social', 'like', "%{$request->search}%")->orWhere('cpf_cnpj', 'like', "%{$request->search}%"))
            ->when($uf_search, fn ($query) => $query->whereHas('enderecos', fn ($query) => $query->whereHas('cidade', fn ($query) => $query->where('uf', trim(strtoupper($request->search)))->orWhere('nome', 'like', "%{$request->search}%"))))
            ->with('enderecos')
            ->paginate($pages);

        return response()->json($clientes, 200);
    }

    /**
     * Store a newly created and update resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->validate($request, [
                'razao_social'  => ['required'],
                'cpf_cnpj'      => ['required', /* 'cpf_cnpj' */],
                'email'         => ['email', 'nullable'],
                //'telefone' => 'required',
            ]);

            $cliente =  Clientes::updateOrCreate(
                ['id' => $request->input('id')],
                [
                    'razao_social'  => $request->input('razao_social'),
                    'cpf_cnpj'      => $request->input('cpf_cnpj'),
                    'email'         => $request->input('email'),
                    'telefone'      => $request->input('telefone'),
                ]
            );

            if ($cliente) {
                $endereco = new EnderecoController();

                $request->query->set('cliente_id', $cliente->id);

                $endereco->store($request);
            }

            return response()->json($cliente->load('enderecos'));
        } catch (ValidationException $th) {
            return response()->json(['errors' => $th->validator->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json(Clientes::destroy($id), 200);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Erro ao deletar endereço'], 500);
        }
    }
}
