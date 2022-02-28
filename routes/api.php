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


/***
 * V1 API routes
 */
Route::prefix('v1')->group(function() {
    Route::middleware('auth:sanctum')->group(function() {
        /***
         * Company Routes
         */
        Route::get('companies/{company}/contacts', [CompaniesController::class, 'contacts']);
        Route::put('companies/{company}/contacts', [CompaniesController::class, 'storeContacts']);
        Route::apiResource('companies', CompaniesController::class);

        /***
         * Contact Routes
         */
        Route::get('contacts/collection', [ContactsController::class, 'collection']);
        Route::put('contacts/{contact}/note', [ContactsController::class, 'addNote']);
        Route::apiResource('contacts', ContactsController::class);
    });
});
