<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Animal extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'age',
        'color',
        'sex',
        'status',
        'vaccines',
        'message',
        'shelter_id',
        'species_id',
        'breed_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'vaccines' => 'array',
        'sex' => 'string',
        'status' => 'string',
    ];

    /**
     * Every Animal belongs to a Shelter
     * @return BelongsTo
     */

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }

    /**
     * Every Animal belongs to a Species
     * @return BelongsTo
     */

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    /**
     * Every Animal belongs to a Breed
     * @return BelongsTo
     */

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    /**
     * Every Animal has pictures, using polymorph relationship
     * @return MorphMany
     */

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
