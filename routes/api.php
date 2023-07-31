<?php

use App\Http\Controllers\ApiCustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('customers')->group( function () {
    // Lấy ra danh sách khách hàng
    Route::get('/', [ApiCustomerController::class, 'index']);

    // Lấy thông tin chi tiết
    Route::get('/{id}', [ApiCustomerController::class, 'show']);

    // Thêm thông tin khách hàng
    Route::post('/', [ApiCustomerController::class, 'store']);

    // Cập nhật thông tin khách hàng
    Route::put('/{id}', [ApiCustomerController::class, 'update']);

    // Xóa thông tin khách hàng
    Route::delete('/{id}', [ApiCustomerController::class, 'destroy']);
});
