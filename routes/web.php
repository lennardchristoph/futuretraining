<?php

use Illuminate\Support\Facades\App;
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

Route::get('/', function () {

});

    Route::group(['prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function () {

        Auth::routes();

        Route::group(['middleware' => 'auth'], function () {

        Route::prefix('athleteviews')->group(function () {
            Route::get('list', 'App\Http\Controllers\athleteController@indexAthleteList')->name('athleteList');
            Route::get('add', 'App\Http\Controllers\athleteController@indexAthleteAddSingle')->name('athleteAdd');
        });

        Route::prefix('nutritionplan')->group(function () {
            Route::prefix('ingredients')->group(function () {
                Route::get('list', 'App\Http\Controllers\nutritionController@indexIngredientList')->name('ingredientList');
                Route::get('add', 'App\Http\Controllers\nutritionController@indexIngredientAddSingle')->name('ingredientAdd');
                Route::get('upload', 'App\Http\Controllers\nutritionController@indexIngredientAddMany')->name('ingredientUpload');
                Route::post('uploadIngs', 'App\Http\Controllers\nutritionController@ingredientsAddMany')->name('ingredientsAddMany');
            });
            Route::prefix('meals')->group(function () {
                Route::get('list', 'App\Http\Controllers\nutritionController@indexMealList')->name('mealList');
                Route::get('add', 'App\Http\Controllers\nutritionController@indexMealAddSingle')->name('mealAdd');
                Route::get('addMany', function () {
                    return view('');
                });
            });
            Route::prefix('plans')->group(function () {
                Route::get('list', 'App\Http\Controllers\nutritionController@indexPlanList')->name('planList');
                Route::get('add', 'App\Http\Controllers\nutritionController@indexPlanAddSingle')->name('planAdd');
            });
        });
        Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        Route::get('upgrade', function () {
            return view('pages.upgrade');
        })->name('upgrade');
        Route::get('map', function () {
            return view('pages.maps');
        })->name('map');
        Route::get('icons', function () {
            return view('pages.icons');
        })->name('icons');
        Route::get('table-list', function () {
            return view('pages.tables');
        })->name('table');
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
        Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
            Route::get('/', function () {
                return view('welcome');
            });
    });
});


Route::group(['middleware' => 'auth'], function () {
});

Route::get('planPDF', 'App\Http\Controllers\PdfGenerateController@planPdfView')->name('planPDF');