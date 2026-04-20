<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Offer\OfferService;
use App\Http\Resources\Offer\OfferResource;
use App\Http\Requests\Offer\CreateOfferRequest;
use App\Services\Offer\CreateOfferService;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Services\Offer\AcceptOfferService;
use App\Services\Offer\RejectOfferService;

class OfferControler extends Controller
{



    public function show(Request $request,OfferService $service)
    {

        $offer=$service->getOfferById($request->id);
        return new OfferResource($offer);
    }

    
    public function create(CreateOfferRequest $request,CreateOfferService $service)
    {

        $result = $service->create($request->validated()); 
        return new OfferResource($result);
    }



    public function accept(Request $request, AcceptOfferService $service)
    {
        $result = $service->handleAccept($request->id);
        if (!$result) {
            return response()->json(['message' => 'failed to accept'], 500);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'the offer is accepted',
        ]);
    }


    public function Reject(Request $request, RejectOfferService $service)
    {
        $result = $service->handleReject($request->id);

        if (!$result) {
            return response()->json(['message' => 'failed to Reject'], 500);
        }

        return response()->json([
            'status'  => 'success',
            'message' =>"the offer is Rejected "
        ]);
    }
}


