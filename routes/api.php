<?php

use App\Http\Controllers\API\V1\CompaniesController;
use App\Http\Controllers\API\V1\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {

    Route::middleware('auth:sanctum')->group(function() {

        Route::apiResource('companies', CompaniesController::class);
        Route::get('companies/{company}/contacts', [CompaniesController::class, 'contacts']);

        Route::apiResource('contacts', ContactsController::class);
        Route::post('contacts/{contact}/note', [ContactsController::class, 'addNote']);
        Route::get('collection/contacts', [ContactsController::class, 'collection']);

        // Route::prefix('contacts')
        // ->as('contacts')
        // ->group(function () {
        //     Route::get('/{contact}', [ContactsController::class, 'show']);
        //     Route::post('/', [ContactsController::class, 'store']);
        // });
    });
});
