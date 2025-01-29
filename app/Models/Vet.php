<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * This class defines the Vet model
 */

class Vet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $fillable = [
        'phone_number',
        'email'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

     /**
      * This function creates a oneToMany relation between schedules and doctors. 
      * A doctor can hane many schedules, for example, he can start on monday at 9:00 and tuesday on 10:00
      */

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * This function creates a many to many relationship between vets and services. A doctor can have many services
     */

    public function services(): BelongsToMany 
    {
        return $this->belongsToMany(Service::class);
    }

        /**
     * Every Vet has pictures, using polymorph relationship
     * @return MorphMany
     */

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
