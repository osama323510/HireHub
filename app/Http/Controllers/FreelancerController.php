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


use App\Models\Freelancer ;
use App\Services\Frelancer\ChangeStatusService;
use GrahamCampbell\ResultType\Success;

class FreelancerController extends Controller
{
    
    public function info(FreelancerService $servie)
    {
        $freelancers = $servie->getFreelancerInfo();
        return FreelancerResource::collection($freelancers);
    }
    

    public function infoWithId($id,FreelancerWithIdService $service)
    {

        $result=$service->infoWithId($id);
        return new ShowFreelancerResource($result);
    }


    public function update(UpdateFreelancerRequest $request,UpdateFreelancerService $service)
    {
        $result=$service->update($request->validated());
        return  new ShowFreelancerResource($result);
    }


    
}
