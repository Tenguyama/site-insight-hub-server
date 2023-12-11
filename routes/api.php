<?php

use App\Http\Controllers\Api\V1\AnalyticController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\ConnectController;
use App\Http\Controllers\Api\V1\SiteController;
use App\Http\Controllers\Api\V1\TargetController;
use App\Http\Controllers\Api\V1\VisitController;
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

Route::prefix('v1')
    ->name('v1')
    ->group(callback: function () {
        Route::middleware('auth:sanctum')->group(function () {
            //роути які мають працювати тільки якщо користувач авторизований,
            //щоб ніхто сторонній не міг натворити всякого з бд
            Route::post('/site', [SiteController::class, 'create'])
                ->name('site.create');
            Route::put('/site/{id}', [SiteController::class, 'update'])
                ->name('site.update')
                ->where('id', '[1-9][0-9]*');
            Route::delete('/site/{id}', [SiteController::class, 'delete'])
                ->name('site.delete')
                ->where('id', '[1-9][0-9]*');

            Route::get('/site/{id}/clients', [SiteController::class, 'getSiteClients'])
                ->name('site.getSiteTargets')
                ->where('id', '[1-9][0-9]*');
            Route::get('/site/{id}/visits', [SiteController::class, 'getSiteVisits'])
                ->name('site.getSiteVisits')
                ->where('id', '[1-9][0-9]*');
            Route::get('/site/{id}/analytics', [SiteController::class, 'getSiteAnalytics'])
                ->name('site.getSiteAnalytics')
                ->where('id', '[1-9][0-9]*');

            Route::post('/search-code', [ConnectController::class, 'searchCode'])
                ->name('connect.searchCode');

            Route::get('/target/{id}', [TargetController::class, 'getById'])
                ->name('target.getById')
                ->where('id', '[1-9][0-9]*');
            Route::post('/target', [TargetController::class, 'create'])
                ->name('target.create');
            Route::put('/target/{id}', [TargetController::class, 'update'])
                ->name('target.update')
                ->where('id', '[1-9][0-9]*');
            Route::delete('/target/{id}', [TargetController::class, 'delete'])
                ->name('target.delete')
                ->where('id', '[1-9][0-9]*');
        });

        //інші роути де не треба авторизованого користувача (ті які я буду колити з versatile.js)
        //типу він ж буде обробляти певні події на сайті клієнта, тому я там ніяк не захищу роутинг
        //хіба якось десь передавати токен туди, але я поки не придумав як це зробити так,
        //щоб ніхто лівий цей токен не міг дістати.
        Route::get('/site/{id}/targets', [SiteController::class, 'getSiteTargets'])
            ->name('site.getSiteTargets')
            ->where('id', '[1-9][0-9]*');

        Route::post('/site/by-url-page', [SiteController::class, 'getSiteByUrlPage'])
            ->name('site.getSiteByUrlPage');

        Route::post('/analytic', [AnalyticController::class, 'create'])
            ->name('analytic.create');
        Route::post('/visit', [VisitController::class, 'create'])
            ->name('visit.create');
        Route::post('/client', [ClientController::class, 'save'])
            ->name('client.save');
    });
