<?php

namespace App\Http\Controllers;
use App\Services\Freelancer\FreelancerService;
use App\Http\Resources\Freelancer\FreelancerResource;
use App\Http\Resources\Freelancer\ShowFreelancerResource;
use Illuminate\Http\Request;
use App\Services\Freelancer\UpdateFreelancerService;
use App\Services\Freelancer\FreelancerWithIdService;
use App\Http\Requests\Freelancer\FreelancerFilterterRequest;
use App\Http\Requests\Freelancer\UpdateFreelancerRequest;

class FreelancerController extends Controller
{
    
    public function info(FreelancerFilterterRequest $request,FreelancerService $servie)
    {
        $freelancers = $servie->getFreelancerInfo($request->validated());
        return FreelancerResource::collection($freelancers);
    }
    

    public function infoWithId(Request $request,FreelancerWithIdService $service)
    {

        $result=$service->infoWithId($request->id);
        return new ShowFreelancerResource($result);
    }

    public function update(UpdateFreelancerRequest $request,UpdateFreelancerService $service)
    {
        $result=$service->update($request->validated());
        return  new ShowFreelancerResource($result);
    }


    
}
