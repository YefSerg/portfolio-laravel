<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

/**
 * @method static create(mixed $data)
 */
class Category extends Model
{
    use HasFactory;
    use RefreshDatabase;

    protected $table = 'categories';

    protected $guarded = false;

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::ucfirst($value),
        );
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
