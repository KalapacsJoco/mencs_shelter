<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * This class defines the Vet`s Service model
 */

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $fillable = [
        'name'
    ];

    /**
     * This function defines the relation between Vet and Service. A Vet can have many services
     */

    public function vets(): HasMany
    {
        return $this->hasMany(Vet::class);
    }
}
