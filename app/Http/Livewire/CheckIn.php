<?php

namespace App\Http\Livewire;

use App\Models\Records;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Business;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class CheckIn extends Component
{
    use WithPagination;
    use LivewireAlert;// libreria para importar los sweetalert

    // variable de busqueda
    public $date;

    // variable de funciones livewire entrada y salida
    public $check_in;
    public $check_out = false;

    // variables para los insert table
    public $LastInsertId;
    public $hour_in;
    public $hour_out;
    public $created_at;
    public $record_id;
    public $valor;
    public $create_record;
    public $jornada;
    public $gm;

    public $enter;
    public $exit;


    public $day;
    public $total;

    // alerta
    public $alert;


    public $confirmingCheckInAdd = false;

    // variables protegidas
    protected $queryString = [
        'date' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    /*
     *  Sort
     */
    public $sortBy = 'id';
    public $sortAsc = true;

    public function render()
    {

        // mostramos solo los registros del usuario logueado
        $records = Records::where('user_id', auth()->user()->id)
            ->when($this->date, function ($query) {
                return $query->where(function ($query) {
                    $query->whereDate('created_at', '=', $this->date);
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');
        $query = $records->toSql();
        $records = $records->paginate(10);

        /*
         * show company
         */
        $companies = Business::where('id', '=', auth()->user()->getAttribute('cod_emp'))
            ->select('name')->get();

        return view('livewire.check-in', [
            'records' => $records,
            'query' => $query,
            'companies' => $companies,
            'this->gm' => $this->gm,
        ]);
    }



    public function updatingDate()
    {
        $this->resetPage();
    }

    // ordenar tabla
    public function sortBy($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function confirmingCheckInAdd()
    {
        $this->confirmingCheckInAdd = true;
    }

    /*
     *  check in
     */
    public function check_in()
    {

        // iniciamos esto si no hay ningun registro en la tabla
        if (Records::all()->where('user_id', '=', auth()->id())->isEmpty()) {

            $this->create_record = auth()->user()->records()
                ->create([
                    'hour_in' => now(),
                ]);


        } else {// iniciamos esto si hay algún registro en la tabla

            $this->created_at = Records::all()
                ->where('user_id', '=', auth()->id())->last()->getAttribute('hour_out');

            $this->day = Records::all()
                ->where('user_id', '=', auth()->id())->last()->getAttribute('created_at');

            if ($this->created_at) {
                $this->create_record = auth()->user()->records()
                    ->create([
                        'hour_in' => now(),
                    ]);
            } else { // comprobamos que la tabla records entro y salio si no salio mostramos el alert
                // sweetalert
                $this->alert('warning', '', [
                    'position' => 'center',
                    'timer' => '4000',
                    'toast' => false,
                    'text' => 'You are already inside you must go out. Thanks',
                    'showCancelButton' => false,
                    'onDismissed' => '',
                    'width' => '',
                    'cancelButtonText' => 'Cancel',
                    'showDenyButton' => false,
                    'onDenied' => '',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'EXIT',
                ]);
            }
        }

    }

    public function check_out()
    {
        // constante guardar el id del urltimo registro
        $this->LastInsertId = Records::all()->last()->getAttribute('id');
        config(['app.record_id' => $this->LastInsertId]);
        $this->valor = config('app.record_id');
        /**************************************/


        $this->enter = Records::all()
            ->where('user_id', '=', auth()->id())->last()->getAttribute('hour_in');

        $this->exit = Records::all()
            ->where('user_id', '=', auth()->id())->last()->getAttribute('hour_out');

        // salida
        if ($this->enter !== null and $this->exit === null) {
            auth()->user()->records()
                ->where('id', '=', $this->valor)
                ->update([
                    'hour_out' => now()
                ]);
            $this->alert = true;


            // pasamos a modelo carbon la entrada y salida para poder calcular el tiempo transcurrido con la funcion diffInSeconds
            $entrada = Carbon::parse(Records::all()->last()->getAttribute('hour_in'));
            $salida = Carbon::parse(Records::all()->last()->getAttribute('hour_out'));

            $this->total = $entrada->diffInSeconds($salida, false, false, 2);


            // total
            auth()->user()->records()
                ->where('id', '=', $this->valor)
                ->update([
                    'total_check' => $this->total,
                ]);



            $this->jornada = Records::whereDate('created_at', now()->format('Y-m-d'))
                ->sum('total_check');

            $this->gm =  gmdate("H:i:s", $this->jornada);


            // total day
            auth()->user()->records()
                ->where('id', '=', $this->valor)
                ->update([
                    'total_day' => $this->gm,
                ]);
        }
    }

    // generamos el pdf
    public function downloadPDF()
    {

        $fin = Carbon::now()->format('Y-m-d');
        $records = Records::where('user_id', auth()->user()->id)->get();
        $pdf = PDF::loadView('pdf.pdf', ['records' => $records]);
        return $pdf->download('records_'.$fin.'.pdf');
    }
}
