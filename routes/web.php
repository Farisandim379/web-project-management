<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/projects', 'project.index')->name('projects.index');
    Route::livewire('/projects/{project}', 'project.show')->name('projects.show');
    Route::livewire('/members', 'member.index')->name('members.index');

});

require __DIR__.'/settings.php';
