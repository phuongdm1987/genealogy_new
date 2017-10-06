<?php

namespace Genealogy\Hocs\Marriages;

use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['started_at', 'ended_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'husband_id', 'wife_id', 'started_at', 'eneded_at'
    ];
}
