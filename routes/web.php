<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {

    $user = Auth::user();

    $filteredFolder = DB::table('folders')->where('user_id', '=', $user->id)->get();

    return view('dashboard', ['folders' => $filteredFolder]);
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/files', function () {
        return view('files');
    })->middleware(['auth', 'verified'])->name('files');


    //Create new folder 
    Route::post('/new_folder', [FolderController::class, 'store'])->name('add_product')->middleware(['auth', 'verified'])->name('files');;
});

require __DIR__ . '/auth.php';
