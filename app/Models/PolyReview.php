<?php

namespace App\Models;

use Database\Factories\PolyReviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PolyReview extends Model
{
    /** @use HasFactory<PolyReviewFactory> */
    use HasFactory;

    protected $table = 'poly_reviews';

    protected $guarded = false;

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
