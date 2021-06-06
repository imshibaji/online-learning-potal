<?php

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Teacher\Entities\Teacher;

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

// Route::middleware('auth:api')->get('/teacher', function (Request $request) {
//     return $request->user();
// });

Route::domain('teacher.larnr.com')->group(function() {
    Route::get('/', function(){
        return ['message' =>'Teacher APIs'];
    });

    // Route::get('/email', function(){
    //     return view('teacher::emails.article', [
    //         'article'=> Article::find(5),
    //         'user' => Auth::user()
    //     ]);
    // });
});
