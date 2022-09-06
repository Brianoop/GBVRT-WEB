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
use App\Http\Controllers\ViolenceController;
use App\Http\Controllers\SubCountiesController;
use App\Http\Controllers\UserCaseController;
use App\Http\Controllers\ReportedUsersController;
use App\Http\Controllers\CaseFeedbackController;



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

Route::get('/charts', [LandingPageController::class, 'chartsPage']);

Route::get('/visuals', [LandingPageController::class, 'visualsPage']);

Route::get('/sleek', [LandingPageController::class, 'sleekPage']);

Route::get('/login', [CustomAuthController::class, 'showLoginPage'])->name('login.page');

Route::get('/signup', [CustomAuthController::class, 'showSignupPage'])->name('signup.page');

Route::get('/forgot-password', [CustomAuthController::class, 'showForgotPasswordPage'])->name('forgot.password');

Route::group(['middleware' => 'auth'], function($router){

    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::get('/activists', [ActivistsController::class, 'showActivists'])->name('view.activists');

    Route::get('/activists-cases/{id}', [ActivistsController::class, 'showActivistCases'])->name('activists.cases');

    Route::get('/activist-view-case_detail/{id}', [ActivistsController::class, 'activistViewCaseDetail']);


    Route::get('/activist-details/{id}', [ActivistsController::class, 'showActivistDetails'])->name('activist.details');

    Route::get('/report-activist/{id}', [ActivistsController::class, 'showReportActivist'])->name('activist.report');




    Route::get('/report-cases', [UsersController::class, 'showReportCasePage'])->name('report.case');

    Route::get('/send-complaint', [UsersController::class, 'showSendComplaintPage'])->name('send.complaint');




    Route::get('/settings', [SettingsController::class, 'showSettingsPage'])->name('user.settings');




    Route::get('/account', [AccountController::class, 'showAccountPage'])->name('user.account');

    Route::get('/create-new-user', [AccountController::class, 'showCreateNewUserPage'])->name('user.create');

    Route::post('/create-new-account', [AccountController::class, 'createNewAccount'])->name('account.create');

    Route::get('/accounts', [AccountController::class, 'showAccountsPage'])->name('user.accounts');

    Route::get('/edit-user-account/{id}', [AccountController::class, 'showEditAccountPage'])->name('edit.account');

    Route::put('/update-account', [AccountController::class, 'updateUserAccount'])->name('account.update');

    Route::get('/confirm-delete-user-account/{id}', [AccountController::class, 'showConfirmDeleteUserAccount'])->name('confirm.delete.account');

    Route::delete('/delete-user-account', [AccountController::class, 'deleteUserAccount'])->name('account.delete');





    Route::get('/chats', [ChatController::class, 'showChats'])->name('user.chats');

    Route::get('/chat', [ChatController::class, 'showChatPage']);

    Route::post('/send-chat-message', [ChatController::class, 'saveChatMessage']);


    Route::get('/chat-detail', [ChatController::class, 'showChatDetail'])->name('chat.detail');

   
    


    Route::get('/complaints', [ComplaintsController::class, 'showComplaintsPage'])->name('user.complaints');

    Route::post('/complaints', [ComplaintsController::class, 'saveComplaint'])->name('user.complaint');

    Route::get('/my-complaints', [ComplaintsController::class, 'showViewMyComplaintsPage'])->name('my.complaints');

    Route::get('/confirm-delete-complaint/{id}', [ComplaintsController::class, 'showConfirmDeleteComplaint']);

    Route::delete('/delete-my-complaint', [ComplaintsController::class, 'deleteMyComplaint'])->name('delete.user.complaint');







    Route::get('/manage-cases', [CaseController::class, 'showManageCases'])->name('manage.cases');

    Route::post('/report-case', [CaseController::class, 'storeCase'])->name('case.report');

    Route::get('/view-case-detail-as-admin', [CaseController::class, 'showAdminCaseDetailPage'])->name('admin.view.case.detail');



    Route::get('/show-violence-types', [ViolenceController::class, 'showViolenceTypesPage'])->name('violence.types.view');

    Route::get('/create-violence-type', [ViolenceController::class, 'showCreateViolencePage'])->name('violence.create');

    Route::post('/create-violence-type', [ViolenceController::class, 'createViolenceType'])->name('violence.save');

    Route::get('/edit-violence-type/{id}', [ViolenceController::class, 'showEditViolenceTypePage'])->name('violence.type.edit');

    Route::put('/update-violence-types', [ViolenceController::class, 'updateViolenceType'])->name('violence.type.update');

    Route::get('/confirm-delete-violence-type/{id}', [ViolenceController::class, 'showConfirmDeleteViolenceTypePage'])->name('violence.type.delete.confirm');
    
    Route::delete('/delete-violence-type', [ViolenceController::class, 'deleteViolenceType'])->name('violence.type.delete');







    

    Route::get('/view-sub-counties', [SubCountiesController::class, 'showSubCounties'])->name('subcounties.view');

    Route::get('/create-sub-county', [SubCountiesController::class, 'showCreateSubcountyPage'])->name('subcounty.create');

    Route::post('/create-sub-county', [SubCountiesController::class, 'createSubcounty'])->name('subcounty.save');

    Route::get('/edit-sub-county/{id}', [SubCountiesController::class, 'showEditSubCountyPage'])->name('subcounty.edit');

    Route::put('/update-sub-county', [SubCountiesController::class, 'updateSubCounty'])->name('subcounty.update');

    Route::get('/confirm-delete-sub-county/{id}', [SubCountiesController::class, 'showConfirmDeleteSubCountyPage'])->name('subcounty.delete.confirm');

    Route::delete('/delete-sub-county', [SubCountiesController::class, 'deleteSubCounty'])->name('subcounty.delete');


    Route::get('/user-cases', [UserCaseController::class, 'showUserCasesPage'])->name('users.cases');

    Route::get('/user-case-detail/{id}', [UserCaseController::class, 'showUserCaseDetailPage']);

    Route::get('/confirm-delete-case/{id}', [UserCaseController::class, 'showConfirmDeleteCasePage']);

    Route::delete('/delete-user-case', [UserCaseController::class, 'deleteUserCase'])->name('delete.user.case');


    Route::get('/user-view-activist-feedback-on-case', [UserCaseController::class, 'showUserViewActivistFeedbackOnCasePage']);

    Route::post('/report-an-activist', [ReportedUsersController::class, 'reportAUser'])->name('report.activist');

    Route::get('/dashboard-stats', [CustomAuthController::class, 'getDashboardStatistics'])->name('dashboard.stats');

    Route::post('/save-feedback', [CaseFeedbackController::class, 'saveCaseFeedback']);

});

Route::get('/dashboard-home', [CustomAuthController::class, 'showDashboardHome'])->name('dashboard.home');

//Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
//Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
//Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 


Route::post('/send-sms', [ChatController::class, 'sendSMS']);