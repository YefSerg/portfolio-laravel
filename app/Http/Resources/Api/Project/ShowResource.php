<?php

namespace App\Http\Resources\Api\Project;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property Category $category
 * @property Carbon $created_at
 * @method isLike()
 */
class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'category' => new \App\Http\Resources\Api\Category\MainResource($this->category),
            'is_like' => $this->isLike(),
            'created_at' => $this->created_at->timestamp,
        ];
    }
}
