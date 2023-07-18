<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\RegistrationsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\ConversactionController;

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
    return view('welcome');
});

Auth::routes();
Route::get('/create-account',[RegistrationsController::class,'register'])->name('client.register');
Route::post('/register-account',[RegistrationsController::class,'createAccount'])->name('register.new.account');
Route::post('/create-broker-account',[RegistrationsController::class,'createBroker'])->name('create.broker.account');
Route::get('/register-broker',[RegistrationsController::class,'registerBroker'])->name('register.broker.account');
Route::get('/get-cities',[RegistrationsController::class,'getCities'])->name('get-cities');


/////Customner Routes///////
Route::group(['prefix'=>"customer",'middleware'=>['auth','isCustomer']],function(){

    Route::get('/dashboard',[CustomerController::class,'dashboard'])->name('customer.dashboard');
    Route::get('/application',[CustomerController::class,'applications'])->name('customer.application');
    Route::post('/submit-application',[CustomerController::class,'submitApplications'])->name('customer.submit.application');
    Route::get('/start-conversaction/{uuid}',[CustomerController::class,'startConversaction'])->name('customer.start.conversaction');
    Route::get('/conversactions',[CustomerController::class,'getConversactions'])->name('cusomer.conversaction');
    Route::get('/profile',[CustomerController::class,'profile'])->name('customer.profile');
    Route::post('/update/profile',[CustomerController::class,'updateProfile'])->name('udpate.profile');
    Route::get('/logout',[CustomerController::class,'logout'])->name('customer.logout');
});


///////// Broker Routes /////////////
Route::group(['prefix'=>"broker",'middleware'=>['auth','isBroker']],function(){

    Route::get('/dashboard',[BrokerController::class,'dashboard'])->name('broker.dashboard');
    Route::get('/customers',[BrokerController::class,'customers'])->name('broker.customers');
    Route::get('/filtered-customers',[BrokerController::class,'filteredCustomers'])->name('broker.filter.customer');
    Route::get('/start-conversaction/{id}',[BrokerController::class,'startConversaction'])->name('broker.start.conversaction');
    Route::get('/conversactions',[BrokerController::class,'getConversactions'])->name('broker.conversaction');
    Route::get('/profile',[BrokerController::class,'profile'])->name('broker.profile');
    Route::post('/udpate/profile',[BrokerController::class,'updateProfile'])->name('broker.update.profile');
    Route::get('/customer-detail/{id}',[BrokerController::class,'getCustomerDetail'])->name('broker.custstomer.detail');
    Route::get('/logout',[BrokerController::class,'logout'])->name('broker.logout');
});
Route::get('/send-messages',[ConversactionController::class,'sendMessage'])->name('broker.send.message');
Route::get('/send-messages-cutomer',[ConversactionController::class,'customerSendMessage'])->name('customer.send.message');
Route::get('/receive-messages',[ConversactionController::class,'receivedMessages'])->name('get.received.messages');

Route::get('/admin',[AdminAuthController::class,'show_login'])->name('admin.sigin');
Route::post('/admin/login',[AdminAuthController::class,'login'])->name('admin.login');
Route::get('/get-region-distric',[AdminController::class,'getDistrics'])->name('get.region.districs');
Route::get('/get-region-cities',[AdminController::class,'getCities'])->name('get.region.cities');
Route::group(['prefix'=>'admin','middleware' => ['adminAuth','isAdmin']],function(){

    
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/regions',[AdminController::class,'regions'])->name('admin.regions');
    Route::post('/add/regions',[AdminController::class,'addRegions'])->name('admin.add.region');
    Route::post('/add/distric',[AdminController::class,'addDistric'])->name('admin.add.distric');
    Route::post('/add/regions/update',[AdminController::class,'updateRegions'])->name('admin.udpate.region');
    Route::post('/add/city',[AdminController::class,'addCities'])->name('admin.add.city');
    Route::post('/add/city/update',[AdminController::class,'udpateCities'])->name('admin.udpate.city');
    Route::get('/delete-region/{id}',[AdminController::class,'deleteRegion'])->name('admin.region.delete');
    Route::get('/delete-city/{id}',[AdminController::class,'deleteCity'])->name('admin.city.delete');
    Route::get('/delete-distric/{id}',[AdminController::class,'deleteCDistric'])->name('admin.distric.delete');
    Route::post('/distric/update',[AdminController::class,'updateDistric'])->name('admin.udpate.distric');
    Route::get('/customers',[AdminController::class,'customers'])->name('admin.customers');
    Route::get('/brokers',[AdminController::class,'brokers'])->name('admin.brokers');
    Route::get('/activate-broker/{id}',[AdminController::class,'activateUser'])->name('admin.broker.activated');
    Route::get('/de-activate-broker/{id}',[AdminController::class,'deActivateUser'])->name('admin.broker.deactive');
    Route::get('/conversactions',[AdminController::class,'getConversactions'])->name('admin.broker.conversaction');
    Route::get('/chats/{uuid}',[AdminController::class,'startConversaction'])->name('admin.broker.start.conversaction');
    Route::get('/applications',[AdminController::class,'applications'])->name('admin.customer.applications');
    Route::get('/approve-applications/{id}',[AdminController::class,'approveApplication'])->name('admin.approve.customer.application');
    Route::get('/disabled-customers',[AdminController::class,'disabledCustomers'])->name('admin.disabled.customers');
    Route::get('/customer/{id}',[AdminController::class,'customerProfile'])->name('admin.customer.detail');
    Route::get('/broker/{id}',[AdminController::class,'brokerProfile'])->name('admin.broker.detail');
    Route::get('/generate-csv',[AdminController::class,'generateCsv'])->name('admin.customer.csv');
    Route::get('/staff-members',[AdminController::class,'staffMember'])->name('admin.staff.member');
    Route::post('/add-staff-members',[AdminController::class,'addMemeber'])->name('admin.add.member');
    Route::post('/udpate-staff-members',[AdminController::class,'updateMemeber'])->name('admin.udpate.member');
    Route::get('/delete-staff-members/{id}',[AdminController::class,'deleteMember'])->name('admin.delete.staff.member');
    Route::post('/update/broker',[AdminController::class,'updateBroker'])->name('admin.broker.update');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');