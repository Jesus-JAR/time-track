<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Business;
use App\Rules\ValidationDni;
use App\Rules\ValidationPhone;
use Jantinnerezo\LivewireAlert\LivewireAlert;


use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    use PasswordValidationRules;
    use LivewireAlert;


    public $rol;
    public $search;

    public $sortBy = 'id';
    public $sortAsc = true;

    public $perPage = 5;
    public $showModal = 'hidden';

    public $user;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $dni;
    public $cod_emp = '';
    public $password;
    public $work_hours;
    public $password_confirmation;

    public $confirmingUserDeletion = false;
    public $confirmingUserAdd = false;


    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true]
    ];

    protected $listeners = [
      'userListUpdate' => 'render'
    ];

    public function rules()
    {
        return [
            'first_name' => ['regex:/^[\pL]+$/','required', 'string', 'min:3', 'max:15'],
            'last_name' => ['regex:/^[\pL]+$/','required', 'string', 'min:3', 'max:15'],
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => [new ValidationPhone, 'required',  'min:9', 'max:12'],
            'dni' => [new ValidationDni, 'required', 'string', 'unique:users,dni'],
            'password' => $this->passwordRules(),
            'work_hours' => 'numeric|min:6',
            'cod_emp' => 'required'

        ];
    }

    protected $messages = [
        'first_name.required' => 'The first name cannot be empty.',
        'first_name.min' => 'Must contain at least 3 characters.',
        'first_name.max' => 'Must contain a maximum of 16 characters.',
        'last_name.required' => 'The last name cannot be empty.',
        'last_name.min' => 'Must contain at least 3 characters.',
        'last_name.max' => 'Must contain a maximum of 16 characters.',
        'cod_emp.required' => 'Select Company'


    ];

    public function render()
    {
        if (auth()->user()->hasRole('Super Admin')){
            // para que no muestre los super administradores en la tabla
            $users = User::where('cod_emp' , '>', 1)
                ->when($this->search, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');

                    });
                })
                ->orderBy($this->sortBy,  $this->sortAsc ? 'ASC' : 'DESC');

            $users = $users->paginate($this->perPage);

        }else{


            $users = User::where('cod_emp' , '=', auth()->user()->getAttribute('cod_emp'))
                ->when($this->search, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');

                    });
                })
                ->orderBy($this->sortBy,  $this->sortAsc ? 'ASC' : 'DESC');

            $users = $users->paginate($this->perPage);


        }

        $companies = Business::where('id', '=', auth()->user()->getAuthIdentifier())
            ->select('name')->get();


        return view('livewire.users', [
            'users' => $users,
            'companies' => $companies
        ]);
    }


        // limpiar todos los campos
        public function clear()
        {
            $this->reset();
        }

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($field == $this->sortBy){
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;

    }

    public function confirmUserDeletion($id)
    {
        $this->confirmingUserDeletion = $id;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        $this->confirmingUserDeletion = false;
    }


    public function confirmUserAdd()
    {
        $this->reset();
        $this->confirmingUserAdd = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showModal(User $user)
    {
        $this->emit('showModal', $user);
    }

    public function saveUser()
    {
        $validatedData = $this->validate();
        $this->user =User::create($validatedData)->assignRole($this->rol);
        $this->confirmingUserAdd = false;
        $this->alert('success', 'User successfully added!');
        $this->user->sendEmailVerificationNotification();
    }

}
