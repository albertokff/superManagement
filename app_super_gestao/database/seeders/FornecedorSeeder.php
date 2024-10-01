<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Forma 1: instanciando o objeto
        // $fornecedor = new Fornecedor();
        // $fornecedor->nome = 'Fornecedor 100';
        // $fornecedor->site = 'fornecedor100.com.br';
        // $fornecedor->uf = 'CE';
        // $fornecedor->email = 'contato@fornecedor100.com.br';
        // $fornecedor->save();

        // Forma 2: Método create
        // Fornecedor::create([
        //     'nome' => 'Fornecedor 200',
        //     'site' => 'fornecedor200.com.br',
        //     'uf' => 'RS',
        //     'email' => 'contato@fornecedor200.com.br'
        // ]);

        // Forma 3: Insert
        // DB::table('fornecedores')->insert([
        //     'nome' => 'Fornecedor 300',
        //     'site' => 'fornecedor300.com.br',
        //     'uf' => 'SP',
        //     'email' => 'contato@fornecedor300.com.br'
        // ]);

        Fornecedor::factory()->count(50)->create();
    }
}
