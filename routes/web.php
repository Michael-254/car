<?php

use App\Http\Livewire\AddMonitoringactivity;
use App\Http\Livewire\AssignedTasks;
use App\Http\Livewire\Response;
use App\Http\Livewire\ViewTasks;
use App\Http\Livewire\ViewYearPlan;
use App\Http\Livewire\YearlyPlan;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    //AddActivitiesToAudit
    Route::get('/Add-Activities-To-Audit', AddMonitoringactivity::class)->name('addActivity');
    //YearlyPlan
    Route::get('/Yearly-Plan', YearlyPlan::class)->name('yearly.plan');
    //ViewYearlyPlan
    Route::get('/View-Year-Plan', ViewYearPlan::class)->name('Viewyear.plan');
    //AssignedTask
    Route::get('/My-Tasks', AssignedTasks::class)->name('assigned.Task');
    //Post Checklist
    Route::get('/Task-Response', [App\Http\Controllers\AuditController::class, 'taskresponse'])->name('task.response');
    //View Tasks
    Route::get('/View-Assigned-Tasks', ViewTasks::class)->name('view.tasks');
    //New Nonconformance
    Route::get('/PrepareNew-Non-Conformance-{id}', [App\Http\Controllers\AuditController::class, 'nonconformance'])->name('new.audit');
    //Auditee Response
    Route::get('/Auditee-Response', Response::class)->name('auditee.respond');
    //Edit Nonconformance
    Route::get('/Edit-Non-Conformance-{id}', [App\Http\Controllers\AuditController::class, 'edit'])->name('edit');
    //Update Nonconformance
    Route::patch('/update-Non-Conformance-{nonConformance}', [App\Http\Controllers\AuditController::class, 'update'])->name('update');
});


require __DIR__ . '/auth.php';
