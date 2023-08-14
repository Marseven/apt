<?php

use App\Http\Controllers\Admin\CandidatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ElectionController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Front\WelcomeController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
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

//home
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/partisan', [WelcomeController::class, 'partisan'])->name('partisan');

//Membre
Route::post('/member', [WelcomeController::class, 'register'])->name('register');

//Scrutateur
Route::post('/vote', [WelcomeController::class, 'scruteur']);

Route::get('logout',  function () {
    Auth::logout();

    return redirect('login');
});

Route::get('503', function () {
    return 'Accès non autorisé';
});

Route::get('404', function () {
    return 'Page non trouvée';
});
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/profil');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return redirect('/profil')->with('error', "Vous devez verifier votre email pour accéder à cette page.");
})->middleware('auth')->name('verification.notice');

Route::get('/email/verification-notification', function () {
    $user = User::find(auth()->user()->id);
    $user->sendEmailVerificationNotification();

    return back()->with('success', 'Le lien de vérification a été envoyé. Consultez votre boîte mail (les spams également) pour valider votre email.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/switchlang', [WelcomeController::class, 'lang'])->name('changeLang');

Route::middleware('auth')->group(function () {
});

/*
| Backend
*/
Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::get('/notifications', [DashboardController::class, 'notifications']);

    //members
    Route::get('/list-members', [MemberController::class, 'index'])->name('admin-list-members');
    Route::post('/member/{member}', [MemberController::class, 'update'])->name('admin-update-member');
    Route::get('/ajax-members', [MemberController::class, 'ajaxMembers'])->name('admin-ajax-members');
    Route::post('/ajax-member', [MemberController::class, 'getMember'])->name('admin-ajax-member');

    Route::get('/export-members', [ExportController::class, 'index'])->name('admin-export-members');

    //candidats
    Route::get('/list-candidats', [CandidatController::class, 'index'])->name('admin-list-candidats');
    Route::post('/candidat/{candidat}', [CandidatController::class, 'update'])->name('admin-update-candidat');
    Route::post('/candidat', [CandidatController::class, 'create'])->name('admin-create-candidat');
    Route::get('/ajax-candidats', [CandidatController::class, 'ajaxCandidats'])->name('admin-ajax-candidats');
    Route::post('/ajax-candidat', [CandidatController::class, 'getCandidat'])->name('admin-ajax-candidat');

    //desks
    Route::get('/list-desks', [ElectionController::class, 'desks'])->name('admin-list-desks');
    Route::post('/desk/{desk}', [ElectionController::class, 'updateDesk'])->name('admin-update-desk');
    Route::post('/desk', [ElectionController::class, 'createDesk'])->name('admin-create-desk');
    Route::get('/ajax-desks', [ElectionController::class, 'ajaxDesks'])->name('admin-ajax-desks');
    Route::post('/ajax-desk', [ElectionController::class, 'getDesk'])->name('admin-ajax-desk');

    //elections
    Route::get('/list-elections', [ElectionController::class, 'index'])->name('admin-list-elections');
    Route::post('/election/{election}', [ElectionController::class, 'update'])->name('admin-update-election');
    Route::post('/election', [ElectionController::class, 'create'])->name('admin-create-election');
    Route::get('/ajax-elections', [ElectionController::class, 'ajaxElections'])->name('admin-ajax-elections');
    Route::post('/ajax-election', [ElectionController::class, 'getElection'])->name('admin-ajax-election');

    //users
    Route::get('/admin-profil', [UserController::class, 'profil'])->name('admin-profil');
    Route::get('/list-admins', [UserController::class, 'admins']);
    Route::get('/list-scrutateurs', [UserController::class, 'scrutateurs']);
    Route::get('/add-user', [UserController::class, 'add']);
    Route::post('/create-user', [UserController::class, 'create']);
    Route::post('/update-user/{user}', [UserController::class, 'update']);

    //role
    Route::get('security-role', [SecurityRoleController::class, 'index']);
    Route::get('security-role/delete/{_id}', [SecurityRoleController::class, 'delete']);
    Route::post('security-role', [SecurityRoleController::class, 'save']);
    Route::get('security-role/edit/{_id}', [SecurityRoleController::class, 'edit']);

    Route::get('security-object', [SecurityObjectController::class, 'index']);
    Route::get('security-object/delete/{_id}', [SecurityObjectController::class, 'delete']);
    Route::post('security-object', [SecurityObjectController::class, 'save']);
    Route::get('security-object/edit/{_id}', [SecurityObjectController::class, 'edit']);

    Route::get('security-permission', [SecurityPermissionController::class, 'index']);
    Route::get('security-permission/delete/{_id}', [SecurityPermissionController::class, 'delete']);
    Route::post('security-permission', [SecurityPermissionController::class, 'save']);
    Route::post('security-permission/edit/{_id}', [SecurityRoleController::class, 'permission']);
});

//Lw!^M$4lYoOq
