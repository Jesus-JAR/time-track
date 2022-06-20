<?php

namespace App\Http\Livewire;

use App\Http\Requests\RequestUpdateBusiness;
use Livewire\Component;
use App\Models\Business;
use Jantinnerezo\LivewireAlert\LivewireAlert;




class LiveModalBusiness extends Component
{

    use LivewireAlert;


    protected $listeners = [
        'showModal',
        'showModalNewBusiness'
    ];
    public $showModal = 'hidden';

    // validacion
    public $name;
    public $address;
    public $description;
    public $business;
    public $action = '';
    public $method = '';
    public $title = '';



    public function render()
    {
        return view('livewire.live-modal-business');
    }

    public function showModal(Business $business)
    {
        $this->business = $business;
        $this->name = $business->name;
        $this->address = $business->address;
        $this->description = $business->description;
        // actualizar
        $this->action = 'Update';
        $this->method = 'updateBusiness';
        $this->title = 'Edit Business';
        $this->showModal = 'fixed';
    }

    public function showModalNewBusiness()
    {
        $this->business = null;

        // Crear business
        $this->action = 'Create';
        $this->method = 'createBusiness';
        $this->title = 'New Business';
        $this->showModal = 'fixed';

    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function updateBusiness()
    {
        // llamamos a la validacion requestupdatebusiness
        $requestBusiness = new RequestUpdateBusiness();
        $values = $this->validate($requestBusiness->rules($this->business), $requestBusiness->messages());
        $this->business->update($values);
        $this->alert('success', 'Business successfully updated!');
        $this->emit('businessListUpdate');
        $this->reset();
    }

    public function updated($propertyName)
    {
        $requestBusiness = new RequestUpdateBusiness();
        $this->validateOnly($propertyName, $requestBusiness->rules($this->business), $requestBusiness->messages());
    }

    public function createBusiness()
    {

        $requestBusiness = new RequestUpdateBusiness();
        $values = $this->validate($requestBusiness->rules($this->business), $requestBusiness->messages());
        //dd($values);
        $business = new Business();
        $business->fill($values);
        $business->save();

        $this->alert('success', 'Business successfully added!');
        $this->emit('businessListCreate');
        $this->reset();
        $this->closeModal();
    }

}
