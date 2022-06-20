
<?php


use App\Http\Controllers\InicioAppController;
use App\Http\Livewire\CheckIn;
use App\Models\User;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
Encargada de redireccionar segun los sitios que se visita
*/


$users = User::all()->isEmpty();
if ($users){
    Route::get('/', [InicioAppController::class, 'create']);
    Route::post('/', [InicioAppController::class, 'store']);
}else{
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
}


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'

])->group(callback: function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    /*
     * users
     */
    Route::get('/users', function () {
        return view('users.users');
    })->name('users');

        /*
     * business
     */
    Route::get('/business', function () {
        return view('business.business');
    })->name('business');

    /*
     *  Check in
     */
    Route::get('/check-in', function () {
        return view('records.check-in');
    })->name('check');

        /*
     *  Bussines
     */
    Route::get('/bussines', function () {
        return view('bussines.bussines');
    })->name('bussines');

    /*
    *  Pdf
     */
    Route::get('download-pdf', [CheckIn::class,'downloadPDF'])->name('download-pdf');


});
