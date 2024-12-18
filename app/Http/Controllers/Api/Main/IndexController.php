<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\PreviewResource;
use App\Models\PolyReview;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $sliderProjects = Project::query()->inRandomOrder()->take(6)->get();

        $mostPopularProjects = Project::query()
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(4)
            ->get();

        $lastProjects = Project::query()->orderBy('created_at', 'desc')->limit(3)->get();

        $lastReviews = PolyReview::query()
            ->where('reviewable_type', Project::class)
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        return response()->json([
            'sliderProjects' => PreviewResource::collection($sliderProjects),
            'mostPopularProjects' => PreviewResource::collection($mostPopularProjects),
            'lastProjects' => PreviewResource::collection($lastProjects),
            'lastReviews' => \App\Http\Resources\Api\Project\Review\PreviewResource::collection($lastReviews),
        ]);
    }
}
