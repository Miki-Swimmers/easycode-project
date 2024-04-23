<?php

use Illuminate\Support\Facades\Route;

Route::view('/{uri?}', 'welcome')->where('uri', '.*');
