<?php

use App\Http\Controllers\BreedingController;
use App\Http\Controllers\CowCalfController;
use App\Http\Controllers\CowControllere;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmerClientsController;
use App\Http\Controllers\FeedingController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MilkPaymentController;
use App\Http\Controllers\MilkSalesController;
use App\Http\Controllers\RecordMilkProductionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
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


Route::group(['middleware' => UserMiddleware::class], function () {

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


    Route::prefix('feeding')->group(function () {
        Route::get('feed-create', [FeedingController::class, 'feedCreate']);
        Route::post('feed-store', [FeedingController::class, 'feedStore']);

        Route::get('feed-minerals-create', [FeedingController::class, 'feedMineralsCreate']);
        Route::post('feed-minerals-store', [FeedingController::class, 'feedMineralsStore']);

        Route::get('feed-basal-create', [FeedingController::class, 'feedBasalCreate']);
        //Route::post('feed-basal-store',[FeedingController::class,'feedBasalStore']);

        Route::get('feed-consum-grass-create', [FeedingController::class, 'feedConsumGrassCreate']);
        Route::post('feed-grass-store', [FeedingController::class, 'feedGrassStore']);

        Route::get('feed-consum-hay-create', [FeedingController::class, 'feedConsumHayCreate']);
        Route::post('feed-hay-store', [FeedingController::class, 'feedHayStore']);

        Route::get('feed-consum-other-create', [FeedingController::class, 'feedConsumOtherCreate']);
        Route::post('feed-other-store', [FeedingController::class, 'feedOtherStore']);

        Route::get('feed-report-list', [FeedingController::class, 'feedReportList']);
        Route::post('feed-paginate', [FeedingController::class, 'paginatFeeedReport'])->middleware([DataTablePaginate::class]);
    });



    Route::prefix('feed')->group(function () {
        Route::get('stock-create', [StockController::class, 'stockCreate']);
        Route::post('stock-store', [StockController::class, 'stockStore']);

        Route::get('stock-minerals-create', [StockController::class, 'stockMineralsCreate']);
        Route::post('stock-minerals-store', [StockController::class, 'stockMineralsStore']);

        Route::get('stock-basal-create', [StockController::class, 'stockBasalCreate']);
        //Route::post('stock-basal-store',[StockController::class,'stockBasalStore']);

        Route::get('stock-consum-grass-create', [StockController::class, 'stockConsumGrassCreate']);
        Route::post('stock-grass-store', [StockController::class, 'stockGrassStore']);

        Route::get('stock-consum-hay-create', [StockController::class, 'stockConsumHayCreate']);
        Route::post('stock-hay-store', [StockController::class, 'stockHayStore']);

        Route::get('stock-consum-other-create', [StockController::class, 'stockConsumOtherCreate']);
        Route::post('stock-other-store', [StockController::class, 'stockOtherStore']);
    });



    Route::prefix('milk-sales')->group(function () {
        Route::get('customer-create', [MilkSalesController::class, 'customerCreate']);
        Route::post('customer-store', [MilkSalesController::class, 'customerStore']);

        Route::get('coop-create', [MilkSalesController::class, 'coopCreate']);
        Route::post('coop-store', [MilkSalesController::class, 'coopStore']);
    });

    Route::prefix('milk-payment')->group(function () {
        Route::get('customer-pay-create', [MilkPaymentController::class, 'customerPayCreate']);
        Route::post('customer-pay-store', [MilkPaymentController::class, 'customerPayStore']);

        Route::get('coop-pay-create', [MilkPaymentController::class, 'coopPayCreate']);
        Route::post('coop-pay-store', [MilkPaymentController::class, 'coopPayStore']);
    });


    Route::prefix('farmer-clients-customer')->group(function () {
        Route::get('create', [FarmerClientsController::class, 'customerCreate']);
        Route::post('customer-store', [FarmerClientsController::class, 'customerStore']);
        Route::get('farmar-client-remove/{client_id}', [FarmerClientsController::class, 'farmarClientRemove']);
        Route::get('farmar-client-edit/{client_id}', [FarmerClientsController::class, 'farmarClientEdit']);
        Route::put('customer-update/{client_id}', [FarmerClientsController::class, 'customerUpdate']);
        Route::get('customer-list', [FarmerClientsController::class, 'customerList']);
        Route::post('customer-paginate', [FarmerClientsController::class, 'paginatCustomerReport'])->middleware([DataTablePaginate::class]);
    });

    Route::prefix('farmer-coop')->group(function () {
        Route::get('create', [FarmerClientsController::class, 'coopCreate']);
        Route::post('coop-store', [FarmerClientsController::class, 'coopStore']);
        Route::get('farmar-coop-remove/{coop_id}', [FarmerClientsController::class, 'farmarCoopRemove']);
        Route::get('farmar-coop-edit/{coop_id}', [FarmerClientsController::class, 'farmarCoopEdit']);
        Route::put('coop-update/{coop_id}', [FarmerClientsController::class, 'coopUpdate']);
        Route::get('coop-list', [FarmerClientsController::class, 'coopList']);
        Route::post('coop-paginate', [FarmerClientsController::class, 'paginatCoopReport'])->middleware([DataTablePaginate::class]);
    });

    Route::prefix('milk-sale-report')->group(function () {
        Route::get('all-customer-list', [MilkSalesController::class, 'allCustomerList']);
        Route::post('coop-paginate', [MilkSalesController::class, 'paginatCoopReport'])->middleware([DataTablePaginate::class]);
    });

    Route::prefix('staff')->group(function () {
        Route::get('create-staff', [StaffController::class, 'staffCreate']);
        Route::post('staff-store', [StaffController::class, 'staffStore']);

        Route::get('staff-list', [StaffController::class, 'allstaffList']);
        Route::get('change-status', [StaffController::class, 'changeStatus']);

        Route::get('staff-edit/{staff_id}', [StaffController::class, 'editStaff']);
        Route::put('staff-update/{staff_id}', [StaffController::class,'updateStaff']);
    });


    Route::prefix('artificial-insemination')->group(function () {
        Route::get('create-artificial', [BreedingController::class, 'staffArtificial']);
        Route::post('artificial-store', [BreedingController::class, 'artificialStore']);

        Route::get('artificial-list', [BreedingController::class, 'allArtificialList']);
        Route::post('artificial-paginate', [BreedingController::class, 'paginatArtificial'])->middleware([DataTablePaginate::class]);
    });


    Route::prefix('health-record')->group(function () {
        Route::get('create-treatment', [HealthController::class, 'CreateTreatment']);
        Route::post('treatment-store', [HealthController::class, 'treatmentStore']);

        Route::get('create-vaccine', [HealthController::class, 'createVaccine']);
        Route::post('vaccine-store', [HealthController::class, 'vaccineStore']);

        Route::get('create-dewormer', [HealthController::class, 'createDewormer']);
        Route::post('dewormer-store', [HealthController::class, 'dewormerStore']);
    });


    Route::prefix('health-report')->group(function () {
        Route::get('list-treatment', [HealthController::class, 'allTreatmentList']);
        Route::post('treatment-paginate', [HealthController::class, 'paginatTreatment'])->middleware([DataTablePaginate::class]);
        Route::get('health-remove/{teeatment_id}', [HealthController::class, 'treatmentRemove']);
        Route::get('edit-treatment/{teeatment_id}', [HealthController::class, 'editTreatment']);
        Route::put('update-treatment/{teeatment_id}', [HealthController::class, 'updateTreatment']);


        Route::get('list-vaccine', [HealthController::class, 'allVaccineList']);
        Route::post('vaccine-paginate', [HealthController::class, 'paginatVaccine'])->middleware([DataTablePaginate::class]);


        Route::get('list-dewormer', [HealthController::class, 'allDewormerList']);
        Route::post('dewormer-paginate', [HealthController::class, 'paginatDewormer'])->middleware([DataTablePaginate::class]);
        Route::get('dewormer-remove/{dewormer_id}', [HealthController::class, 'dewormerRemove']);
        Route::get('edit-dewormer/{dewormer_id}', [HealthController::class, 'editDewormer']);
        Route::put('update-dewormer/{dewormer_id}', [HealthController::class, 'updateDewormer']);

    });



    Route::prefix('salary')->group(function () {
        Route::get('create-salary', [SalaryController::class, 'createSalary']);
        Route::post('salary-store', [SalaryController::class, 'salaryStore']);

        Route::get('artificial-list', [SalaryController::class, 'allArtificialList']);
        Route::post('artificial-paginate', [SalaryController::class, 'paginatArtificial'])->middleware([DataTablePaginate::class]);
    });


});
