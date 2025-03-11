<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ArchivePhotoController;
use App\Http\Controllers\HistoryPhotoController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'auth.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Home route handling
Route::get('/home',[HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home.home');
Route::get('/home/create', [HomeController::class, 'create'])->middleware(['auth', 'verified'])->name('home.create');
Route::post('/home', [HomeController::class, 'store'])->middleware(['auth', 'verified'])->name('home.store');
Route::get('/home/{home}/edit', [HomeController::class, 'edit'])->middleware(['auth', 'verified'])->name('home.edit');
Route::put('/home/{home}/update', [HomeController::class, 'update'])->middleware(['auth', 'verified'])->name('home.update');
Route::delete('/home/{home}', [HomeController::class, 'destroy'])->middleware(['auth', 'verified'])->name('home.destroy');
// End home route handling
Route::get('/home/preview', [HomeController::class, 'preview'])->middleware(['auth', 'verified'])->name('home.preview');
Route::get('/home/confirm', [HomeController::class, 'confirm'])->middleware(['auth', 'verified'])->name('home.confirm');
Route::get('/home/cancel', [HomeController::class, 'cancel'])->middleware(['auth', 'verified'])->name('home.cancel');

// Photo home route handling
// End photo home route handling

// Geschdenis route handling
Route::get('/history',[HistoryController::class, 'index'])->middleware(['auth', 'verified'])->name('history.history');
Route::get('/history/create', [HistoryController::class, 'create'])->middleware(['auth', 'verified'])->name('history.create');
Route::post('/history', [HistoryController::class, 'store'])->middleware(['auth', 'verified'])->name('history.store');
Route::get('/history/{history}/edit', [HistoryController::class, 'edit'])->middleware(['auth', 'verified'])->name('history.edit');
Route::put('/history/{history}/update', [HistoryController::class, 'update'])->middleware(['auth', 'verified'])->name('history.update');
Route::delete('/history/{history}', [HistoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('history.destroy');
// Geschiedenis route handling

// History photo handling
Route::get('/history/photos/{history}', [HistoryPhotoController::class, 'index'])->name('historyfoto.foto');
Route::get('/history/photos/{history}/addphoto', [HistoryPhotoController::class, 'create'])->name('historyfoto.create');
Route::get('/history/photo/edit/{history}', [HistoryPhotoController::class, 'edit'])->middleware(['auth', 'verified'])->name('historyfoto.edit');
Route::put('/historyfoto/{history}/update', [HistoryPhotoController::class, 'update'])->middleware(['auth', 'verified'])->name('historyfoto.update');
Route::post('/history/photo', [HistoryPhotoController::class, 'store'])->middleware(['auth', 'verified'])->name('historyfoto.store');
Route::delete('/history/photo/{history}', [HistoryPhotoController::class, 'destroy'])->middleware(['auth', 'verified'])->name('historyfoto.destroy');
// end history photo handling

// Event route handling
Route::get('/events',[EventController::class, 'index'])->middleware(['auth', 'verified'])->name('event.events');
Route::get('/events/create', [EventController::class, 'create'])->middleware(['auth', 'verified'])->name('event.create');
Route::post('/events', [EventController::class, 'store'])->middleware(['auth', 'verified'])->name('event.store');
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->middleware(['auth', 'verified'])->name('event.edit');
Route::put('/events/{event}/update', [EventController::class, 'update'])->middleware(['auth', 'verified'])->name('event.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->middleware(['auth', 'verified'])->name('event.destroy');
Route::post('/events/{event}/archive', [EventController::class, 'archive'])->middleware(['auth', 'verified'])->name('event.archive');
// End event route handling

// Archive route handling
Route::get('/archive',[ArchiveController::class, 'index'])->middleware(['auth', 'verified'])->name('archive.archive');
Route::get('/archive/{event}/edit', [ArchiveController::class, 'edit'])->middleware(['auth', 'verified'])->name('archive.edit');
Route::put('/archive/{event}/update', [ArchiveController::class, 'update'])->middleware(['auth', 'verified'])->name('archive.update');
Route::delete('/archive/{event}', [ArchiveController::class, 'destroy'])->middleware(['auth', 'verified'])->name('archive.destroy');
// End archive route handling


// News letter route handling
Route::get('/newsletter',[NewsController::class, 'index'])->middleware(['auth', 'verified'])->name('newsletter.newsletter');
Route::get('/newsletter/create',[NewsController::class, 'create'])->middleware(['auth', 'verified'])->name('newsletter.create');
Route::post('/newsletter',[NewsController::class, 'store'])->middleware(['auth', 'verified'])->name('newsletter.store');
Route::get('/newsletter/{newsletter}/edit',[NewsController::class, 'edit'])->middleware(['auth', 'verified'])->name('newsletter.edit');
Route::put('/newsletter/{newsletter}/update',[NewsController::class, 'update'])->middleware(['auth', 'verified'])->name('newsletter.update');
Route::delete('/newsletter/{newsletter}',[NewsController::class, 'destroy'])->middleware(['auth', 'verified'])->name('newsletter.destroy');
// End news letter route handling

// Phothobook route handling
Route::get('/archive/photos/{id}', [ArchivePhotoController::class, 'foto'])->name('archive.foto');
Route::get('/archive/photos/{id}/addphoto', [ArchivePhotoController::class, 'create'])->name('archive.create');
Route::get('/archive/photo/edit/{id}', [ArchivePhotoController::class, 'edit'])->middleware(['auth', 'verified'])->name('archive.fotoedit');
Route::put('/archive/{id}/update/foto', [ArchivePhotoController::class, 'update'])->middleware(['auth', 'verified'])->name('archive.fotoupdate');
Route::post('/archive/photo', [ArchivePhotoController::class, 'store'])->middleware(['auth', 'verified'])->name('archive.fotostore');
Route::delete('/archive/photo/{id}', [ArchivePhotoController::class, 'destroy'])->middleware(['auth', 'verified'])->name('archive.destroy');
// End photobook rout ehandling




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
