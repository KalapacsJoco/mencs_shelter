<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hostel extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'description',
        'city',
        'street',
        'phone_number',
        'email',
        'schedule'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'schedule' => 'array',
    ];

    /**
     * Every Hostel could have more tags, therefore ther is a Many to Many relationship between them
     * @return BelongRoMany
     */

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'hostel_tag');
    }

    /**
     * Every Hostel has pictures, using polymorph relationship
     * @return MorphMany
     */

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
