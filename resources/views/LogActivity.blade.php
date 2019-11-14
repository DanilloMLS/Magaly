@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Logs') }}</div>

                <div class="card-body">

                  @if (\Session::has('success'))
                  <br>
                      <div class="alert alert-success">
                          {!! \Session::get('success') !!}
                      </div>
                  @endif
                  <div class="panel-body">
                          <br>
                        <div id="tabela" class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Subject</th>
                                  <th>URL</th>
                                  <th>Method</th>
								  <th>IP</th>
								  <th>User Agent</th>
								  <th>User ID</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($logs as $log)
                                <tr>
                                    <td data-title="#">{{ $log->id }}</td>
                                    <td data-title="Subject">{{ $log->subject }}</td>
                                    <td data-title="URL">{{ $log->url }}</td>
                                    <td data-title="Method">{{ $log->method }}</td>
									<td data-title="IP">{{ $log->ip }}</td>
									<td data-title="User Agent">{{ $log->agent }}</td>
									<td data-title="User ID">{{ $log->user_id }}</td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function buscar() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("termo");
      filter = input.value.toUpperCase();
      table = document.getElementById("tabela");
      tr = table.getElementsByTagName("tr");
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>
@endsection