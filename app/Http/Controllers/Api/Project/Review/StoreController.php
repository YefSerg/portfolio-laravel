<?php

namespace App\Http\Controllers\Api\Project\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Project\Review\StoreRequest;
use App\Http\Resources\Api\Project\Review\MainResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, Project $project): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $review = $project->reviews()->create($data);

        return response()->json(MainResource::make($review), Response::HTTP_CREATED);
    }
}
