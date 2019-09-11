<?php
namespace App\Http\Middleware;
use Closure;
class AdmMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::guest()){
            return redirect('login');
        }else{
              $rotas_fornecedor = [
              "fornecedor/cadastrar",
              "fornecedor/editar/{id}",
              "fornecedor/salvar",
              "fornecedor/remover/{id}",
              ];
              $rotas_contrato = [
              "contrato/telaCadastrar",
              "contrato/cadastrar",
              "contrato/inserirItem",
              "contrato/removerItem/{id}",
              "contrato/finalizarContrato/{id}",
              ];
              $rotas_escola = [
              "escola/cadastrar",
              "escola/editar/{id}",
              "escola/salvar",
              "escola/remover/{id}",
              ];
              $rotas_distribuicao = [
              "distribuicao/telaCadastrar",
              "distribuicao/cadastrar",
              "distribuicao/editar/{id}",
              "distribuicao/salvar",
              "distribuicao/remover/{id}",
              "distribuicao/inserirItem",
              "distribuicao/removerItem/{id}",
              "distribuicao/finalizarDistribuicao/{id}",
              "itemDistribuicao/editar/{id}",
              "itemDistribuicao/salvar",
              ];
              $rotas_itens = [
              "item/telaCadastrar",
              "item/cadastrar",
              "item/editar/{id}",
              "item/salvar",
              "item/remover/{id}",
              ];
              $rotas_estoque = [
              "estoque/cadastrar",
              "estoque/editar/{id}",
              "estoque/salvar",
              "estoque/remover/{id}",
              "estoque/finalizarEstoque/{id}",
              "estoque/novoItem",
              "estoque/novoItemEstoque/{id}",
              "estoque/removerItem/{id}",
              "estoque/inserirEntrada/{id}",
              "estoque/abrirEntrada",
              "estoque/inserirSaida/{id}",
              "estoque/abrirSaida",
              ];
              $rotas_refeicao = [
              "refeicao/cadastrar",
              "refeicao/editar/{id}",
              "refeicao/salvar",
              "refeicao/remover/{id}",
              "refeicao/inserirItem",
              "refeicao/removerItem/{id}",
              "refeicao/finalizarRefeicao/{id}",
              "itemRefeicao/editar/{id}",
              "itemRefeicao/salvar",
              ];
              $rotas_cardapio = [
              "cardapio/cadastrar",
              "cardapioSemanal/cadastrar",
              "cardapio/salvar",
              "cardapio/inserirRefeicao/{dia}/{cardapio_semanal}/{cardapio_mensal}/{refeicao}",
              "cardapio/inserirItem",
              "cardapioDiario/finalizarCardapio/{id}",
              "cardapioMensal/finalizarCardapio",
              "cardapio/removerItem/{id}",
              ];
              if(!(\Auth::user()->is_adm)){
                  return redirect("/home")->with('denied','Você tentou acessar uma página que você não tem permissão.');
              }
        }
        return $next($request);
    }
}
