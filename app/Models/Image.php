<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'path'
    ];

    /**
     * Since multiple models have pictures, polimorphic one to many relations is used
     * @return MorphTo
     */

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
