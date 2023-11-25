<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/user/updatePassword', [App\Http\Controllers\ResetPasswordController::class, 'updatePassword'])->name('update.password');

Route::post('/admin/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create');
Route::post('/admin/group/create',[App\Http\Controllers\Admin\GroupController::class, 'create'])->name('admin.group.create');


Route::post('/user/updatePassword', [App\Http\Controllers\ResetPasswordController::class, 'updatePassword'])->name('update.password');

Route::post('/admin/children/create', [App\Http\Controllers\Admin\ChildrenController::class, 'create'])->name('admin.children.create');

Route::post('/admin/resume/question/create', [App\Http\Controllers\Admin\QuestionController::class, 'create'])->name('admin.resume.question.create');

Route::post('/employee/group/create', [App\Http\Controllers\Employee\GroupController::class, 'create'])->name('employee.group.create');


