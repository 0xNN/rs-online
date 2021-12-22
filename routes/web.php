<?php

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

use App\Models\PasienDirawatKomorbid;
use App\Models\PasienDirawatNonKomorbid;
use App\Models\PasienKeluar;
use App\Models\PasienMasuk;

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/', function () {
        $total['pm'] = PasienMasuk::count();
        $total['pk'] = PasienKeluar::count();
        $total['pdk'] = PasienDirawatKomorbid::count();
        $total['pdnk'] = PasienDirawatNonKomorbid::count();
        return view('dashboard.homepage',compact(
            'total'
        )); 
    });

    Route::group(['middleware' => ['role:user']], function () {
        Route::prefix('data-ruangan-tempat-tidur')->name('data-ruangan-tempat-tidur.')->group(function(){
            Route::get('/',[App\Http\Controllers\DataRuanganTempatTidurController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\DataRuanganTempatTidurController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\DataRuanganTempatTidurController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\DataRuanganTempatTidurController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\DataRuanganTempatTidurController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\DataRuanganTempatTidurController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pasien-masuk')->name('pasien-masuk.')->group(function(){
            Route::get('/',[App\Http\Controllers\PasienMasukController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\PasienMasukController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\PasienMasukController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\PasienMasukController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\PasienMasukController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\PasienMasukController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pasien-keluar')->name('pasien-keluar.')->group(function(){
            Route::get('/',[App\Http\Controllers\PasienKeluarController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\PasienKeluarController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\PasienKeluarController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\PasienKeluarController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\PasienKeluarController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\PasienKeluarController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pasien-dirawat-komorbid')->name('pasien-dirawat-komorbid.')->group(function(){
            Route::get('/',[App\Http\Controllers\PasienDirawatKomorbidController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\PasienDirawatKomorbidController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\PasienDirawatKomorbidController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\PasienDirawatKomorbidController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\PasienDirawatKomorbidController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\PasienDirawatKomorbidController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pasien-dirawat-tanpa-komorbid')->name('pasien-dirawat-tanpa-komorbid.')->group(function(){
            Route::get('/',[App\Http\Controllers\PasienDirawatNonKomorbidController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\PasienDirawatNonKomorbidController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\PasienDirawatNonKomorbidController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\PasienDirawatNonKomorbidController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\PasienDirawatNonKomorbidController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\PasienDirawatNonKomorbidController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('data-sdm')->name('data-sdm.')->group(function(){
            Route::get('/',[App\Http\Controllers\DataSdmController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\DataSdmController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\DataSdmController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\DataSdmController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\DataSdmController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\DataSdmController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('data-apd')->name('data-apd.')->group(function(){
            Route::get('/',[App\Http\Controllers\DataApdController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\DataApdController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\DataApdController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\DataApdController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\DataApdController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\DataApdController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('igd-triase')->name('igd-triase.')->group(function(){
            Route::get('/',[App\Http\Controllers\IgdTriaseController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\IgdTriaseController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\IgdTriaseController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\IgdTriaseController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\IgdTriaseController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\IgdTriaseController::class, 'destroy'])->name('destroy');
            Route::post('/range',[App\Http\Controllers\IgdTriaseController::class, 'range'])->name('range');
        });

        Route::prefix('pcr-nakes')->name('pcr-nakes.')->group(function(){
            Route::get('/',[App\Http\Controllers\PcrNakesController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\PcrNakesController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\PcrNakesController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\PcrNakesController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\PcrNakesController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\PcrNakesController::class, 'destroy'])->name('destroy');
            Route::post('/range',[App\Http\Controllers\PcrNakesController::class, 'range'])->name('range');
        });

        Route::prefix('harian-nakes-terinfeksi')->name('harian-nakes-terinfeksi.')->group(function(){
            Route::get('/',[App\Http\Controllers\NakesTerinfeksiController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\NakesTerinfeksiController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\NakesTerinfeksiController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\NakesTerinfeksiController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\NakesTerinfeksiController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\NakesTerinfeksiController::class, 'destroy'])->name('destroy');
            Route::post('/range',[App\Http\Controllers\NakesTerinfeksiController::class, 'range'])->name('range');
        });

        Route::prefix('oksigenasi')->name('oksigenasi.')->group(function(){
            Route::get('/',[App\Http\Controllers\OksigenasiController::class, 'index'])->name('index');
            Route::get('/create',[App\Http\Controllers\OksigenasiController::class, 'create'])->name('create');
            Route::post('/',[App\Http\Controllers\OksigenasiController::class, 'store'])->name('store');
            Route::get('/{id}',[App\Http\Controllers\OksigenasiController::class, 'show'])->name('show');
            Route::post('/sinkronisasi',[App\Http\Controllers\OksigenasiController::class, 'sinkronisasi'])->name('sinkronisasi');
            Route::delete('/{id}',[App\Http\Controllers\OksigenasiController::class, 'destroy'])->name('destroy');
            Route::post('/range',[App\Http\Controllers\OksigenasiController::class, 'range'])->name('range');
        });
        
        Route::get('/colors', function () {     return view('dashboard.colors'); });
        Route::get('/typography', function () { return view('dashboard.typography'); });
        Route::get('/charts', function () {     return view('dashboard.charts'); });
        Route::get('/widgets', function () {    return view('dashboard.widgets'); });
        Route::get('/404', function () {        return view('dashboard.404'); });
        Route::get('/500', function () {        return view('dashboard.500'); });
        Route::prefix('base')->group(function () {  
            Route::get('/breadcrumb', function(){   return view('dashboard.base.breadcrumb'); });
            Route::get('/cards', function(){        return view('dashboard.base.cards'); });
            Route::get('/carousel', function(){     return view('dashboard.base.carousel'); });
            Route::get('/collapse', function(){     return view('dashboard.base.collapse'); });

            Route::get('/forms', function(){        return view('dashboard.base.forms'); });
            Route::get('/jumbotron', function(){    return view('dashboard.base.jumbotron'); });
            Route::get('/list-group', function(){   return view('dashboard.base.list-group'); });
            Route::get('/navs', function(){         return view('dashboard.base.navs'); });

            Route::get('/pagination', function(){   return view('dashboard.base.pagination'); });
            Route::get('/popovers', function(){     return view('dashboard.base.popovers'); });
            Route::get('/progress', function(){     return view('dashboard.base.progress'); });
            Route::get('/scrollspy', function(){    return view('dashboard.base.scrollspy'); });

            Route::get('/switches', function(){     return view('dashboard.base.switches'); });
            Route::get('/tables', function () {     return view('dashboard.base.tables'); });
            Route::get('/tabs', function () {       return view('dashboard.base.tabs'); });
            Route::get('/tooltips', function () {   return view('dashboard.base.tooltips'); });
        });
        Route::prefix('buttons')->group(function () {  
            Route::get('/buttons', function(){          return view('dashboard.buttons.buttons'); });
            Route::get('/button-group', function(){     return view('dashboard.buttons.button-group'); });
            Route::get('/dropdowns', function(){        return view('dashboard.buttons.dropdowns'); });
            Route::get('/brand-buttons', function(){    return view('dashboard.buttons.brand-buttons'); });
        });
        Route::prefix('icon')->group(function () {  // word: "icons" - not working as part of adress
            Route::get('/coreui-icons', function(){         return view('dashboard.icons.coreui-icons'); });
            Route::get('/flags', function(){                return view('dashboard.icons.flags'); });
            Route::get('/brands', function(){               return view('dashboard.icons.brands'); });
        });
        Route::prefix('notifications')->group(function () {  
            Route::get('/alerts', function(){   return view('dashboard.notifications.alerts'); });
            Route::get('/badge', function(){    return view('dashboard.notifications.badge'); });
            Route::get('/modals', function(){   return view('dashboard.notifications.modals'); });
        });
        Route::resource('notes', 'NotesController');
    });
    Auth::routes();

    Route::resource('resource/{table}/resource', 'ResourceController')->names([
        'index'     => 'resource.index',
        'create'    => 'resource.create',
        'store'     => 'resource.store',
        'show'      => 'resource.show',
        'edit'      => 'resource.edit',
        'update'    => 'resource.update',
        'destroy'   => 'resource.destroy'
    ]);

    Route::group(['middleware' => ['role:admin','auth']], function () {

        Route::resource('bread',  'BreadController');   //create BREAD (resource)
        Route::resource('users',        'UsersController')->except( ['create', 'store'] );
        Route::resource('roles',        'RolesController');
        Route::resource('mail',        'MailController');
        Route::get('prepareSend/{id}',        'MailController@prepareSend')->name('prepareSend');
        Route::post('mailSend/{id}',        'MailController@send')->name('mailSend');
        Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () { 
            Route::get('/',             'MenuElementController@index')->name('menu.index');
            Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create',       'MenuElementController@create')->name('menu.create');
            Route::post('/store',       'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents',  'MenuElementController@getParents');
            Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
            Route::post('/update',      'MenuElementController@update')->name('menu.update');
            Route::get('/show',         'MenuElementController@show')->name('menu.show');
            Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () { 
            Route::get('/',         'MenuController@index')->name('menu.menu.index');
            Route::get('/create',   'MenuController@create')->name('menu.menu.create');
            Route::post('/store',   'MenuController@store')->name('menu.menu.store');
            Route::get('/edit',     'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update',  'MenuController@update')->name('menu.menu.update');
            Route::get('/delete',   'MenuController@delete')->name('menu.menu.delete');
        });
        Route::prefix('media')->group(function () {
            Route::get('/',                 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder',           'MediaController@folder')->name('media.folder');
            Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

            Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file',             'MediaController@file');
            Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp',      'MediaController@cropp');
            Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');
        });
    });
});