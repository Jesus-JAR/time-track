<?php

namespace App\Http\Livewire;

//use App\Models\Business;

use App\Models\Business as ModelsBusiness;
use Livewire\Component;
use Livewire\WithPagination;

class Business extends Component
{

    // para poder usar la paginacion
    use WithPagination;

    // Variable
    public $search; //busqueda
    public $perPage;//elegir paginas

    public $confirmBusinessDeletion = false;

    // iconos
    public $camp = null;
    public $order = null;
    public $icon = 'circle';


    protected $queryString = [
        'search' => ['except' => ''],
        'camp' => ['except' => null],
        'order' => ['except' => null],
    ];

    // para actualizar la pagina y que sea dinamica al editar o crear empresa
    protected $listeners = [
        'businessListUpdate' => 'render',
        'businessListCreate' => 'render'
    ];


    public function render()
    {
        // mostramos o todas las empresas o la perteneciente al usario admin logueado
        if(auth()->user()->hasRole('Super Admin')){

            $business = ModelsBusiness::where('name', 'like', "%{$this->search}%")
            ->orWhere('address', 'like', "%$this->search%");

        }else{

            $business = ModelsBusiness::where('id', '=',  auth()->user()->getAttribute('cod_emp'));
        }

        // condicional para comprobar que no sea nulo los campos
        if ($this->camp && $this->order) {
            $business = $business->orderBy($this->camp, $this->order);
        } else {
            $this->camp = null;
            $this->order = null;
        }
        $business = $business->paginate($this->perPage);

        // llamamos a la vista para mostrar empresas
        return view('livewire.business', [

            'business' => $business
        ]);
    }

    // para no perder los ordenes de la pagina al actualizar
    public function mount()
    {
        $this->icon = $this->iconDirection($this->order);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // limpiar todos los campos
    public function clear()
    {
        $this->page = 1;
        $this->order = null;
        $this->camp = null;
        $this->icon = '';
        $this->search = '';
        $this->perPage = null;
    }

    public function sortable($camp)
    {
        if ($camp !== $this->camp) {
            $this->order = null;
        }
        switch ($this->order) {
            case null:
                $this->order = 'asc';
                break;
            case 'asc':
                $this->order = 'desc';
                break;
            case 'desc':
                $this->order = null;
                break;
        }
        $this->icon  = $this->iconDirection($this->order);
        $this->camp = $camp;
    }

    public function iconDirection($sort): string
    {
        if (!$sort) {

            return '';
        } else {

            return $sort === 'asc' ? 'up' : 'down';
        }
    }

    // eliminar empresa
    public function confirmBusinessDeletion($id)
    {
        $this->confirmBusinessDeletion = $id;
    }

    public function deleteBusiness(ModelsBusiness $business)
    {
        $business->delete();
        $this->confirmBusinessDeletion = false;
    }

    public function showModal(ModelsBusiness $business)
    {
        if($business->name){
            $this->emit('showModal', $business);
        }else{
            $this->emit('showModalNewBusiness');

        }



    }


}
