<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Vet extends Model
{
    protected $fillable = ['services', 'shedule', 'phone_number', 'email'];

    protected $casts = [
        'services' => 'array',
        'shedule' => 'array',
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
