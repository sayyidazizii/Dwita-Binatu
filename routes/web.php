<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesInvoiceController;
use App\Http\Controllers\InvItemController;
use App\Models\InvItem;
use Illuminate\Support\Facades\Auth;

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
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sales-invoice', [SalesInvoiceController::class, 'index'])->name('index');
Route::get('/sales-invoice/history', [SalesInvoiceController::class, 'history'])->name('history');
Route::post('/sales-invoice/elements-add/', [SalesInvoiceController::class, 'elements_add'])->name('elements-add-sales-invoice');
Route::get('/sales-invoice/delete/{sales_invoice_item_temp_id}', [SalesInvoiceController::class, 'deleteItem'])->name('delete-item-temp');
Route::post('/sales-invoice/add', [SalesInvoiceController::class, 'processAdd'])->name('process-add-sales-invoice');
Route::get('/sales-invoice/refresh', [SalesInvoiceController::class, 'refresh'])->name('refresh-sales-invoice');
Route::post('/sales-invoice/add-array', [SalesInvoiceController::class, 'processAddArraySalesOrderItem'])->name('sales-invoice-add-array');
Route::get('/sales-invoice/print/{sales_invoice_id}', [SalesInvoiceController::class, 'print'])->name('print-sales-invoice-repeat');
Route::get('/sales-invoice/printSalesInvoice', [SalesInvoiceController::class, 'printSalesInvoice'])->name('print-sales-invoice');



Route::get('/inv-item', [InvItemController::class, 'index'])->name('inv-item');
Route::post('/inv-item/process-add-item', [InvItemController::class, 'processAddBarang'])->name('process-add-item');
Route::get('/inv-item/edit-item/{item_id}', [InvItemController::class, 'EditBarang'])->name('edit-item');
Route::post('/inv-item/process-edit-item', [InvItemController::class, 'ProcessEditBarang'])->name('process-edit-item');
Route::get('/hapus-item/{item_id}', [InvItemController::class, 'deleteBarang'])->name('hapus-item');