<?php

use Illuminate\Support\Facades\Route;
use App\Models\Brand;
use App\Models\Manual;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ManualVisitorsController;

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

/*
2017-10-30 setup for urls
Home:			/
Brand:			/52/AEG/
Type:			/52/AEG/53/Superdeluxe/
Manual:			/52/AEG/53/Superdeluxe/8023/manual/
				/52/AEG/456/Testhandle/8023/manual/

If we want to add product categories later:
Productcat:		/category/12/Computers/
*/

// Homepage met populaire handleidingen
Route::get('/', function () {
    // Alle merken
    $brands = Brand::all()->sortBy('name');

    // Alle handleidingen, gesorteerd op bezoekersaantallen
    $manuals = Manual::leftJoin('visitors_manual', 'manuals.name', '=', 'visitors_manual.name_manual')
        ->select('manuals.*')
        ->orderByDesc('visitors_manual.visitors_count')
        ->get();

    return view('pages.homepage', compact('brands', 'manuals'));
})->name('home');

// Brand redirect
Route::get('/manual/{language}/{brand_slug}/', [RedirectController::class, 'brand']);
Route::get('/manual/{language}/{brand_slug}/brand.html', [RedirectController::class, 'brand']);

// Datafeeds
Route::get('/datafeeds/{brand_slug}.xml', [RedirectController::class, 'datafeed']);

// Contactpagina
Route::get('/contact/', function () {
    return view('pages.contactpage');
})->name('contact');

// Locale routes
Route::get('/language/{language_slug}/', [LocaleController::class, 'changeLocale']);

// Overzicht van categorieën
Route::get('/categories', [BrandController::class, 'showCategories'])->name('categories');

// List of manuals for a brand
Route::get('/{brand_id}/{brand_slug}/', [BrandController::class, 'show']);

// Detail page for a manual
Route::get('/{brand_id}/{brand_slug}/{manual_id}/', [ManualController::class, 'show']);

// Generate sitemaps
Route::get('/generateSitemap/', [SitemapController::class, 'generate']);

// Testpagina
Route::get('/test', function () {
    return view('pages.test', [
        'name' => 'güzin',
        'age' => 18,
        'city' => 'Dongen',
        'favColor' => 'groen',
        'hobby' => 'coderen'
    ]);
});
