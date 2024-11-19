<?php

use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\Users\DeliveryAgentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->controller(UserAuthController::class)->group(function () {
    // تسجيل المستخدم
    Route::post('/register', 'register')->middleware('guest:sanctum');


    // تسجيل الدخول
    Route::post('/login', 'login')->middleware('guest:sanctum');

    Route::post('/logout', 'logout')->middleware('auth:sanctum');
    // تسجيل الخروج


});


Route::prefix('/delevery-agent')->controller(DeliveryAgentController::class)->group(function () {
    // إضافة مندوب جديد
    Route::post('/add', 'createAgent')->middleware('auth:sanctum', 'isUser');


});