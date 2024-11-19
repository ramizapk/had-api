<?php


use App\Http\Controllers\Api\Customers\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\CustomerAuthController;

Route::prefix('/auth')->controller(CustomerAuthController::class)->group(function () {
    Route::post('/login', 'login')->middleware('guest:sanctum');
    Route::post('/register', 'register')->middleware('guest:sanctum');
    Route::post('/verify-verification-code', 'verifyVerificationCode')->middleware('guest:sanctum');
    Route::post('/resend-verification-code', 'resendVerificationCode')->middleware('auth:sanctum', 'isCustomer');
    Route::post('/set-password', 'setPassword')->middleware('auth:sanctum', 'isCustomer');
    Route::post('/logout', 'logout')->middleware('auth:sanctum', 'isCustomer');
});

Route::prefix('addresses')->controller(AddressController::class)->group(function () {
    // إضافة عنوان جديد
    Route::post('/add', 'handleAddress')->middleware('auth:sanctum', 'isCustomer');

    // عرض جميع العناوين الخاصة بالعميل
    Route::get('/get', 'handleAddress')->middleware('auth:sanctum', 'isCustomer');

    // تعديل العنوان
    Route::put('update/{addressId}', 'handleAddress')->middleware('auth:sanctum', 'isCustomer');

    // حذف العنوان
    Route::delete('remove/{addressId}', 'handleAddress')->middleware('auth:sanctum', 'isCustomer');

    // تعيين العنوان الافتراضي
    Route::patch('setDefault/{addressId}', 'handleAddress')->middleware('auth:sanctum', 'isCustomer');
});