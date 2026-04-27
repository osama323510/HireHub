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

class OfferController extends Controller
{



    public function show($id,OfferService $service)
    {

        $offer=$service->getOfferById($id);
        return new OfferResource($offer);
    }

    
    public function create(CreateOfferRequest $request,CreateOfferService $service)
    {

        $result = $service->create($request->validated()); 
        return new OfferResource($result);
    }



    public function accept($id, AcceptOfferService $service)
    {
        $result = $service->handleAccept($id);
        if (!$result) {
            return response()->json(['message' =>$result], 500);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'the offer is accepted',
        ]);
    }


    public function Reject($id, RejectOfferService $service)
    {
        $result = $service->handleReject($id);

        if (!$result) {
            return response()->json(['message' =>$result], 500);
        }

        return response()->json([
            'status'  => 'success',
            'message' =>"the offer is Rejected "
        ]);
    }
}


