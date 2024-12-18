<?php

namespace App\Http\Resources\Api\Project\Review;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $text
 * @property User $user
 * @property Carbon $created_at
 * @property int $reviewable_id
 */
class PreviewResource extends JsonResource
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
            'text' => $this->text,
            'user' => \App\Http\Resources\Api\User\MainResource::make($this->user),
            'project_id' => $this->reviewable_id,
            'created_at' => $this->created_at,
        ];
    }
}
