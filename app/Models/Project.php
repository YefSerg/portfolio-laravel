<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property string $image
 * @property Collection $reviews
 */
class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'projects';

    protected $guarded = false;

    protected $with = ['category'];

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::ucfirst($value),
        );
    }

    protected function shortDescription(int $limit = 200): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => Str::limit($attributes['description'], $limit),
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(PolyReview::class, 'reviewable');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user_likes');
    }

    public function isLike(): bool
    {
        $userId = auth()->id();
        if ($userId) {
            return $this->likes()->where('user_id', $userId)->exists();
        }

        return false;
    }
}
