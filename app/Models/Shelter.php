<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Shelter extends Model
{
    protected $fillable = ['name', 'adress', 'phone_number', 'email', 'description'];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
