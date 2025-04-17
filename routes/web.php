<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    return view('job-matching.chat');
})->name('chat');

Route::get('/chat/company', function () {
    return view('job-matching.companychat');
})->name('chat_company');

Route::get('/bookmark', function () {
    return view('job-matching.bookmark');
})->name('bookmark');
