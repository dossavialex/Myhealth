<?php

use App\Http\Controllers\ComposantController;
use App\Http\Controllers\ElementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Models\ComposantRepas;
use App\Models\ElementComposant;

/*Route::get('/', function () {
    return view('welcome');
});*/


    Route::get('inscription',[UserController::class,'register'])->name('inscription');
    Route::post('post-inscription',[UserController::class,'post_register'])->name('post_inscription');
    Route::get('/',[UserController::class,'login'])->name('connexion');
    Route::post('post-connexion',[UserController::class,'post_login'])->name('post_connexion');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('forget-password',[UserController::class,'form_forget_password'])->name('password.request');
    Route::post('forget-password',[UserController::class,'forget_password'])->name('password.email');
    Route::get('reset-password/{token}',[UserController::class,'form_reset_password'])->name('password.reset');
    Route::post('/reset-password',[UserController::class,'ResetPassword'])->name('password.update');;

Route::middleware(['admin'])->group(function () {

    Route::get('ajouter-Element',[ElementController::class,'form_element'])->name('form_element');
    Route::post('ajouter-Element',[ElementController::class,'form_element_post'])->name('form_element_post');
    Route::post('modifier-Element',[ElementController::class,'form_element_modif_post'])->name('form_element_modif_post');
    Route::get('supprimer-Element/{id}',[ElementController::class,'delete_element'])->name('delete_element');
    Route::get('dashboard-composant',[ComposantController::class,'dashboardComposant'])->name('dashboardComposant');
    Route::post('ajouter-composant',[ComposantController::class,'post_ajout_composant'])->name('post_ajout_composant');
    Route::get('supprimer-composant/{id}',[ComposantController::class,'delete_composant'])->name('delete_composant');
    Route::get('modifier-composant/{id}',[ComposantController::class,'modif_composant'])->name('modif_composant');
    Route::post('modifier-composant/{id}',[ComposantController::class,'post_modif_composant'])->name('post_modif_composant');
    Route::post('modifier-image-composant/{id}',[ComposantController::class,'post_modif_photo_composant'])->name('post_modif_photo_composant');
});

Route::middleware(['web','remember'])->group(function () {
    Route::get('accueil',[ViewController::class,'principoal_view'])->name('accueil');
    Route::get('ajouter-repas',[ViewController::class,'form_view'])->name('form_view');
    Route::post('post-form-ajout-repas',[ViewController::class,'post_form_repas'])->name('post_form_view');
    Route::get('modificaion-profil',[ViewController::class,'modif_profil'])->name('modif_profil');
    Route::post('post-modif-profil/{id}',[ViewController::class,'post_modif_profil'])->name('post_modif_profil');
    Route::post('post-modif-profil-password/{id}',[ViewController::class,'post_modif_profil_password'])->name('post_modif_profil_password');
    Route::get('detail-repas-day/{date}',[ViewController::class,'detailRepasday'])->name('detailRepasday');
    Route::get('detail-repas/{id}/{date}/{n}',[ViewController::class,'detailRepas'])->name('detailRepas');
    Route::post('modif-image-profil',[ViewController::class,'modif_photo'])->name('modif_photo');

});


