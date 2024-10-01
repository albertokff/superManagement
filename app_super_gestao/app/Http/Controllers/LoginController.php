<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request) {
        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = 'Usuário e ou senha não existente';
        }

        if ($request->get('erro') == 2) {
            $erro = 'Necessário realizar o login para ter acesso a página!';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request) {

        //regras de validação
        $regras = [
            'usuario' => 'email',
            'password' => 'required'
        ];

        //as mensagens de feedback de validação
        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) é obrigatório',
            'password.required' => 'O campo senha é obrigatório'
        ];

        //se não passar pelo validate, é feito um redirect para a rota antiga
        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('password');

        //iniciar o Model User
        $user = new User();

        $usuario = $user->where('email', $email)
                        ->where('password', $password)
                        ->get()
                        ->first();             

        if(isset($usuario->name)) {
            
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }        
    }

    public function sair() {
        session_destroy();

        return redirect()->route('site.principal');
    }
}
