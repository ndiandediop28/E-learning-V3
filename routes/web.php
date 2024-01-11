<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\TacheStagiaireController;
use App\Http\Controllers\TemporalyImageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//cours
Route::group(['middleware' => 'auth'], function () {
    // Définissez ici vos routes qui nécessitent une authentification
    Route::get('/cours', [CourController::class, 'index'])->name('cours.index');
    Route::get('/cours/create', [CourController::class, 'create'])->name('cours.create');
    Route::post('/cours', [CourController::class, 'store'])->name('cours.store');
    Route::get('/cours/update/{id}',[CourController::class,'update'])->name('cours.update');
    Route::post('/cours/edit',[CourController::class,'edit'])->name('cours.edit');
    Route::get('/cours/delete/{id}',[CourController::class,'delete'])->name('cours.delete');
    Route::post('/cours/{cours}/mark-completed', [CourController::class, 'markCompleted'])->name('markCourseCompleted');

    // ... d'autres routes
});

//domaines
Route::group(['middleware' => 'auth'], function () {
    // Définissez ici vos routes qui nécessitent une authentification
    Route::get('/domaines', [DomaineController::class, 'index'])->name('domaines.index');
    Route::get('/domaines/create', [DomaineController::class, 'create'])->name('domaines.create');
    Route::post('/domaines', [DomaineController::class, 'store'])->name('domaines.store');
    Route::get('/domaines/{id}',[DomaineController::class,'addmodule'])->name('domaines.addmodule');
    Route::get('/domaines/update/{id}',[DomaineController::class,'update'])->name('domaines.update');
    Route::post('/domaines/edit',[DomaineController::class,'edit'])->name('domaines.edit');
    Route::get('/domaines/delete/{id}',[DomaineController::class,'delete'])->name('domaines.delete');
    // ... d'autres routes
});
//modules
Route::group(['middleware' => 'auth'], function () {
    // Définissez ici vos routes qui nécessitent une authentification
    Route::get('/modules', [ModuleController::class, 'index'])->name('module.index');
    Route::get('/modules/create', [ModuleController::class, 'create'])->name('module.create');
    Route::post('/modules', [ModuleController::class, 'store'])->name('module.store');
    Route::get('/modules/{id}',[ModuleController::class,'addcours'])->name('module.addcours');
    Route::get('/modules/update/{id}',[ModuleController::class,'update'])->name('module.update');
    Route::post('/modules/edit',[ModuleController::class,'edit'])->name('module.edit');
    Route::get('/modules/delete/{id}',[ModuleController::class,'delete'])->name('module.delete');

    // ... d'autres routes
});

Route::group(['middleware' => ['web']], function (){
    Route::post('/update-progress', [ModuleController::class, 'updateProgress'])->name('update-progress');
});

//stagiaires
Route::group(['middleware' => 'auth'], function () {
    // Définissez ici vos routes qui nécessitent une authentification
    Route::get('/stagiaires', [StagiaireController::class, 'index'])->name('stagiaires.index');
    Route::get('/etat/{id}', [StagiaireController::class, 'etat'])->name('stagiaires.etat');
    Route::get('/resetmotdepasse/{id}', [StagiaireController::class, 'resetmotdepasse'])->name('stagiaires.resetmotdepasse');
    Route::get('/stagiaires/create', [StagiaireController::class, 'create'])->name('stagiaires.create');
    Route::post('/stagiaires', [StagiaireController::class, 'store'])->name('stagiaires.ajouter');
    Route::get('/stagiaires/{id}',[StagiaireController::class,'showStagiaire'])->name('stagiaires.showStagiaire');
    Route::get('/stagiaires/update/{id}',[StagiaireController::class,'update'])->name('stagiaires.updateStagiaire');
    Route::post('/stagiaires/edit',[StagiaireController::class,'editStagiaire'])->name('stagiaires.editeStagiaire');

    // ... d'autres routes
});



// -----------------------Stagiaires controle connection--------------------------------------------------------
Route::get('/',[StagiaireController::class,'indexlogin'])->name('stagiaires.login_form');
Route::post('/loginstagiaire',[StagiaireController::class,'login'])->name('stagiaires.login');

Route::group(['middleware' => 'stagiaire'],function(){
Route::get('/dashboardStagiaire',[StagiaireController::class,'dashboard'])->name('stagiaires.dashboard');
Route::get('/logintstagiaire',[StagiaireController::class,'logout'])->name('stagiaires.logout');
Route::get('/modulestagiaire/{id}',[StagiaireController::class,'module'])->name('stagiaires.modulestagiaire');
Route::get('/courstagiaire/{id}',[StagiaireController::class,'cours'])->name('stagiaires.courstagiaire');
Route::post('/storestagiaire',[StagiaireController::class,'store'])->name('stagiaires.store');
Route::get('/updatestagiaire/{id}',[StagiaireController::class,'edit'])->name('stagiaires.edit');
Route::post('/updatestagiaire',[StagiaireController::class,'updateProfil'])->name('stagiaires.updateProfil');
Route::get('/changemotdepassestagiaire/{id}',[StagiaireController::class,'changemotdepasse'])->name('stagiaires.changemotdepasse');
Route::post('/updatepasswordstagiaire',[StagiaireController::class,'updatepassword'])->name('stagiaires.updatepassword');
Route::get('/gettache/{id}',[TacheStagiaireController::class,'gettache'])->name('stagiaires.gettache');
Route::post('/addfiletache',[TacheStagiaireController::class,'addfiletache'])->name('stagiaires.addfiletache');
Route::get('allfiletaches/{id}',[TacheStagiaireController::class,'allfiletaches'])->name('stagiaires.allfiletaches');
Route::get('showtache/{id}',[TacheStagiaireController::class,'showtache'])->name('stagiaires.showtache');
// Route::post('/temporariyimage',[TemporalyImageController::class,'store'])->name('stagiaires.temporariyimage');
// Route::delete('/deletetemporariyimage',[TemporalyImageController::class,'deletetmpfile'])->name('stagiaires.removetemporariyimage');

});

require __DIR__.'/auth.php';
