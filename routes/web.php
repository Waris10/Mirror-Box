<?php

use App\Livewire\DeviceConnection;
use App\Livewire\MirrorControls;
use Illuminate\Support\Facades\Route;



Route::get('/', MirrorControls::class)->name('mirror-controls');
Route::get('/addDeviceThroughWiFi', DeviceConnection::class)->name('addDeviceThroughWiFi');
