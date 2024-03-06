<?php

use App\Http\Controllers\AdminMailApproveController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('guest');

Route::get('/dashboard', [HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [HomeController::class, 'welcome'])->middleware('guest')->name('welcome');

Route::get('/my-dashboard', function () {
    return view('index');
})->name('myDashboard');

Route::get('/approve/mail', [AdminMailApproveController::class, 'index'])->middleware(['auth', 'verified'])->name('approve.mail');

Route::get('/user/draft/status/{draft}', [AdminMailApproveController::class, 'userDraftStatus'])->middleware(['auth', 'verified'])->name('user.draft');

Route::get('/approve-company-from-email/{user_id}', [AdminMailApproveController::class, 'approveCompanyFromEmail'])
    // ->middleware(['companyApproval.key'])
    ->name('approve-company-from-email');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('/company/change-status-to-draft/{id}', [CompanyController::class, 'draftCompanyStatus'])->name('company.draft');
    Route::get('/company/change-status-to-approve/{id}', [CompanyController::class, 'approveCompanyStatus'])->name('company.approve');

    Route::resource('jobs', JobController::class);
    Route::post('/jobs/delete/{id}', [JobController::class, 'delete'] )->name('jobs.delete');
    Route::resource('tags', TagController::class);
});