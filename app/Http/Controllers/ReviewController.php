<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\CreateReviewRequest;
use App\Jobs\FreelancerRating;
use App\Models\Freelancer;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\Review\CreateReviewService;

class ReviewController extends Controller
{
    
public function newcomment(CreateReviewRequest $request,CreateReviewService $service)
{
    $result=$service->create($request->validated());
    if($result)
    return response()->json(['message' => 'Success']);
    else 
    return  response()->json(['message' => 'fail']);
}
}

