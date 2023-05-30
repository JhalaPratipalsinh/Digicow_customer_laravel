<?php

use App\Http\Controllers\CowCalfController;
use App\Http\Controllers\CowControllere;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecordMilkProductionController;
use App\Http\Middleware\DataTablePaginate;
use App\Http\Middleware\UserMiddleware;
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
    return view('auth.login');
});

Route::post('authenticate', [LoginController::class, 'checkAuth']);
Route::get('logout', [LoginController::class, 'logout']);


Route::group(['middleware' => UserMiddleware::class] , function(){

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::prefix('cow')->group(function () {
        Route::get('new-register', [CowControllere::class, 'newRegister']);
        Route::post('register-store', [CowControllere::class, 'registerStore']);

        Route::get('sold-register', [CowControllere::class, 'soldRegister']);
        Route::post('sold-store', [CowControllere::class, 'soldRegisterStore']);

        Route::get('dead-register', [CowControllere::class, 'deadRegister']);
        Route::post('dead-store', [CowControllere::class, 'deadRegisterStore']);

        Route::get('genetic-register', [CowControllere::class, 'geneticRegister']);
        Route::post('genetic-store', [CowControllere::class, 'geneticRegisterStore']);

        Route::get('list', [CowControllere::class, 'cowList']);
        Route::post('paginate', [CowControllere::class, 'paginateCow'])->middleware([DataTablePaginate::class]);

        Route::get('dead-list', [CowControllere::class, 'deadList']);
        Route::post('dead-paginate', [CowControllere::class, 'paginateDead'])->middleware([DataTablePaginate::class]);
        Route::get('dead-remove/{dead_id}', [CowControllere::class, 'deleteDeadCow']);

        Route::get('sold-list', [CowControllere::class, 'soldList']);
        Route::post('sold-paginate', [CowControllere::class, 'paginateSold'])->middleware([DataTablePaginate::class]);
        Route::get('sold-remove/{sold_id}', [CowControllere::class, 'deleteSoldCow']);


        Route::get('deleted-list', [CowControllere::class, 'deletedList']);
        Route::post('deleted-paginate', [CowControllere::class, 'paginateDeleted'])->middleware([DataTablePaginate::class]);


    });


    Route::prefix('calfs')->group(function () {
        Route::get('new-register', [CowCalfController::class, 'newRegister']);
        Route::post('register-store', [CowCalfController::class, 'registerStore']);

        Route::get('sold-register', [CowCalfController::class, 'soldRegister']);
        Route::post('sold-store', [CowCalfController::class, 'soldRegisterStore']);

        Route::get('dead-register', [CowCalfController::class, 'deadRegister']);
        Route::post('dead-store', [CowCalfController::class, 'deadRegisterStore']);

        Route::get('genetic-register', [CowCalfController::class, 'geneticRegister']);
        Route::post('genetic-store', [CowCalfController::class, 'geneticRegisterStore']);

        Route::get('list', [CowCalfController::class, 'cowList']);
        Route::post('paginate', [CowCalfController::class, 'paginateCalf'])->middleware([DataTablePaginate::class]);

        Route::get('dead-list', [CowCalfController::class, 'deadList']);
        Route::post('dead-paginate', [CowCalfController::class, 'paginateDead'])->middleware([DataTablePaginate::class]);
        Route::get('dead-remove/{dead_id}', [CowCalfController::class, 'deleteDeadCow']);

        Route::get('sold-list', [CowCalfController::class, 'soldList']);
        Route::post('sold-paginate', [CowCalfController::class, 'paginateSold'])->middleware([DataTablePaginate::class]);
        Route::get('sold-remove/{sold_id}', [CowCalfController::class, 'deleteSoldCow']);

        Route::get('deleted-list', [CowCalfController::class, 'deletedList']);
        Route::post('deleted-paginate', [CowCalfController::class, 'paginateDeleted'])->middleware([DataTablePaginate::class]);

    });



    Route::prefix('record-milk-production')->group(function () {
        Route::get('list', [RecordMilkProductionController::class, 'recordMilkProduction']);
        Route::post('milk-store', [RecordMilkProductionController::class, 'milkStore']);
        Route::get('per-cow', [RecordMilkProductionController::class, 'perCowReport']);
        Route::post('json-per-cow', [RecordMilkProductionController::class, 'jsonPerCow']);

        Route::get('all-cow', [RecordMilkProductionController::class, 'allCowReport']);
    });

});

