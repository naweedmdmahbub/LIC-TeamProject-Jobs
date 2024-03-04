<?php

use App\Http\Controllers\AdminMailApproveController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/dashboard', [HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/my-dashboard', function () {
    return view('index');
})->name('myDashboard');

Route::get('/jobs', [JobController::class, 'index'])->middleware(['auth', 'verified'])->name('jobs');
Route::get('/approve/mail', [AdminMailApproveController::class, 'index'])->middleware(['auth', 'verified'])->name('approve.mail');

Route::get('/user/draft/status/{draft}', [AdminMailApproveController::class, 'userDraftStatus'])->middleware(['auth', 'verified'])->name('user.draft');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
});