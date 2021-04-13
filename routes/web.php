<?php

use App\Http\Livewire\AddMonitoringactivity;
use App\Http\Livewire\AssignedTasks;
use App\Http\Livewire\AssignRole;
use App\Http\Livewire\CarLogs;
use App\Http\Livewire\ClosedCar;
use App\Http\Livewire\MyOwnNonConform;
use App\Http\Livewire\Response;
use App\Http\Livewire\ViewTasks;
use App\Http\Livewire\ViewYearPlan;
use App\Http\Livewire\YearlyPlan;
use Illuminate\Http\Request;
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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['auditor'])->group(function () {
        Route::middleware(['LA'])->group(function () {
            //AddActivitiesToAudit
            Route::get('/Add-Activities-To-Audit', AddMonitoringactivity::class)->name('addActivity');
            //YearlyPlan
            Route::get('/Yearly-Plan', YearlyPlan::class)->name('yearly.plan');
            //View Tasks
            Route::get('/View-Assigned-Tasks', ViewTasks::class)->name('view.tasks');
            //Assign Follow Up
            Route::get('/Assign-follow-up-Role', AssignRole::class)->name('followup');
        });
        Route::middleware(['HOD'])->group(function () {
            //HOD Response
            Route::get('/HOD-Response-Operations', [App\Http\Controllers\AuditController::class, 'Operations'])->name('OP.response');
            Route::get('/HOD-Response-Forestry', [App\Http\Controllers\AuditController::class, 'Forestry'])->name('FR.response');
            Route::get('/HOD-Response-HR', [App\Http\Controllers\AuditController::class, 'HR'])->name('HR.response');
            Route::get('/HOD-Response-IT', [App\Http\Controllers\AuditController::class, 'IT'])->name('IT.response');
            Route::get('/HOD-Response-Communications', [App\Http\Controllers\AuditController::class, 'Communications'])->name('CM.response');
            Route::get('/HOD-Response-Miti_Magazine', [App\Http\Controllers\AuditController::class, 'Miti_Magazine'])->name('MITI.response');
            Route::get('/HOD-Response-Accounts', [App\Http\Controllers\AuditController::class, 'Accounts'])->name('ACC.response');
            Route::get('/HOD-Response-M-E', [App\Http\Controllers\AuditController::class, 'ME'])->name('ME.response');
            //Closed CARs
            Route::get('/Closed-CARS', ClosedCar::class)->name('closed.car');
            //Logs
            Route::get('/CAR-Logs', CarLogs::class)->name('car.logs');
        });

        //ViewYearlyPlan
        Route::get('/View-Year-Plan', ViewYearPlan::class)->name('Viewyear.plan');
        //AssignedTask
        Route::get('/My-Tasks', AssignedTasks::class)->name('assigned.Task');
        //Auditee Response
        Route::get('/Auditee-Response', Response::class)->name('auditee.respond');
        //Edit Nonconformance
        Route::get('/Edit-Non-Conformance-{id}', [App\Http\Controllers\AuditController::class, 'edit'])->name('edit');
        //Follow Up
        Route::get('/Follow-Up', [App\Http\Controllers\AuditController::class, 'followUp'])->name('follow');
        //Update Nonconformance
        Route::patch('/update-Non-Conformance-{nonConformance}', [App\Http\Controllers\AuditController::class, 'update'])->name('update');
        //Post Checklist
        Route::get('/Task-Response', [App\Http\Controllers\AuditController::class, 'taskresponse'])->name('task.response');
        //New Nonconformance
        Route::get('/PrepareNew-Non-Conformance-{id}', [App\Http\Controllers\AuditController::class, 'nonconformance'])->name('new.audit');
    });
    //MY Non-conformances
    Route::get('/Home', MyOwnNonConform::class)->name('home');
    //file
    Route::get('/View/{id}/file', [App\Http\Controllers\AuditController::class, 'file'])->name('view.file');
});


require __DIR__ . '/auth.php';
