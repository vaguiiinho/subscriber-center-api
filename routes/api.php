<?php

use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\InvoiceController;
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

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});

Route::apiResource(
    name: '/invoices',
    controller: InvoiceController::class
);

Route::apiResource(
    name: '/contracts',
    controller: ContractController::class
);
