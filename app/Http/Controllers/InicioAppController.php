<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Rules\ValidationDni;
use Illuminate\Http\Request;

/*
*   Iniciamos este controlador cuando se inicia por primera vez la aplicacion y creamos el usuario super admin
*/

class InicioAppController extends Controller
{
    use PasswordValidationRules;
    public $fist_name;


    public function create()
    {
        return view('users.inicio-app');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'first_name' => ['regex:/^[\pL]+$/', 'required', 'string', 'min:3', 'max:15'],
            'dni' => [new ValidationDni, 'required', 'string', 'unique:users,dni'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ]);
        $data = request()->all();
        $data['cod_emp'] = 1;
        $data['last_name'] = "";
        $data['phone'] = "";
        $user = User::create($data)->assignRole('Super Admin');

        auth()->login($user);
        return redirect()->to('dashboard');
    }
}
