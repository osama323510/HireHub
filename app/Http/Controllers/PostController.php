<?php

namespace App\Http\Controllers;
use App\Services\Post\PostService;
use Illuminate\Http\Request;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\ShowPostResource;
use App\Http\Requests\Post\CreatePostRequest;
use App\Services\Post\CreatePostService;
use App\Services\Post\ShowPostService;
use App\Rules\ForbiddenWords;
use App\Http\Requests\Post\PostFilterterRequest;


class PostController extends Controller
{


    public function index(PostFilterterRequest $request,PostService $service)
    {
        $posts = $service->getAll($request->validated());
        return PostResource::collection($posts);
    }


    public function create(CreatePostRequest $request,CreatePostService $service)
    {
        $result = $service->create($request->validated());
        return new PostResource($result);
    }


    public function show(Request $request,ShowPostService $service)
    {
        $result = $service->show($request->id);
        if(!$result)
        {
            return response()->json([
                'message'=>"no post with this id"
            ]);
        }
        return new ShowPostResource($result);
    }
}
