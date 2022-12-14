<?php

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
    return view('welcome');
});

// Admin routes
Route::name('admin.')->prefix('admin')->namespace('Admin')->group(function () {
    Route::namespace('Auth')->middleware(['guest:admin','prevent-back-history'])->group(function () {
        // Login
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login');

        // Forget and reset Password
        Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('forgot_password');
        Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset/{token}/{email?}', 'ResetPasswordController@showResetForm')->name('reset_password_link');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('reset_password');
    });

    // Logged in admin user required
    Route::group(['middleware' => 'auth:admin'], function () {
        // Dashboard
        Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

        
        Route::get('/promote', 'PromoteController@promote')->name('promote.index');
        Route::post('/promote', 'PromoteController@do_promote')->name('promote.promote');
        Route::get('/chats', 'ChatController@index')->name('chats.index');
        Route::get('/chats/{user}', 'ChatController@show')->name('chats.show');
        Route::post('/chats/{user}', 'ChatController@send')->name('chats');
        
        Route::resource('notes', 'NoteController');
        Route::resource('attendances', 'AttendanceController');
        Route::resource('teachers', 'TeacherController');
        Route::resource('students', 'StudentController');
        Route::resource('subjects', 'SubjectController');
        Route::resource('grades', 'GradeController');
        Route::resource('rooms', 'RoomController');
        Route::resource('exams', 'ExamController');
        Route::resource('admins', 'AdminsController');
        Route::resource('marks', 'MarkController');
        Route::post('marks/add_mark/{student}', 'MarkController@store_mark')->name('save_mark');
      
        Route::get('time_tables/add_period/{time_table}', 'TimeTableController@add_period')->name('add_period');
        Route::post('time_tables/add_period/{time_table}', 'TimeTableController@store_period')->name('save_period');
        Route::resource('time_tables', 'TimeTableController');
        


        // Profile
        Route::get('/profile', 'AdminController@profile')->name('profile');
        Route::post('/profile', 'AdminController@profileUpdate');
        Route::post('/password', 'AdminController@passwordUpdate')->name('password_update');

        // Logout
        Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    });
});