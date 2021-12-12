<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeshboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ServicingController;
use App\Models\Servicing;
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
*/

// Route::get('/', function () {
//     return view('deshboard.deshboard', ['deshboard_active'=> 'active']);
// });


Route::get('/', [DeshboardController::class, 'index']);
// customer route 
Route::get('/customer/add', function () {
    $data = [
        'customer_active'=> 'active',
        'customer_add_active'=> 'active',
    ];
    return view('customer.add', $data);
}); 
Route::post('customer', [CustomerController::class, 'add'])->name('customer.add');
Route::get('customer/all', [CustomerController::class, 'all']);
Route::get('customer/{customer}/servicing', [CustomerController::class, 'servicing_view']);
Route::get('customer/{customer}/sell', [CustomerController::class, 'sell_view']);
Route::get('customer/{customer}/profile', [CustomerController::class, 'profile']);
Route::post('customer/{customer}/update', [CustomerController::class, 'update'])->name('customer.update');
// customer route end


// servicing route
// Route::get('servicing/{id}/add_servicing', [ServicingController::class, 'add_servicing']);
Route::get('servicing/{id}/add_servicing', [ServicingController::class, 'add_servicing']);
Route::get('servicing/{id}/servicing_details', [ServicingController::class, 'servicing_details']);
Route::get('servicing/all_togather', [ServicingController::class, 'all_togather']);

Route::post('servicing/{customer}/add', [ServicingController::class, 'add_process'])->name('servicing.add');

Route::post('servicing/{servicing}/update', [ServicingController::class, 'servicing_update'])->name('servicing.update');
Route::delete('servicing/{servicing}/delete', [ServicingController::class, 'servicing_delete'])->name('servicing.delete');

// servicing route end


// order and sell route
Route::post('order/{customer}/new_order', [OrderController::class, 'new_order'])->name('sell.add_new');
Route::get('order/{order}/view', [OrderController::class, 'index']);
Route::post('order/{order}/update', [OrderController::class, 'update'])->name('order.update');
Route::delete('order/{order}/delete', [OrderController::class, 'delete'])->name('order.delete');
Route::get('order/{order}/print', [OrderController::class, 'print']);

Route::get('sell/all_togather', [SellController::class, 'all_togather']);
Route::get('sell/{order}/take', [SellController::class, 'take']);
Route::get('sell/{sell}/update', [SellController::class, 'update_form']);
Route::post('sell/{sell}/update', [SellController::class, 'update'])->name('sell.update');
Route::delete('sell/{sell}/delete', [SellController::class, 'delete'])->name('sell.delete');

Route::post('sell/{order}/add', [SellController::class, 'add'])->name('sell.add');
// order and sell route end
