<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Species extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = ['name'];

    /**
     * Get the animals that belongs to this species
     * @return HasMany
     */

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    /**
     * Every species could have many breeds
     * @return HasMany
     */

    public function breeds(): HasMany
    {
        return $this->hasMany(Breed::class);
    }
}
