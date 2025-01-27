<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Animal extends Model
{
    protected $fillable = ['name', 'age', 'color', 'sex', 'status', 'vaccines', 'message', 'shelter_id', 'species_id', 'breed_id'];

    protected $casts = [
        'vaccines' => 'array',
        'sex' => 'string',
        'status' => 'string',
    ];

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
