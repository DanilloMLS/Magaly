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
     * Exibe uma lista de ordens de fornecimento de um fornecedor
     */
    public function listarOrdemForn(Request $request)
    {
        $ordem_fornecimentos = \App\OrdemFornecimento::where('fornecedor_id', $request->id)->get();
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
        ]);
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
     * Inserir um item de um contrato em uma Ordem de Fornecimento
     * 
     *  */    
    public function inserirItem(Request $request)
    {
        $ordem_fornecimento = \App\OrdemFornecimento::find($request->ordem_fornecimento_id);
        $contrato_item = \App\Contrato_item::find($request->contratoitem_id);

        $validator = Validator::make($request->all(), [
            'quantidade_pedida' => ['required', 'integer', 'min:0', 'max:'.$contrato_item->quantidade],
            ],[
            'quantidade_pedida.required' => 'Quantidade é obrigatória',
            'quantidade_pedida.integer' => 'Quantidade deve ser um número',
            'quantidade_pedida.min' => 'Quantidade não pode ser inferior a zero',
            'quantidade_pedida.max' => 'Quantidade deve ser máximo '.$contrato_item->quantidade.', o que no momento tem disponível desse produto',
          ]);
      
        if ($validator->fails()) {
            return redirect()->route('/ordemfornecimento/inserirItemOrdem', ['id' => $ordem_fornecimento->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $ordem_item = new \App\Ordem_item();
        $ordem_item->ordem_fornecimento_id = $ordem_fornecimento->id;
        $ordem_item->contratoitem_id = $request->contratoitem_id;
        $ordem_item->quantidade_pedida = $request->quantidade_pedida;
        $ordem_item->quantidade_restante = $request->quantidade_pedida;
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

        if (isset($ordem_item)) {
            $ordem_fornecimento = \App\OrdemFornecimento::find($ordem_item->ordem_fornecimento_id);

            $ordem_item->delete();
            return redirect()->route('/ordemfornecimento/inserirItemOrdem', [
                'id' => $ordem_fornecimento->id,
            ]);
        }

        return redirect()->back()->with('alert', 'O item não existe.');
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
     * Exibe uma lista com as Ordens de Serviço de um item de uma Ordem de Fornecimento
     */
    public function listarOrdemServ(Request $request)
    {
        $ordem_servicos = \App\OrdemServico::where('ordem_item_id', $request->id)->get();
        //$ordem_servicos = \App\OrdemServico::all();
        return view("DetalhamentoOrdem", [
            "ordem_servicos" => $ordem_servicos,
        ]);
    }


    /**
     * Apresenta o formulário para edição da Ordem de Fornecimento.
     *
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function editarOrdem(Request $request)
    {
        $ordem_fornecimento = \App\OrdemFornecimento::find($request->id);
        $escolas = \App\Escola::all();

        $ids_escolas = [];
        foreach ($escolas as $escola) {
            $ids_escolas[] = $escola->estoque_id;
        }

        $estoques = \App\Estoque::whereNotIn('id',$ids_escolas)->get();

        if (isset($ordem_fornecimento)) {
            return view("EditarOrdemFornecimento", [
                'ordem_fornecimento' => $ordem_fornecimento,
                'estoques' => $estoques
            ]);
        }

        return redirect()->back()->with('alert', 'A ordem de fornecimento não existe');
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
        $contrato_item = \App\Contrato_item::find($ordem_item->contratoitem_id);

        $validator = Validator::make($request->all(), [
            'quantidade_pedida' => ['required', 'integer', 'min:0', 'max:'.$contrato_item->quantidade],
            ],[
            'quantidade_pedida.required' => 'Quantidade é obrigatória',
            'quantidade_pedida.integer' => 'Quantidade deve ser um número',
            'quantidade_pedida.min' => 'Quantidade não pode ser inferior a zero',
            'quantidade_pedida.max' => 'Quantidade deve ser máximo '.$contrato_item->quantidade.', o que no momento tem disponível desse produto',
          ]);
      
        if ($validator->fails()) {
            return redirect()->route('/ordemfornecimento/editarOrdemItem', ['id' => $ordem_item->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        if (isset($ordem_item)) {
            $ordem_item->quantidade_pedida = $request->quantidade_pedida;
            $ordem_item->quantidade_restante = $request->quantidade_pedida;
            $ordem_item->save();

            session()->flash('success', 'Item alterado com sucesso.');
            return redirect()->route('/ordemfornecimento/listarItensOrdem', [
                'id' => $ordem_item->ordem_fornecimento_id
            ]);
        }

        return redirect()->back()->with('alert', 'Item não encontrado.');
    }

    /**
     * Grava as alterações dos dados da ordem.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdemFornecimento  $ordemFornecimento
     * @return \Illuminate\Http\Response
     */
    public function salvarOrdem(Request $request)
    {
        $ordem_fornecimento = \App\OrdemFornecimento::find($request->id);
        
        if (isset($ordem_fornecimento)) {
            $ordem_fornecimento->observacao = $request->observacao;
            $ordem_fornecimento->estoque_id = $request->estoque_id;
            $ordem_fornecimento->save();

            return redirect()->route('/ordemfornecimento/listar');
        }
        
        return redirect()->back()->with('alert', 'A ordem de fornecimento não existe');
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

    /**
     * Abre o formulário para dar baixa na ordem de fornecimento
     */
    public function abreBaixa(Request $request)
    {
        $ordem_fornecimento = \App\OrdemFornecimento::find($request->id); 

        if (isset($ordem_fornecimento)) {
            $ordem_itens = \App\Ordem_item::where('ordem_fornecimento_id', $ordem_fornecimento->id)->get();

            if (count($ordem_itens) > 0) {
                return view("BaixaOrdemFornecimento", [
                    'ordem_itens' => $ordem_itens
                ]);
            }
            return redirect()->back()->with('success', 'Não há itens nessa ordem.');
        }
        return redirect()->back()->with('success', 'A ordem de fornecimento não existe.');
    }

    /**
     * Abre o formulário para atualização da quantidade aceita de um item de ordem de fornecimento
     */
    public function abreItem(Request $request)
    {
        $ordem_item = \App\Ordem_item::find($request->id);

        if (isset($ordem_item)) {
            return view("BaixaOrdemItem", [
                'ordem_item' => $ordem_item
            ]);
        }

        return redirect()->back()->with('alert', 'O item não existe.');
    }

    /**
     * Realiza as movimentações referentes à baixa da Ordem de Fornecimento
     */
    public function baixaOrdem(Request $request)
    {
        $ordem_fornecimento = \App\OrdemFornecimento::find($request->id);
        $ordem_itens = \App\Ordem_item::where('ordem_fornecimento_id', $ordem_fornecimento->id)->get();

        if (isset($ordem_fornecimento) || $ordem_fornecimento->ehcompleta == false) {
            $estoque = \App\Estoque::find($ordem_fornecimento->estoque_id);
            
            if (isset($ordem_itens)) {
                foreach ($ordem_itens as $ordem_item) {
                    if ($ordem_item->quantidade_restante > 0 && $ordem_item->quantidade_aceita > 0) {
                        //Itens de contrato removidos antes da baixa
                        $contrato_item = \App\Contrato_item::find($ordem_item->contratoitem_id);
                        $contrato_item->quantidade -= $ordem_item->quantidade_aceita;
                        $contrato_item->save();
                        
                        $estoque_item = \App\Estoque_item::where('item_id', $contrato_item->item_id)
                                                        ->where('contrato_id', $contrato_item->contrato_id)
                                                        ->where('data_validade', $ordem_item->data_validade)
                                                        ->where('n_lote', $ordem_item->n_lote)->first();

                        //Verifica se o item existia no estoque ou se criará um novo item
                        if (isset($estoque_item)) {
                            $estoque_item->quantidade += $ordem_item->quantidade_aceita;
                            $estoque_item->save();
                        } else {
                            $estoque_item = new \App\Estoque_item();
                            $estoque_item->item_id = $contrato_item->item_id;
                            $estoque_item->quantidade_danificados = 0;
                            $estoque_item->quantidade = $ordem_item->quantidade_aceita;
                            $estoque_item->estoque_id = $estoque->id;
                            $estoque_item->contrato_id = $contrato_item->contrato_id;
                            $estoque_item->n_lote = $ordem_item->n_lote;
                            $estoque_item->data_validade = $ordem_item->data_validade;
                            $estoque_item->save();
                        }

                        $ordem_item->quantidade_restante -= $ordem_item->quantidade_aceita;

                        $ordem_servicos = \App\OrdemServico::where('ordem_item_id', $ordem_item->id)->get();
                        $ordem_servico = new \App\OrdemServico();
                        $ordem_servico->ordem_item_id = $ordem_item->id;
                        $ordem_servico->quantidade = $ordem_item->quantidade_aceita;
                        $ordem_servico->observacao = $ordem_item->osbervacao;
                        $ordem_servico->n_ordem = count($ordem_servicos) + 1;
                        $ordem_servico->save();

                        $ordem_item->quantidade_aceita = 0;
                        $ordem_item->save();
                    }
                }
                $this->verificaRestante($ordem_fornecimento);
                session()->flash('success', 'Baixa realizada com sucesso.');
                return redirect()->route('/ordemfornecimento/listarOrdemEstoque', [
                    'id' => $estoque->id
                ]);
            }
            session()->flash('success', 'Não há itens.');
            return redirect()->route('/ordemfornecimento/listarOrdemEstoque', [
                'id' => $estoque->id
            ]);
        }
        session()->flash('success', 'A ordem não existe ou está completa.');
        return redirect()->route('/ordemfornecimento/listarOrdemEstoque', [
            'id' => $estoque->id
        ]);
    }

    /**
     * Atualiza as informações de um item de uma Ordem de Fornecimento
     * incluindo data de validade e lote
     */
    public function revisaItem(Request $request)
    {
        $ordem_item = \App\Ordem_item::find($request->id);

        $validator = Validator::make($request->all(), [
            'quantidade_aceita' => ['required', 'integer', 'min:0', 'max:'.$ordem_item->quantidade_restante],
            'n_lote' =>            ['required', 'string', 'max:255'],
            'data_validade' =>     ['required', 'after_or_equal:today']
            ],[
            'quantidade_aceita.required' => 'Quantidade é obrigatória',
            'quantidade_aceita.integer' => 'Quantidade deve ser um número',
            'quantidade_aceita.min' => 'Quantidade não pode ser inferior a zero',
            'quantidade_aceita.max' => 'Quantidade deve ser máximo '.$ordem_item->quantidade_restante.', o que ainda resta adquirir desse produto.',
          ]);
      
        if ($validator->fails()) {
            return redirect()->route('/ordemfornecimento/baixaItem', ['id' => $ordem_item->id])
                        ->withErrors($validator)
                        ->withInput();
        }

        if (isset($ordem_item)) {
            $ordem_item->quantidade_aceita = $request->quantidade_aceita;
            $ordem_item->n_lote = $request->n_lote;
            $ordem_item->data_validade = $request->data_validade;
            $ordem_item->save();

            return redirect()->route('/ordemfornecimento/novaBaixa', [
                'id' => $ordem_item->ordem_fornecimento_id
            ]);
        }

        return redirect()->back()->with('alert', 'O item não existe');
    }

    /**
     * Verifica se a Ordem de Fornecimento tem algum item restante
     */
    private function verificaRestante(OrdemFornecimento $ordem_fornecimento)
    {
        $ordem_flag = true;
        $ordem_itens = \App\Ordem_item::where('ordem_fornecimento_id', $ordem_fornecimento->id)->get();

        if (isset($request)) {
            foreach ($ordem_itens as $ordem_item) {
                if ($ordem_item->quantidade_restante != 0) {
                    $ordem_fornecimento->ehcompleta = false;
                    return null;
                } else {
                    
                }
            }
            $ordem_fornecimento->ehcompleta = true;
            $ordem_fornecimento->save();
        }
    }
}
