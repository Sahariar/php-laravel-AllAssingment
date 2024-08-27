<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('project.index');
Route::get('/projects/{id}', [PortfolioController::class, 'projectDetails'])->name('project.detail');
