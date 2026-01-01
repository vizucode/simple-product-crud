<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Products\Index::class)->name('products.index');
