<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;

/*
Route::get('/', function () {
    return 'Olá, seja bem-vindo ao curso!';
});

Route::get('/about', function() {
    return 'Sobre nós';
});
 
Route::get('/contact', function() {
    return 'Contato';
});
*/

Route::get('/', [PrincipalController::class, 'principal'])->name('site.principal');
Route::get('/about', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');
Route::get('/contact', [ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contact', [ContatoController::class, 'salvar'])->name('site.contato');
Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');

Route::get('/contato/{nome}/{categoria_id}', //
    function(
        string $nome = 'Desconhecido', 
        int $categoria_id = 1
    ) {
        echo "Estamos aqui: $nome - $categoria_id";

    }
)->where('categoria_id', '[0-9]+')->where('nome', '[A-Za-z]+');

Route::get('/teste/{p1}/{p2}', 'App\Http\Controllers\TesteController@teste')->name('teste');

Route::middleware('log.acesso', 'autenticacao:ldap,visitante')->prefix('/app')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');
    
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');

    // Route::get('/produto', [ProdutoController::class, 'index'])->name('app.produto');

    //Resource - O comando abaixo irá gerar automaticamente as rotas para os métodos que o controller que foi criado com a flag -r
    Route::resource('produto', ProdutoController::class); 

    Route::resource('produto-detalhe', ProdutoDetalheController::class);

    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    // Route::resource('pedido-produto', PedidoProdutoController::class);
    Route::get('pedido-produto/create/{pedido}', [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
    // Route::get('pedido-produto.destroy/{pedido}/{produto}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
    Route::get('pedido-produto.destroy/{pedidoProduto}/{pedido_id}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
});