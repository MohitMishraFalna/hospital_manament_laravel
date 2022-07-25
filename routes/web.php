<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\Login;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;

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

Route::get('/', [Login::class, 'index']);
Route::post('/', [Login::class, 'login'])->name('login');

// Middleware start here...
Route::middleware('loginAuth')->group(function(){
    // This route use for showing landing page.
    Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');

    // Department Routes
    // This route use for storing data in database.
    Route::post('department/create', [DepartmentController::class, 'store'])->name('create');
    Route::get('department/list', [DepartmentController::class, 'index'])->name('list');
    Route::get('department/new', [DepartmentController::class, 'create'])->name('departmentNew');
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('departmentEdit');
    Route::post('department/update/{id}', [DepartmentController::class, 'update'])->name('departmentUpdate');
    Route::get('department/status/{stats}/{id}', [DepartmentController::class, 'statusChange'])->name('departmentStatus');
    Route::get('department/delete/{id}', [DepartmentController::class, 'destroy'])->name('departmentDelete');
    Route::get('department/search', [DepartmentController::class, 'searchRecord'])->name('departmentSearch');

    // Staff Routes
    // This route use for storing data in database.
    Route::post('staff/dashboard', [StaffController::class, 'login'])->name('staffLogin')->withoutMiddleware([loginAuth::class]);
    Route::post('staff/create', [StaffController::class, 'store'])->name('staffCreate');
    Route::get('staff/list', [StaffController::class, 'index'])->name('staffList');
    Route::get('staff/new', [StaffController::class, 'create'])->name('staffNew');
    Route::get('staff/edit/{id}', [StaffController::class, 'edit'])->name('staffEdit');
    Route::post('staff/update/{id}', [StaffController::class, 'update'])->name('staffUpdate');
    Route::get('staff/status/{stats}/{id}', [StaffController::class, 'statusChange'])->name('staffStatus');
    Route::get('staff/delete/{id}', [StaffController::class, 'destroy'])->name('staffDelete');
    Route::get('staff/doctor/list', [StaffController::class, 'allDoctors'])->name('docList');
    Route::get('staff/search', [StaffController::class, 'searchRecord'])->name('staffSearch');
    Route::get('staff/show/profile/{id}', [StaffController::class, 'profile'])->name('profile');
    Route::post('staff/update/profile/{id}', [StaffController::class, 'updateProfile'])->name('updateProfile');
    Route::post('staff/change/password/{id}', [StaffController::class, 'changePassword'])->name('changePassword');

    // Doctor Routes
    // This route use for storing data in database.
    Route::post('doctor/create', [DoctorsController::class, 'store'])->name('doctorCreate');
    Route::get('doctor/list', [DoctorsController::class, 'index'])->name('doctorList');
    Route::get('doctor/new', [DoctorsController::class, 'create'])->name('doctorNew');
    Route::get('doctor/edit/{id}', [DoctorsController::class, 'edit'])->name('doctorEdit');
    Route::post('doctor/update/{id}', [DoctorsController::class, 'update'])->name('doctorUpdate');
    Route::get('doctor/status/{stats}/{id}', [DoctorsController::class, 'statusChange'])->name('doctorStatus');
    Route::get('doctor/delete/{id}', [DoctorsController::class, 'destroy'])->name('doctorDelete');
    Route::get('doctor/search', [DoctorsController::class, 'searchRecord'])->name('doctorSearch');

    
    // Post Routes
    // This route use for storing data in database.
    Route::post('post/create', [PostController::class, 'store'])->name('postCreate');
    Route::get('post/list', [PostController::class, 'index'])->name('postList');
    Route::get('post/new', [PostController::class, 'create'])->name('postNew');
    Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('postEdit');
    Route::post('post/update/{id}', [PostController::class, 'update'])->name('postUpdate');
    Route::get('post/status/{stats}/{id}', [PostController::class, 'statusChange'])->name('postStatus');
    Route::get('post/delete/{id}', [PostController::class, 'destroy'])->name('postDelete');
    Route::get('post/search', [PostController::class, 'searchRecord'])->name('postSearch');

    
    // Test Routes
    // This route use for storing data in database.
    Route::post('test/create', [TestController::class, 'store'])->name('testCreate');
    Route::get('test/list', [TestController::class, 'index'])->name('testList');
    Route::get('test/new', [TestController::class, 'create'])->name('testNew');
    Route::get('test/edit/{id}', [TestController::class, 'edit'])->name('testEdit');
    Route::post('test/update/{id}', [TestController::class, 'update'])->name('testUpdate');
    Route::get('test/status/{stats}/{id}', [TestController::class, 'statusChange'])->name('testStatus');
    Route::get('test/delete/{id}', [TestController::class, 'destroy'])->name('testDelete');
    Route::get('test/search', [TestController::class, 'searchRecord'])->name('testSearch');

    // Common route 
    Route::post('common/address', [CommonController::class, 'findAddress'])->name('address');
});

/**
 * If we want to use Request Class in Route file so first have to import Request class like
 * use Illuminate\Http\Request;
 */
Route::get('logout', function(Request $request){
    if($request->session()->has('login') == "YES"){
        $request->session()->flush();
        return redirect(route('login'))->with('status', 'You are loged out successfully...');
    }

    return view('login');
})->name('logout');

// personal page for all types error.
Route::get('AllError', function(){
    return view('customeError.allError');
})->name('error');

// error page for 404 page not found.
Route::any('{catchall}', function(){
    return view('errors.404');
})->where('catchall', '.*');
