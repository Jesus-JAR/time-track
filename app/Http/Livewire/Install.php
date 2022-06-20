<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Rules\ValidationDni;
use Livewire\Component;


class Install extends Component
{
    public $first_name, $email, $dni, $password;

    public function render()
    {
        return view('livewire.install');
    }

    protected $rules = [

        'first_name' => ['regex:/^[\pL]+$/','required', 'string', 'min:3', 'max:15'],
        'email' => 'required|email',
        'dni' => 'new ValidationDni()|required|string|unique:users,dni',

    ];


    public function updated($propertyName)

    {
        $this->validateOnly($propertyName);
    }



    public function saveContact()

    {
        $validatedData = $this->validate();
        User::create($validatedData);
    }
}
