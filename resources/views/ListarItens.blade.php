@extends('layouts.app')

@section('content')


<table id="tabela-01" class="display">
  <thead>
    <tr>
        <th>Nome</th>
        <th>Marca</th>
        <th>Descrição</th>
        <th>Gramatura</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($itens as $item)
      <tr>
          <td data-title="Nome">{{ $item->nome }}</td>
          <td data-title="Marca">{{ $item->marca }}</td>
          <td data-title="Descrição">{{ $item->descricao }}</td>
          <td data-title="Gramatura">{{ $item->gramatura }}{{ $item->unidade }}</td>

          @if (Auth::guard()->check() && Auth::user()->tipo_user == 'adm')
            <td align="right">
                <a class="btn btn-primary" href="{{ route ("/item/editar", ['id' => $item->id])}}">
                    <img src="/img/edit.png" class="tamIconsPadrao">
                </a>
            </td>
          @endif
      </tr>
    @endforeach
  </tbody>
</table>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.10/js/jquery.datatables.min.js"></script>

<script>
  $(document).ready( function () {
    $('#tabela-01').DataTable();
  } );
</script>


@endsection
