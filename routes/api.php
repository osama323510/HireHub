<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OfferControler;
use App\Http\Controllers\AuthControler;
use App\Http\Controllers\OwnerControler;


route::post('/UpdateProfile',[FreelancerController::class,'update'])->middleware('auth:sanctum');
Route::post('/login', [AuthControler::class, 'login']);





route::get('/posts', [PostController::class, 'index']);

route::get('/post/{id}',[PostController::class, 'show']);

Route::middleware(['auth:sanctum','is_client'])->group(function () {
    route::post('/CreatPost',[PostController::class,'create']);
});



route::get('/freelancers', [FreelancerController::class, 'info']); 
route::get('/freelancer/{id}', [FreelancerController::class, 'infoWithId']); 






Route::middleware(['auth:sanctum','is_freelancer'])->group(function () {
    
    route::post('/CreateOffer',[OfferControler::class,'create']);
});

route::get('/accept/{id}',[OfferControler::class,'accept']);
route::get('/Reject/{id}',[OfferControler::class,'Reject']);


route::get('/offer/{id}',[OfferControler::class,'show']);


route::get('/Panel',[OwnerControler::class, 'Panel']);












		// "post_id":1,
		// "offer_price":500,
		// "description":"sdasasdsadasdasdasdasdasdasd",
		// "days":5
	

        // 	"email":"schuppe.jaron@example.com",
		// "password":"password"

// {
//     "title": "Build a Laravel Backend for HireHub App",
//     "description": "I need an experienced backend developer to build a robust API for a freelancer marketplace. The project includes authentication, post management, and notification systems using Laravel 11.",
//     "budget": "fixed",
//     "price": 500.50,
//     "deadline": "2026-05-20",
//     "tags": [1, 5, 1]
// }

