<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customer', [CustomerController::class, 'index']);

Route::get('/customer/{id}', [CustomerController::class, 'index']);

Route::get('/hinh_chu_nhat/{chieu_dai}/{chieu_rong}', [CustomerController::class, 'hinh_chu_nhat']);

Route::get('/listCustomer', [CustomerController::class, 'customer']);

Route::get('/customers', [CustomerController::class, 'listCustomer']);
// khi tòn tại 1 acction thì sẽ thực hiện route post
Route::post('/customers', [CustomerController::class, 'listCustomer'])->name('search_customer');

// match cho phép các bạn truy cập 1 hoặc nhiều phương thức khác nhau
Route::match(['get', 'post'], '/customers/add', [CustomerController::class, 'add_customer'])->name('add_customer');

// Sửa thông tin khách hàng
Route::match(['get', 'post'], '/customers/edit/{id}', [CustomerController::class, 'edit_customer'])->name('edit_customer');

Route::get('/customers/delete/{id}', [CustomerController::class, 'delete_customer'])->name('delete_customer');