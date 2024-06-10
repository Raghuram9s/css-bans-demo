<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\Rcon\RconController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\VIP\VIPController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BansController;
use App\Http\Controllers\K4Ranks\RanksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MutesController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [DashboardController::class, 'home'])->name('home');

