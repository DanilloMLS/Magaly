<?php

namespace App\Http\Controllers;

use App\OrdemFornecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdemFornecimentoController extends Controller
{
    /**
     * Lista de todas as ordem de fornecimento
     *
     * @return \Illuminate\Http\Response
     */
    public function listar()
    {
        $ordem_fornecimentos = \App\OrdemFornecimento::all();
        return view("ListarOrdemFornecimentos", [
            "ordem_fornecimentos" => $ordem_fornecimentos,
        ]);
    }

    /**
     * Exibe uma lista de ordens de fornecimento de um único estoque
     */
    public function listarOrdemEstoque(Request $request)
    {
        $ordem_fornecimentos = \App\OrdemFornecimento::where('estoque_id', $request->id)->get();
        return view("ListarOrdemFornecimentos", [
            "ordem_fornecimentos" => $ordem_fornecimentos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function telaCadastrar(Request $request)
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
    public function cadastrar(Request $request)
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
              return redirect()->route('/ordemfornecimento/telaCadastrar', ['id' => $fornecedor->id])
                          ->withErrors($validator)
                          ->withInput();
          }

        $ordem_fornecimento = new \App\OrdemFornecimento();
        $ordem_fornecimento->fornecedor_id = $request->fornecedor_id;
        $ordem_fornecimento->observacao = $request->observacao;
        $ordem_fornecimento->estoque_id = $request->estoque_id;
        $ordem_fornecimento->save();

        session()->flash('success','Ordem de Fornecimento cadsatrada com sucesso.');
        return redirect()->route('/ordemfornecimento/inserirItemOrdem', [
            'id' => $ordem_fornecimento->id,
        ]);//chamada de rota para inserir itens
    }

    /**
     * Procura uma ordem para inserir itens nela
     * 
     */
    public function buscarOrdem(Request $request)
    {
        $ordem_fornecimento = \App\OrdemFornecimento::find($request->id);

        if (isset($ordem_fornecimento)) {
            $fornecedor = \App\Fornecedor::find($ordem_fornecimento->fornecedor_id);
            $contratos = \App\Contrato::where('fornecedor_id', '=', $fornecedor->id)->get('id');

            if (isset($contratos)) {
                $contrato_itens = \App\Contrato_item::whereIn('contrato_id', $contratos)->get();
    
                return view("InserirItensOrdem", [
                    "id" => $ordem_fornecimento->id,
                    "contratos" => $contrato_itens
                ]);   
            }
        }

        return redirect()->back()->with('alert', 'A ordem de fornecimento não existe.');
    }

    /**
     * Inserir um item de um contrato em uma Ordem de serviço
     * 
     *  */    
    public function inserirItem(Request $request)
    {
        $ordem_fornecimento = \App\OrdemFornecimento::find($request->ordem_fornecimento_id);

        $ordem_item = new \App\Ordem_item();
        $ordem_item->ordem_fornecimento_id = $ordem_fornecimento->id;
        $ordem_item->contratoitem_id = $request->contratoitem_id;
        $ordem_item->quantidade = $request->quantidade;
        $ordem_item->save();

        return redirect()->route('/ordemfornecimento/inserirItemOrdem', [
            'id' => $ordem_fornecimento->id,
        ]);
    }

    /**
     * Remove um item de uma ordem de fornecimento
     * 
     */
    public function removerItem(Request $request)
    {
        $ordem_item = \App\Ordem_item::find($request->id);
        $ordem_fornecimento = \App\OrdemFornecimento::find($ordem_item->ordem_fornecimento_id);

        $ordem_item->delete();
        return redirect()->route('/ordemfornecimento/inserirItemOrdem', [
            'id' => $ordem_fornecimento->id,
        ]);
    }

    /**
     * Lista os itens de uma ordem de serrviço
     * 
     */
    public function listarItensOrdem(Request $request)
    {
        $ordem_fornecimento = \App\OrdemFornecimento::where('id',$request->id)->first();

        if (isset($ordem_fornecimento)) {
            $ordem_itens = \App\Ordem_item::where('ordem_fornecimento_id', $ordem_fornecimento->id)->get();

            return view("VisualizarItensOrdem", [
                'ordem_itens' => $ordem_itens
            ]);
        }
        
        return redirect()->back()->with('alert', 'A ordem de fornecimento não existe.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function exibir(OrdemFornecimento $ordemFornecimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function editar(OrdemFornecimento $ordemFornecimento)
    {
        //
    }

    /**
     * Abre o formulário para edição da quantidade de um item de ordem de fornecimento
     * que ainda não teve baixa no estoque
     */
    public function editarOrdemItem(Request $request)
    {
        $ordem_item = \App\Ordem_item::find($request->id);

        if (isset($ordem_item)) {
            return view("EditarOrdemItemQuantidade", [
                'ordem_item' => $ordem_item
            ]);
        }

        return redirect()->back()->with('alert', 'Item não encontrado.');
    }

    public function salvarItem(Request $request)
    {
        $ordem_item = \App\Ordem_item::find($request->id);

        if (isset($ordem_item)) {
            $ordem_item->quantidade = $request->quantidade;
            $ordem_item->save();

            session()->flash('success', 'Item alterado com sucesso.');
            return redirect()->route('/ordemfornecimento/listarItensOrdem', [
                'id' => $ordem_item->ordem_fornecimento_id
            ]);
        }

        return redirect()->back()->with('alert', 'Item não encontrado.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function salvar(Request $request, OrdemFornecimento $ordemFornecimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function removerOrdem(OrdemFornecimento $ordemFornecimento)
    {
        //
    }
}
