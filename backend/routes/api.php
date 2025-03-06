<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, 'test']);

Route::post('/campaigns', [CampaignController::class, 'createCampaign']);