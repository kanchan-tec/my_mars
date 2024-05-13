<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PatientController;

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

Route::get('/admin-login', [App\Http\Controllers\AdminController::class, 'admin_login'])->name('admin_login');
Route::post('/admin_store', [App\Http\Controllers\AdminController::class, 'admin_store'])->name('admin_store');

//Route::get('/', [App\Http\Controllers\AdminController::class, 'index']);
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);




//Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
//Language Translation

//Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');

Route::middleware(['auth', 'user-access:staff'])->group(function () {
    Route::get('/staff-login', [App\Http\Controllers\HomeController::class, 'root'])->name('admin.home');
    Route::controller(PatientController::class)->group(function(){
    Route::get('patient/list','list')->name('patient.list');
    Route::get('patient/register','register')->name('patient.register');
    Route::get('/check-mobile', 'checkMobile')->name('check.mobile');
    Route::get('/get-names', 'getName')->name('get.names');

    Route::post('patient/save','save')->name('patient.save');
    Route::get('patient/view/{id}','patient_view')->name('patient.view');
    Route::get('patient/edit/{id}','edit')->name('patient.edit');
    Route::post('patient_filter','patient_filter')->name('patient.filter');
    Route::get('patient/visit/{id}','add_visit')->name('patient.visit');
    Route::get('patient/bill/{id}','gen_bill')->name('patient.bill');
    Route::post('visit/save','visit_save')->name('visit.save');
    Route::get('visit/list','visit_list')->name('visit.list');
    Route::get('visit/add','visit_add')->name('visit.add');
   Route::get('get/patient/details','getPatientDetails')->name('get.patient.details');
    Route::post('visit/patsave','visit_patsave')->name('visit.patsave');
    
    Route::get('vital/add/{id}/{patient_id}','vital_add')->name('vital.add');
    Route::post('vital/save','vital_save')->name('vital.save');
});

});

Route::middleware(['auth', 'user-access:hospital'])->group(function () {
    Route::get('/hospital-login', [App\Http\Controllers\HospitalController::class, 'index'])->name('hospital.home');
    



});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
   Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'admin_dashboard'])->name('admin.dashboard'); 
   Route::post('/admin-logout', [App\Http\Controllers\AdminController::class, 'admin_logout'])->name('admin.logout');
   Route::get('/hospital_list', [App\Http\Controllers\AdminController::class, 'hospital_list'])->name('hospital.list');
   Route::get('/add_hospital', [App\Http\Controllers\AdminController::class, 'add_hospital'])->name('add.hospital');
   Route::post('/save_hospital', [App\Http\Controllers\AdminController::class, 'save_hospital'])->name('save.hospital');
   Route::get('/edit_hospital/{id}', [App\Http\Controllers\AdminController::class, 'edit_hospital'])->name('edit.hospital');
   Route::post('/update_hospital/{id}', [App\Http\Controllers\AdminController::class, 'update_hospital'])->name('update.hospital');
   Route::get('/delete_hospital/{id}', [App\Http\Controllers\AdminController::class, 'delete_hospital'])->name('delete.hospital');
   Route::get('/changeHospStatus',[App\Http\Controllers\AdminController::class,'hospital_status_update'])->name('hospital.status_update');
   
   
   Route::get('/doctor_list', [App\Http\Controllers\AdminController::class, 'doctor_list'])->name('doctor.list');
   Route::get('/add_doctor', [App\Http\Controllers\AdminController::class, 'add_doctor'])->name('add.doctor');
   Route::post('/save_doctor', [App\Http\Controllers\AdminController::class, 'save_doctor'])->name('save.doctor');
   Route::get('/edit_doct/{id}', [App\Http\Controllers\AdminController::class, 'edit_doct'])->name('edit.doc');
   Route::post('/update_doctor/{id}', [App\Http\Controllers\AdminController::class, 'update_doctor'])->name('update.doctor');
    Route::get('/delete_doct/{id}', [App\Http\Controllers\AdminController::class, 'delete_doct'])->name('delete.doct');
    Route::get('/changeStatus',[App\Http\Controllers\AdminController::class,'doctor_status_update'])->name('doctor.status_update');
    
    Route::get('/insurance_list', [App\Http\Controllers\AdminController::class, 'insurance_list'])->name('insurance.list');
   Route::get('/add_insurance', [App\Http\Controllers\AdminController::class, 'add_insurance'])->name('add.insurance');
   Route::post('/save_insurance', [App\Http\Controllers\AdminController::class, 'save_insurance'])->name('save.insurance');
   Route::get('/edit_insurance/{id}', [App\Http\Controllers\AdminController::class, 'edit_insurance'])->name('edit.insurance');
   Route::post('/update_insurance/{id}', [App\Http\Controllers\AdminController::class, 'update_insurance'])->name('update.insurance');
    Route::get('/delete_insurance/{id}', [App\Http\Controllers\AdminController::class, 'delete_insurance'])->name('delete.insurance');
    Route::get('/changeInsuStatus',[App\Http\Controllers\AdminController::class,'insurance_status_update'])->name('insurance.status_update');
    
    Route::get('/service_list', [App\Http\Controllers\AdminController::class, 'service_list'])->name('service.list');
   Route::get('/add_service', [App\Http\Controllers\AdminController::class, 'add_service'])->name('add.service');
   Route::post('/save_service', [App\Http\Controllers\AdminController::class, 'save_service'])->name('save.service');
   Route::get('/edit_service/{id}', [App\Http\Controllers\AdminController::class, 'edit_service'])->name('edit.service');
   Route::post('/update_service/{id}', [App\Http\Controllers\AdminController::class, 'update_service'])->name('update.service');
    Route::get('/delete_service/{id}', [App\Http\Controllers\AdminController::class, 'delete_service'])->name('delete.service');
    Route::get('/changeServStatus',[App\Http\Controllers\AdminController::class,'service_status_update'])->name('service.status_update');
    
    Route::get('/specialization_list', [App\Http\Controllers\AdminController::class, 'specialization_list'])->name('specialization.list');
   Route::get('/add_specialization', [App\Http\Controllers\AdminController::class, 'add_specialization'])->name('add.specialization');
   Route::post('/save_specialization', [App\Http\Controllers\AdminController::class, 'save_specialization'])->name('save.specialization');
   Route::get('/edit_specialization/{id}', [App\Http\Controllers\AdminController::class, 'edit_specialization'])->name('edit.specialization');
   Route::post('/update_specialization/{id}', [App\Http\Controllers\AdminController::class, 'update_specialization'])->name('update.specialization');
    Route::get('/delete_specialization/{id}', [App\Http\Controllers\AdminController::class, 'delete_specialization'])->name('delete.specialization');
    Route::get('/changeSpecStatus',[App\Http\Controllers\AdminController::class,'specialization_status_update'])->name('specialization.status_update');
});


