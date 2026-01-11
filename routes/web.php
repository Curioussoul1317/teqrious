<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\HighlightCardController;
use App\Http\Controllers\Admin\ServiceTileController;
use App\Http\Controllers\Admin\FeaturedWorkController;
use App\Http\Controllers\Admin\SubsidiaryController;
use App\Http\Controllers\Admin\AboutContentController;
use App\Http\Controllers\Admin\ValueController;
use App\Http\Controllers\Admin\WorkStepController;
use App\Http\Controllers\Admin\ExpertiseController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SubsidiaryQuoteController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/subsidiary/{slug}', [FrontendController::class, 'subsidiary'])->name('subsidiary.show');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');
Route::post('/subsidiary/{subsidiary}/quote', [FrontendController::class, 'submitQuote'])->name('subsidiary.quote');

// Admin Routes
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hero-slides', HeroSlideController::class);
    Route::resource('highlight-cards', HighlightCardController::class);
    Route::resource('service-tiles', ServiceTileController::class);
    Route::resource('featured-works', FeaturedWorkController::class);
    Route::resource('subsidiaries', SubsidiaryController::class);
    
    Route::post('subsidiaries/{subsidiary}/services', [SubsidiaryController::class, 'storeService'])->name('subsidiaries.services.store');
    Route::put('subsidiaries/{subsidiary}/services/{service}', [SubsidiaryController::class, 'updateService'])->name('subsidiaries.services.update');
    Route::delete('subsidiaries/{subsidiary}/services/{service}', [SubsidiaryController::class, 'destroyService'])->name('subsidiaries.services.destroy');
    Route::post('subsidiaries/{subsidiary}/gallery', [SubsidiaryController::class, 'storeGallery'])->name('subsidiaries.gallery.store');
    Route::delete('subsidiaries/{subsidiary}/gallery/{gallery}', [SubsidiaryController::class, 'destroyGallery'])->name('subsidiaries.gallery.destroy');

    Route::get('about', [AboutContentController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutContentController::class, 'update'])->name('about.update');

    Route::resource('values', ValueController::class);
    Route::resource('work-steps', WorkStepController::class);
    Route::resource('expertise', ExpertiseController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('contacts', ContactController::class)->except(['create', 'store', 'edit']);
    Route::resource('subsidiary-quotes', SubsidiaryQuoteController::class)->except(['create', 'store', 'edit']);

    Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SiteSettingController::class, 'store'])->name('settings.store');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');
    Route::delete('settings/{setting}', [SiteSettingController::class, 'destroy'])->name('settings.destroy');
});

 
 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
