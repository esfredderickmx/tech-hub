<?php

use App\Http\Controllers\AuthenticationController;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
  Volt::route('/sign-in', 'authentication.sign-in')->name('login');
  Volt::route('/sign-up', 'authentication.sign-up')->name('auth.sign-up');
});

Route::middleware('auth')->group(function () {
  Route::get('/sign-out', [AuthenticationController::class, 'signOut'])->name('auth.sign-out');

  Volt::route('/', 'pages.home')->name('index');
  Volt::route('/home', 'pages.home')->name('home');

  Route::prefix('/admin')->group(function () {
    Volt::route('/customers', 'admin.customers.customers')->name('admin.customers');
    Volt::route('/employees', 'admin.employees.employees')->name('admin.employees');
    Volt::route('/providers', 'admin.providers.providers')->name('admin.providers');
    Volt::route('/products', 'admin.products.products')->name('admin.products');
  });
});
