@extends('layouts.app')

@section('content')

<script type="text/javascript">
  function tableInit() {
    creche_integral.style.display = "none";
    creche_parcial.style.display = "none";
    infantil.style.display = "none";

  }

  function tableChange(selectObj) {
  	var idx = selectObj.selectedIndex;
  	var which = selectObj.options[idx].value;
    var creche_integral = document.getElementById("creche_integral");
    var creche_parcial = document.getElementById("creche_parcial");
    var infantil = document.getElementById("infantil");
    switch (which) {
  		case "0":
  			creche_integral.style.display = "none";
   			creche_parcial.style.display = "none";
        infantil.style.display = "none";
   			break;
  		case "1":
  			creche_integral.style.display = "block";
   			creche_parcial.style.display = "none";
        infantil.style.display = "none";
   			break;
  		case "2":
  			creche_integral.style.display = "none";
   			creche_parcial.style.display = "block";
        infantil.style.display = "none";
   			break;
      case "3":
    		creche_integral.style.display = "none";
   			creche_parcial.style.display = "none";
        infantil.style.display = "block";
   			break;
      case "4":
      	creche_integral.style.display = "none";
     		creche_parcial.style.display = "none";
        infantil.style.display = "block";
     		break;
      case "5":
        creche_integral.style.display = "none";
       	creche_parcial.style.display = "none";
        infantil.style.display = "block";
       	break;
      case "6":
        creche_integral.style.display = "none";
    		creche_parcial.style.display = "none";
        infantil.style.display = "block";
        break;
   	}
  }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Cardápio') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                      {{ csrf_field() }}
                        @csrf

                        <div class="form-group row">
                            <label for="modalidade_ensino" class="col-md-4 col-form-label text-md-right">{{ __('Modalidade de ensino') }}</label>
                            <div class="col-md-6">
                              <select class="form-control" id="modalidade_ensino" onchange="tableChange(this);" name="modalidade_ensino" required>
      								              <option value="0">Selecione uma Modalidade de ensino</option>
      									            <option value="1">Creche Infantil Integral</option>
                                    <option value="2">Creche Infantil Parcial</option>
                                    <option value="3">Infantil (pré-escola)</option>
                                    <option value="4">Ensino Fundamental</option>
                                    <option value="5">EJA</option>
                                    <option value="6">Quilombola</option>
                              </select>
                            </div>
                         </div>

                         <div class="form-group row">
                             <label for="mes" class="col-md-4 col-form-label text-md-right">{{ __('Mês/ano') }}</label>
                             <div class="col-md-6">
                               <input type="mes" id="mes" name="mes" min="2018-03" placeholder="06/2018">
                             </div>
                          </div>

                         <div id="creche_integral">
                           <div id="tabela_integral" class="table-responsive">
                             <table class="table table-hover">
                               <thead>
                                 <tr>
                                     <th>Segunda</th>
                                     <th>Terça</th>
                                     <th>Quarta</th>
                                     <th>Quinta</th>
                                     <th>Sexta</th>
                                 </tr>
                               </thead>
                               <tbody>
                                   <tr>
                                       <td data-title="Segunda">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Terça">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Quarta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Quinta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Sexta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>

                                   </tr>
                                   <tr>
                                       <td data-title="Segunda">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                         <td data-title="Terça">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                         <td data-title="Quarta">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                         <td data-title="Quinta">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                         <td data-title="Sexta">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                   </tr>
                                   <tr>
                                       <td data-title="Segunda">
                                         <a class="btn btn-primary" href="">Refeição 3</a>
                                         </td>
                                         <td data-title="Terça">
                                         <a class="btn btn-primary" href="">Refeição 3</a>
                                         </td>
                                         <td data-title="Quarta">
                                         <a class="btn btn-primary" href="">Refeição 3</a>
                                         </td>
                                         <td data-title="Quinta">
                                         <a class="btn btn-primary" href="">Refeição 3</a>
                                         </td>
                                         <td data-title="Sexta">
                                         <a class="btn btn-primary" href="">Refeição 3</a>
                                         </td>
                                   </tr>

                               </tbody>
                             </table>
                           </div>
                         </div>
                         <div id="creche_parcial">
                           <div id="tabela_parcial" class="table-responsive">
                             <table class="table table-hover">
                               <thead>
                                 <tr>
                                     <th>Segunda</th>
                                     <th>Terça</th>
                                     <th>Quarta</th>
                                     <th>Quinta</th>
                                     <th>Sexta</th>
                                 </tr>
                               </thead>
                               <tbody>
                                   <tr>
                                       <td data-title="Segunda">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Terça">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Quarta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Quinta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Sexta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>

                                   </tr>
                                   <tr>
                                       <td data-title="Segunda">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                         <td data-title="Terça">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                         <td data-title="Quarta">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                         <td data-title="Quinta">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                         <td data-title="Sexta">
                                         <a class="btn btn-primary" href="">Refeição 2</a>
                                         </td>
                                   </tr>

                               </tbody>
                             </table>
                           </div>
                         </div>
                         <div id="infantil">
                           <div id="tabela_infantil" class="table-responsive">
                             <table class="table table-hover">
                               <thead>
                                 <tr>
                                     <th>Segunda</th>
                                     <th>Terça</th>
                                     <th>Quarta</th>
                                     <th>Quinta</th>
                                     <th>Sexta</th>
                                 </tr>
                               </thead>
                               <tbody>
                                   <tr>
                                       <td data-title="Segunda">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Terça">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Quarta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Quinta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>
                                       <td data-title="Sexta">
                                       <a class="btn btn-primary" href="">Refeição 1</a>
                                       </td>

                                   </tr>

                               </tbody>
                             </table>
                           </div>
                         </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                              <button type="submit" class="btn btn-primary">
                                  Inserir Cardápio
                              </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
tableInit();
</script>
@endsection
