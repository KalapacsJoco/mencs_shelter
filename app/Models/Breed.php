<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Breed extends Model
{

        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable =[
        'name',
        'species_id'
    ];

    /**
     * Every Breed belongs to a Species
     * @return BelongsTo
     */

    public function species (): BelongsTo {
       return $this->belongsTo(Species::class);
    }

    /**
     * Every Breed belong to an Animal
     * @return HasMany
     */

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
