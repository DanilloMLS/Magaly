<?php

use Illuminate\Database\Seeder;
use App\Contrato;
use Illuminate\Support\DateFactory;
use Faker\Provider\tr_TR\DateTime;

class ContratoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contrato::create([
            'data'=>date_create(),
            'valor_total'=>3000,
            'n_contrato'=>'001',
            'n_processo_licitatorio'=>'002',
            'descricao'=>'Fornecedor de testes 1',
            'fornecedor_id'=>1
        ]);
        Contrato::create([
            'data'=>date_create(),
            'valor_total'=>3000,
            'n_contrato'=>'001',
            'n_processo_licitatorio'=>'002',
            'descricao'=>'Fornecedor de testes 1',
            'fornecedor_id'=>2
        ]);
        Contrato::create([
            'data'=>date_create(),
            'valor_total'=>3000,
            'n_contrato'=>'001',
            'n_processo_licitatorio'=>'002',
            'descricao'=>'Fornecedor de testes 1',
            'fornecedor_id'=>3
        ]);
    }
}
