<?php

use App\Http\Controllers\Admin\Inventory\AccessPointController;
use App\Http\Controllers\Admin\Inventory\CctvController;
use App\Models\AppsLocal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Admin\Inventory\Laptop;
use App\Models\Admin\Inventory\Computer;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\AppsLocalController;
use App\Http\Controllers\DeviceStockController;
use App\Http\Controllers\Admin\MasterData\AreaController;
use App\Http\Controllers\Admin\MasterData\UnitController;
use App\Http\Controllers\Admin\MasterData\UserController;
use App\Http\Controllers\Admin\Inventory\LaptopController;
use App\Http\Controllers\Admin\Inventory\ServerController;
use App\Http\Controllers\Admin\Inventory\NetworkDeviceController;
use App\Http\Controllers\Admin\MasterData\LoginController;
use App\Http\Controllers\Admin\Inventory\PrinterController;
use App\Http\Controllers\Admin\MasterData\RegionController;
use App\Http\Controllers\Admin\MasterData\VendorController;
use App\Http\Controllers\Admin\Inventory\ComputerController;
use App\Http\Controllers\Admin\Inventory\GedungController;
use App\Http\Controllers\Admin\Inventory\HandphoneController;
use App\Http\Controllers\Admin\Inventory\MobilDinasController;
use App\Http\Controllers\Admin\Inventory\MotorDinasController;
use App\Http\Controllers\Admin\Inventory\StarlinkController;
use App\Http\Controllers\Admin\Inventory\TelevisionController;
use App\Http\Controllers\Admin\MasterData\ProjectController;
use App\Http\Controllers\Admin\MasterData\EmployeeController;
use App\Http\Controllers\Admin\MasterData\ItSupportController;
use App\Http\Controllers\Admin\MasterData\DeviceBrandController;
use App\Http\Controllers\Admin\MasterData\DeviceInterferenceCategoryController;
use App\Http\Controllers\Admin\MasterData\NetworkInterferenceCategoryController;
use App\Http\Controllers\Admin\MasterData\VulnerabilityLevelController;
use App\Http\Controllers\Admin\MasterData\NetworkContractIconController;
use App\Http\Controllers\Admin\MasterData\PopIconPlusController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SSO\SSOApiController;
use App\Models\Admin\Inventory\Gedung;
use App\Models\Admin\Inventory\Handphone;
use App\Models\Admin\Inventory\MobilDinas;
use App\Models\Admin\Inventory\MotorDinas;
use App\Models\Admin\Inventory\Television;
use App\Models\Admin\MasterData\PopIconPlus;
use App\Http\Controllers\Export\LaptopExportController;
use App\Http\Controllers\Export\HandphoneExportController;
use App\Http\Controllers\Export\CctvExportController;
use App\Http\Controllers\Export\StarlinkExportController;


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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $computers = Computer::count();
    $laptops = Laptop::count();
    $apps = AppsLocal::count();
    return view('dashboard', compact('computers', 'laptops', 'apps'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('area', AreaController::class);
    Route::resource('region', RegionController::class);
    Route::post('users/sync', [UserController::class, 'sync'])->name('users.sync');
    Route::resource('users', UserController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('vendor', VendorController::class);
    Route::resource('device-brand', DeviceBrandController::class);
    Route::resource('laptops', LaptopController::class);
    Route::resource('computers', ComputerController::class);
    Route::get('edit-profile', [UserController::class, 'editProfile']);
    Route::resource('servers', ServerController::class);
    Route::resource('network-devices', NetworkDeviceController::class);
    Route::resource('appslocal', AppsLocalController::class);
    Route::resource('monitors', MonitorController::class);
    Route::resource('printers', PrinterController::class);
    Route::resource('support', ItSupportController::class);
    Route::resource('deviceinterference', DeviceInterferenceCategoryController::class);
    Route::resource('networkinterference', NetworkInterferenceCategoryController::class);
    Route::resource('device_stock', DeviceStockController::class);
    Route::resource('vulnerability-level', VulnerabilityLevelController::class);
    Route::resource('network-contract-icon', NetworkContractIconController::class);
    Route::resource('popicon', PopIconPlusController::class);
    Route::resource('handphone', HandphoneController::class);
    Route::resource('television', TelevisionController::class);
    Route::resource('mobil-dinas', MobilDinasController::class);
    Route::resource('motor-dinas', MotorDinasController::class);
    Route::resource('access-point', AccessPointController::class);
    Route::resource('cctv', CctvController::class);
    Route::resource('starlink', StarlinkController::class);
    Route::resource('gedung', GedungController::class);


    // Get Data Chart
    Route::get('/dataChartLaptop', function () {
        $dataLaptops = DB::table('laptops')
            ->join('device_brands', 'laptops.brand_id', '=', 'device_brands.id')
            ->select('device_brands.name as brand_name', DB::raw('count(*) as laptop_count'))
            ->groupBy('device_brands.name', 'device_brands.id')
            ->get();
        return response()->json($dataLaptops);
    });
    Route::get('/dataChartPrinter', function () {
        $dataPrinters = DB::table('printers')
            ->join('device_brands', 'printers.brand_id', '=', 'device_brands.id')
            ->select('device_brands.name as brand_name_printer', DB::raw('count(*) as printer_count'))
            ->groupBy('device_brands.name', 'device_brands.id')
            ->get();
        return response()->json($dataPrinters);
    });

    Route::get('/form', function () {
        return view('pages.forms.advanced-elements');
    });

    Route::get('/viewBastLaptop/{id}', function($id){
        $data = Laptop::find($id);
        $file = storage_path('app/bast/laptops/'.$data->bast);
        return response()->file($file);
    })->name('viewBast');

    Route::get('/viewBastHandphone/{id}', function($id){
        $data = Handphone::find($id);
        $file = storage_path('app/bast/handphone/'.$data->bast);
        return response()->file($file);
    })->name('viewBastHandphone');

    Route::get('/viewBastTelevision/{id}', function($id){
        $data = Television::find($id);
        $file = storage_path('app/bast/television/'.$data->bast);
        return response()->file($file);
    })->name('viewBastTelevision');

    Route::get('/viewBastMobilDinas/{id}', function($id){
        $data = MobilDinas::find($id);
        $file = storage_path('app/bast/mobil-dinas/'.$data->bast);
        return response()->file($file);
    })->name('viewBastMobilDinas');

    Route::get('/viewBastMotorDinas/{id}', function($id){
        $data = MotorDinas::find($id);
        $file = storage_path('app/bast/motor-dinas/'.$data->bast);
        return response()->file($file);
    })->name('viewBastMotorDinas');

    Route::get('/viewBastKomputer/{id}', function($id){
        $data = Computer::find($id);
        $file = storage_path('app/bast/computers/'.$data->bast);
        return response()->file($file);
    })->name('viewBastKomputer');

    Route::get('/viewBastGedung/{id}', function($id){
        $data = Gedung::find($id);
        $file = storage_path('app/bast/gedung/'.$data->bast);
        return response()->file($file);
    })->name('viewBastGedung');

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('cetak-laporan-pdf', [ReportController::class, 'exportpdf'])->name('cetak-laporan-pdf');
    Route::get('cetak-laporan-xls', [ReportController::class, 'exportxls'])->name('cetak-laporan-xls');
    Route::get('laptops/export/excel', [LaptopExportController::class, 'exportExcel'])->name('laptops.export.excel');
    Route::get('laptops/export/pdf', [LaptopExportController::class, 'exportPdf'])->name('laptops.export.pdf');
    Route::get('monitors/export/excel', [App\Http\Controllers\Export\MonitorExportController::class, 'exportExcel'])->name('monitors.export.excel');
    Route::get('monitors/export/pdf', [App\Http\Controllers\Export\MonitorExportController::class, 'exportPdf'])->name('monitors.export.pdf');

    Route::get('computers/export/excel', [\App\Http\Controllers\Export\ComputerExportController::class, 'exportExcel'])->name('computers.export.excel');
    Route::get('computers/export/pdf', [\App\Http\Controllers\Export\ComputerExportController::class, 'exportPdf'])->name('computers.export.pdf');

    Route::get('printers/export/excel', [\App\Http\Controllers\Export\PrinterExportController::class, 'exportExcel'])->name('printers.export.excel');
    Route::get('printers/export/pdf', [\App\Http\Controllers\Export\PrinterExportController::class, 'exportPdf'])->name('printers.export.pdf');

    Route::get('handphone/export/excel', [HandphoneExportController::class, 'exportExcel'])->name('handphone.export.excel');
    Route::get('handphone/export/pdf', [HandphoneExportController::class, 'exportPdf'])->name('handphone.export.pdf');

    Route::get('/cctv/export/excel', [CctvExportController::class, 'exportExcel'])->name('cctv.export.excel');
    Route::get('/cctv/export/pdf', [CctvExportController::class, 'exportPdf'])->name('cctv.export.pdf');

    Route::get('access-point/export/excel', [\App\Http\Controllers\Export\AccessPointExportController::class, 'exportExcel'])->name('access-point.export.excel');
    Route::get('access-point/export/pdf', [\App\Http\Controllers\Export\AccessPointExportController::class, 'exportPdf'])->name('access-point.export.pdf');

    Route::get('/starlink/export/excel', [StarlinkExportController::class, 'exportExcel'])->name('starlink.export.excel');
    Route::get('/starlink/export/pdf', [StarlinkExportController::class, 'exportPdf'])->name('starlink.export.pdf');




});

// =============
//      SSO
// =============
Route::get('sso/callback', [SSOApiController::class, 'login'])->name('login-sso');
