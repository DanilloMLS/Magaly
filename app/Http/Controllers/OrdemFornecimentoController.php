<?php

namespace App\Http\Controllers;

use App\OrdemFornecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdemFornecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordem_fornecimentos = \App\OrdemFornecimento::all();
        return view("ListarOrdemFornecimentos", [
            "ordem_fornecimentos" => $ordem_fornecimentos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fornecedor = \App\Fornecedor::find($request->id);
        $escolas = \App\Escola::all();

        $ids_escolas = [];
        foreach ($escolas as $escola) {
            $ids_escolas[] = $escola->estoque_id;
        }

        $estoques = \App\Estoque::whereNotIn('id',$ids_escolas)->get();

        if (isset($fornecedor)) {
            return view("CadastrarOrdemFornecimento", [
                "fornecedor" => $fornecedor,
                "estoques" => $estoques
            ]);
        }
        
        session()->flash('success', 'Fornecedor não existe.');
        return redirect()->route('/fornecedor/listar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fornecedor = \App\Fornecedor::find($request->fornecedor_id);

        $validator = Validator::make($request->all(), [
            'observacao' => ['nullable', 'string', 'max:255'],
            'estoque_id' => ['required', 'integer', 'exists:estoques,id'],
            ],[
            'observacao.max' => 'Observação deve ter no máximo 255 caracteres',
            'estoque_id.required' => 'Escolha um estoque',
          ]);
      
          if ($validator->fails()) {
              return redirect()->route('/ordemfornecimento/cadastrar', ['id' => $fornecedor->id])
                          ->withErrors($validator)
                          ->withInput();
          }

        $ordem_fornecimento = new \App\OrdemFornecimento();
        $ordem_fornecimento->fornecedor_id = $request->fornecedor_id;
        $ordem_fornecimento->observacao = $request->observacao;
        $ordem_fornecimento->estoque_id = $request->estoque_id;
        $ordem_fornecimento->save();

        session()->flash('success','Ordem de Fornecimento cadsatrada com sucesso.');
        return redirect()->route('/ordemfornecimento/listar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function show(OrdemFornecimento $ordemFornecimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdemFornecimento $ordemFornecimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdemFornecimento $ordemFornecimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdemFornecimento $ordemFornecimento)
    {
        //
    }
}
