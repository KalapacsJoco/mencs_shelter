<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Shelter extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'city',
        'street',
        'phone_number',
        'email',
        'description'
    ];

    /**
     * Every Shelter has many Animals
     * @return HasMany
     */

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

        /**
     * Every Shelter has pictures, using polymorph relationship
     * @return MorphMany
     */

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
