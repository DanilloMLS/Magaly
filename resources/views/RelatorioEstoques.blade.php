<html>
    <head>

    </head>
    <body>
        <table width="100%">
            <tr>
                <td align="center">
                    <img id="logo" src="./img/logo.png" width="80" alt="Logo">
                </td>
                <td><pre align="center">
Secretaria Municipal de Educação</br>
Rua: Siqueira Campos, 75 - Garanhuns PE</br>
Tel: (87)3762-7060
                    </pre>
                </td>
                <td>
                    <?php
                    echo "<p>".date("H").":".date("i").":".date("s"). "</p>";
                    echo "<p>".date("d")."/".date("m")."/".date("y"). "</p>";
                    ?>
                </td>
            </tr>
            <hr>
            <tr align="">
                <td align="center" colspan=3><h1 size="80">Estoques</h1></td>
            </tr>
        </table>
        <table width="100%" class="table table-hover">
            <tbody>
                <tr>
                    <th>Item</th>
                    <th>Unidade</th>
                    <th>Estoque</th>
                    <th>Data de validade</th>
                    <th>Nº lote</th>
                    <th>Gramatura</th>
                    <th>Descrição</th>
                </tr>
                @foreach ($estoques as $estoque)
                  @foreach (\App\Estoque_item::where('estoque_id', '=', $estoque->id)->get() as $item_estoque)
                      @php
                          $item = \App\Item::find($item_estoque->item_id);
                      @endphp
                      <tr>
                          <td data-title="Valor unitário">{{ $item->nome }}</td>
                          <td data-title="Unidade">{{ $item->unidade }}</td>
                          <td data-title="Nome">{{ $estoque->nome }}</td>
                          <td data-title="Data de validade">{{ $item->data_validade }}</td>
                          <td data-title="Nº lote">{{ $item->n_lote }}</td>
                          <td data-title="Gramatura">{{ $item->gramatura }}</td>
                          <td data-title="Descrição">{{ $item->descricao }}</td>
                      </tr>
                  @endforeach
              @endforeach
            </tbody>
        </table>
    </body>
</html>