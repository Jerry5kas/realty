<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/theme-settings', [App\Http\Controllers\ThemeSettingsController::class, 'index'])
    ->middleware('auth')->name('theme.settings');

Route::post('/theme-settings', [App\Http\Controllers\ThemeSettingsController::class, 'update'])
    ->middleware('auth')->name('theme.settings.update');

Route::resource('cities', App\Http\Controllers\CityController::class)->middleware('auth');
Route::post('/cities/bulk-delete', [App\Http\Controllers\CityController::class, 'bulkDelete'])
    ->middleware('auth')->name('cities.bulk-delete');

// Properties Routes
Route::resource('properties', App\Http\Controllers\PropertyController::class)->middleware('auth');
Route::post('/properties/bulk-delete', [App\Http\Controllers\PropertyController::class, 'bulkDelete'])
    ->middleware('auth')->name('properties.bulk-delete');

// Projects Routes
Route::resource('projects', App\Http\Controllers\ProjectController::class)->middleware('auth');
Route::post('/projects/bulk-delete', [App\Http\Controllers\ProjectController::class, 'bulkDelete'])
    ->middleware('auth')->name('projects.bulk-delete');

// ImageKit Routes
Route::get('/imagekit/auth', [App\Http\Controllers\ImageKitController::class, 'auth'])
    ->middleware('auth')->name('imagekit.auth');
Route::post('/imagekit/upload', [App\Http\Controllers\ImageKitController::class, 'upload'])
    ->middleware('auth')->name('imagekit.upload');

// Amenities Routes
Route::resource('amenities', App\Http\Controllers\AmenityController::class)->middleware('auth');
Route::post('/amenities/bulk-delete', [App\Http\Controllers\AmenityController::class, 'bulkDelete'])
    ->middleware('auth')->name('amenities.bulk-delete');

// Property Features Routes
Route::resource('features', App\Http\Controllers\PropertyFeatureController::class)->middleware('auth');
Route::post('/features/bulk-delete', [App\Http\Controllers\PropertyFeatureController::class, 'bulkDelete'])
    ->middleware('auth')->name('features.bulk-delete');

// Property Types Routes
Route::resource('property-types', App\Http\Controllers\PropertyTypeController::class)->middleware('auth');
Route::post('/property-types/bulk-delete', [App\Http\Controllers\PropertyTypeController::class, 'bulkDelete'])
    ->middleware('auth')->name('property-types.bulk-delete');

// Builders Routes
Route::resource('builders', App\Http\Controllers\BuilderController::class)->middleware('auth');
Route::post('/builders/bulk-delete', [App\Http\Controllers\BuilderController::class, 'bulkDelete'])
    ->middleware('auth')->name('builders.bulk-delete');

// Banners Routes
Route::resource('banners', App\Http\Controllers\BannerController::class)->middleware('auth');
Route::post('/banners/bulk-delete', [App\Http\Controllers\BannerController::class, 'bulkDelete'])
    ->middleware('auth')->name('banners.bulk-delete');

// Media Assets Routes
Route::resource('media-assets', App\Http\Controllers\MediaAssetController::class)->middleware('auth');
Route::post('/media-assets/bulk-delete', [App\Http\Controllers\MediaAssetController::class, 'bulkDelete'])
    ->middleware('auth')->name('media-assets.bulk-delete');

// Events Routes
Route::get('/events/calendar', [App\Http\Controllers\EventController::class, 'calendar'])
    ->middleware('auth')->name('events.calendar');
Route::resource('events', App\Http\Controllers\EventController::class)->middleware('auth');
Route::post('/events/bulk-delete', [App\Http\Controllers\EventController::class, 'bulkDelete'])
    ->middleware('auth')->name('events.bulk-delete');

// Transactions Routes
Route::resource('transactions', App\Http\Controllers\TransactionController::class)->middleware('auth');
Route::post('/transactions/bulk-delete', [App\Http\Controllers\TransactionController::class, 'bulkDelete'])
    ->middleware('auth')->name('transactions.bulk-delete');

// Roles Routes
Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('auth');
Route::post('/roles/bulk-delete', [App\Http\Controllers\RoleController::class, 'bulkDelete'])
    ->middleware('auth')->name('roles.bulk-delete');

// Users Routes
Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');
Route::post('/users/bulk-delete', [App\Http\Controllers\UserController::class, 'bulkDelete'])
    ->middleware('auth')->name('users.bulk-delete');


// Collections Routes - Admin (must come before public routes)
Route::middleware('auth')->group(function () {
    Route::resource('collections', App\Http\Controllers\CollectionController::class);
    Route::post('/collections/bulk-delete', [App\Http\Controllers\CollectionController::class, 'bulkDelete'])
        ->name('collections.bulk-delete');
});

// Collections Routes - Public
Route::get('/collection/{slug}', [App\Http\Controllers\CollectionController::class, 'showPublic'])->name('collection.show');

// Listings Page - Public
Route::get('/listings', [HomeController::class, 'listings'])->name('listings');
