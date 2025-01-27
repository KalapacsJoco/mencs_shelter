<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = ['name'];

    /**
     * Many to many relation between Hostel and Tag resource
     * @return BelongsToMany
     */

    public function hostels(): BelongsToMany
    {
        return $this->belongsToMany(Hostel::class, 'hostel_tag');
    }
}
