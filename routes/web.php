<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/listings', [HomeController::class, 'listings'])->name('listings');
Route::get('/map-view', [HomeController::class, 'mapView'])->name('map.view');
Route::get('/collection/{slug}', [App\Http\Controllers\CollectionController::class, 'showPublic'])->name('collection.show');
Route::get('/property/{property}', [App\Http\Controllers\PropertyController::class, 'show'])->name('property.show');
Route::get('/project/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->name('project.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Favorites Routes (Authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites');
    Route::post('/favorites/toggle', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::post('/favorites/remove', [App\Http\Controllers\FavoriteController::class, 'remove'])->name('favorites.remove');
});

// Protected Routes - Require Authentication
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ImageKit Routes (All authenticated users)
    Route::get('/imagekit/auth', [App\Http\Controllers\ImageKitController::class, 'auth'])->name('imagekit.auth');
    Route::post('/imagekit/upload', [App\Http\Controllers\ImageKitController::class, 'upload'])->name('imagekit.upload');

    // Properties Routes
    Route::middleware('permission:properties.view')->group(function () {
        Route::get('/properties', [App\Http\Controllers\PropertyController::class, 'index'])->name('properties.index');
        Route::get('/properties/{property}/edit', [App\Http\Controllers\PropertyController::class, 'edit'])
            ->middleware('permission:properties.edit')->name('properties.edit');
        Route::get('/properties/create', [App\Http\Controllers\PropertyController::class, 'create'])
            ->middleware('permission:properties.create')->name('properties.create');
        Route::post('/properties', [App\Http\Controllers\PropertyController::class, 'store'])
            ->middleware('permission:properties.create')->name('properties.store');
        Route::put('/properties/{property}', [App\Http\Controllers\PropertyController::class, 'update'])
            ->middleware('permission:properties.edit')->name('properties.update');
        Route::delete('/properties/{property}', [App\Http\Controllers\PropertyController::class, 'destroy'])
            ->middleware('permission:properties.delete')->name('properties.destroy');
        Route::post('/properties/bulk-delete', [App\Http\Controllers\PropertyController::class, 'bulkDelete'])
            ->middleware('permission:properties.delete')->name('properties.bulk-delete');
    });

    // Projects Routes
    Route::middleware('permission:projects.view')->group(function () {
        Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects/{project}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])
            ->middleware('permission:projects.edit')->name('projects.edit');
        Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])
            ->middleware('permission:projects.create')->name('projects.create');
        Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store'])
            ->middleware('permission:projects.create')->name('projects.store');
        Route::put('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'update'])
            ->middleware('permission:projects.edit')->name('projects.update');
        Route::delete('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'destroy'])
            ->middleware('permission:projects.delete')->name('projects.destroy');
        Route::post('/projects/bulk-delete', [App\Http\Controllers\ProjectController::class, 'bulkDelete'])
            ->middleware('permission:projects.delete')->name('projects.bulk-delete');
    });

    // Cities Routes
    Route::middleware('permission:cities.view')->group(function () {
        Route::get('/cities', [App\Http\Controllers\CityController::class, 'index'])->name('cities.index');
        Route::get('/cities/{city}', [App\Http\Controllers\CityController::class, 'show'])->name('cities.show');
        Route::get('/cities/{city}/edit', [App\Http\Controllers\CityController::class, 'edit'])
            ->middleware('permission:cities.edit')->name('cities.edit');
        Route::get('/cities/create', [App\Http\Controllers\CityController::class, 'create'])
            ->middleware('permission:cities.create')->name('cities.create');
        Route::post('/cities', [App\Http\Controllers\CityController::class, 'store'])
            ->middleware('permission:cities.create')->name('cities.store');
        Route::put('/cities/{city}', [App\Http\Controllers\CityController::class, 'update'])
            ->middleware('permission:cities.edit')->name('cities.update');
        Route::delete('/cities/{city}', [App\Http\Controllers\CityController::class, 'destroy'])
            ->middleware('permission:cities.delete')->name('cities.destroy');
        Route::post('/cities/bulk-delete', [App\Http\Controllers\CityController::class, 'bulkDelete'])
            ->middleware('permission:cities.delete')->name('cities.bulk-delete');
    });

    // Amenities Routes
    Route::middleware('permission:amenities.view')->group(function () {
        Route::get('/amenities', [App\Http\Controllers\AmenityController::class, 'index'])->name('amenities.index');
        Route::get('/amenities/{amenity}', [App\Http\Controllers\AmenityController::class, 'show'])->name('amenities.show');
        Route::get('/amenities/{amenity}/edit', [App\Http\Controllers\AmenityController::class, 'edit'])
            ->middleware('permission:amenities.edit')->name('amenities.edit');
        Route::get('/amenities/create', [App\Http\Controllers\AmenityController::class, 'create'])
            ->middleware('permission:amenities.create')->name('amenities.create');
        Route::post('/amenities', [App\Http\Controllers\AmenityController::class, 'store'])
            ->middleware('permission:amenities.create')->name('amenities.store');
        Route::put('/amenities/{amenity}', [App\Http\Controllers\AmenityController::class, 'update'])
            ->middleware('permission:amenities.edit')->name('amenities.update');
        Route::delete('/amenities/{amenity}', [App\Http\Controllers\AmenityController::class, 'destroy'])
            ->middleware('permission:amenities.delete')->name('amenities.destroy');
        Route::post('/amenities/bulk-delete', [App\Http\Controllers\AmenityController::class, 'bulkDelete'])
            ->middleware('permission:amenities.delete')->name('amenities.bulk-delete');
    });

    // Property Features Routes
    Route::middleware('permission:features.view')->group(function () {
        Route::get('/features', [App\Http\Controllers\PropertyFeatureController::class, 'index'])->name('features.index');
        Route::get('/features/{feature}', [App\Http\Controllers\PropertyFeatureController::class, 'show'])->name('features.show');
        Route::get('/features/{feature}/edit', [App\Http\Controllers\PropertyFeatureController::class, 'edit'])
            ->middleware('permission:features.edit')->name('features.edit');
        Route::get('/features/create', [App\Http\Controllers\PropertyFeatureController::class, 'create'])
            ->middleware('permission:features.create')->name('features.create');
        Route::post('/features', [App\Http\Controllers\PropertyFeatureController::class, 'store'])
            ->middleware('permission:features.create')->name('features.store');
        Route::put('/features/{feature}', [App\Http\Controllers\PropertyFeatureController::class, 'update'])
            ->middleware('permission:features.edit')->name('features.update');
        Route::delete('/features/{feature}', [App\Http\Controllers\PropertyFeatureController::class, 'destroy'])
            ->middleware('permission:features.delete')->name('features.destroy');
        Route::post('/features/bulk-delete', [App\Http\Controllers\PropertyFeatureController::class, 'bulkDelete'])
            ->middleware('permission:features.delete')->name('features.bulk-delete');
    });

    // Property Types Routes
    Route::middleware('permission:property-types.view')->group(function () {
        Route::get('/property-types', [App\Http\Controllers\PropertyTypeController::class, 'index'])->name('property-types.index');
        Route::get('/property-types/{propertyType}', [App\Http\Controllers\PropertyTypeController::class, 'show'])->name('property-types.show');
        Route::get('/property-types/{propertyType}/edit', [App\Http\Controllers\PropertyTypeController::class, 'edit'])
            ->middleware('permission:property-types.edit')->name('property-types.edit');
        Route::get('/property-types/create', [App\Http\Controllers\PropertyTypeController::class, 'create'])
            ->middleware('permission:property-types.create')->name('property-types.create');
        Route::post('/property-types', [App\Http\Controllers\PropertyTypeController::class, 'store'])
            ->middleware('permission:property-types.create')->name('property-types.store');
        Route::put('/property-types/{propertyType}', [App\Http\Controllers\PropertyTypeController::class, 'update'])
            ->middleware('permission:property-types.edit')->name('property-types.update');
        Route::delete('/property-types/{propertyType}', [App\Http\Controllers\PropertyTypeController::class, 'destroy'])
            ->middleware('permission:property-types.delete')->name('property-types.destroy');
        Route::post('/property-types/bulk-delete', [App\Http\Controllers\PropertyTypeController::class, 'bulkDelete'])
            ->middleware('permission:property-types.delete')->name('property-types.bulk-delete');
    });

    // Builders Routes
    Route::middleware('permission:builders.view')->group(function () {
        Route::get('/builders', [App\Http\Controllers\BuilderController::class, 'index'])->name('builders.index');
        Route::get('/builders/{builder}', [App\Http\Controllers\BuilderController::class, 'show'])->name('builders.show');
        Route::get('/builders/{builder}/edit', [App\Http\Controllers\BuilderController::class, 'edit'])
            ->middleware('permission:builders.edit')->name('builders.edit');
        Route::get('/builders/create', [App\Http\Controllers\BuilderController::class, 'create'])
            ->middleware('permission:builders.create')->name('builders.create');
        Route::post('/builders', [App\Http\Controllers\BuilderController::class, 'store'])
            ->middleware('permission:builders.create')->name('builders.store');
        Route::put('/builders/{builder}', [App\Http\Controllers\BuilderController::class, 'update'])
            ->middleware('permission:builders.edit')->name('builders.update');
        Route::delete('/builders/{builder}', [App\Http\Controllers\BuilderController::class, 'destroy'])
            ->middleware('permission:builders.delete')->name('builders.destroy');
        Route::post('/builders/bulk-delete', [App\Http\Controllers\BuilderController::class, 'bulkDelete'])
            ->middleware('permission:builders.delete')->name('builders.bulk-delete');
    });

    // Banners Routes
    Route::middleware('permission:banners.view')->group(function () {
        Route::get('/banners', [App\Http\Controllers\BannerController::class, 'index'])->name('banners.index');
        Route::get('/banners/{banner}', [App\Http\Controllers\BannerController::class, 'show'])->name('banners.show');
        Route::get('/banners/{banner}/edit', [App\Http\Controllers\BannerController::class, 'edit'])
            ->middleware('permission:banners.edit')->name('banners.edit');
        Route::get('/banners/create', [App\Http\Controllers\BannerController::class, 'create'])
            ->middleware('permission:banners.create')->name('banners.create');
        Route::post('/banners', [App\Http\Controllers\BannerController::class, 'store'])
            ->middleware('permission:banners.create')->name('banners.store');
        Route::put('/banners/{banner}', [App\Http\Controllers\BannerController::class, 'update'])
            ->middleware('permission:banners.edit')->name('banners.update');
        Route::delete('/banners/{banner}', [App\Http\Controllers\BannerController::class, 'destroy'])
            ->middleware('permission:banners.delete')->name('banners.destroy');
        Route::post('/banners/bulk-delete', [App\Http\Controllers\BannerController::class, 'bulkDelete'])
            ->middleware('permission:banners.delete')->name('banners.bulk-delete');
    });

    // Media Assets Routes
    Route::middleware('permission:media-assets.view')->group(function () {
        Route::get('/media-assets', [App\Http\Controllers\MediaAssetController::class, 'index'])->name('media-assets.index');
        Route::get('/media-assets/{mediaAsset}', [App\Http\Controllers\MediaAssetController::class, 'show'])->name('media-assets.show');
        Route::get('/media-assets/{mediaAsset}/edit', [App\Http\Controllers\MediaAssetController::class, 'edit'])
            ->middleware('permission:media-assets.edit')->name('media-assets.edit');
        Route::get('/media-assets/create', [App\Http\Controllers\MediaAssetController::class, 'create'])
            ->middleware('permission:media-assets.create')->name('media-assets.create');
        Route::post('/media-assets', [App\Http\Controllers\MediaAssetController::class, 'store'])
            ->middleware('permission:media-assets.create')->name('media-assets.store');
        Route::put('/media-assets/{mediaAsset}', [App\Http\Controllers\MediaAssetController::class, 'update'])
            ->middleware('permission:media-assets.edit')->name('media-assets.update');
        Route::delete('/media-assets/{mediaAsset}', [App\Http\Controllers\MediaAssetController::class, 'destroy'])
            ->middleware('permission:media-assets.delete')->name('media-assets.destroy');
        Route::post('/media-assets/bulk-delete', [App\Http\Controllers\MediaAssetController::class, 'bulkDelete'])
            ->middleware('permission:media-assets.delete')->name('media-assets.bulk-delete');
    });

    // Collections Routes
    Route::middleware('permission:collections.view')->group(function () {
        Route::get('/collections', [App\Http\Controllers\CollectionController::class, 'index'])->name('collections.index');
        Route::get('/collections/{collection}', [App\Http\Controllers\CollectionController::class, 'show'])->name('collections.show');
        Route::get('/collections/{collection}/edit', [App\Http\Controllers\CollectionController::class, 'edit'])
            ->middleware('permission:collections.edit')->name('collections.edit');
        Route::get('/collections/create', [App\Http\Controllers\CollectionController::class, 'create'])
            ->middleware('permission:collections.create')->name('collections.create');
        Route::post('/collections', [App\Http\Controllers\CollectionController::class, 'store'])
            ->middleware('permission:collections.create')->name('collections.store');
        Route::put('/collections/{collection}', [App\Http\Controllers\CollectionController::class, 'update'])
            ->middleware('permission:collections.edit')->name('collections.update');
        Route::delete('/collections/{collection}', [App\Http\Controllers\CollectionController::class, 'destroy'])
            ->middleware('permission:collections.delete')->name('collections.destroy');
        Route::post('/collections/bulk-delete', [App\Http\Controllers\CollectionController::class, 'bulkDelete'])
            ->middleware('permission:collections.delete')->name('collections.bulk-delete');
    });

    // Events Routes
    Route::middleware('permission:events.view')->group(function () {
        Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
        Route::get('/events/calendar', [App\Http\Controllers\EventController::class, 'calendar'])->name('events.calendar');
        Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
        Route::get('/events/{event}/edit', [App\Http\Controllers\EventController::class, 'edit'])
            ->middleware('permission:events.edit')->name('events.edit');
        Route::get('/events/create', [App\Http\Controllers\EventController::class, 'create'])
            ->middleware('permission:events.create')->name('events.create');
        Route::post('/events', [App\Http\Controllers\EventController::class, 'store'])
            ->middleware('permission:events.create')->name('events.store');
        Route::put('/events/{event}', [App\Http\Controllers\EventController::class, 'update'])
            ->middleware('permission:events.edit')->name('events.update');
        Route::delete('/events/{event}', [App\Http\Controllers\EventController::class, 'destroy'])
            ->middleware('permission:events.delete')->name('events.destroy');
        Route::post('/events/bulk-delete', [App\Http\Controllers\EventController::class, 'bulkDelete'])
            ->middleware('permission:events.delete')->name('events.bulk-delete');
    });

    // Transactions Routes
    Route::middleware('permission:transactions.view')->group(function () {
        Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{transaction}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');
        Route::get('/transactions/{transaction}/edit', [App\Http\Controllers\TransactionController::class, 'edit'])
            ->middleware('permission:transactions.edit')->name('transactions.edit');
        Route::get('/transactions/create', [App\Http\Controllers\TransactionController::class, 'create'])
            ->middleware('permission:transactions.create')->name('transactions.create');
        Route::post('/transactions', [App\Http\Controllers\TransactionController::class, 'store'])
            ->middleware('permission:transactions.create')->name('transactions.store');
        Route::put('/transactions/{transaction}', [App\Http\Controllers\TransactionController::class, 'update'])
            ->middleware('permission:transactions.edit')->name('transactions.update');
        Route::delete('/transactions/{transaction}', [App\Http\Controllers\TransactionController::class, 'destroy'])
            ->middleware('permission:transactions.delete')->name('transactions.destroy');
        Route::post('/transactions/bulk-delete', [App\Http\Controllers\TransactionController::class, 'bulkDelete'])
            ->middleware('permission:transactions.delete')->name('transactions.bulk-delete');
    });

    // Users Routes - Admin and Owner only
    Route::middleware('permission:users.view')->group(function () {
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])
            ->middleware('permission:users.edit')->name('users.edit');
        Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])
            ->middleware('permission:users.create')->name('users.create');
        Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])
            ->middleware('permission:users.create')->name('users.store');
        Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])
            ->middleware('permission:users.edit')->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])
            ->middleware('permission:users.delete')->name('users.destroy');
        Route::post('/users/bulk-delete', [App\Http\Controllers\UserController::class, 'bulkDelete'])
            ->middleware('permission:users.delete')->name('users.bulk-delete');
    });

    // Roles Routes - Admin only
    Route::middleware('permission:roles.view')->group(function () {
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/{role}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
        Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])
            ->middleware('permission:roles.edit')->name('roles.edit');
        Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])
            ->middleware('permission:roles.create')->name('roles.create');
        Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])
            ->middleware('permission:roles.create')->name('roles.store');
        Route::put('/roles/{role}', [App\Http\Controllers\RoleController::class, 'update'])
            ->middleware('permission:roles.edit')->name('roles.update');
        Route::delete('/roles/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])
            ->middleware('permission:roles.delete')->name('roles.destroy');
        Route::post('/roles/bulk-delete', [App\Http\Controllers\RoleController::class, 'bulkDelete'])
            ->middleware('permission:roles.delete')->name('roles.bulk-delete');
    });

    // Theme Settings - Admin only
    Route::middleware('permission:settings.view')->group(function () {
        Route::get('/theme-settings', [App\Http\Controllers\ThemeSettingsController::class, 'index'])->name('theme.settings');
        Route::post('/theme-settings', [App\Http\Controllers\ThemeSettingsController::class, 'update'])
            ->middleware('permission:settings.edit')->name('theme.settings.update');
    });
});
