<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * This class defines the Schedule model
 */

class Schedule extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */
    protected $fillable = [
        'vet_id',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    /**
     * This function defines the relation between Vet and Schedule. A schedule belong to a doctor
     */

    public function vet(): BelongsTo
    {
        return $this->belongsTo(Vet::class);
    }
}
