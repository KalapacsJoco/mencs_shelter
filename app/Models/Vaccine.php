<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vaccine extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

     protected $fillable =['name'];

    /**
     * Many to many relation between Vaccine and Animal
     */

    public function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class, 'animal_vaccine');
    }
}