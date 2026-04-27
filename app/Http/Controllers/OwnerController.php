<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Owner\OwnerResource;
use App\Services\Owner\OwnerService;

class OwnerController extends Controller
{
    
    public function Panel(OwnerService $service)
    {
        $owner=$service->getData();
        return new OwnerResource($owner);
    }
}
