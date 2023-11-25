<?php

use App\Services\Localization\LocalizationService;
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
Route::group(
    [
        'prefix' => LocalizationService::locale(),
        'middleware' => 'setLocale'
    ],
    function(){
        Route::group(['prefix'=>'user'], function (){
            Route::get('/register', [App\Http\Controllers\RegisterController::class, 'form'])->name('user.register.form');
            Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('user.register');
            Route::get('/login', [App\Http\Controllers\AuthController::class, 'form'])->name('user.auth.form');
            Route::post('/login', [App\Http\Controllers\AuthController::class, 'userAuth'])->name('user.auth');
            Route::get('/logout', App\Http\Controllers\LogoutController::class)->name('user.logout');
            Route::get('/resetPassword', [App\Http\Controllers\ResetPasswordController::class, 'form'])->name('reset.password.form');
            Route::post('/resetPassword', [App\Http\Controllers\ResetPasswordController::class, 'sendLink'])->name('reset.password.link');
            Route::get('/resetPassword/{email}', [App\Http\Controllers\ResetPasswordController::class, 'changePassword'])->name('change.password.form');
            Route::post('/enroll/create', [App\Http\Controllers\EnrollController::class, 'create'])->name('enroll.create');
            Route::get('/enroll', [App\Http\Controllers\EnrollController::class,'index'])->name('enroll.index');
        });
        Route::get('/{user?}',App\Http\Controllers\IndexController::class)->name('index');
        Route::get('/verification/form/{user}', [App\Http\Controllers\VerificateController::class, 'form'])->name('verification.form');
        Route::post('/verification/email', [App\Http\Controllers\VerificateController::class, 'verification'])->name('verification');

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/main/gallery', [App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');

        Route::get('main/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

        Route::get('/main/literature', [App\Http\Controllers\HomeController::class, 'literature'])->name('literature');
        Route::get('/main/condition', [App\Http\Controllers\HomeController::class, 'condition'])->name('condition');

        Route::get('main/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');

        Route::get('/main/vacancy', [App\Http\Controllers\User\VacancyController::class, 'index'])->name('vacancy');
        Route::post('/main/vacancy/save', [App\Http\Controllers\User\VacancyController::class, 'save'])->name('vacancy.save');

        Route::get('/main/profile/{user}', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile');
        Route::patch('/main/profile/update/{user}', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');

        Route::get('/main/children/{child}', [App\Http\Controllers\User\ChildrenController::class, 'index'])->name('children');
        Route::patch('/main/children/update/{child}', [App\Http\Controllers\User\ChildrenController::class, 'update'])->name('children.update');

        Route::post('/main/payment', [App\Http\Controllers\User\PaymentController::class, 'index'])->name('payment');
        Route::get('/main/payment/{child}', [App\Http\Controllers\User\PaymentController::class, 'index'])->name('payment.child');
        Route::post('/main/payment/form', [App\Http\Controllers\User\PaymentController::class, 'form'])->name('payment.form');
        Route::post('/main/payment/create', [App\Http\Controllers\User\PaymentController::class, 'create'])->name('payment.create');

        Route::post('/main/feedback/create', [App\Http\Controllers\User\FeedbackController::class, 'create'])->name('feedback.create');

        Route::group(['prefix'=>'employee'], function (){
            Route::get('/index/{user}', App\Http\Controllers\Employee\IndexController::class)->name('employee');

            Route::group(['prefix'=>'profile'], function (){
                Route::get('/index/{user}', [App\Http\Controllers\Employee\ProfileController::class, 'index'])->name('employee.profile');
                Route::patch('/update/{user}', [App\Http\Controllers\Employee\ProfileController::class, 'update'])->name('employee.profile.update');
            });

            Route::group(['prefix'=>'group'], function (){
                Route::get('/', [App\Http\Controllers\Employee\GroupController::class, 'index'])->name('employee.group.index');
                Route::get('/show/{child}', [App\Http\Controllers\Employee\GroupController::class, 'show'])->name('employee.group.show');
                Route::get('/edit/{child}', [App\Http\Controllers\Employee\GroupController::class, 'edit'])->name('employee.group.edit');
                Route::patch('/update/{child}', [App\Http\Controllers\Employee\GroupController::class, 'update'])->name('employee.group.update');
                Route::delete('/{child}', [App\Http\Controllers\Employee\GroupController::class, 'delete'])->name('employee.group.delete');
            });

            Route::group(['prefix'=>'attendance'], function (){
                Route::get('/', [App\Http\Controllers\Employee\AttendanceController::class, 'index'])->name('employee.attendance.index');
                Route::post('/create', [App\Http\Controllers\Employee\AttendanceController::class, 'create'])->name('employee.attendance.create');
                Route::post('/archive', [App\Http\Controllers\Employee\AttendanceController::class, 'showArchive'])->name('employee.attendance.archive');
                Route::post('/archive/edit', [App\Http\Controllers\Employee\AttendanceController::class, 'editArchive'])->name('employee.attendance.archiveEdit');
                Route::post('/archive/update/{attendance}', [App\Http\Controllers\Employee\AttendanceController::class, 'updateArchive'])->name('employee.attendance.archiveUpdate');
            });

            Route::group(['prefix'=>'gallery'], function (){
                Route::get('/', [App\Http\Controllers\Employee\GalleryController::class, 'index'])->name('employee.gallery.index');
                Route::post('/create/{group}', [App\Http\Controllers\Employee\GalleryController::class, 'create'])->name('employee.gallery.create');
                Route::delete('/{date}', [App\Http\Controllers\Employee\GalleryController::class, 'delete'])->name('employee.gallery.delete');

            });

            Route::group(['prefix' => 'payment'], function (){
                Route::get('/index', [App\Http\Controllers\Employee\PaymentController::class, 'index'])->name('employee.payment.index');
                Route::post('/create', [App\Http\Controllers\Employee\PaymentController::class, 'create'])->name('employee.payment.create');
            });
        });

        Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function (){
            Route::get('/index', \App\Http\Controllers\Admin\IndexController::class)->name('admin');

            Route::group(['prefix'=>'user'],function (){
                Route::get('/',[App\Http\Controllers\Admin\UserController::class,'index'])->name('admin.user.index');
                Route::delete('/{user}', [App\Http\Controllers\Admin\UserController::class,'delete'])->name('admin.user.delete');
                Route::get('/edit/{user}', [App\Http\Controllers\Admin\UserController::class,'edit'])->name('admin.user.edit');
                Route::patch('/update/{user}', [App\Http\Controllers\Admin\UserController::class,'update'])->name('admin.user.update');
                Route::get('/show/{user}', [App\Http\Controllers\Admin\UserController::class,'show'])->name('admin.user.show');
            });

            Route::group(['prefix'=>'group'], function (){
                Route::get('/',[App\Http\Controllers\Admin\GroupController::class,'index'])->name('admin.group.index');
                Route::get('/show/{group}',[App\Http\Controllers\Admin\GroupController::class, 'show'])->name('admin.group.show');
                Route::get('/edit/{group}', [App\Http\Controllers\Admin\GroupController::class, 'edit'])->name('admin.group.edit');
                Route::patch('/update/{group}', [App\Http\Controllers\Admin\GroupController::class, 'update'])->name('admin.group.update');
                Route::delete('/{group}',[App\Http\Controllers\Admin\GroupController::class, 'delete'])->name('admin.group.delete');
                Route::get('/Gallery/{group}', [App\Http\Controllers\Admin\GroupController::class, 'Gallery'])->name('admin.group.Gallery');
                Route::post('/gallery/create/{group}',[App\Http\Controllers\Admin\GroupController::class, 'galleryCreate'])->name('admin.gallery.create');
                Route::delete('/{gallery}',[App\Http\Controllers\Admin\GroupController::class, 'galleryDelete'])->name('admin.gallery.delete');
            });

            Route::group(['prefix'=>'children'], function (){
                Route::get('/', [App\Http\Controllers\Admin\ChildrenController::class, 'index'])->name('admin.children.index');
                Route::get('/edit/{child}', [App\Http\Controllers\Admin\ChildrenController::class, 'edit'])->name('admin.children.edit');
                Route::get('/show/{child}', [App\Http\Controllers\Admin\ChildrenController::class, 'show'])->name('admin.children.show');
                Route::patch('/update/{child}', [App\Http\Controllers\Admin\ChildrenController::class, 'update'])->name('admin.children.update');
                Route::delete('/{child}', [App\Http\Controllers\Admin\ChildrenController::class, 'delete'])->name('admin.children.delete');
            });
            Route::group(['prefix'=>'enroll'], function (){
                Route::get('/', [App\Http\Controllers\Admin\EnrollController::class, 'index'])->name('admin.enroll.index');
                Route::get('/show/{enroll}', [App\Http\Controllers\Admin\EnrollController::class, 'show'])->name('admin.enroll.show');
                Route::post('/approve/{enroll}', [App\Http\Controllers\Admin\EnrollController::class, 'approve'])->name('admin.enroll.approve');
                Route::delete('/{enroll}', [App\Http\Controllers\Admin\EnrollController::class, 'delete'])->name('admin.enroll.delete');
            });

            Route::group(['prefix'=>'resume'], function (){
                Route::get('/', [App\Http\Controllers\Admin\ResumeController::class, 'index'])->name('admin.resume.index');
                Route::get('/show/{resume}', [App\Http\Controllers\Admin\ResumeController::class, 'show'])->name('admin.resume.show');
                Route::delete('/{resume}', [App\Http\Controllers\Admin\ResumeController::class, 'delete'])->name('admin.resume.delete');
            });

            Route::group(['prefix'=>'question'], function (){
                Route::get('/', [App\Http\Controllers\Admin\QuestionController::class, 'index'])->name('admin.resume.question.index');
                Route::get('/edit/{question}', [App\Http\Controllers\Admin\QuestionController::class, 'edit'])->name('admin.resume.question.edit');
                Route::get('/show/{question}', [App\Http\Controllers\Admin\QuestionController::class, 'show'])->name('admin.resume.question.show');
                Route::patch('/update/{question}', [App\Http\Controllers\Admin\QuestionController::class, 'update'])->name('admin.resume.question.update');
                Route::delete('/{question}', [App\Http\Controllers\Admin\QuestionController::class, 'delete'])->name('admin.resume.question.delete');
            });

            Route::group(['prefix'=>'mainGallery'], function (){
                Route::get('/', [App\Http\Controllers\Admin\MainGalleryController::class, 'index'])->name('admin.mainGallery.index');
                Route::post('/create', [App\Http\Controllers\Admin\MainGalleryController::class, 'create'])->name('admin.mainGallery.create');
                Route::delete('/{gallery}', [App\Http\Controllers\Admin\MainGalleryController::class, 'delete'])->name('admin.mainGallery.delete');
            });

            Route::group(['prefix'=>'attendance'], function (){
                Route::get('/', [App\Http\Controllers\Admin\AttendanceContoller::class, 'index'])->name('admin.attendance.index');
                Route::post('/show', [App\Http\Controllers\Admin\AttendanceContoller::class, 'show'])->name('admin.attendance.show');
            });

            Route::group(['prefix' => 'profile'], function (){
                Route::get('/{user}', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
                Route::patch('/update/{user}', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
            });

            Route::group(['prefix' => 'payment'], function (){
                Route::get('/index', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('admin.payment.index');
                Route::post('/create', [App\Http\Controllers\Admin\PaymentController::class, 'create'])->name('admin.payment.create');
            });

            Route::group(['prefix' => 'feedback'], function (){
                Route::get('/index', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('admin.feedback.index');
                Route::delete('/{feedback}', [App\Http\Controllers\Admin\FeedbackController::class, 'delete'])->name('admin.feedback.delete');
                Route::get('/show/{feedback}', [App\Http\Controllers\Admin\FeedbackController::class, 'show'])->name('admin.feedback.show');
            });
        });
    });






//Route::auth();

