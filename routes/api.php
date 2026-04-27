<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ReviewController;


Route::post('/login', [AuthController::class, 'login']);



Route::middleware(['auth:sanctum','is_client'])->group(function () {

    route::post('/CreatPost',[PostController::class,'create']);

	route::get('/accept/{id}',[OfferController::class,'accept']);

	route::get('/Reject/{id}',[OfferController::class,'Reject']);
});


Route::middleware(['auth:sanctum','is_freelancer'])->group(function () {
    
    route::post('/CreateOffer',[OfferController::class,'create']);

	route::post('/UpdateProfile',[FreelancerController::class,'update'])->middleware('auth:sanctum');

});


Route::middleware('auth:sanctum')->group(function () {
		
	route::get('/freelancers', [FreelancerController::class, 'info']); 

	route::get('/freelancer/{id}', [FreelancerController::class, 'infoWithId']); 

	route::get('/posts', [PostController::class, 'index']);

	route::get('/post/{id}',[PostController::class, 'show']);

	route::get('/offer/{id}',[OfferController::class,'show']);

	route::post('/createreview',[ReviewController::class,'newcomment']);

	route::get('/Panel',[OwnerController::class, 'Panel']);


});









