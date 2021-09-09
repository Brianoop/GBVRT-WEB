<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\ActivistsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\CaseController;


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



Route::get('/', [LandingPageController::class, 'index']);

Route::get('/login', [CustomAuthController::class, 'showLoginPage'])->name('login.page');

Route::get('/signup', [CustomAuthController::class, 'showSignupPage'])->name('signup.page');

Route::get('/forgot-password', [CustomAuthController::class, 'showForgotPasswordPage'])->name('forgot.password');

Route::get('/dashboard-home', [CustomAuthController::class, 'showDashboardHome'])->name('dashboard.home')->middleware('auth');

//Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
//Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
//Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('/activists', [ActivistsController::class, 'showActivists'])->name('view.activists')->middleware('auth');

Route::get('/activists-cases', [ActivistsController::class, 'showActivistCases'])->name('activists.cases')->middleware('auth');

Route::get('/activist-details', [ActivistsController::class, 'showActivistDetails'])->name('activist.details')->middleware('auth');

Route::get('/report-activist', [ActivistsController::class, 'showReportActivist'])->name('activist.report')->middleware('auth');

Route::get('/users-cases', [UsersController::class, 'showUsersCases'])->name('users.cases')->middleware('auth');

Route::get('/report-cases', [UsersController::class, 'showReportCasePage'])->name('report.case')->middleware('auth');

Route::get('/send-complaint', [UsersController::class, 'showSendComplaintPage'])->name('send.complaint')->middleware('auth');


Route::get('/settings', [SettingsController::class, 'showSettingsPage'])->name('user.settings')->middleware('auth');

Route::get('/account', [AccountController::class, 'showAccountPage'])->name('user.account')->middleware('auth');

Route::get('/chat', [ChatController::class, 'showChats'])->name('user.chats')->middleware('auth');

Route::get('/chat-detail', [ChatController::class, 'showChatDetail'])->name('chat.detail')->middleware('auth');

Route::get('/complaints', [ComplaintsController::class, 'showComplaintsPage'])->name('user.complaints')->middleware('auth');

Route::get('/manage-cases', [CaseController::class, 'showManageCases'])->name('manage.cases')->middleware('auth');

Route::post('/report-case', [CaseController::class, 'storeCase'])->name('case.report')->middleware('auth');