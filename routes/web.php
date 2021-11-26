<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;

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
    return view('app');
});

Route::get('/answer_show', function () {
    return view('app')->name('answer_show');
});

//これで確認画面に到達する
Route::get('/answer_show/{share_id}', function (Request $request) {
    if (!$request->hasValidSignature()) {
        abort(401);
    }
    return view('app');
})->name('answer_show');

Route::get('/get_all_questions', [QuestionController::class, 'getAll']);
