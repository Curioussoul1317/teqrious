<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\FeaturedWorkController;
use App\Http\Controllers\Admin\AboutContentController;
use App\Http\Controllers\Admin\ValueController;
use App\Http\Controllers\Admin\WorkStepController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ClientController; 
use App\Http\Controllers\Admin\OurClientController; 
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\BillController as AdminBillController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\Client\BillController as ClientBillController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CommentController;

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');
 

// Route::middleware('guest')->group(function () {
//     Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
//     Route::post('/login', [LoginController::class, 'login']);
// });

// Route::middleware('auth')->group(function () {
//     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//     Route::get('/profile', [LoginController::class, 'showProfile'])->name('profile');
//     Route::put('/profile', [LoginController::class, 'updateProfile'])->name('profile.update');
//     Route::put('/profile/password', [LoginController::class, 'updatePassword'])->name('profile.password');
// });

// Admin Routes
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {


     // Client Management
     Route::resource('clients', ClientController::class);
     Route::post('/clients/{client}/reset-password', [ClientController::class, 'resetPassword'])->name('clients.reset-password');
     Route::post('/clients/{client}/toggle-status', [ClientController::class, 'toggleStatus'])->name('clients.toggle-status');
 
     // Project Management
     Route::resource('projects', AdminProjectController::class);
     Route::post('/projects/{project}/updates', [AdminProjectController::class, 'addUpdate'])->name('projects.updates.store');
 
     // Bill Management
     Route::resource('bills', AdminBillController::class);
     Route::patch('/bills/{bill}/status', [AdminBillController::class, 'updateStatus'])->name('bills.status');
     Route::get('/clients/{client}/projects', [AdminBillController::class, 'getProjectsByClient'])->name('clients.projects');


    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Website Content Management
    Route::resource('our-clients', OurClientController::class);
    Route::resource('client-images', \App\Http\Controllers\Admin\OurClientImageController::class);
    Route::resource('hero-slides', HeroSlideController::class);
    Route::resource('featured-works', FeaturedWorkController::class);
    Route::resource('values', ValueController::class);
    Route::resource('work-steps', WorkStepController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('products', ProductController::class);
    Route::resource('contacts', ContactController::class)->except(['create', 'store', 'edit']);
    
    // About Page
    Route::get('about', [AboutContentController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutContentController::class, 'update'])->name('about.update');
    
    // Site Settings
    Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SiteSettingController::class, 'store'])->name('settings.store');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');
    Route::delete('settings/{setting}', [SiteSettingController::class, 'destroy'])->name('settings.destroy');
});

 
 /*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');

    // Projects
    Route::get('/projects', [ClientProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ClientProjectController::class, 'show'])->name('projects.show');

    // Bills
    Route::get('/bills', [ClientBillController::class, 'index'])->name('bills.index');
    Route::get('/bills/{bill}', [ClientBillController::class, 'show'])->name('bills.show');
});
 
/*
|--------------------------------------------------------------------------
| Shared Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Documents
    Route::post('/projects/{project}/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    // Comments
    Route::post('/projects/{project}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


    Route::get('/profile', [LoginController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [LoginController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [LoginController::class, 'updatePassword'])->name('profile.password');
});
